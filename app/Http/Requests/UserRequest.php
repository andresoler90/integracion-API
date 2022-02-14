<?php namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $request = request();
        if (strpos(url()->previous(), "edit"))
        {
            $usVal = 1;
            if (isset($request->id))
                $usVal = User::where('email', $request->email)->where('id', '!=', $request->id)->count();
        }
        else
            $usVal = User::where('email', $request->email)->count();
        if ($usVal)
            $rules = ['email' => 'mimes:xls'];
        else
        {
            $rules = [
                'name' => 'required',
                'email' => 'required|email:rfc,dns',
            ];
            if (strpos(url()->previous(), "edit"))
                $rules = array_merge($rules, ['id' => 'required|numeric']);
        }
        return $rules;
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.mimes' => __('Usuario existente, por favor modificarlo'),
            'email.required' => __('Por favor completar el campo de usuario'),
            'email.email' => __('El campo de email no es correcto'),
            'name.required' => __('Por favor completar el campo de nombre'),
            'id.required' => __('Error al obtener el usuario'),
            'id.numeric' => __('Error al obtener el usuario'),
        ];
    }
}

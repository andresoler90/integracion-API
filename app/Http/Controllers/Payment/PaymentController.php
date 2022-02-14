<?php namespace App\Http\Controllers\Payment;

use App\Http\Core\EpaycoConfirmation;
use App\Http\Core\ManagementPayment;
use App\Payment\Paym5Relation;
use App\Traits\Payments\PaymentManagement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MongoDB\Driver\Session;

class PaymentController
{
    private $management;
    private $managementEpayco;

    /**
     * PaymentController constructor.
     */
    public function __construct()
    {
        $this->management = new ManagementPayment();
        $this->managementEpayco = new EpaycoConfirmation();
    }

    /**
     * @sum: Vista inicial del portal de pagos
     * @date 29/03/2021
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('payment.pages.index');
    }

    /**
     * @sum: Testeo de pagos
     * @date 29/03/2021
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function test()
    {
        return view('payment.pages.test');
    }

    public function composerData($param = false)
    {
        $data = $this->management->getComposerData($param);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = (array)$this->management->startObject();
        $additionalData = $this->composerData();
        return view('payment.pages.create',compact('data','additionalData'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try
        {

            $this->management->createConfig($request);
            \Alert::success(__("Registro exitoso"));
            return redirect(route('payment.config'));

        }catch (\Exception $exception)
        {
            if (config('app.debug'))
                throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($paym5_id)
    {
        $data = (array)$this->management->startObject();
        $additionalData = $this->composerData();
        $data = $this->management->getPaymData($paym5_id);
        return view('payment.pages.edit',compact('data','additionalData'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        try
        {
            #Envia datos para la edición
            if($this->management->updateConfig($request))
            {
                #Respuesta
                \Alert::success(__("Success"));
                return redirect(route('payment.config'));
            }else{
                \Alert::error(__("Error"));
                return back()->withInput();
            }

        }catch (\Exception $exception)
        {
            if (config('app.debug'))
                throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @sum: Vista inicial configurador de pagos
     * @date 29/03/2021
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function config()
    {
        $paginate = $this->management->getConfigData();
        return view('payment.pages.config',compact('paginate'));
    }

    /**
     * @date: 15/03/21
     * @sum: Se elimina registro de la configuracion.
     * @return Response
     */
    public function destroy(Request $request)
    {
        try
        {
            //Se elimina relacion con el proveedor
            $model = Paym5Relation::find($request["paym5_id"]);
            $model->delete();

            \Alert::success(__("Delete"));
            return back();

        }catch (\Exception $exception)
        {
            if (config('app.debug'))
                throw new \Exception($exception->getMessage(), $exception->getCode());

            \Alert::error(__("Ocurrió un error al momento de eliminar el registro"));
        }
    }


    /**
     * Pasos de pago
     */

    /**
     * @sum: Vista inicial del portal de pagos - primer-paso
     * @date 29/03/2021
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function firstStep()
    {
        return view('payment.pages.firstStep');
    }

    /**
     * @sum: Vista inicial del portal de pagos - segundo-paso
     * @date 29/03/2021
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function secondStep($product)
    {
        $additionalData = $this->composerData();
        return view('payment.pages.secondStep',compact('additionalData'));
    }

    /**
     * @sum: Vista inicial del portal de pagos - segundo-paso
     * @date 29/03/2021
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thirdStep()
    {
        $additionalData = $this->composerData(true);
        return view('payment.pages.thirdStep',compact('additionalData'));
    }

    /**
     * @sum: seteo de sesion info cliente y redireccion a paso 4 de pago
     * @date 29/03/2021
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function storeClient(Request $request)
    {
        try
        {
            $data = $this->management->storeClient($request);
            return view('payment.pages.fourStep',compact('data'));

        }catch (\Exception $exception)
        {
            if (config('app.debug'))
                throw new \Exception($exception->getMessage(), $exception->getCode());

            \Alert::error(__("Ocurrió un error porfavor comuniquese con el administrador"));
        }
    }

    /**
     * Epayco
     */

    /**
     * @sum: Retorno Epayco estado de transacción
     * @date 29/03/2021
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function response()
    {
        return view('payment.pages.response');
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function confirmation(Request $request)
    {
        //
        $data =  $this->managementEpayco->savePayment($request);
        return $data;
    }

    /**
     * Pasos de tipo ajax
     */
    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function getCountry(Request $request)
    {
        $data = $this->management->getCountry($request);
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function getSubProducts(Request $request)
    {
        $data = $this->management->getSubProducts($request);
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function getValue(Request $request)
    {
        $data = $this->management->getValue($request);
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function signature(Request $request)
    {
        $data = $this->management->generateSignature($request);
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function madePayment()
    {
        $data = $this->management->madePayment();
        return $data;
    }
}

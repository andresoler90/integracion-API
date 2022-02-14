<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
use Html;
use Response;

class FormPrototypeProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->componentForm();
    }

    /**
     * Components Form
     */
    private function componentForm(){

        /**
         * Campo tipo file
         * @param nameLabel => nombre del label
         * @param nameCamp  => nombre del campo
         * @param array($attributes) => atributos adicionales []
         */
        Form::component('bsFile','components.form.file',['nameLabel','nameCamp','attributes' => [], 'transArgs' => []]);

        /**
         * Campo tipo Fecha
         */
        Form::component('bsDate','components.form.date',['nameLabel','nameCamp','value' => null,'attributes' => []]);

        /**
         * Campo tipo Hora
         */
        Form::component('bsTime','components.form.time',['nameLabel','nameCamp','value' => null,'attributes' => []]);

        /**
         * Campo tipo Check
         */
        Form::component('bsCheckbox','components.form.checkbox',['nameLabel','nameCamp','value'=> null,'attributes' => []]);

        /**
         * Campo tipo password
         */
        Form::component('bsPassword','components.form.password',['nameLabel','nameCamp','attributes' => []]);

        /**
         * Campo tipo textarea
         */
        Form::component('bsTextarea','components.form.textarea',['name','nameCamp','value' => null,'attributes' => [], 'transArgs' => []]);

        /**
         * Campo tipo hidden
         */
        Form::component('bsHidden','components.form.hidden',['nameCamp','value' => null,'attributes' => []]);

        /**
         * Button
         */
        Form::component('bsButton','components.form.button',['name','attributes' => []]);

        /**
         * Submit
         */
        Form::component('bsSubmit','components.form.submit',['name','attributes' => []]);

        /**
         * Campo tipo Label
         */
        Form::component('bsLabel','components.form.label',['name','attributes' => []]);

        /**
         * Campo tipo radio
         */
        Form::component('bsRadio','components.form.radio',['nameLabel','nameCamp','value' => null,'attributes' => []]);

        /**
         * Campo tipo email
         */
        Form::component('bsEmail','components.form.email',['nameLabel','nameCamp','value' => null,'attributes' => [], 'transArgs' => []]);

        /**
         * Campo tipo number
         */
        Form::component('bsNumber'  ,'components.form.number',  ['nameLabel','nameCamp','value' => null,'attributes' => [], 'transArgs' => []]);

        /**
         * Campo tipo text
         */
        Form::component('bsText'    ,'components.form.text'  ,  ['nameLabel','nameCamp','value' => null,'attributes' => [], 'transArgs' => [], 'attrLabel' => []]);

        /**
         * Campo tipo select
         */
        Form::component('bsSelect'  ,'components.form.select',  ['nameLabel','nameCamp','value' => [],'selected','attributes' => [], 'transArgs' => []]);

        /**
         * Campo Data List
         */
        Form::component('bsDataList'  ,'components.form.dataList',  ['nameLabel','nameCamp','value' => [],'selected','attributes' => []]);

        /**
         * Campo tipo text con boton
         */
        Form::component('bsTextButton', 'components.form.textButton', ['nameLabel','nameCamp','value' => null,'attributes' => []]);

        /**
         * Campos con icon
         */
        Form::component('bsTextIcon', 'components.form.textIcon', ['nameLabel','nameCamp','iconVal','value' => null,'attributes' => []]);
        Form::component('bsNumberIcon', 'components.form.numberIcon', ['nameLabel','nameCamp','iconVal','value' => null,'attributes' => [], 'transArgs' => []]);
        Form::component('bsNumberRs', 'components.form.numberRs', ['nameLabel','nameCamp','value' => null,'attributes' => [], 'transArgs' => []]);
        Form::component('bsPasswordIcon', 'components.form.passwordIcon', ['nameLabel','nameCamp','iconVal','idChangePass','value' => null,'attributes' => [], 'transArgs' => []]);
        Form::component('bsPasswordIconPar', 'components.form.passwordIconPar', ['nameLabel','nameCamp','iconVal','idChangePass','value' => null,'attributes' => [], 'transArgs' => []]);

        Form::component('bsSelectIcon'  ,'components.form.selectIcon',  ['nameLabel','nameCamp','iconVal','value' => [],'selected','attributes' => [], 'transArgs' => []]);
        Form::component('bsSubmitIcon','components.form.submitIcon',['nameLabel','iconVal','attributes' => []]);

        /**
         * Campo tipo button con icon
         */
        Form::component('bsButtonIcon','components.form.buttonIcon',['icon','attributes' => []]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

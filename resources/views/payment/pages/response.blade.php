@extends('payment.layouts.master')
@section('content')
    <div class="row mb-5">
        <div class="col-xl-6 offset-3 bg-white box-shadow rounded">
            <div class="row">
                <div class="col-md-12">
                    <div class='row'>
                        <div class='col-lg-8 col-lg-offset-2'>
                            <h3 class="font-weight-bold payment-text-primary mt-3 mb-2">{{ __('Respuesta de la Transacción') }}</h3>
                            <hr>
                        </div>
                        <div class='col-lg-8 col-lg-offset-2' >
                            <div class='table-responsive'>
                                <table class='table table-bordered'>
                                    <tbody>
                                    <tr>
                                        <td>Referencia </td>
                                        <td id='referencia'> </td >
                                    </tr>
                                    <tr>
                                        <td class='bold'> Fecha </td>
                                        <td id='fecha' class=''>  < /td>
                                    </tr>
                                    <tr>
                                        <td> Respuesta < /td>
                                        <td id='respuesta'>  < /td>
                                    </tr>
                                    <tr>
                                        <td> Motivo < /td>
                                        <td id='motivo'>  </td>
                                    </tr>
                                    <tr>
                                        <td class='bold'> Banco </td>
                                        <td class=' id='banco'>
                                    </tr>
                                    <tr>
                                        <td class='bold'> Recibo </td>
                                        <td id='recibo'>  </td>
                                    </tr>
                                    <tr>
                                        <td class='bold'> Total </td>
                                        <td class='' id='total'></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
@stop

{{-- ESQUEMA DE CARGUE DE ESTILOS EN BLADES QUE EXTIENDAN DE ESTA --}}
@push('sectionStyles_layouts')
    <style>
    </style>
@endpush
{{-- ESQUEMA DE CARGUE DE JQUERY EXTIENDAN DE ESTA --}}
@push('sectionScripts_afterLoad')
<script>
    function getQueryParam(param)
    {
        location.search.substr(1)
            .split('&')
            .some(function(item) { // returns first occurence and stops
                return item.split('=')[0] == param && (param = item.split('=')[1])
            })
        return param
    }
    $(document).ready(function() {
        //llave publica del comercio
        //Referencia de payco que viene por url
        var ref_payco = getQueryParam('ref_payco');
        //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
        var urlapp = 'https://secure.epayco.co/validation/v1/reference/' + ref_payco;
        $.get(urlapp, function(response) {
            if (response.success) {
                if (response.data.x_cod_response == 1)
                {
                    //Codigo personalizado
                    alert('Transaccion Aprobada');
                    console.log('transacción aceptada');
                    swal("Exito","Pago aceptado","success");

                } //
                    //Transaccion Rechazada
                if (response.data.x_cod_response == 2) {
                    console.log('transacción rechazada');
                }
                    //Transaccion Pendiente
                if (response.data.x_cod_response == 3) {
                    console.log('transacción pendiente');
                }
                //Transaccion Fallida
                if (response.data.x_cod_response == 4) {
                    console.log('transacción fallida');
                }
                $('#fecha').html(response.data.x_transaction_date);
                $('#respuesta').html(response.data.x_response);
                $('#referencia').text(response.data.x_id_invoice);
                $('#motivo').text(response.data.x_response_reason_text);
                $('#recibo').text(response.data.x_transaction_id);
                $('#banco').text(response.data.x_bank_name);
                $('#autorizacion').text(response.data.x_approval_code);
                $('#total').text(response.data.x_amount + ' ' + response.data.x_currency_code);
            } else {
                alert('Error consultando la información');
            }
        });
    });
</script>
@endpush

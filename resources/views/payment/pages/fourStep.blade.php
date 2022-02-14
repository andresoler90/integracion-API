@extends('payment.layouts.master')
@section('content')
    <div class="row mb-5">
        <div class="col-xl-6 offset-3 bg-white box-shadow rounded">
            <div class="row">
                <div class="col-xl-12">
                    <h3 class="font-weight-bold payment-text-primary mt-3 mb-2">{{ __('Datos de pago') }}</h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                       <thead>
                       <tr>
                           <th>{{__("Cliente")}}</th>
                           <th>{{__("Páis")}}</th>
                           <th>{{__("Sub Producto")}}</th>
                           <th>{{__("Moneda")}}</th>
                           <th>{{__("Valor")}}</th>
                       </tr>
                       </thead>
                        <tbody>
                            <td>{{$data["client"]}}</td>
                            <td>{{$data["country"]}}</td>
                            <td>{{$data["subProduct"]}}</td>
                            <td>{{$data["currency"]}}</td>
                            <td>{{$data["value"]}}</td>
                        </tbody>
                    </table>
                </div>
                <div class="col-xl-12">
                    <h3 class="font-weight-bold payment-text-primary mt-3 mb-2">{{ __('Datos del Cliente') }}</h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__("Razon Social'")}}</th>
                            <th>{{__("Nit (TAX ID)")}}</th>
                            <th>{{__("Nombres y Apellidos")}}</th>
                            <th>{{__("Correo Electronico")}}</th>
                            <th>{{__("Télefono")}}</th>
                            <th>{{__("Dirección")}}</th>
                            <th>{{__("País")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <td>{{$data["pv1_providerName"]}}</td>
                            <td>{{$data["paym9_nit"]}}</td>
                            <td>{{$data["paym9_fullName"]}}</td>
                            <td>{{$data["paym9_mail"]}}</td>
                            <td>{{$data["paym9_phone"]}}</td>
                            <td>{{$data["paym9_address"]}}</td>
                            <td>{{$data["loc3_shortName"]}}</td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="payment-container mt-4 mb-4">
                <form>
                    <script
                        src="https://checkout.epayco.co/checkout.js"
                        class="epayco-button"
                        data-epayco-key="491d6a0b6e992cf924edd8d3d088aff1"
                        data-epayco-amount="{{$data['value']}}"
                        data-epayco-name="{{$data['client']}}"
                        data-epayco-description="{{$data['subProduct']}}"
                        data-epayco-currency="{{$data['currency']}}"
                        data-epayco-country="co"
                        data-epayco-test="true"
                        data-epayco-external="false"
                        data-epayco-response="{{route('payment.epayco.response')}}"
                        data-epayco-confirmation="{{route('payment.epayco.confirmation')}}">
                    </script>
                </form>
            </div>

        </div>
        <br>
    </div>
        @stop

        {{-- ESQUEMA DE CARGUE DE ESTILOS EN BLADES QUE EXTIENDAN DE ESTA --}}
        @push('sectionStyles_layouts')
            <style>
                .center-flex
                {
                    margin: 0px auto !important;
                    display: table !important;
                }
            </style>
    @endpush


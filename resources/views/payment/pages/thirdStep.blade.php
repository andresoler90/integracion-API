@extends('payment.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-6 offset-3 bg-white box-shadow rounded">
        <div class="row">
            <div class="col-xl-12">
                <h3 class="font-weight-bold payment-text-primary mt-3 mb-2">{{ __('Formulario de registro del pago') }}</h3>
            </div>
            <form method="POST" action="{{route("payment.ajax.storeClient")}}"
                  accept-charset="UTF-8" name="clientInfo" id="clientInfo" enctype="multipart/form-data">
                <input name="_token" type="hidden">
                <input type="hidden" name="_token" value="">
                <div class="col-xl-12 mt-3">
                    <hr>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Razon Social')}}</label>
                                <select class="form-control" id="pv1_id" name="pv1_id">
                                    @foreach($additionalData["providers"] as $key => $value)
                                        <option value='{{$key}}'>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Nit (TAX ID)')}}</label>
                                <input class="form-control" autocomplete="off" name="paym9_nit" type="text">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Nombres y Apellidos')}}</label>
                                <input class="form-control" autocomplete="off" name="paym9_fullName" type="text">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Correo Electronico')}}</label>
                                <input class="form-control" autocomplete="off" name="paym9_mail" type="text">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Télefono')}}</label>
                                <input class="form-control" autocomplete="off" name="paym9_phone" type="text">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Dirección')}}</label>
                                <input class="form-control" autocomplete="off" name="paym9_address" type="text">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('País')}}</label>
                                <select class="form-control" id="paym9_country" name="paym9_country">
                                    @foreach($additionalData["countries"] as $key => $value)
                                        <option value='{{$key}}'>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 mb-3">
                    <input class="btn btn-primary center-flex" type="submit" value="Proceder al Pago">
                </div>
            </form>
        </div>
    </div>
    <br>
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


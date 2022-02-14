@extends('payment.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-6 offset-3 bg-white box-shadow rounded" style="min-height: 300px;">
            <div class="row">
                <div class="col-xl-4">
                    <h1 class="font-weight-bold payment-text-primary mt-3 mb-2">{{ __('PortalPagos') }}</h1>
                    <p style="text-align: left;">
                        {{ __('PortalPagosExtend') }}
                    </p>
                </div>
                <div class="col-xl-8 mb-6">
                    <div class="container-img-payment">
                        <img src="{{asset('img/4142132.jpg')}}" class="payment-image rounded mt-5">
                        <img src="{{asset('img/4142132.jpg')}}" class="payment-image rounded mt-5">
                        <img src="{{asset('img/4142132.jpg')}}" class="payment-image rounded mt-5">
                        <img src="{{asset('img/4142132.jpg')}}" class="payment-image rounded mt-5">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 mt-5">
            <div class="row">
                <div class="col-xl-6 offset-3">
                    <a href="{{route("payment.firstStep")}}">
                        <button type="button" class="btn btn-payment btn-success">{{ __('PaymentButton') }}</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- ESQUEMA DE CARGUE DE ESTILOS EN BLADES QUE EXTIENDAN DE ESTA --}}
@push('sectionStyles_layouts')
    <style>

        .btn-payment
        {
            font-weight: bold;
            margin: 0px auto !important;
            display: table !important;
            background-color: rgb(0,169,131,0.8) !important;
        }

        .payment-text-primary
        {
            text-align: center;
            font-weight: bold;
            color: rgba(0, 169, 131,1);
            text-transform: uppercase;
        }

        .container-img-payment
        {
            transform: rotate(-10deg) skew(-0deg) scale(.9);
            transition: 0.5s;
        }

        .container-img-payment img
        {
            position: absolute;
            width: 50%;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            /*box-shadow: rgba(0, 169, 131, 0.3) 0px 7px 29px 0px;*/
        }

        .container-img-payment img:nth-child(4)
        {
            transform: translate(200px,60px);
            opacity: 1;
        }

        .container-img-payment img:nth-child(3)
        {
            transform: translate(100px,40px);
            opacity: .8;
        }
        .container-img-payment img:nth-child(2)
        {
            transform: translate(40px,20px);
            opacity: .6;
        }
        .container-img-payment img:nth-child(1)
        {
            transform: translate(-50px,0px);
            opacity: .4;
        }

        .payment-image
        {
            width: 100%;
        }

        .center
        {
           margin-top: 12.5vh;
           margin-left: 12.5vh;
        }

        #content-wrapper
        {
            background-color: transparent !important;
            height: 100vh;
        }


        .bg-green
        {
         background-color: rgb(0,169,131,0.8);
         color: #fff;
        }
    </style>
@endpush

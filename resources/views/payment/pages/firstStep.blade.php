@extends('payment.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-6 offset-3 bg-white box-shadow rounded" style="min-height: 300px;">
            <div class="row">
                <div class="col-xl-12 mt-5" id="products">
                    <h4 class="font-weight-bold payment-text-primary mb-2">{{ __('Opciones de los servicios que pueden ser pagados') }}</h4>
                    <a href="{{route("payment.secondStep",1)}}" class="link-product">
                        <button type="button" class="btn btn-center mt-4 btn-product">
                            {{ __('MiRegistro') }}
                        </button>
                    </a>
                    <a href="{{route("payment.secondStep",2)}}" class="link-product">
                        <button type="button" class="btn btn-center mt-2 btn-product">
                            {{ __('MisCatálogos') }}
                        </button>
                    </a>
                    <a href="{{route("payment.secondStep",3)}}" class="link-product">
                        <button type="button" class="btn btn-center mt-2 mb-4 btn-product">
                            {{ __('Otros') }}
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @endsection

        {{-- ESQUEMA DE CARGUE DE ESTILOS EN BLADES QUE EXTIENDAN DE ESTA --}}
        @push('sectionStyles_layouts')
            <style>

                .btn-center
                {
                    margin: 0px auto !important;
                    margin-top: 0px;
                    display: table !important;
                    color: #fff !important;
                }

                .link-product:link
                {
                    text-decoration: none;
                }

                .btn-product
                {
                    padding: 25px 45px 25px 45px !important;
                    text-transform: uppercase;
                    min-width: 250px;
                    color: #fff
                }

                .link-product:nth-of-type(1) button
                {
                    background-color: orange;
                }

                .link-product:nth-of-type(2) button
                {
                    background-color: green;
                    color:#000;
                }

                .link-product:nth-of-type(3) button
                {
                    background-color: #1c294e;
                    color:#000;
                }

                .btn-payment
                {
                    font-weight: bold;
                    margin: 0px auto !important;
                    display: table !important;
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

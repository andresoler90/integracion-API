@extends('payment.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-6 offset-3 bg-white box-shadow rounded" style="min-height: 300px;">
            <div class="row">
                <div class="col-xl-12">
                    <h3 class="font-weight-bold payment-text-primary mt-3 mb-2">{{ __('Seleccion de opciones') }}</h3>
                    <div class="form-group">
                        <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                        <label for="Cliente" class="control-label">{{__('Cliente')}}</label>
                        <select class="form-control" id="paym4" name="paym4_id">
                            @foreach($additionalData["clients"] as $key => $value)
                                <option value='{{$key}}'>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                        <label for="Pais" class="control-label">{{__("Pais")}}</label>
                        <select class="form-control" id="loc3" name="loc3_id">
                        </select>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                        <label for="Sub Producto" class="control-label">{{__("Sub Producto")}}</label>
                        <select class="form-control" id="paym2" name="paym2_id">
                        </select>
                    </div>
                    <div class="row" id="selection-cotainer">
                        <div class="col-md-8 offset-2">
                            <div class="small-box bg-payment">
                                <div class="inner">
                                    <ul id="options">
                                    </ul>
                                    <div id="valueSelection">
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-xl-12 mt-2 mb-4">
            <div class="row">
                <div class="col-xl-6">
                    <a href="#">
                        <button type="button" id="confirm" class="btn btn-payment btn-success">{{ __('Confirmar Selección') }}</button>
                    </a>
                </div>
                <div class="col-xl-6">
                    <a href="#">
                        <button type="button" id="reload" class="btn btn-payment btn-success">{{ __('Nueva Selección') }}</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- ESQUEMA DE CARGUE DE ESTILOS EN BLADES QUE EXTIENDAN DE ESTA --}}
@push('sectionStyles_layouts')
    <style>

        #selection-cotainer
        {
            display: none;
        }

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

        .small-box {
        border-radius: .25rem;
        box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
        display: block;
        margin-bottom: 20px;
        position: relative;
        }

        .bg-payment {
            background-color: rgba(0, 169, 131, 0.8) !important;
        }

        .small-box .icon > i
        {
            color: rgba(255,255,255,0.5);
            font-size: 90px;
            position: absolute;
            right:0.15em;
            top: 25px;
            transition: -webkit-transform .3s linear;
            transition: transform .3s linear;
            transition: transform .3s linear,-webkit-transform .3s linear;
        }

        .small-box > .small-box-footer {
            background-color: rgba(2, 45, 35, 0.8) !important;
            color: rgba(255,255,255,.8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }

        .small-box ul , .small-box p
        {
            color: rgba(255,255,255,.8);
            font-weight: bold;
        }

        .small-box p
        {
            padding: 1em;
        }

        .small-box .icon > i.fa, .small-box .icon > i.fab, .small-box .icon > i.fad, .small-box .icon > i.fal, .small-box .icon > i.far, .small-box .icon > i.fas, .small-box .icon > i.ion {
            font-size: 70px;
            top: 0.5em;
        }

        #options
        {
            margin: 0px;
            list-style: none;
            padding: 1em;
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

        {{-- ESQUEMA DE CARGUE DE JQUERY EXTIENDAN DE ESTA --}}
        @push('sectionScripts_afterLoad')
            <script>
                {{--Busqueda de pais por cliente--}}
                $("#paym4").change(function ()
                {
                    var paym4_id = this.value;
                    var url = '{{route('payment.ajax.country')}}';

                    $.ajax({
                        url: url,
                        data : {paym4_id : paym4_id},
                        type: "post",
                        cache: false,
                        async: false,
                        success: function (data)
                        {
                            var country = $('#loc3');
                            country.empty();

                            country.append('<option id=' + 0 + ' value=' + 0 + '>Seleccione</option>');

                            if(data!=="")
                            {
                                for (var key in data)
                                {
                                    country.append('<option id=' + key + ' value=' + key + '>' + data[key] + '</option>');
                                }
                            }

                        },error: function (data){

                            try {
                                var errors = $.parseJSON(data.responseText);
                                $.each(errors, function (key, value){
                                    swal("error",value,"error");
                                });
                            }
                            catch(error) {
                                swal("error","{{__("Error")}}","error");
                            }
                        }

                    }).fail(function (data)
                    {
                        var country = $('#loc3');
                        country.empty();
                    });
                })

                {{--Busqueda de SubProducto por cliente y pais--}}
                $("#loc3").change(function ()
                {
                    var loc3_id = this.value;
                    var paym4_id = $("#paym4").val();
                    var url = '{{route('payment.ajax.subProduct')}}';

                    $.ajax({
                        url: url,
                        data : {paym4_id : paym4_id,loc3_id : loc3_id},
                        type: "post",
                        cache: false,
                        async: false,
                        success: function (data)
                        {
                            var subProduct = $('#paym2');
                            subProduct.empty();

                            subProduct.append('<option id=' + 0 + ' value=' + 0 + '>Seleccione</option>');

                            if(data!=="")
                            {
                                for (var key in data)
                                {
                                    subProduct.append('<option id=' + key + ' value=' + key + '>' + data[key] + '</option>');
                                }
                            }

                        },error: function (data){

                            try {
                                var errors = $.parseJSON(data.responseText);
                                $.each(errors, function (key, value){
                                    swal("error",value,"error");
                                });
                            }
                            catch(error) {
                                swal("error","{{__("Error")}}","error");
                            }
                        }

                    }).fail(function (data)
                    {
                        var subProduct = $('#paym2');
                        subProduct.empty();
                    });
                });

                {{--Busqueda de SubProducto por cliente y pais--}}
                $("#paym2").change(function ()
                {
                    var loc3_id = $("#loc3").val();
                    var country = $("#loc3 option[value="+loc3_id+"]").text();
                    var paym4_id = $("#paym4").val();
                    var client = $("#paym4 option[value="+paym4_id+"]").text();
                    var paym2_id = $("#paym2").val();
                    var subProduct = $("#paym2 option[value="+paym2_id+"]").text();
                    var options = $("#options");

                    options.empty();
                    options.append('<li id="clientAppend">Cliente : '+client+'</li>');
                    options.append('<li id="countryAppend">País de Origen : '+country+'</li>');
                    options.append('<li id="subProductAppend">Tipo de Regístro : '+subProduct+'</li>');
                    var url = '{{route('payment.ajax.value')}}';

                    $.ajax({
                        url: url,
                        data : {paym4_id : paym4_id,loc3_id : loc3_id,paym2_id:paym2_id},
                        type: "post",
                        cache: false,
                        async: false,
                        success: function (data)
                        {
                            var containerParent = $("#selection-cotainer");
                            containerParent.css("display","block");
                            var container = $('#valueSelection');
                            container.empty();

                            if(data!=="")
                            {
                                container.append('<p id="valueResult">El importe de su seleccion es $: ' + data + '</p>');
                            }

                            $([document.documentElement, document.body]).animate({
                                scrollTop: containerParent.offset().top
                            }, 2000);

                        },error: function (data){

                            try {
                                var errors = $.parseJSON(data.responseText);
                                $.each(errors, function (key, value){
                                    swal("error",value,"error");
                                });
                            }
                            catch(error) {
                                swal("error","{{__("Error")}}","error");
                            }
                        }

                    }).fail(function (data)
                    {
                        var options = $("#options");
                        options.empty();
                    });
                });

                $( "#confirm" ).click(function()
                {
                    var url = '{{route('payment.ajax.signature')}}';
                    var loc3_id = $("#loc3").val();
                    var paym4_id = $("#paym4").val();
                    var paym2_id = $("#paym2").val();

                    $.ajax({
                        url: url,
                        data : {paym4_id : paym4_id,loc3_id : loc3_id,paym2_id:paym2_id},
                        type: "post",
                        cache: false,
                        async: false,
                        success: function (data)
                        {
                            if(data)
                            {
                                var url = "{{route("payment.thirdStep")}}";
                                location.replace(url);
                            }

                        },error: function (data){

                            try {
                                var errors = $.parseJSON(data.responseText);
                                $.each(errors, function (key, value){
                                    swal("error",value,"error");
                                });
                            }
                            catch(error) {
                                swal("error","{{__("Error")}}","error");
                            }
                        }

                    }).fail(function (data)
                    {
                        swal("error","{{__("Error")}}","error");
                    });
                });

                $( "#reload" ).click(function()
                {
                    location.reload(true);
                });

            </script>
    @endpush

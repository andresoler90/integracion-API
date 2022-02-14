@extends('payment.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-6 offset-3 bg-white box-shadow rounded">
            <div class="row">
                <div class="col-xl-12">
                    <h3 class="font-weight-bold payment-text-primary mt-3 mb-2">{{ __('PaymentConfig') }}</h3>
                </div>
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-6"></div>
                        <div class="col-xl-6 float-md-right">
                            <a href="{{route("payment.create")}}" class="float-right">
                                <i class="fa fa-plus-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{__('Productos')}}</th>
                                <th>{{__('Cliente')}}</th>
                                <th>{{__('País de origen')}}</th>
                                <th>{{__('Sub producto')}}</th>
                                <th>{{__('Valor')}}</th>
                                <th>{{__('Tipo de base')}}</th>
                                <th>{{__('Acciones')}}</th>
                            </tr>
                            </thead>
                            <tboddy>
                                {{--Contador--}}
                                @php $i=0; @endphp
                                @if(count($paginate))
                                    @foreach($paginate as $reg)
                                        <tr>

                                            <td>{{$reg->paym1_product}}</td>
                                            <td>{{$reg->paym4_name}}</td>
                                            <td>{{$reg->loc3_shortName}}</td>
                                            <td>{{$reg->paym2_subProduct}}</td>
                                            <td>{{$reg->paym5_value}}</td>
                                            <td>{{$reg->paym3_typeBase}}</td>
                                            <td>
                                                <table class="action-table">
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('payment.edit', [$reg->paym5_id])}}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="#" onclick="$('#Form_{{$reg->paym5_id}}').submit()">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            {{ Form::open(
                                                                array(
                                                                    'url' => route('payment.destroy'),
                                                                    'method' => 'POST',
                                                                    'onsubmit' => 'event.preventDefault(); ConfirmAlerts(this.id, "delete");',
                                                                    "name" => "deleteRegister".$reg->paym5_id,
                                                                    "id" => 'Form_' . $reg->paym5_id,
                                                                    "style"=>"display:inline-block;"))}}

                                                            {{ Form::hidden('paym5_id',$reg->paym5_id) }}
                                                            {!! Form::close()!!}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">
                                            {{trans('trackingcontracts::trackingcontractsPeople.people.empty')}}
                                        </td>
                                    </tr>
                                @endif
                            </tboddy>
                            <tfoot>
                            <tr>
                                <th colspan="4" class="center">
                                    {{$paginate->links()}}
                                </th>
                            </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

{{-- ESQUEMA DE CARGUE DE ESTILOS EN BLADES QUE EXTIENDAN DE ESTA --}}
@push('sectionStyles_layouts')
    <style>
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

    </style>
@endpush

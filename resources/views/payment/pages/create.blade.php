@php
    #Item activo de menu 1er nivel
    $activeMultiUserCreate = 'active';
    $data['urlForm'] = route('payment.store');
    $data['methodForm'] = 'POST';
    $data['nameForm'] = 'paymentStore';
    $data['idForm'] = 'paymentStore';
    $data['readonly'] = '';
@endphp
@extends('payment.layouts.master')

@section('content')
    @include('payment.partials.formCreate',$data)
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


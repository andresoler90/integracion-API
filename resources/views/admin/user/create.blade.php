@section('title', __('Crear Usuario'))
@extends('layouts.sb')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Datos basicos')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            @include('admin.user.partials._form', ['btn' => "Crear"])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

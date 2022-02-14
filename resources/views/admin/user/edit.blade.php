@section('title', __('Editar Usuario'))
@extends('layouts.sb')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <h4 class="iq-header-title">{{__('Datos basicos')}}</h4>
                        </div>
                        <div class="iq-card-body">
                            @include('admin.user.partials._form', ['data' => $user, 'btn' => "Editar"])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@php($title = __('Usua1rios'))
@section('title', __('Usuarios'))
@extends('layouts.sb', ['title'])
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('Usuarios')}}
                                    <span class="badge badge-primary">
                                        {{$users->total()/*Al usar count por la paginacion maximo se visualizaria la cantidad que haya en cada pagina*/}}
                                    </span>
                                </h4>
                            </div>
                            <a href="{{route('admin.user.create')}}" class="btn btn-primary btn-sm float-right">{{__('Crear')}}</a>
                        </div>
                        <div class="col-md-12">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">
                                            {{__('Busqueda')}}
                                        </h4>
                                    </div>
                                    <a href="{{route('admin.user')}}">
                                        <i class="fa fa-eraser" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="iq-card-body">
                                    {{Form::open(['route' => ['admin.user']])}}
                                        @csrf
                                        <div class="row">
                                            <div class="input-group col-md-4 mb-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{__('Nombre')}}</span>
                                                </div>
                                                <input type="text" name="name" class="form-control" value="{{isset($requests->nameFilter) ? $requests->nameFilter : null}}">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-left btn-sm">{{__('Buscar')}}</button>
                                        </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="bg-light">
                                        <th scope="col" style="width: 2%">#</th>
                                        <th scope="col">{{__('Usuario')}}</th>
                                        <th scope="col">{{__('Nombre')}}</th>
                                        <th scope="col" style="width: 5%">{{__('Opciones')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($users as $request)
                                    <tr>
                                        <td style="width: 10px" class="text-center">{{$i++}}</td>
                                        <td>{{$request->email}}</td>
                                        <td>{{$request->name}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="fa fa-bars"></span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{route('admin.user.edit', [$request->id])}}" class="dropdown-item">
                                                        <i class="far fa-edit"></i>
                                                        {{__('Editar')}}
                                                    </a>
                                                    <hr class="dropdown-divider">
                                                    <a href="#" onclick="ConfirmAlertsDelete({{$request->id}})" class="dropdown-item">
                                                        <i class="far fa-trash-alt"></i>
                                                        {{__('Eliminar')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$users->appends(request()->input())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function ConfirmAlertsDelete(id)
        {
            swal({
                title: "{{__('Eliminar usuario')}}",
                text: "{{__('¿Está seguro de eliminar el registro?')}}",
                icon: "warning",
                dangerMode: true,
                buttons: ["{{__('Cancelar')}}", "{{__('Sí, continuar')}}"]
            })
            .then((willDelete) => {
                if (willDelete) {
                    /*swal("Done! category has been softdeleted!", {
                        icon: "success",
                        button: false,
                    });
                    location.reload(true);//this will release the event*/
                    var url = "{{route('admin.user.delete', ['%id%'])}}";
                    url = url.replace('%id%', id);
                    window.location.href = url;
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        }
    </script>
@endsection

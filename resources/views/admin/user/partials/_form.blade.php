                            @include('partials._app_errors')
                            @if(isset($data))
                                {{Form::open(['route' => ['admin.user.update']])}}
                                    {{Form::hidden('id', $data->id)}}
                            @else
                                {{Form::open(['route' => ['admin.user.save']])}}
                            @endif
                                    @csrf
                                    <div class="form-group">
                                        <label for="user">{{__('Email')}}</label>
                                        {{Form::email("email", isset($data)?$data->email:"", ['class' => "form-control", 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{__('Nombre')}}</label>
                                        {{Form::text("name", isset($data)?$data->name:"", ['class' => "form-control", 'required'])}}
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{__($btn)}}</button>
                                    <a href="{{route('admin.user')}}" class="btn iq-bg-danger">{{__('Cancelar')}}</a>
                                {{Form::close()}}

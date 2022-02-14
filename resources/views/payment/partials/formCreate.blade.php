<hr>
<div class="row">
    <div class="col-xl-6 offset-3 bg-white box-shadow rounded">
        <form method="{{$methodForm}}" action="{{$urlForm}}"
              accept-charset="UTF-8" name="{{$nameForm}}" id="{{$idForm}}" enctype="multipart/form-data">
            <input name="_token" type="hidden">
            <input type="hidden" name="_token" value="">
            <div class="row">
                <div class="col-xl-12">
                    <h3 class="font-weight-bold payment-text-primary mt-3 mb-2">{{ __('PaymentConfig') }}</h3>
                </div>
                <div class="col-xl-12 mt-3">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Productos')}}</label>
                                <select class="form-control" id="paym1_id" name="paym1_id">
                                    @foreach($additionalData["products"] as $key => $value)
                                        <option value='{{$key}}'>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Valor')}}</label>
                                <input class="form-control" step="any" name="paym5_value" type="number">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Cliente')}}</label>
                                <select class="form-control" id="paym4_id" name="paym4_id">
                                    @foreach($additionalData["clients"] as $key => $value)
                                        <option value='{{$key}}'>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('País de origen')}}</label>
                                <select class="form-control" id="role1_id" name="loc3_id">
                                    @foreach($additionalData["countries"] as $key => $value)
                                        <option value='{{$key}}'>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Sub producto')}}</label>
                                <select class="form-control" id="paym2_id" name="paym2_id">
                                    @foreach($additionalData["subProducts"] as $key => $value)
                                        <option value='{{$key}}'>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Tipo de base')}}</label>
                                <select class="form-control" id="paym3_id" name="paym3_id">
                                    @foreach($additionalData["bases"] as $key => $value)
                                        <option value='{{$key}}'>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <i class="fa fa-asterisk" style="font-size:10px;color: red"></i>
                                <label for="Cliente" class="control-label">{{__('Moneda')}}</label>
                                <select class="form-control" id="use6_id" name="use6_id">
                                    @foreach($additionalData["currency"] as $key => $value)
                                        <option value='{{$key}}'>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-danger"></p>
                <div class="col-xl-12 mb-3">
                        @if($data["paym5_id"])
                         <input id="paym5_id" name="paym5_id" type="hidden" value="{{$data["paym5_id"]}}">
                        @endif
                        <input class="btn btn-primary center-flex" type="submit" value="Registrar">
                </div>
            </div>
        </form>
    </div>
</div>
<br>

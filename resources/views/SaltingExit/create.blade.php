<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.salting_exit')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                    aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('salting_exit-store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <h6 class="text-danger text-right" style="font-size: 9px ; font-weight:normal">ملحوظة :  يتم حساب التكلفة و نسبة العجز في حالة خروج كمية الرسالة بالكامل </h6>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.id') }} </label>
                                    <input type="text" name="code" id="code"
                                           class="form-control @error('code') is-invalid @enderror"
                                           placeholder="" autofocus  readonly required />
                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.meal') }}  </label>
                                    <select class="form-select search @error('salting_enter_id') is-invalid @enderror" name="salting_enter_id" id="salting_enter_id" required>
                                        <option value=""> أختر الرسالة </option>
                                        @foreach($enters as $enter)
                                            <option value="{{$enter -> id}}"> {{$enter -> code}}</option>
                                        @endforeach
                                    </select>
                                    <input id="item_id" name="item_id" type="hidden"/>
                                    @error('salting_enter_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input  name="id" id="id" type="hidden"/>

                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.client') }}  </label>
                                    <select class="form-select @error('client_id') is-invalid @enderror" name="client_id" id="client_id" required>
                                        <option value=""> أختر العميل </option>
                                        @foreach($clients as $client)
                                            <option value="{{$client -> id}}"> {{$client -> name}} </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.enteringDate') }} </label>
                                    <input type="text" name="enteringDate" id="enteringDate"
                                           class="form-control  date @error('enteringDate') is-invalid @enderror"
                                           placeholder="" autofocus readonly/>
                                    @error('enteringDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.exitDate') }} </label>
                                    <input type="date" name="date" id="date"
                                           class="form-control @error('date') is-invalid @enderror"
                                           placeholder="" autofocus required/>
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.duration') }} </label>
                                    <input type="number" name="duration" id="duration"
                                           class="form-control @error('duration') is-invalid @enderror"
                                           placeholder="" autofocus readonly/>
                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                        </div>



                        <div class="row" style="margin-top: 10px">

                            <div class="col-3">
                                <div class="form-group">

                                    <label>{{ __('main.quantity') }} </label>

                                    <input type="number"  step="any" name="quantity" id="quantity"
                                           class="form-control @error('quantity') is-invalid @enderror"
                                           placeholder="0" autofocus required />


                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">

                                    <label>{{ __('main.boxes') }} </label>

                                    <input type="number"  step="any" name="boxes" id="boxes"
                                           class="form-control @error('boxes') is-invalid @enderror"
                                           placeholder="0" autofocus  required/>


                                    @error('boxes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.exitWeight') }} </label>
                                    <input type="number"  step="any" name="weight" id="weight"
                                           class="form-control @error('weight') is-invalid @enderror"
                                           placeholder="0" autofocus required/>
                                    @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input type="number"  step="any" name="oldWeight" id="oldWeight"
                                           class="form-control @error('oldWeight') is-invalid @enderror"
                                           placeholder="0" autofocus hidden="hidden"/>
                                    <input type="number"  step="any" name="exitOldWeight" id="exitOldWeight"
                                           class="form-control @error('exitOldWeight') is-invalid @enderror"
                                           placeholder="0" autofocus hidden="hidden"/>
                                    <input type="number"  step="any" name="enterWeight" id="enterWeight"
                                           class="form-control @error('enterWeight') is-invalid @enderror"
                                           placeholder="0" autofocus hidden="hidden"/>
                                    <input type="number"  step="any" name="oldQuantity" id="oldQuantity"
                                           class="form-control @error('oldQuantity') is-invalid @enderror"
                                           placeholder="0" autofocus hidden="hidden"/>
                                    <input type="number"  step="any" name="freshValue" id="freshValue"
                                           class="form-control @error('freshValue') is-invalid @enderror"
                                           placeholder="0" autofocus hidden="hidden"/>
                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('main.transport') }} </label>
                                    <input type="number"  step="any" name="serviceTotal" id="serviceTotal"
                                           class="form-control @error('serviceTotal') is-invalid @enderror"
                                           placeholder="0" autofocus required/>
                                    @error('serviceTotal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('main.losPerc') }} </label>
                                    <input type="number"  step="any" name="losPerc" id="losPerc"
                                           class="form-control @error('losPerc') is-invalid @enderror"
                                           placeholder="0" autofocus readonly/>
                                    @error('losPerc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('main.cost') }} </label>
                                    <input type="number"  step="any" name="cost" id="cost"
                                           class="form-control @error('cost') is-invalid @enderror"
                                           placeholder="0" autofocus />
                                    @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.description') }}</label>
                                    <textarea  name="description" id="description" rows="3"
                                               class="form-control @error('description') is-invalid @enderror"
                                               placeholder="{{ __('main.description') }}" autofocus ></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 40px">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-warning">{{ __('main.save_btn') }}</button>

                            </div>

                        </div>




                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

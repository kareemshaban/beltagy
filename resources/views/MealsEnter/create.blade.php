<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.meals_enter')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                    aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('meals_enter-store') }}"
                        enctype="multipart/form-data">
                        @csrf
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
                                    <label>{{ __('main.item') }}  </label>
                                    <select class="form-select @error('item_id') is-invalid @enderror" name="item_id" id="item_id" required>
                                        <option value=""> أختر الصنف </option>
                                        @foreach($items as $item)
                                            <option value="{{$item -> id}}"> {{$item -> name}} -- {{$item -> code}}</option>
                                        @endforeach
                                    </select>
                                    @error('item_id')
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
                                    <label>{{ __('main.date') }} </label>
                                    <input type="text" name="date" id="date"
                                           class="form-control date @error('date') is-invalid @enderror"
                                           autofocus required  placeholder="dd-mm-yyyy" min="1997-01-01" max="2050-12-31"/>
                                    @error('date')
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
                                           placeholder="0" autofocus required/>


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
                                    <label>{{ __('main.enteringTax') }} </label>
                                    <input type="number"  step="any" name="enteringTax" id="enteringTax"
                                           class="form-control @error('enteringTax') is-invalid @enderror"
                                           placeholder="0" autofocus required/>
                                    @error('enteringTax')
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
                                <button type="submit" id="saveBtn" class="btn btn-warning">{{ __('main.save_btn') }}</button>

                            </div>

                        </div>




                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

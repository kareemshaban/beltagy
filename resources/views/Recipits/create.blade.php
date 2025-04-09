<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.recipits')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                              aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('recipits-store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.docNumber') }} </label>
                                    <input type="text" name="billNumber" id="billNumber"
                                           class="form-control @error('billNumber') is-invalid @enderror"
                                           placeholder="" autofocus  readonly  required/>
                                    @error('billNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input name="id" id="id" type="hidden">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.date') }} </label>
                                    <input type="date" name="date" id="date"
                                           class="form-control @error('date') is-invalid @enderror"
                                           placeholder="" autofocus  required/>
                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.client') }}  </label>
                                    <select class="form-select @error('client_id') is-invalid @enderror" name="client_id" id="client_id">
                                        <option value=""> أختر المورد </option>
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
                                    <label>{{ __('main.safe') }}  </label>
                                    <select class="form-select @error('safe_id') is-invalid @enderror" name="safe_id" id="safe_id" required>
                                        <option value=""> أختر الخزنة </option>
                                        @foreach($safes as $safe)
                                            <option value="{{$safe -> id}}"> {{$safe -> name}} </option>
                                        @endforeach
                                    </select>
                                    @error('safe_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                                </div>
                            </div>
                            <div class="col-6" hidden="hidden">
                                <div class="form-group">
                                    <label>{{ __('main.requiredAmount') }} </label>
                                    <input type="number"  step="any" name="total" id="total"
                                           class="form-control @error('total') is-invalid @enderror"
                                           placeholder="0" autofocus readonly required/>
                                    @error('total')
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
                                    <label>{{ __('main.paidAmount') }} </label>
                                    <input type="number"  step="any" name="amount" id="amount"
                                           class="form-control @error('amount') is-invalid @enderror"
                                           placeholder="0" autofocus  required/>
                                    @error('amount')
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
                                    <textarea  name="notes" id="notes" rows="3"
                                               class="form-control @error('notes') is-invalid @enderror"
                                               placeholder="{{ __('main.notes') }}" autofocus ></textarea>
                                    @error('notes')
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

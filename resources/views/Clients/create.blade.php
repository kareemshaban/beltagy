<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.clients')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                    aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('client-store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="required">{{ __('main.name') }}  </label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ __('main.name_place') }}" autofocus  required/>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input  name="id" id="id" type="hidden"/>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.phone') }}</label>
                                    <input type="text" name="phone" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="{{ __('main.phone_place') }}" autofocus />
                                    @error('phone')
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
                                    <label>{{ __('main.phone') }} 2</label>
                                    <input type="text" name="phone2" id="phone2"
                                        class="form-control @error('phone2') is-invalid @enderror"
                                        placeholder="" autofocus />
                                    @error('phone2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.phone') }} 3</label>
                                    <input type="text" name="mobile" id="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror"
                                        placeholder="" autofocus />
                                    @error('mobile')
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
                                    <label class="required">{{ __('main.pricingType') }} </label>
                                    <select id="pricingType" name="pricingType" class="form-control">
                                        <option value="0"> {{__('main.systemPrice')}} </option>
                                        <option value="1"> {{__('main.privatePrice')}} </option>

                                    </select>
                                    @error('pricingType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.enteringTax') }} </label>
                                    <input type="number" step="any" name="enteringTaxPerBoxPerMonth" id="enteringTaxPerBoxPerMonth"
                                           class="form-control @error('enteringTaxPerBoxPerMonth') is-invalid @enderror"
                                           placeholder="0" autofocus />
                                    @error('enteringTaxPerBoxPerMonth')
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
                                    <label>{{ __('main.outingTax') }} </label>
                                    <input type="number" step="any" name="coolingValuePerBoxPerMonth" id="coolingValuePerBoxPerMonth"
                                           class="form-control @error('coolingValuePerBoxPerMonth') is-invalid @enderror"
                                           placeholder="0" autofocus />
                                    @error('coolingValuePerBoxPerMonth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.address') }}</label>
                                    <textarea  name="address" id="address" rows="3"
                                               class="form-control @error('address') is-invalid @enderror"
                                               placeholder="{{ __('main.address_place') }}" autofocus ></textarea>
                                    @error('address')
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
                                    <label class="required">{{ __('main.pricingType') }} </label>
                                    <select id="pricingType" name="pricingType" class="form-control">
                                        <option value="0"> {{__('main.systemPrice')}} </option>
                                        <option value="1"> {{__('main.privatePrice')}} </option>

                                    </select>
                                    @error('pricingType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.enteringTax') }} </label>
                                    <input type="number" step="any" name="enteringTaxPerBoxPerMonth" id="enteringTaxPerBoxPerMonth"
                                           class="form-control @error('enteringTaxPerBoxPerMonth') is-invalid @enderror"
                                           placeholder="0" autofocus />
                                    @error('enteringTaxPerBoxPerMonth')
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
                                    <label>{{ __('main.beforeBalanceCredit') }} </label>
                                    <input type="number" step="any" name="beforeBalanceCredit" id="beforeBalanceCredit"
                                           class="form-control @error('beforeBalanceCredit') is-invalid @enderror"
                                           placeholder="0" autofocus value="0" />
                                    @error('beforeBalanceCredit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.beforeBalanceDebit') }} </label>
                                    <input type="number" step="any" name="beforeBalanceDebit" id="beforeBalanceDebit"
                                           class="form-control @error('beforeBalanceDebit') is-invalid @enderror"
                                           placeholder="0" autofocus value="0"/>
                                    @error('beforeBalanceDebit')
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

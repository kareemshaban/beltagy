<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.view_catch')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                              aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.docNumber') }} </label>
                                    <input type="text" name="billNumber" id="billNumber"
                                           class="form-control @error('billNumber') is-invalid @enderror"
                                           placeholder="" autofocus  readonly  required />

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.date') }} </label>
                                    <input type="text" name="date" id="date"
                                           class="form-control @error('date') is-invalid @enderror"
                                           placeholder="" autofocus  required readonly/>
                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.client') }}  </label>
                                    <input type="text" name="client" id="client"
                                           class="form-control"
                                           placeholder="" autofocus  required readonly/>


                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.safe') }}  </label>
                                    <input type="text" name="safe" id="safe"
                                           class="form-control"
                                           placeholder="" autofocus  required readonly/>
                                </div>
                            </div>


                        </div>
                        <div class="row" style="margin-top: 10px">

                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.paidAmount') }} </label>
                                    <input type="number"  step="any" name="amount" id="amount"
                                           class="form-control @error('amount') is-invalid @enderror"
                                           placeholder="0" autofocus  required readonly/>

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


                                </div>
                            </div>

                        </div>


                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.advances')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                    aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('advances-store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.employe') }}  </label>
                                    <select  name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                        @foreach ($employees as $employee)
                                         <option value="{{ $employee -> id }}">  {{ $employee -> name }} </option>

                                        @endforeach

                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input  name="id" id="id" type="hidden"/>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.date') }}</label>
                                    <input type="date" name="date" id="date"
                                        class="form-control @error('date') is-invalid @enderror" autofocus required/>
                                    @error('date')
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
                                    <label>{{ __('main.type') }}</label>
                                    <select  name="type" id="type"
                                        class="form-select @error('type') is-invalid @enderror" required>
                                        <option value="0"> {{ __('main.month_advance') }} </option>
                                        <option value="1"> {{ __('main.payments_advance') }} </option>

                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.amount') }}</label>
                                    <input type="number" name="amount" id="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        placeholder="0" autofocus required/>
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>


                        </div>
                       <div id="payments">
                            <div class="row" style="margin-top: 10px">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.monthlyPayment') }}</label>
                                        <input type="number" name="monthlyPayment" id="monthlyPayment"
                                            class="form-control @error('monthlyPayment') is-invalid @enderror"
                                            placeholder="0" autofocus required/>
                                        @error('monthlyPayment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.startDate') }}</label>
                                        <input type="date" name="startDate" id="startDate"
                                            class="form-control @error('startDate') is-invalid @enderror"
                                            placeholder="0" autofocus required/>
                                        @error('startDate')
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
                                        <label>{{ __('main.paymentsCount') }}</label>
                                        <input type="number" name="paymentsCount" id="paymentsCount"
                                            class="form-control @error('paymentsCount') is-invalid @enderror"
                                            placeholder="0" autofocus required readonly/>
                                        @error('paymentsCount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.remainPaymentsCount') }}</label>
                                        <input type="number" name="remainPaymentsCount" id="remainPaymentsCount"
                                            class="form-control @error('remainPaymentsCount') is-invalid @enderror"
                                            placeholder="0" autofocus required readonly/>
                                        @error('remainPaymentsCount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
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

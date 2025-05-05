<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.financial_deduction_boins')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                    aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('financialDeductionAndBonse-store') }}"
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
                                    <input type="text" name="date" id="date"
                                        class="form-control date @error('date') is-invalid @enderror" autofocus required/>
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
                                        <option value="0"> {{ __('main.deduction') }} </option>
                                        <option value="1"> {{ __('main.bonse') }} </option>

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
                                    <input type="number" name="reward" id="reward"
                                        class="form-control @error('reward') is-invalid @enderror"
                                        placeholder="0" autofocus required/>
                                    @error('reward')
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
                                    <label>{{ __('main.notes') }}</label>
                                    <textarea  name="notes" id="notes" rows="5"
                                        class="form-control @error('notes') is-invalid @enderror"
                                        placeholder="{{ __('main.notes_place') }}" autofocus ></textarea>
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

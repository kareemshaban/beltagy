<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.attend')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                    aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('attend-store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
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

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.day') }}</label>
                                    <input type="date" name="date" id="date"
                                           class="form-control @error('date') is-invalid @enderror" autofocus required/>
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label> {{__('main.absent')}}  ?</label>
                                    <select class="form-control" id="absent" name="absent" required>
                                        <option value="true"> {{__('main.absent')}} </option>
                                        <option value="false"> {{__('main.present')}} </option>
                                    </select>

                                </div>

                            </div>

                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.on_duty') }}</label>
                                    <input name="on_duty" id="on_duty"
                                           class="form-control easyui-timepicker @error('on_duty') is-invalid @enderror"
                                           placeholder="0" autofocus required/>
                                    @error('on_duty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.off_duty') }}</label>
                                    <input  name="off_duty" id="off_duty"
                                           class="form-control easyui-timepicker @error('off_duty') is-invalid @enderror"
                                           placeholder="0" autofocus required />
                                    @error('off_duty')
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
                                    <label>{{ __('main.clock_in') }}</label>
                                    <input  name="clock_in" id="clock_in"
                                           class="form-control easyui-timepicker @error('clock_in') is-invalid @enderror"
                                           placeholder="0" autofocus required />
                                    @error('clock_in')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.clock_out') }}</label>
                                    <input  name="clock_out" id="clock_out"
                                           class="form-control easyui-timepicker @error('clock_out') is-invalid @enderror"
                                           placeholder="0" autofocus required />
                                    @error('clock_out')
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

<script type="text/javascript">



</script>

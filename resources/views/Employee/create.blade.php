<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.employee')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                    aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('employee-store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.name') }}  </label>
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
                                    <label>{{ __('main.tag') }}</label>
                                    <input type="number" name="tag" id="tag"
                                           class="form-control @error('tag') is-invalid @enderror"
                                           placeholder="0" autofocus required/>
                                    @error('tag')
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
                                    <label>{{ __('main.department') }}</label>
                                    <select class="form-select  @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
                                        <option value=""> اختر القسم</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department -> id}}">  {{$department -> name}}</option>
                                        @endforeach

                                    </select>
                                    @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.job') }}</label>
                                    <select class="form-select  @error('job_id') is-invalid @enderror" id="job_id" name="job_id" required>
                                        <option value=""> اختر الوظيفة</option>
                                        @foreach($jobs as $job)
                                            <option value="{{$job -> id}}">  {{$job -> name}}</option>
                                        @endforeach

                                    </select>
                                    @error('job_id')
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
                                    <label>{{ __('main.salary') }}</label>
                                    <input type="number" name="salary" id="salary"
                                        class="form-control @error('salary') is-invalid @enderror"
                                        placeholder="0" autofocus required/>
                                    @error('salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.workHoursCount') }}</label>
                                    <input type="number" name="workHoursCount" id="workHoursCount"
                                        class="form-control @error('workHoursCount') is-invalid @enderror"
                                        placeholder="0" autofocus required/>
                                    @error('workHoursCount')
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
                                    <label>{{ __('main.workDaysCount') }}</label>
                                    <input type="number" name="workDaysCount" id="workDaysCount"
                                        class="form-control @error('workDaysCount') is-invalid @enderror"
                                        placeholder="0" autofocus required/>
                                    @error('workDaysCount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.offWeaklyDay') }}</label>
                                    <select class="form-select @error('offWeaklyDaysCount') is-invalid @enderror" id="offWeaklyDay" name="offWeaklyDay">
                                        <option value="1"> {{__('main.day1')}} </option>
                                        <option value="2"> {{__('main.day2')}} </option>
                                        <option value="3"> {{__('main.day3')}} </option>
                                        <option value="4"> {{__('main.day4')}} </option>
                                        <option value="5"> {{__('main.day5')}} </option>
                                        <option value="6"> {{__('main.day6')}} </option>
                                        <option value="7"> {{__('main.day7')}} </option>
                                    </select>
                                    @error('offWeaklyDaysCount')
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

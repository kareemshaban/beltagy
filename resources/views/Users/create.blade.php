<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.users')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                    aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="container-fluid">

                    <form class="center" method="POST" action="{{ route('user-store') }}"
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
                                    <label>{{ __('main.email') }}</label>
                                    <input type="text" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="{{ __('main.email_place') }}" autofocus />
                                    @error('email')
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
                                        <label>{{ __('main.password') }} </label>
                                    <input type="text" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{__('main.password_place')}}" autofocus />
                                    @error('password')
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

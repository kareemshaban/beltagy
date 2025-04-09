<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>


    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper" @if(Config::get('app.locale')=='ar' )
            style="margin-left: 0 ; margin-right: 260px ; direction: rtl;" @else
            style="margin-right: 0 ; margin-left: 260px ; direction: ltr;" @endif>
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header"
                            style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.settings') }}</h5>

                        </div>
                        <div class="card-body">

                        <form class="center" method="POST" action="{{ route('settings-store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                @include('flash-message')

                            </div>
                             <div class="col-12">
                             <div class="form-group">
                                    <label>{{ __('main.enteringTax') }}  </label>
                                    <input type="number" step="any" name="enteringTax" id="enteringTax"
                                        class="form-control @error('enteringTax') is-invalid @enderror"
                                         autofocus  required @if ($setting)  value="{{$setting -> enteringTax}}"  @endif/>
                                    @error('enteringTax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input  name="id" id="id" type="hidden" @if ($setting)  value="{{$setting -> id}}" @else value="0"  @endif/>

                                </div>
                             </div>


                        </div>
                        <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.monthly_cooling_tax_per_box') }}  </label>
                                        <input type="number"  step="any" name="monthly_cooling_tax_per_box" id="monthly_cooling_tax_per_box"
                                               class="form-control @error('monthly_cooling_tax_per_box') is-invalid @enderror"
                                               autofocus  required @if ($setting)  value="{{$setting -> monthly_cooling_tax_per_box}}"  @endif/>
                                        @error('monthly_cooling_tax_per_box')
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


                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>


</body>

</html>

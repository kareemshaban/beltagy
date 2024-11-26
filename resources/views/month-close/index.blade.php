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
                                __('main.monthly_close') }}</h5>
                            <button type="button" class="btn btn-info btn-lg" style="display: flex ; align-items: center;" id="createButton">
                                <span style="margin-left: 5px; margin-right: 5px"> {{ __('main.attach_file') }} </span>
                                <iconify-icon icon="mingcute:plus-fill"></iconify-icon>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-wrapper">

                                <table class="table table-striped  table-bordered table-hover" id="table">
                                    <thead>
                                        <th class="text-center"> {{ __('main.id') }} </th>
                                        <th class="text-center"> {{ __('main.employe') }} </th>
                                        <th class="text-center"> {{ __('main.attend_days_count') }} </th>
                                        <th class="text-center"> {{ __('main.absence_days_count') }} </th>
                                        <th class="text-center"> {{ __('main.deductions_days_count') }} </th>
                                        <th class="text-center"> {{ __('main.bonse_days_count') }} </th>
                                        <th class="text-center"> {{ __('main.deductions_amount') }} </th>
                                        <th class="text-center"> {{ __('main.bonse_amount') }} </th>
                                        <th class="text-center"> {{ __('main.advance_amount') }} </th>
                                        <th class="text-center"> {{ __('main.net_salary') }} </th>
                                        <th class="text-center"> {{ __('main.actions') }} </th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

            

                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

 
</body>

</html>

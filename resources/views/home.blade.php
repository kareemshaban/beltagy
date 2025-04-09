<!doctype html>
<html lang="en">

@include('layouts.head')

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
       @include('layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper edit_layout" @if(Config::get('app.locale')=='ar' )  style="margin-left: 0 ; margin-right: 260px ; direction: rtl;"
         @else style="margin-right: 0 ; margin-left: 260px ; direction: ltr;" @endif>
      <!--  Header Start -->
      @include('layouts.header')
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 -->
          <div class="row" style="min-height: 70vh">

            <div class="col-lg-12">
                <div class="row" >
                    <div class="col-xl-3 col-md-6" onclick="openProgramme('cooling')">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">{{__('main.cool_pro')}}</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" >{{__('main.view_details')}}</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" onclick="openProgramme('salting')">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">{{__('main.salt_pro')}}</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" >{{__('main.view_details')}}</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" onclick="openProgramme('hr')">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">{{__('main.hr_pro')}}</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <span class="small text-white stretched-link" >{{__('main.view_details')}}</span>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" onclick="openProgramme('erp')">
                        <div class="card bg-danger text-white mb-4" >
                            <div class="card-body">{{__('main.erp_pro')}}</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <span class="small text-white stretched-link" >{{__('main.view_details')}}</span>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>


           @include('layouts.footer')
        </div>
      </div>
    </div>
  </div>
<script>
    function openProgramme(id){
        sessionStorage.setItem("programme", id);
        $('.erp').hide();
        $('.hr').hide();
        $('.salting').hide();
        $('.cooling').hide();
        $("." +  id).show();
        $('#programme').val(id);
        let url = "{{ route('index') }}";
        document.location.href=url;
    }
</script>

</body>

</html>

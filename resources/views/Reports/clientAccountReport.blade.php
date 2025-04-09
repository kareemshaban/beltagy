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
        <div class="body-wrapper edit_layout">
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header"style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.client_account') }}</h5>


                        </div>
                        <div class="card-body">
                            <form class="center" method="POST" action="{{ route('client_AccountSearch') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('main.dateFrom') }} </label>
                                            <div style="display: flex ; gap: 10px">
                                                <input type="checkbox" id="isDateFrom" name="isDateFrom" class="form-check"  >
                                                <input type="date" name="dateFrom" id="dateFrom"
                                                       class="form-control @error('dateFrom') is-invalid @enderror"
                                                       placeholder="" autofocus required disabled/>
                                            </div>

                                            @error('dateFrom')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('main.dateTo') }} </label>
                                            <div style="display: flex ; gap: 10px">
                                                <input type="checkbox" id="isDateTo" name="isDateTo" class="form-check"  >
                                                <input type="date" name="dateTo" id="dateTo"
                                                       class="form-control @error('dateTo') is-invalid @enderror"
                                                       placeholder="" autofocus required disabled/>
                                            </div>

                                            @error('dateTo')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('main.client') }} </label>
                                            <select class="form-select" id="client_id" name="client_id" required>
                                                <option value=""> اختر عميل / مورد </option>
                                                @foreach($clients as $client)

                                                    <option value="{{$client -> id}}"> {{$client -> name}} </option>
                                                @endforeach

                                            </select>
                                            @error('client_id')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('main.reportType') }} </label>
                                            <select class="form-select" id="reportType" name="reportType">
                                                <option value="0"> تقرير تفصيلي </option>
                                                <option value="1"> تقرير إجمالي </option>
                                                <option value="2"> تقرير تفصيلي بالأصناف </option>


                                            </select>
                                            @error('reportType')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>

                                    </div>
                                </div>


                                <div class="row" style="margin-top: 40px">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-warning" style="width: 120px ; height: 40px ; border-radius: 15px">{{ __('main.search_btn') }}</button>

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

    <script >
        $( document ).ready(function() {
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

            $('#dateFrom').val(today);
            $('#dateTo').val(today);
            $('#client_id').val('');


            $('#isDateFrom').prop('checked', false); //
            $('#isDateTo').prop('checked', false); //
            $("#dateFrom").prop('disabled', true);
            $("#dateTo").prop('disabled', true);

            $("#isDateFrom").change(function(){
                if($("#isDateFrom").is(':checked')){
                    $("#dateFrom").prop('disabled', false);
                } else {
                    $("#dateFrom").prop('disabled', true);
                }
            });
            $("#isDateTo").change(function(){
                if($("#isDateTo").is(':checked')){
                    $("#dateTo").prop('disabled', false);
                } else {
                    $("#dateTo").prop('disabled', true);
                }
            });
        });
    </script>


</body>

</html>

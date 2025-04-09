<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<style>

    @media print {
        #filter_card { /* Add the elements you want to hide */
            display: none;
        }
        #print_btn{
            display: none;
        }
    }
</style>
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



                <div class="card" >
                    <div class="card-header"style="display: flex ; justify-content: space-between ; align-items: center">
                        <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.stockReport') }}</h5>

                    </div>
                    <div class="card-body">
                        <form class="center" method="POST" action="{{ route('stockReportSearch') }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.item') }} </label>
                                        <select class="form-select" id="item_id" name="item_id">
                                            <option value=""> الكل </option>
                                            @foreach($items as $item)

                                                <option value="{{$item -> id}}"> {{$item -> name}} </option>
                                            @endforeach

                                        </select>
                                        @error('item_id')
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
<script>
    $( document ).ready(function() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        $('#dateFrom').val(today);
        $('#dateTo').val(today);
        $('#client_id').val('');
        $('#payment_type').val('');


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

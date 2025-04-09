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
                        <div class="col-12">
                            @include('flash-message')

                        </div>
                        <div class="table-wrapper">
                            <div class="table-responsive">
                                <table class="table table table-striped  table-bordered table-hover"  id="table" >
                                    <thead>
                                    <th class="text-center"> # </th>
                                    <th class="text-center"> {{ __('main.item') }} </th>
                                    <th class="text-center"> {{ __('main.purchaseQnt') }} </th>
                                    <th class="text-center"> {{ __('main.soldQnt') }} </th>
                                    <th class="text-center"> {{ __('main.stockBalance') }} </th>

                                    </thead>
                                    <tbody id="table_body">
                                    @foreach ( $stocks as $stock )
                                        <tr >
                                            <td class="text-center"> {{ $loop -> index + 1}} </td>
                                            <td class="text-center"> {{ $stock -> item_name }} </td>
                                            <td class="text-center"> {{ $stock -> quantity_in }} </td>
                                            <td class="text-center"> {{ $stock -> quantity_out}} </td>
                                            <td class="text-center"> {{ $stock -> quantity_in - $stock -> quantity_out}} </td>
                                        </tr>


                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>


                    </div>
                </div>

                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>

<script >


    function printAction(){
        var item_id = $('#item_id').val();
        var client_id = $('#client_id').val();
        if(client_id == "") client_id = "0" ;
        if(item_id == "") item_id = "0" ;
        let url = "{{ route('meals_report_print', [':client_id' , ':item_id']) }}";
        url = url.replace(':client_id', client_id);
        url = url.replace(':item_id', item_id);
        window.open(url, '_blank').focus();
    }
    function excelAction(){
        var item_id = $('#item_id').val();
        var client_id = $('#client_id').val();
        if(client_id == "") client_id = "0" ;
        if(item_id == "") item_id = "0" ;
        let url = "{{ route('meals_report_excel', [':client_id' , ':item_id']) }}";
        url = url.replace(':client_id', client_id);
        url = url.replace(':item_id', item_id);
        window.open(url, '_blank').focus();
    }
</script>
</body>

</html>

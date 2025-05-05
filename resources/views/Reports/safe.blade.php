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
                                __('main.safeReport') }}</h5>

                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @include('flash-message')

                        </div>
                        <div class="table-wrapper">
                            <div class="table-responsive">
                                <?php $total = 0 ; ?>
                                <table class="table table table-striped  table-bordered table-hover"  id="table" >
                                    <thead>
                                    <th class="text-center"> # </th>
                                    <th class="text-center"> {{ __('main.safe') }} </th>
                                    <th class="text-center"> {{ __('main.billNumber') }} </th>
                                    <th class="text-center"> {{ __('main.date') }} </th>
                                    <th class="text-center"> {{ __('main.safeIndex') }} </th>
                                    <th class="text-center text-success" > {{ __('main.debit') }} </th>
                                    <th class="text-center text-danger" > {{ __('main.credit') }} </th>
                                    <th class="text-center text-primary"> {{ __('main.balance') }} </th>

                                    </thead>

                                    <tbody id="table_body">

                                    @foreach ( $docs as $doc )
                                        <tr >
                                            <td class="text-center"> {{ $loop -> index + 1}} </td>
                                            <td class="text-center"> {{ $doc -> safe	 }} </td>
                                            <td class="text-center"> {{ $doc -> billNumber	 }} </td>
                                            <td class="text-center"> {{ \Carbon\Carbon::parse($doc -> date) ->format('Y-m-d')  }} </td>
                                            <td class="text-center">
                                                <span @if ($doc -> type == 1 || $doc -> type == 3 ) class="badge
                                                    text-bg-danger" @else class="badge text-bg-success" @endif> {{ $doc -> client_name	}}
                                                </span>
                                            </td>
                                            <td class="text-center text-success"> {{ $doc -> type == 2 ?  $doc -> amount : 0}} </td>
                                            <td class="text-center text-danger"> {{ ($doc -> type == 1 || $doc -> type == 3) ? $doc -> amount : 0}} </td>
                                            <td class="text-center @if($doc -> type ==  2 )  text-success @else text-danger @endif"> {{ $doc -> type == 2 ? $doc -> amount : -1 * $doc -> amount}} </td>
                                        </tr>

                                      <?php  $total +=  $doc -> type == 2 ? $doc -> amount : -1 * $doc -> amount ?>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center" style="font-size: 18px ; font-weight: bold" colspan="3">{{__('main.safeBalance')}}</td>
                                            <td class="text-center @if($totalBalance  > 0 )  text-success @else text-danger @endif" style="font-size: 18px ; font-weight: bold" colspan="4">{{$totalBalance}}</td>
                                        </tr>
                                    </tfoot>
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

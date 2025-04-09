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
                    <div class="card-header"
                         style="display: flex ; justify-content: space-between ; align-items: center">
                        <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.return_Sales_bill') }}</h5>
                        <a href="{{route('returnSales-create')}}"> <button type="button" class="btn btn-info btn-lg" style="display: flex ; align-items: center;" >
                                <span style="margin-left: 5px; margin-right: 5px"> {{ __('main.add_new') }} </span>
                                <iconify-icon icon="mingcute:plus-fill"></iconify-icon>
                            </button></a>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @include('flash-message')

                        </div>
                        <div class="table-wrapper">
                            <div class="table-responsive">
                                <table class="table table-striped  table-bordered table-hover" id="table">
                                    <thead>
                                    <th class="text-center"> # </th>
                                    <th class="text-center"> {{ __('main.billNumberReturn') }} </th>
                                    <th class="text-center"> {{ __('main.billNumber') }} </th>
                                    <th class="text-center"> {{ __('main.supplier') }} </th>
                                    <th class="text-center"> {{ __('main.date') }} </th>
                                    <th class="text-center"> {{ __('main.total') }} </th>
                                    <th class="text-center"> {{ __('main.actions') }} </th>
                                    </thead>
                                    <tbody>
                                    @foreach ( $sales as $sale )
                                        <tr>
                                            <td class="text-center"> {{ $loop -> index + 1}} </td>
                                            <td class="text-center"> {{ $sale -> originalBillNumber }} </td>
                                            <td class="text-center"> {{ $sale -> billNumber }} </td>
                                            <td class="text-center"> {{ $sale -> client }} </td>
                                            <td class="text-center"> {{ \Carbon\Carbon::parse($sale -> date) ->format('Y-m-d') }} </td>

                                            <td class="text-center"> {{ $sale -> total }} </td>
                                            <td class="text-center" >
                                                <a href="{{route('returnSales-view' , $sale -> id)}}">
                                                    <button type="button" style="border-radius: 15px ; height: 40px ; width: 70px" class="btn btn-success" > <iconify-icon icon="mynaui:eye" style="font-size: 20px"></iconify-icon> </button>
                                                </a>
                                                <button type="button" style="border-radius: 15px ; height: 40px ; width: 70px" class="btn btn-danger deleteBtn" value="{{ $sale -> id }}"> <iconify-icon icon="mynaui:trash-solid" style="font-size: 20px"></iconify-icon> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>


                    </div>
                </div>

                @include('Purchases.deleteModal')

                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>
<script>
    var id = 0 ;
    $( document ).ready(function() {
        $(document).on('click', '.deleteBtn', function(event) {
            id = event.currentTarget.value ;
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#deleteModal').modal("show");
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })

        });


    });
    $(document).on('click', '.btnConfirmDelete', function(event) {
        console.log(id);
        confirmDelete();
    });
    $(document).on('click', '.cancel-modal', function(event) {
        $('#deleteModal').modal("hide");
        id = 0 ;
    });
    function confirmDelete(){
        let url = "{{ route('returnSales-destroy', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }
</script>

</body>

</html>

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
                                __('main.cathes') }}</h5>
                        <button type="button" class="btn btn-info btn-lg" style="display: flex ; align-items: center;" id="createButton">
                            <span style="margin-left: 5px; margin-right: 5px"> {{ __('main.add_new') }} </span>
                            <iconify-icon icon="mingcute:plus-fill"></iconify-icon>
                        </button>
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
                                    <th class="text-center"> {{ __('main.docNumber') }} </th>
                                    <th class="text-center"> {{ __('main.date') }} </th>
                                    <th class="text-center"> {{ __('main.safe') }} </th>
                                    <th class="text-center"> {{ __('main.client') }} </th>
                                    <th class="text-center"> {{ __('main.paidAmount') }} </th>
                                    <th class="text-center"> {{ __('main.actions') }} </th>
                                    </thead>
                                    <tbody>
                                    @foreach ( $docs as $doc )
                                        <tr>
                                            <td class="text-center"> {{ $doc -> id }} </td>
                                            <td class="text-center"> {{ $doc -> billNumber }} </td>
                                            <td class="text-center"> {{ \Carbon\Carbon::parse($doc -> date) ->format('Y-m-d') }} </td>
                                            <td class="text-center"> {{ $doc -> safe }} </td>
                                            <td class="text-center"> {{ $doc -> client }} </td>
                                            <td class="text-center"> {{ $doc -> amount }} </td>
                                            <td class="text-center" >
                                                <button type="button" style="border-radius: 15px ; height: 40px ; width: 70px" class="btn btn-success viewBtn" value="{{$doc -> id}}"> <iconify-icon icon="mynaui:eye" style="font-size: 20px"></iconify-icon> </button>

                                                <button type="button" style="border-radius: 15px ; height: 40px ; width: 70px" class="btn btn-danger deleteBtn" value="{{ $doc -> id }}"> <iconify-icon icon="mynaui:trash-solid" style="font-size: 20px"></iconify-icon> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>


                    </div>
                </div>

                @include('Catchs.create')
                @include('Catchs.deleteModal')
                @include('Catchs.view')
                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>

<script >
    $(document).on('click', '#createButton', function (event) {
        id = 0;
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            type:'get',
            url:'catch-get',
            dataType: 'json',
            success:function(docNumber){
                $.ajax({
                    url: href,
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    // return the result
                    success: function (result) {
                        var date = new Date();
                        var currentDate = date.toISOString().substring(0,10);
                        //
                        $('#createModal').modal("show");
                        $(".modal-body #billNumber").val(docNumber);
                        $(".modal-body #id").val(0);
                        $(".modal-body #date").val(currentDate);
                        $(".modal-body #client_id").val("");
                        $(".modal-body #total").val("0");
                        $(".modal-body #amount").val("0");
                        $(".modal-body #notes").val("");
                        $(".modal-body #safe_id").val("");
                       // clientChangeChange();
                    },
                    complete: function () {
                        $('#loader').hide();
                    },
                    error: function (jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                    },
                    timeout: 8000
                })
            }

        });

    });

    $(document).on('click', '.viewBtn', function (event) {
        id = event.currentTarget.value ;
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            type:'get',
            url:'catch-view' + '/' + id,
            dataType: 'json',
            success:function(response){
                console.log(response);
                $.ajax({
                    url: href,
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    // return the result
                    success: function (result) {
                        var date = new Date(response.date);
                        var currentDate = date.toISOString().substring(0,10);
                        console.log(currentDate);
                        $('#viewModal').modal("show");
                        $(".modal-body #billNumber").val(response.billNumber);
                        $(".modal-body #date").val(currentDate);
                        $(".modal-body #client").val(response.client);
                        $(".modal-body #safe").val(response.safe);
                        $(".modal-body #amount").val(response.amount);
                        $(".modal-body #notes").val(response.notes);

                    },
                    complete: function () {
                        $('#loader').hide();
                    },
                    error: function (jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                    },
                    timeout: 8000
                })
            }

        });

    });

    $(document).on('click', '.deleteBtn', function(event) {
        id = event.currentTarget.value ;
        console.log(id);
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
    $(document).on('click', '.btnConfirmDelete', function(event) {
        console.log(id);
        confirmDelete();
    });
    $(document).on('click', '.cancel-modal', function(event) {
        $('#deleteModal').modal("hide");
        id = 0 ;
    });




    function confirmDelete(){
        let url = "{{ route('cathes-destroy', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }


    function clientChangeChange(){
        $(".modal-body #client_id").change(function(e){
            var client_id = e.target.value ;
          //client-get
            getClient(client_id);
        });
    }

    function getClient(id){
        $.ajax({
            type: 'get',
            url: '/client_account_get' + '/' + id,
            dataType: 'json',
            success: function (total) {
               $('#total').val(total * -1);
            }
        })
    }





</script>
</body>

</html>

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
                                __('main.clients') }}</h5>
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
                                    <th class="text-center"> {{ __('main.id') }} </th>
                                    <th class="text-center"> {{ __('main.name') }} </th>
                                    <th class="text-center"> {{ __('main.phone') }} </th>
                                    <th class="text-center"> {{ __('main.openningBalance') }} </th>
                                    <th class="text-center"> {{ __('main.balance_current') }} </th>
                                    <th class="text-center"> {{ __('main.actions') }} </th>
                                    </thead>
                                    <tbody>
                                    @foreach ( $clients as $client )
                                        <tr>
                                            <td class="text-center"> {{ $loop -> index + 1 }} </td>
                                            <td class="text-center"> {{ $client -> name }} </td>
                                            <td class="text-center"> {{ $client -> phone }} </td>
                                            <td style="font-size: 15px ; font-weight: bold ;" class="text-center @if(( $client -> beforeBalanceDebit) - ( $client -> beforeBalanceCredit) > 0) text-success @else text-danger @endif" > {{ number_format(( $client -> beforeBalanceDebit) - ( $client -> beforeBalanceCredit) , 2 )}} </td>

                                            <td style="font-size: 15px ; font-weight: bold ;" class="text-center @if(($client -> debit + $client -> beforeBalanceCredit) - ($client -> credit + $client -> beforeBalanceDebit) < 0) text-success @else text-danger @endif" > {{ number_format(($client -> debit + $client -> beforeBalanceCredit) - ($client -> credit + $client -> beforeBalanceDebit) , 2 )}} </td>
                                            <td class="text-center">

                                                <button type="button" style="border-radius: 15px; height: 40px ; width: 60px ;" class="btn btn-danger deleteBtn" value="{{ $client -> id }}"> <iconify-icon icon="mynaui:trash-solid" style="font-size: 25px"></iconify-icon> </button>
                                                <button type="button" style="border-radius: 15px; height: 40px ; width: 60px ;" class="btn btn-success editBtn" value="{{ $client -> id }}"> <iconify-icon icon="akar-icons:edit" style="font-size: 25px"></iconify-icon> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>
                </div>

                @include('Clients.create')
                @include('Clients.deleteModal')

                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>

<script >
    $(document).on('click', '#createButton', function (event) {
        console.log('clicked');
        id = 0;
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function () {
                $('#loader').show();
            },
            // return the result
            success: function (result) {
                $('#createModal').modal("show");
                $(".modal-body #id").val(0);
                $(".modal-body #name").val("");
                $(".modal-body #phone").val("");
                $(".modal-body #phone2").val("");
                $(".modal-body #mobile").val("");
                $(".modal-body #address").val("");
                $(".modal-body #pricingType").val("0");
                $(".modal-body #beforeBalanceDebit").val("0");
                $(".modal-body #beforeBalanceCredit").val("0");
                $(".modal-body #enteringTaxPerBoxPerMonth").val("0");
                $(".modal-body #coolingValuePerBoxPerMonth").val("0");
                $(".modal-body #enteringTaxPerBoxPerMonth").prop('disabled', true);
                $(".modal-body #coolingValuePerBoxPerMonth").prop('disabled', true);
                $(".modal-body #pricingType").change(function(e){
                    var val = e.target.value;
                    if(val == 0){
                        $(".modal-body #enteringTaxPerBoxPerMonth").prop('disabled', true);
                        $(".modal-body #coolingValuePerBoxPerMonth").prop('disabled', true);
                    } else {
                        $(".modal-body #enteringTaxPerBoxPerMonth").prop('disabled', false);
                        $(".modal-body #coolingValuePerBoxPerMonth").prop('disabled', false);
                    }
                });
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
    });

    $(document).on('click', '.editBtn', function(event) {
        let id = event.currentTarget.value ;
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            type:'get',
            url:'client-get' + '/' + id,
            dataType: 'json',

            success:function(response){
                console.log(response);
                if(response){
                    let href = $(this).attr('data-attr');
                    $.ajax({
                        url: href,
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        // return the result
                        success: function(result) {
                            $('#createModal').modal("show");
                            $(".modal-body #id").val(response.id);
                            $(".modal-body #name").val(response.name);
                            $(".modal-body #phone").val(response.phone);
                            $(".modal-body #phone2").val(response.phone2);
                            $(".modal-body #mobile").val(response.mobile);
                            $(".modal-body #address").val(response.address);
                            $(".modal-body #pricingType").val(response.pricingType);
                            $(".modal-body #beforeBalanceDebit").val(response.beforeBalanceDebit);
                            $(".modal-body #beforeBalanceCredit").val(response.beforeBalanceCredit);
                            $(".modal-body #enteringTaxPerBoxPerMonth").val(response.enteringTaxPerBoxPerMonth);
                            $(".modal-body #coolingValuePerBoxPerMonth").val(response.coolingValuePerBoxPerMonth);
                            $(".modal-body #enteringTaxPerBoxPerMonth").prop('disabled', response.pricingType == 0);
                            $(".modal-body #coolingValuePerBoxPerMonth").prop('disabled', response.pricingType == 0);
                            $(".modal-body #pricingType").change(function(e) {
                                var val = e.target.value;
                                if (val == 0) {
                                    $(".modal-body #enteringTaxPerBoxPerMonth").prop('disabled', true);
                                    $(".modal-body #coolingValuePerBoxPerMonth").prop('disabled', true);
                                } else {
                                    $(".modal-body #enteringTaxPerBoxPerMonth").prop('disabled', false);
                                    $(".modal-body #coolingValuePerBoxPerMonth").prop('disabled', false);
                                }
                            });

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
                } else {

                }
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
        let url = "{{ route('client-destroy', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }

</script>
</body>

</html>

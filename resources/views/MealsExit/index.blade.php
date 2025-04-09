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
                                __('main.meals_exit') }}</h5>
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
                                    <th class="text-center"> {{ __('main.client') }} </th>
                                    <th class="text-center"> {{ __('main.date') }} </th>
                                    <th class="text-center"> {{ __('main.meal') }} </th>
                                    <th class="text-center"> {{ __('main.item') }} </th>
                                    <th class="text-center"> {{ __('main.quantity') }} </th>
                                    <th class="text-center"> {{ __('main.boxes') }} </th>
                                    <th class="text-center"> {{ __('main.duration') }} </th>
                                    <th class="text-center"> {{ __('main.outingTax') }} </th>
                                    <th class="text-center"> {{ __('main.actions') }} </th>
                                    </thead>
                                    <tbody>
                                    @foreach ( $meals as $meal )
                                        <tr>
                                            <td class="text-center"> {{ $meal -> id }} </td>
                                            <td class="text-center"> {{ $meal -> client }} </td>
                                            <td class="text-center"> {{ \Carbon\Carbon::parse($meal -> date) ->format('Y-m-d') }} </td>
                                            <td class="text-center"> {{ $meal -> code }} </td>
                                            <td class="text-center"> {{ $meal -> item_name }} -- {{$meal -> item_code}} </td>
                                            <td class="text-center"> {{ $meal -> quantity }} </td>
                                            <td class="text-center"> {{ $meal -> quantity  / 4}} </td>
                                            <td class="text-center"> {{ $meal -> duration}} </td>
                                            <td class="text-center"> {{ $meal -> outingTax}} </td>
                                            <td class="text-center" >

                                                <button type="button" style="border-radius: 15px ; height: 40px ; width: 60px" class="btn btn-danger deleteBtn"  value="{{ $meal -> id }}"> <iconify-icon icon="mynaui:trash-solid" style="font-size: 20px"></iconify-icon> </button>
                                                <button type="button" style="border-radius: 15px ; height: 40px ; width: 60px"  class="btn btn-success editBtn" value="{{ $meal -> id }}"> <iconify-icon icon="carbon:view-filled" style="font-size: 20px"></iconify-icon> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>


                    </div>
                </div>

                @include('MealsExit.create')
                @include('MealsExit.deleteModal')

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
                var date = new Date();
                var currentDate = date.toISOString().substring(0,10);

                $('#createModal').modal("show");
                $(".modal-body #id").val(0);
                $(".modal-body #code").val("");
                $(".modal-body #meal_id").val("");
                $(".modal-body #item_id").val("");
                $(".modal-body #client_id").val("");
                $(".modal-body #date").val(currentDate);
                $(".modal-body #enteringDate").val(currentDate);
                $(".modal-body #duration").val(duration);
                $(".modal-body #quantity").val("0");
                $(".modal-body #boxes").val("0");
                $(".modal-body #outingTax").val("0");
                $(".modal-body #description").val("");

                $(".modal-body #meal_id").prop('disabled', false);
                $(".modal-body #client_id").prop('disabled', false);

                selectItemAction();
                quantityTextChange();
                boxesTextChange();
                exitDataChange();
                $(".modal-body #client_id").change(function(e){
                    getOutingTax();
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
            url:'/meals_exit-get' + '/' + id,
            dataType: 'json',

            success:function(response){
                console.log(response);
                if(response){
                    let href = $(this).attr('data-attr');

                    var date = new Date(response.date);
                    var day = date.getDate(),
                        month = date.getMonth() + 1,
                        year = date.getFullYear();
                    month = (month < 10 ? "0" : "") + month;
                    day = (day < 10 ? "0" : "") + day;
                    var operationDate = year + "-" + month + "-" + day ;

                    var date2 = new Date(response.enteringDate);
                    var day2 = date2.getDate(),
                        month2 = date2.getMonth() + 1,
                        year2 = date2.getFullYear();
                    month2 = (month2 < 10 ? "0" : "") + month2;
                    day2 = (day2 < 10 ? "0" : "") + day2;
                    var enteringDate = year2 + "-" + month2 + "-" + day2 ;

                    $.ajax({
                        url: href,
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        // return the result
                        success: function(result) {
                            $('#createModal').modal("show");
                            $(".modal-body #id").val(response.id);
                            $(".modal-body #code").val(response.code);
                            $(".modal-body #meal_id").val(response.meal_id);
                            $(".modal-body #item_id").val(response.item_id);
                            $(".modal-body #client_id").val(response.client_id);
                            $(".modal-body #date").val(operationDate);
                            $(".modal-body #enteringDate").val(enteringDate);
                            $(".modal-body #quantity").val(response.quantity);
                            $(".modal-body #boxes").val(response.quantity/4);
                            $(".modal-body #outingTax").val(response.outingTax);
                            $(".modal-body #duration").val(response.duration);
                            $(".modal-body #description").val(response.description);

                            $(".modal-body #meal_id").prop('disabled', true);
                            $(".modal-body #client_id").prop('disabled', true);

                            selectItemAction();
                            quantityTextChange();
                            boxesTextChange();
                            exitDataChange();
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
        let url = "{{ route('meals_exit-destroy', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }

    function selectItemAction(){
        $(".modal-body #meal_id").change(function(e){
            var id = e.target.value;
            $.ajax({
                type:'get',
                url:'/item_meals_exit' + '/' + id,
                dataType: 'json',
                success:function(response){
                        console.log(response);

                    var date = new Date(response.date);
                    var day = date.getDate(),
                        month = date.getMonth() + 1,
                        year = date.getFullYear();
                    month = (month < 10 ? "0" : "") + month;
                    day = (day < 10 ? "0" : "") + day;
                    var operationDate = year + "-" + month + "-" + day ;


                    var date2 = new Date( $(".modal-body #date").val());
                    const diffTime = Math.abs(date2 - date);
                    console.log(diffTime);
                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 2;
                    $(".modal-body #enteringDate").val(operationDate);
                    $(".modal-body #item_id").val(response.item_id);
                    $(".modal-body #client_id").val(response.client_id);
                    $(".modal-body #duration").val(diffDays);
                    $(".modal-body #oldQuantity").val(response.quantity - response.outingQuantity);
                    $(".modal-body #quantity").attr({
                        "max" : (response.quantity - response.outingQuantity),
                        "min" : 1
                    });
                    $(".modal-body #boxes").attr({
                        "max" : (response.quantity - response.outingQuantity) / 4,
                        "min" : 0.25
                    });
                    $.ajax({
                        type:'get',
                        url:'/get_exit_meal_count' + '/' + id,
                        dataType: 'json',
                        success:function(response){
                            var prefix = "" ;

                            if(response.length  > 0){
                                $.ajax({
                                    type:'get',
                                    url:'/get_exit_meal_item' + '/' + id,
                                    dataType: 'json',
                                    success:function(response2){
                                        if(response2){
                                            var prefix = "" ;

                                            prefix =   String( response.length + 1 ).padStart(3, '0') + '-MX-' +
                                                response2.name + '--' + response2.code;


                                            $(".modal-body #code").val(prefix);


                                        } else {
                                            $(".modal-body #code").val("");
                                        }
                                    }
                                });
                            } else {
                                $.ajax({
                                    type:'get',
                                    url:'/get_exit_meal_item' + '/' + id,
                                    dataType: 'json',
                                    success:function(response){
                                        console.log(response);
                                        if(response){
                                            var prefix = "" ;

                                            prefix =   String( 1 ).padStart(3, '0') + '-MX-' +
                                                response.name + '--' + response.code;


                                            $(".modal-body #code").val(prefix);


                                        } else {
                                            $(".modal-body #code").val("");
                                        }
                                    }
                                });
                            }


                        } ,
                        error: function (err) {
                            $(".modal-body #code").val("");
                        }
                    });



                } ,
                error: function (err) {
                    var date = new Date();
                    var currentDate = date.toISOString().substring(0,10);
                    $(".modal-body #enteringDate").val(currentDate);
                    $(".modal-body #item_id").val(0);
                    $(".modal-body #duration").val(0);
                }
            });


        });
    }
    function quantityTextChange(){
        $(".modal-body #quantity").change(function(e){
            var val = e.target.value ;
            $(".modal-body #boxes").val(val > 0 ? val / 4 : 0);
            getOutingTax();
        });

        $(".modal-body #quantity").keyup(function(e){
            var val = e.target.value ;
            $(".modal-body #boxes").val(val > 0 ? val / 4 : 0);
            getOutingTax();
        });
    }

    function boxesTextChange(){
        $(".modal-body #boxes").change(function(e){
            var val = e.target.value ;
            $(".modal-body #quantity").val( val * 4 );
            getOutingTax();
        });

        $(".modal-body #boxes").keyup(function(e){
            var val = e.target.value ;
            $(".modal-body #quantity").val(val * 4);
            getOutingTax();
        });
    }


    function getOutingTax(){
        if($(".modal-body #client_id").val() != ""){

            $.ajax({
                type:'get',
                url:'/client-get/'+$(".modal-body #client_id").val() ,
                dataType: 'json',
                success:function(client){
                    console.log(client);
                    var tax = 0 ;
                    if(client.pricingType == 0){
                        $.ajax({
                            type:'get',
                            url:'/settings_get',
                            dataType: 'json',
                            success:function(response){

                                if(response){
                                    var qnt = $(".modal-body #boxes").val();
                                    var days = $(".modal-body #duration").val();
                                    var months = Math.floor(days/30);
                                    if(days % 30 > 0){
                                        months += 1 ;
                                    }
                                    var tax = qnt * months * response.monthly_cooling_tax_per_box ;

                                    $(".modal-body #outingTax").val(tax);


                                } else {
                                    $(".modal-body #outingTax").val("0");
                                }
                            }
                        });
                    } else {
                        var qnt = $(".modal-body #boxes").val();
                        var days = $(".modal-body #duration").val();
                        var months = Math.floor(days/30);
                        if(days % 30 > 0){
                            months += 1 ;
                        }
                        var tax = qnt * months * client.coolingValuePerBoxPerMonth ;

                        $(".modal-body #outingTax").val(tax);
                    }
                } ,
                error: function (err) {
                    $.ajax({
                        type:'get',
                        url:'/settings_get',
                        dataType: 'json',
                        success:function(response){

                            if(response){
                                var qnt = $(".modal-body #boxes").val();
                                var days = $(".modal-body #duration").val();
                                var months = Math.floor(days/30);
                                if(days % 30 > 0){
                                    months += 1 ;
                                }
                                var tax = qnt * months * response.monthly_cooling_tax_per_box ;

                                $(".modal-body #outingTax").val(tax);


                            } else {
                                $(".modal-body #outingTax").val("0");
                            }
                        }
                    });
                }
            });
        } else {
            $.ajax({
                type:'get',
                url:'/settings_get',
                dataType: 'json',
                success:function(response){

                    if(response){
                        var qnt = $(".modal-body #boxes").val();
                        var days = $(".modal-body #duration").val();
                        var months = Math.floor(days/30);
                        if(days % 30 > 0){
                            months += 1 ;
                        }
                        var tax = qnt * months * response.monthly_cooling_tax_per_box ;

                        $(".modal-body #outingTax").val(tax);


                    } else {
                        $(".modal-body #outingTax").val("0");
                    }
                }
            });
        }

    }

    function exitDataChange(){
        $(".modal-body #date").change(function(e){
            var date = new Date($(".modal-body #enteringDate").val());
            var date2 = new Date( $(".modal-body #date").val());
            const diffTime = Math.abs(date2 - date);
            console.log(diffTime);
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 2;
            $(".modal-body #duration").val(diffDays);
            getOutingTax();

        });

    }



</script>
</body>

</html>

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
                                __('main.advances') }}</h5>
                            <button type="button" class="btn btn-info btn-lg"
                                style="display: flex ; align-items: center;" id="createButton">
                                <span style="margin-left: 5px; margin-right: 5px"> {{ __('main.add_new') }} </span>
                                <iconify-icon icon="mingcute:plus-fill"></iconify-icon>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-wrapper">

                                <table class="table table-striped  table-bordered table-hover" id="table">
                                    <thead>
                                        <th class="text-center"> {{ __('main.id') }} </th>
                                        <th class="text-center"> {{ __('main.date') }} </th>
                                        <th class="text-center"> {{ __('main.employe') }} </th>
                                        <th class="text-center"> {{ __('main.type') }} </th>
                                        <th class="text-center"> {{ __('main.amount') }} </th>
                                        <th class="text-center"> {{ __('main.actions') }} </th>
                                    </thead>
                                    <tbody>
                                        @foreach ( $operations as $operation )
                                        <tr>
                                            <td class="text-center"> {{ $operation -> id }} </td>
                                            <td class="text-center"> {{ $operation -> date }} </td>
                                            <td class="text-center"> {{ $operation -> employe }} </td>
                                            <td class="text-center"> <span @if ($operation -> type == 0 ) class="badge
                                                    text-bg-warning" @else class="badge text-bg-info" @endif> {{
                                                    $operation -> type == 0 ? __('main.month_advance') :
                                                    __('main.payments_advance') }} </span></td>
                                            <td class="text-center"> {{ $operation -> amount }} </td>
                                            <td class="text-center">

                                                <button type="button" class="btn btn-danger deleteBtn"
                                                    value="{{ $operation -> id }}">
                                                    <iconify-icon icon="mynaui:trash-solid" style="font-size: 25px">
                                                    </iconify-icon>
                                                </button>
                                                <button type="button" class="btn btn-success editBtn"
                                                    value="{{ $operation -> id }}">
                                                    <iconify-icon icon="akar-icons:edit" style="font-size: 25px">
                                                    </iconify-icon>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

                    @include('advances.create')
                    @include('advances.deleteModal')

                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#createButton', function (event) {
        console.log('clicked');
        id = 0;
        event.preventDefault();
        let href = $(this).attr('data-attr');

        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var next_month = ("0" + (now.getMonth() + 2)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        var startTade =now.getFullYear()+"-"+(next_month)+"-"+(day) ;


        $.ajax({
            url: href,
            beforeSend: function () {
                $('#loader').show();
            },
            // return the result
            success: function (result) {
                $('#createModal').modal("show");
                $(".modal-body #payments").hide();
                $(".modal-body #id").val(0);
                $(".modal-body #user_id").val(0);
                $(".modal-body #date").val(today);
                $(".modal-body #type").val(0);
                $(".modal-body #amount").val(0);
                $(".modal-body #monthlyPayment").val(0);
                $(".modal-body #startDate").val(startTade);
                $(".modal-body #paymentsCount").val(0);
                $(".modal-body #remainPaymentsCount").val(0);

                $(".modal-body #type").change(function(val){
                    console.log(val.target.value);
                    if(val.target.value == 0){
                    $(".modal-body #payments").slideUp();
                    } else {
                    $(".modal-body #payments").slideDown();
                    }
            });

            $(".modal-body #monthlyPayment").keyup(function(val){
                var amount = 0 ;
                var  allAmount  = $(".modal-body #amount").val();
                var payments = 0 ;
                amount = val.target.value ;
                payments = allAmount / amount ;
                $(".modal-body #paymentsCount").val(payments);
                $(".modal-body #remainPaymentsCount").val(payments);



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
            url:'/advances-get' + '/' + id,
            dataType: 'json',

            success:function(response){
                console.log(response);
                var now = new Date(response.date);
                var start = new Date(response.startDate);

                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var date_val = now.getFullYear()+"-"+(month)+"-"+(day) ;

                var day2 = ("0" + start.getDate()).slice(-2);
                var month2 = ("0" + (start.getMonth() + 1)).slice(-2);
                var date_val2 = start.getFullYear()+"-"+(month2)+"-"+(day2) ;


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
                            if(response.type == 0){
                                $(".modal-body #payments").hide();
                            } else {
                                $(".modal-body #payments").show();
                            }
                            $(".modal-body #id").val(response.id);
                            $(".modal-body #user_id").val(response.user_id);
                            $(".modal-body #date").val(date_val);
                            $(".modal-body #type").val(response.type);
                            $(".modal-body #amount").val(response.amount);
                            $(".modal-body #monthlyPayment").val(response.monthlyPayment);
                            $(".modal-body #startDate").val(date_val2);
                            $(".modal-body #paymentsCount").val(response.paymentsCount);
                            $(".modal-body #remainPaymentsCount").val(response.remainPaymentsCount);
                            $(".modal-body #type").change(function(val){
                                 if(val.target.value == 0){
                                    $(".modal-body #payments").slideUp();
                                 } else {
                                    $(".modal-body #payments").slideDown();
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
        console.log()
        id = 0 ;
    });




    function confirmDelete(){
        let url = "{{ route('advances-destroy', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }

    </script>
</body>

</html>

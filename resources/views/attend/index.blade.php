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
        <div class="body-wrapper edit_layout"  >
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header"
                            style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.attend') }}</h5>
                            <div style="display: flex ; gap: 10px">
                             <div class="form-group">
                                 <select id="month" name="month" class="form-control">
                                     <option value="1">  {{__('main.month1')}} </option>
                                     <option value="2">  {{__('main.month2')}} </option>
                                     <option value="3">  {{__('main.month3')}} </option>
                                     <option value="4">  {{__('main.month4')}} </option>
                                     <option value="5">  {{__('main.month5')}} </option>
                                     <option value="6">  {{__('main.month6')}} </option>
                                     <option value="7">  {{__('main.month7')}} </option>
                                     <option value="8">  {{__('main.month8')}} </option>
                                     <option value="9">  {{__('main.month9')}} </option>
                                     <option value="10">  {{__('main.month10')}} </option>
                                     <option value="11">  {{__('main.month11')}} </option>
                                     <option value="12">  {{__('main.month12')}} </option>
                                 </select>
                             </div>
                                <div class="form-group">
                                    <select id="year" name="year" class="form-control">
                                        <option value="2020">  2020 </option>
                                        <option value="2021">  2021 </option>
                                        <option value="2022">  2022 </option>
                                        <option value="2023">  2023 </option>
                                        <option value="2024">  2024 </option>
                                        <option value="2025">  2025 </option>
                                        <option value="2026">  2026 </option>
                                        <option value="2027">  2027 </option>
                                        <option value="2028">  2028 </option>
                                        <option value="2029">  2029 </option>
                                        <option value="2030">  2030 </option>

                                    </select>
                                </div>
                                <div class="form-group">

                                    <select class="form-control" id="user_id" name="user_id">
                                        <option value="0"> All </option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee -> id}}" >{{$employee -> name}}</option>

                                        @endforeach

                                    </select>

                                </div>


                                <button type="button" class="btn btn-success btn-lg"
                                        style="display: flex ; align-items: center;" id="excelFile">
                                    <span style="margin-left: 5px; margin-right: 5px"> {{ __('main.excel_attend') }} </span>
                                    <iconify-icon icon="line-md:text-box-multiple"></iconify-icon>
                                </button>
                            </div>

                        </div>
                        @include('flash-message')
                        <div class="card-body">
                            <div class="table-wrapper">
                                <div class="table-responsive">
                                <table class="table table-striped  table-bordered table-hover" id="mtable">
                                    <thead>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> {{ __('main.day') }} </th>
                                        <th class="text-center"> {{ __('main.employe') }} </th>
                                        <th class="text-center"> {{ __('main.on_duty') }} </th>
                                        <th class="text-center"> {{ __('main.off_duty') }} </th>
                                        <th class="text-center"> {{ __('main.clock_in') }} </th>
                                        <th class="text-center"> {{ __('main.clock_out') }} </th>
                                        <th class="text-center"> {{ __('main.late') }} </th>
                                        <th class="text-center"> {{ __('main.early') }} </th>
                                        <th class="text-center"> {{ __('main.absent') }} </th>
                                        <th class="text-center"> {{ __('main.workTime') }} </th>
                                        <th class="text-center"> {{ __('main.actions') }} </th>
                                    </thead>
                                    <tbody id="attend-body">
                                        @foreach ( $attends as $attend )
                                        <tr>
                                            <td class="text-center"> {{ $attend -> id }} </td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($attend -> date) -> format("d-m-Y")  }} </td>
                                            <td class="text-center"> {{ $attend -> employee_name }} </td>
                                            <td class="text-center"> {{ $attend -> on_duty }} </td>
                                            <td class="text-center"> {{ $attend -> off_duty }} </td>
                                            <td class="text-center"> {{ $attend -> clock_in }} </td>
                                            <td class="text-center"> {{ $attend -> clock_out }} </td>
                                            <td class="text-center"> {{ $attend -> late }} </td>
                                            <td class="text-center"> {{ $attend -> early }} </td>
                                            <td class="text-center">
                                              <input type="checkbox" readonly @if(strtolower($attend -> absent) == "true") checked  @endif>
                                            </td>
                                            <td class="text-center"> {{ $attend -> workTime }} </td>
                                            <td class="text-center">

                                                <button type="button" class="btn btn-success editBtn"
                                                    value="{{ $attend -> id }}" style="width: 60px;height: 40px;border-radius: 15px;">
                                                    <iconify-icon icon="akar-icons:edit" style="font-size: 20px">
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
                    </div>


                    @include('attend.create')
                    @include('attend.excelFile')
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('assets/jquery-easyui/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jquery-easyui/jquery.easyui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jquery-easyui/plugins/jquery.timepicker.js')}}"></script>
    <script>
        var data = {};
        $( document ).ready(function() {
            var d = new Date();
            var month = d.getMonth() ;
            var year = d.getFullYear();
            $('#month').val(month);
            $('#year').val(year);
            $('#user_id').val("0");

        });

        $('#month').on('change', function() {
            console.log(this.value);
            var month =  this.value ;
            var year =  $('#year').val();
            var user_id =  $('#user_id').val();
            getAttend(month , year , user_id);
        });
        $('#year').on('change', function() {
            var year =  this.value ;
            var month =  $('#month').val();
            var user_id =  $('#user_id').val();
            getAttend(month , year , user_id);
        });
        $('#user_id').on('change', function() {
            var user_id =  this.value ;
            var month =  $('#month').val();
            var year =  $('#year').val()
            getAttend(month , year , user_id);
        });

    $(document).on('click', '#createButton', function (event) {
        id = 0;
        event.preventDefault();
        let href = $(this).attr('data-attr');

        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;


        $.ajax({
            url: href,
            beforeSend: function () {
                $('#loader').show();
            },
            // return the result
            success: function (result) {
                $('#createModal').modal("show");
                $(".modal-body #id").val(0);
                $(".modal-body #user_id").val(0);
                $(".modal-body #date").val(today);
                $(".modal-body #on_duty").val("09:00");
                $(".modal-body #off_duty").val("17:00");
                $(".modal-body #clock_in").val("09:00");
                $(".modal-body #clock_out").val("17:00");



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
            url:'/attend-get' + '/' + id,
            dataType: 'json',

            success:function(response){
                data = response ;
                var now = new Date(response.date);

                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var date_val = now.getFullYear()+"-"+(month)+"-"+(day) ;



                if(response){
                    let href = $(this).attr('data-attr');
                    $.ajax({
                        url: href,
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        // return the result
                        success: function(result) {

                            console.log(response.on_duty);
                            $('#createModal').modal("show");


                            $(".modal-body #id").val(response.id);
                            $(".modal-body #user_id").val(response.user_id);
                            $(".modal-body #date").val(date_val);
                            var absent = response.absent.toLowerCase() == 'true' ? 'true' : 'false' ;
                            $(".modal-body #absent").val(absent);

                            $(".modal-body #on_duty").timepicker( { hour24: true ,} );
                            $(".modal-body #off_duty").timepicker( { hour24: true ,} );
                            $(".modal-body #clock_in").timepicker( { hour24: true ,} );
                            $(".modal-body #clock_out").timepicker( { hour24: true ,} );

                            $(".modal-body #on_duty").timepicker(  'setValue', response.on_duty );
                            $(".modal-body #off_duty").timepicker( 'setValue', response.off_duty);
                            $(".modal-body #clock_in").timepicker( 'setValue', response.clock_in);
                            $(".modal-body #clock_out").timepicker('setValue', response.clock_out);


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

    $(document).on('click', '#excelFile', function(event) {
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
                    $('#excelModal').modal("show");
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

        $('#createModal').on('shown.bs.modal', function () {
            //$(".modal-body #on_duty").val(data.on_duty.toString()).trigger('change');
            // $(".modal-body #off_duty").val( data.off_duty.toString());
            // $(".modal-body #clock_in").val( data.clock_in);
            // $(".modal-body #clock_out").val( data.clock_out);
        });
    function  getAttend(month , year , user_id){
        $.ajax({
            type:'get',
            url:'/getAttendAjax' + '/' + month + '/' + year + '/' + user_id,
            dataType: 'json',

            success:function(attends){
               $('#attend-body').html("");
               let html = '';

                attends.forEach(attend => {
                    let checked = attend.absent.toLowerCase() == 'true' ? 'checked' : '';
                       html += ` <tr>
                            <td class="text-center">${attend.id}</td>
                            <td class="text-center">${new Date(attend.date).toLocaleDateString('en-GB')}</td>
                            <td class="text-center">${attend.employee_name}</td>
                            <td class="text-center">${attend.on_duty}</td>
                            <td class="text-center">${attend.off_duty}</td>
                            <td class="text-center">${attend.clock_in}</td>
                            <td class="text-center">${attend.clock_out}</td>
                            <td class="text-center">${attend.late}</td>
                            <td class="text-center">${attend.early}</td>
                            <td class="text-center"><input type="checkbox" disabled class="absent"   ${checked}/></td>
                            <td class="text-center">${attend.workTime}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success editBtn" value="${attend.id}" style="width: 60px;height: 40px;border-radius: 15px;">
                                    <iconify-icon icon="akar-icons:edit" style="font-size: 20px"></iconify-icon>
                                </button>
                            </td>
                        </tr>`;

                   });
                $('#attend-body').html(html);


            }
        });

    }

    function confirmDelete(){
        let url = "{{ route('advances-destroy', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }



    </script>
</body>

</html>

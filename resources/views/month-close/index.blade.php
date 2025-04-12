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
                                __('main.monthly_close') }}</h5>
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
                                    <span style="margin-left: 5px; margin-right: 5px"> {{ __('main.approve_salary') }} </span>
                                    <iconify-icon icon="line-md:confirm"></iconify-icon>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-wrapper">

                                <table class="table table-striped  table-bordered table-hover" id="mtable">
                                    <thead>
                                        <th class="text-center"> {{ __('main.id') }} </th>
                                        <th class="text-center"> {{ __('main.date') }} </th>
                                        <th class="text-center"> {{ __('main.employe') }} </th>
                                        <th class="text-center"> {{ __('main.attend_days_count') }} </th>
                                        <th class="text-center"> {{ __('main.absence_days_count') }} </th>
                                        <th class="text-center"> {{ __('main.deductions_days_count') }} </th>
                                        <th class="text-center"> {{ __('main.bonse_days_count') }} </th>
                                        <th class="text-center"> {{ __('main.deductions_amount') }} </th>
                                        <th class="text-center"> {{ __('main.bonse_amount') }} </th>
                                        <th class="text-center"> {{ __('main.advance_amount') }} </th>
                                        <th class="text-center"> {{ __('main.net_salary') }} </th>
                                        <th class="text-center"> {{ __('main.actions') }} </th>
                                    </thead>
                                    @if($isSalary == 0)
                                    <tbody id="attend-body">
                                    @foreach ( $attends as $attend )

                                    @endforeach
                                    </tbody>
                                        @else
                                        <tbody id="attend-body">
                                        @foreach ( $salaries as $salary )
                                            <tr>
                                                <td class="text-center"> {{ $salary -> tag }} </td>
                                                <td class="text-center">{{ \Carbon\Carbon::parse($salary -> date) -> format("d-m-Y")  }} </td>
                                                <td class="text-center"> {{ $salary -> attend_days_count }} </td>
                                                <td class="text-center"> {{ $attend -> absence_days_count }} </td>
                                                <td class="text-center"> {{ $attend -> deductions_days_count }} </td>
                                                <td class="text-center"> {{ $attend -> bonse_days_count }} </td>
                                                <td class="text-center"> {{ $attend -> deductions_amount }} </td>
                                                <td class="text-center"> {{ $attend -> bonse_amount }} </td>
                                                <td class="text-center"> {{ $attend -> advance_amount }} </td>
                                                <td class="text-center"> {{ $attend -> net_salary }} </td>
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
                                    @endif
                                </table>
                            </div>


                        </div>
                    </div>



                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>


</body>

</html>

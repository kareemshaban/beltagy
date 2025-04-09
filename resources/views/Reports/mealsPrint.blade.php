<!doctype html>
<html lang="en">
@include('layouts.head')
<style type="text/css" media="print">
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }
</style>

<body>
<div class="body-wrapper" @if(Config::get('app.locale')=='ar' )
    style="margin-left: 0 ; margin-right: 0px ; direction: rtl;" @else
         style="margin-right: 0 ; margin-left: 0px ; direction: ltr;" @endif>
    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">تقرير كشف التبريد</h5>

                </div>
                <div class="table-wrapper">
                    <div class="table-responsive">
                        <table class="table table table-striped  table-bordered table-hover"  id="table" >
                            <thead>
                            <th class="text-center"> # </th>
                            <th class="text-center"> {{ __('main.client') }} </th>
                            <th class="text-center"> {{ __('main.date') }} </th>
                            <th class="text-center"> {{ __('main.meal') }} </th>
                            <th class="text-center"> {{ __('main.item') }} </th>
                            <th class="text-center"> {{ __('main.boxes') }} </th>
                            <th class="text-center"> {{ __('main.enteringTax') }} </th>

                            </thead>
                            <tbody id="table_body">
                            @foreach ( $data as $meal )
                                <tr >
                                    <td class="text-center"> {{ $meal -> id }} </td>
                                    <td class="text-center"> {{ $meal -> client_name }} </td>
                                    <td class="text-center"> {{ \Carbon\Carbon::parse($meal -> date) ->format('Y-m-d') }} </td>
                                    <td class="text-center"> {{ $meal -> code }} </td>
                                    <td class="text-center"> {{ $meal -> item_name }} -- {{$meal -> item_code}} </td>
                                    <td class="text-center"> {{ $meal -> quantity  / 4}} </td>
                                    <td class="text-center"> {{ $meal -> enteringTax}} </td>
                                </tr>

                                @if(count($meal -> exits) > 0)

                                    <td colspan="7">
                                        <table class="table table-danger table-striped  table-bordered " >
                                            <thead>
                                            <tr>
                                                <td colspan="8" class="text-center text-primary">  رسائل الخروج من {{ $meal -> item_name }} -- {{$meal -> item_code}} </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center"> # </th>
                                                <th class="text-center"> {{ __('main.client') }} </th>
                                                <th class="text-center"> {{ __('main.date') }} </th>
                                                <th class="text-center"> {{ __('main.meal') }} </th>
                                                <th class="text-center"> {{ __('main.item') }} </th>
                                                <th class="text-center"> {{ __('main.boxes') }} </th>
                                                <th class="text-center"> {{ __('main.duration') }} </th>
                                                <th class="text-center"> {{ __('main.outingTax') }} </th>
                                            </tr>

                                            </thead>
                                            <tbody>
                                            @foreach ( $meal -> exits as $exit )
                                                <tr>


                                                    <td class="text-center"> {{ $exit -> id }} </td>
                                                    <td class="text-center"> {{ $exit -> client }} </td>
                                                    <td class="text-center"> {{ \Carbon\Carbon::parse($exit -> date) ->format('Y-m-d') }} </td>
                                                    <td class="text-center"> {{ $exit -> code }} </td>
                                                    <td class="text-center"> {{ $exit -> item_name }} -- {{$exit -> item_code}} </td>
                                                    <td class="text-center"> {{ $exit -> quantity  / 4}} </td>
                                                    <td class="text-center"> {{ $exit -> duration}} </td>
                                                    <td class="text-center"> {{ $exit -> outingTax}} </td>
                                                </tr>
                                            @endforeach

                                            </tbody>

                                        </table>
                                    </td>
                                @else
                                    <tr style="background: #0a53be">

                                        <td colspan="8" class="text-danger text-center"> لا يوجد رسائل خروج </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="4" class="text-center text-dark" style="font-weight: bold">   رصيد الرسالة الباقي  </td>
                                    <td colspan="4"  class="text-center text-success">  {{($meal -> quantity - $meal -> outingQuantity) / 4}}  {{__('main.box')}} </td>

                                </tr>



                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>
    </div>

</div>
<script>

    print();
    window.close();

</script>

</body>
</html>

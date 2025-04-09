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
                    <div class="card">
                        <div class="card-header"style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.filters') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row" style="align-items: end;">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.client') }}  </label>
                                        <select class="form-select @error('client_id') is-invalid @enderror" name="client_id" id="client_id">
                                            <option value=""> أختر العميل </option>
                                            @foreach($clients as $client)
                                                <option value="{{$client -> id}}"> {{$client -> name}} </option>
                                            @endforeach
                                        </select>
                                        @error('client_id')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror


                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.item') }}  </label>
                                        <select class="form-select @error('item_id') is-invalid @enderror" name="item_id" id="item_id">
                                            <option value=""> أختر الصنف </option>
                                            @foreach($items as $item)
                                                <option value="{{$item -> id}}"> {{$item -> name}} -- {{$item -> code}} </option>
                                            @endforeach
                                        </select>
                                        @error('client_id')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror


                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-primary" style="width: 100px" onclick="filterAction()">{{ __('main.search_btn') }}</button>
                                </div>

                            </div>


                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header"style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.client_meals') }}</h5>
                            <div>
                                <button type="button" class="btn btn-warning" style="width: 100px" onclick="printAction()" >{{ __('main.print_btn') }}</button>
                                <button type="button" hidden="hidden" class="btn btn-success" style="width: 100px" onclick="excelAction()">EXCEL</button>

                            </div>


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
                                        <th class="text-center"> {{ __('main.client') }} </th>
                                        <th class="text-center"> {{ __('main.date') }} </th>
                                        <th class="text-center"> {{ __('main.meal') }} </th>
                                        <th class="text-center"> {{ __('main.item') }} </th>
                                        <th class="text-center"> {{ __('main.quantity') }} </th>
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
                                                <td class="text-center"> {{ $meal -> quantity }} </td>
                                                <td class="text-center"> {{ $meal -> quantity  / 4}} </td>
                                                <td class="text-center"> {{ $meal -> enteringTax}} </td>
                                            </tr>

                                            @if(count($meal -> exits) > 0)

                                                <td colspan="8">
                                                    <table class="table table-danger table-striped  table-bordered " >
                                                        <thead>
                                                        <tr>
                                                            <td colspan="9" class="text-center text-primary">  رسائل الخروج من {{ $meal -> item_name }} -- {{$meal -> item_code}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center"> # </th>
                                                            <th class="text-center"> {{ __('main.client') }} </th>
                                                            <th class="text-center"> {{ __('main.date') }} </th>
                                                            <th class="text-center"> {{ __('main.meal') }} </th>
                                                            <th class="text-center"> {{ __('main.item') }} </th>
                                                            <th class="text-center"> {{ __('main.outingQnt') }} </th>
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
                                                                <td class="text-center"> {{ $exit -> quantity }} </td>
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

                    @include('MealsEnter.create')
                    @include('MealsEnter.deleteModal')

                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

    <script >
    function filterAction(){
      var item_id = $('#item_id').val();
      var client_id = $('#client_id').val();
      var detailsObjOfArray = {};

      $.ajax({
         url:"{{route('meals_report')}}",
         type:"GET",
         data:{'item_id': item_id , 'client_id': client_id},
         success: function (data){
             var html = '' ;
             var details = "" ;
             var items = data.data ;
             console.log('items' , items);
             document.getElementById('table_body').innerHTML = "" ;
             if(items.length > 0){
                 for(let i = 0 ; i < items.length ; i++){
                     details = "" ;
                     var date = new Date(items[i]['date']);
                     var day = date.getDate(),
                         month = date.getMonth() + 1,
                         year = date.getFullYear();
                     month = (month < 10 ? "0" : "") + month;
                     day = (day < 10 ? "0" : "") + day;
                     var operationDate = year + "-" + month + "-" + day ;
                     var id = 'exits_id' + items[i]['id'] ;


                     html += '<tr >\
                     <td class="text-center"> '+ items[i]['id']+' </td>\
                     <td class="text-center"> '+ items[i]['client_name']+'  </td>\
                     <td class="text-center"> '+ operationDate +'   </td>\
                     <td class="text-center">   ' + items[i]['code'] +' </td>\
                     <td class="text-center"> ' + items[i]['item_name'] + '--' + items[i]['item_code']  +' </td>\
                     <td class="text-center"> ' + items[i]['quantity'] +  ' </td>\
                     <td class="text-center"> ' + items[i]['quantity'] / 4 +  '  </td>\
                     <td class="text-center"> ' + items[i]['enteringTax'] +  '  </td>\
                 </tr>' ;

                     if(items[i]['exits'].length > 0){

                         html += '<td colspan="8">\
                             <table class="table table-danger table-striped  table-bordered " >\
                             <thead>\
                             <tr>\
                             <td colspan="9" class="text-center text-primary">  رسائل الخروج من {{ $meal -> item_name }} -- {{$meal -> item_code}} </td>\
                     </tr>\
                         <tr>\
                             <th class="text-center"> # </th>\
                             <th class="text-center"> {{ __('main.client') }} </th>\
                             <th class="text-center"> {{ __('main.date') }} </th>\
                             <th class="text-center"> {{ __('main.meal') }} </th>\
                             <th class="text-center"> {{ __('main.item') }} </th>\
                             <th class="text-center"> {{ __('main.outingQnt') }} </th>\
                             <th class="text-center"> {{ __('main.boxes') }} </th>\
                             <th class="text-center"> {{ __('main.duration') }} </th>\
                             <th class="text-center"> {{ __('main.outingTax') }} </th>\
                         </tr>\
                     </thead>\
                         <tbody id=  ' + id + ' >\
                             </tbody>\
                     </table>\
                     </td>';


                       for(let n = 0 ; n < items[i]['exits'].length ; n++){
                           var date = new Date(items[i]['exits'][n]['date']);
                           var day = date.getDate(),
                               month = date.getMonth() + 1,
                               year = date.getFullYear();
                           month = (month < 10 ? "0" : "") + month;
                           day = (day < 10 ? "0" : "") + day;
                           var operationDate = year + "-" + month + "-" + day ;

                           details += '<tr>\
                            <td class="text-center"> ' + items[i]['exits'][n]['id'] + '</td>\
                           <td class="text-center">  ' + items[i]['exits'][n]['client'] + ' </td>\
                           <td class="text-center"> ' + operationDate + '   </td>\
                           <td class="text-center">  ' + items[i]['exits'][n]['code'] + ' </td>\
                           <td class="text-center"> ' + items[i]['exits'][n]['item_name']  + '--' +  items[i]['exits'][n]['item_code']  + ' </td>\
                           <td class="text-center"> ' + items[i]['exits'][n]['quantity'] + '  </td>\
                           <td class="text-center"> ' + items[i]['exits'][n]['quantity'] / 4 + '  </td>\
                           <td class="text-center"> ' + items[i]['exits'][n]['duration'] + ' </td>\
                           <td class="text-center"> ' + items[i]['exits'][n]['outingTax'] + ' </td>\
                       </tr>';
                           detailsObjOfArray[id] =  details ;

                       }

                     } else {
                         html += '<tr style="background: #0a53be">\
                             <td colspan="8" class="text-danger text-center"> لا يوجد رسائل خروج </td>\
                     </tr>';
                     }
                     html += '<tr>\
                         <td colspan="4" class="text-center text-dark" style="font-weight: bold">   رصيد الرسالة الباقي  </td>\
                     <td colspan="5"  class="text-center text-success"> ' + (items[i]['quantity']  - items[i]['outingQuantity'] ) / 4 + '  {{__('main.box')}} </td>\
                 </tr>';
                 }
                 console.log(html);

                 document.getElementById('table_body').innerHTML = html ;
              //   document.getElementById(id).innerHTML = details ;

                 for (const [key, value] of Object.entries(detailsObjOfArray)) {

                     document.getElementById(key).innerHTML = value ;
                 }

                console.log(detailsObjOfArray);

             } else {
                 html = '<tr> No Data found ! </tr>' ;
                 document.getElementById('table_body').innerHTML = html;
             }
         }
      });
    }

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

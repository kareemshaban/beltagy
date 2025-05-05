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
                                __('main.weight_statment') }}</h5>

                    </div>
                    <div class="card-body">
                        <div class="container-fluid">

                            <form class="center" method="POST" action="{{ route('balance-store') }}"
                                  enctype="multipart/form-data">
                            @csrf
                               <div class="row">
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                       <div class="form-group">
                                           <label> {{__('main.client')}}</label>
                                           <select class="form-control" id="client_id" name="client_id" required>
                                               <option value="">اختر العميل</option>
                                               @foreach($clients as $client)
                                                   <option value="{{$client -> id}}"> {{$client ->name}}</option>

                                               @endforeach

                                           </select>

                                       </div>

                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                       <div class="form-group">
                                           <label> {{__('main.item')}}</label>
                                           <select class="form-control" id="item_id" name="item_id" required>
                                               <option value="">اختر الصنف</option>
                                               @foreach($items as $item)
                                                   <option value="{{$item -> id}}"> {{$item -> code }} -- {{$item -> name  }}</option>
                                               @endforeach
                                           </select>

                                       </div>

                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                       <div class="form-group">
                                           <label> {{__('main.date')}}</label>
                                           <input type="text" name="date" id="date"
                                                  class="form-control date @error('date') is-invalid @enderror"
                                                  autofocus required  placeholder="dd-mm-yyyy" min="1997-01-01" max="2050-12-31"/>

                                       </div>

                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                       <div class="form-group">
                                           <label> {{__('main.quantity')}}</label>
                                           <input type="text" name="total_quantity" id="total_quantity"
                                                  class="form-control @error('total_quantity') is-invalid @enderror"
                                                  autofocus required  readonly/>

                                       </div>

                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                       <div class="form-group">
                                           <label> {{__('main.net_weight')}}</label>
                                           <input type="text" name="net_weight" id="net_weight"
                                                  class="form-control @error('net_weight') is-invalid @enderror"
                                                  autofocus required readonly/>

                                       </div>

                                   </div>
                               </div>

                                <div class="card" style="margin-top: 10px">
                                    <div class="card-header"
                                         style="display: flex ; justify-content: space-between ; align-items: center">
                                        <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.weights') }}</h5>

                                    </div>

                                    <div class="card-body">
                                        <div class="table-wrapper">
                                            <div class="table-responsive">
                                                <table class="table table-striped  table-bordered table-hover" id="mtable">
                                                    <thead>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    <th class="text-center"> {{ __('main.weight') }} </th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $id = 0 ?>
                                                    @for ( $i = 0  ; $i < 10 ; $i++ )
                                                        <tr>
                                                            @for ( $j = 0  ; $j < 10 ; $j++ )
                                                                @php
                                                                    $id = 'weight' . $i . '-' . $j;
                                                                @endphp
                                                                <td class="text-center" style="padding-left: 5px ; padding-right: 5px">
                                                                    <input class="form-control weight_cell" type="text"  id="{{ $id }}"
                                                                           name="{{ $id }}[]"     data-row="{{ $i }}"
                                                                           data-col="{{ $j }}"/>
                                                                </td>

                                                            @endfor


                                                        </tr>
                                                    @endfor
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="10" class="text-center text-primary" style="font-size: 18px">  {{__('main.total_weights')}} </td>
                                                    </tr>
                                                    <tr>
                                                        @for ( $t = 0  ; $t < 10 ; $t++ )
                                                            @php
                                                                $id = 'weight_total' . $t;
                                                            @endphp
                                                            <td class="text-center" style="padding-right: 5px ; padding-left: 5px">
                                                                <input class="form-control total_cell" type="text" id="{{ $id }}" name="weight_total[]" readonly  />
                                                            </td>

                                                        @endfor


                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="row"style="margin-top: 10px">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label> {{__('main.weight_all')}}</label>
                                            <input type="text" name="weight" id="weight"
                                                   class="form-control @error('weight_all') is-invalid @enderror"
                                                   autofocus required  readonly/>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label> {{__('main.burlap_weight')}}</label>
                                            <input type="text" name="burlap_weight" id="burlap_weight"
                                                   class="form-control @error('burlap_weight') is-invalid @enderror"
                                                   autofocus required  readonly/>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label> {{__('main.price')}}</label>
                                            <input type="number" step="any" name="price" id="price"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   autofocus required  />
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label> {{__('main.total')}}</label>
                                            <input type="text" name="total" id="total"
                                                   class="form-control @error('total') is-invalid @enderror"
                                                   autofocus required  readonly/>
                                        </div>

                                    </div>
                                </div>


                                <div class="row" style="margin-top: 40px">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-warning" onclick="valdiateRequest()">{{ __('main.save_btn') }}</button>

                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>



                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>

<script>


    $(document).ready(function() {
        $('#client_id').val("");
        $('#item_id').val("");
        $('#total_quantity').val("");
        $('#net_weight').val("");
        $('#weight').val("");
        $('#burlap_weight').val("");
        $('#price').val("");
        $('#total').val("");

        $('.weight_cell').each(function() {
            $(this).val("");
        });
        $('.total_cell').each(function() {
            $(this).val("");
        });
        var date = new Date();
        var day = date.getDate(),
            month = date.getMonth() + 1,
            year = date.getFullYear();
        month = (month < 10 ? "0" : "") + month;
        day = (day < 10 ? "0" : "") + day;
        var currentDate = year + "-" + month + "-" + day ;
        $('#date').val(currentDate);

        $('.weight_cell').on('change keyup', function() {
            // Your code here
            let newValue = $(this).val();
            let colIndex = $(this).data('col');
            let rowIndex = $(this).data('row');
            if(rowIndex == 0 && colIndex == 0){
                changeAction(colIndex);
            }

        });


    });

    function changeAction(colIndex){
        let sum = 0;
        $('.weight_cell').each(function() {
            if ($(this).data('col') == colIndex) {
                let val = parseFloat($(this).val());
                if (!isNaN(val)) {
                    sum += val;
                }
            }
        });
        let total_id = 'weight_total' + colIndex ;
        $('#'+total_id).val(sum);
        calculateTotal();
    }
    function  valdiateRequest(){

    }
    function calculateTotal(){
        let sum = 0 ;
        $('.total_cell').each(function() {
            let val = parseFloat($(this).val());
            if (!isNaN(val)) {
                sum += val;
            }
            console.log(sum);
            $('#weight').val(sum);
        });
    }
</script>
</body>

</html>

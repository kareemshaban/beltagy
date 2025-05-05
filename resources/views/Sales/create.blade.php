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
                <form class="center" id="invoiceForm" name="invoiceForm" method="POST" action="{{ route('sales-store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header"
                             style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.create_sales') }}</h5>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.billNumber') }} </label>
                                        <input type="text" name="billNumber" id="billNumber"
                                               class="form-control @error('billNumber') is-invalid @enderror"
                                               placeholder="" autofocus  readonly required />
                                        @error('billNumber')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.date') }} </label>
                                        <input type="text" name="date" id="date"
                                               class="form-control date @error('date') is-invalid @enderror"
                                               placeholder="" autofocus required/>
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="row" style="align-items: end ; margin-top: 5px">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.client') }}  </label>
                                        <select class="form-select @error('client_id') is-invalid @enderror" name="client_id" id="client_id" required>
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
                                <div class="col-6 text-center">
                                    <button type="button"  id="btnItemsShow" style="border-radius: 10px;display: block;width: 100%;"
                                            class="btn btn-secondary">{{ __('main.show_items') }}</button>

                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.description') }}</label>
                                        <textarea  name="notes" id="notes" rows="3"
                                                   class="form-control @error('notes') is-invalid @enderror"
                                                   placeholder="{{ __('main.notes') }}" autofocus ></textarea>
                                        @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                @include('flash-message')

                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="text-center text-primary"> {{__('main.invoice_details')}}  </h2>
                            <div class="table-wrapper">
                                <div class="table-responsive">
                                    <table class="table table-striped  table-bordered table-hover">
                                        <thead>
                                        <th class="text-center" hidden="hidden"> details_id </th>
                                        <th class="text-center" hidden="hidden"> item_id </th>
                                        <th class="text-center" style="width:25%" > {{ __('main.item') }} </th>
                                        <th class="text-center" style="width:15%"> {{ __('main.quantity') }} </th>
                                        <th class="text-center" style="width:15%"> {{ __('main.weight') }} </th>
                                        <th class="text-center" style="width:15%"> {{ __('main.price') }} </th>
                                        <th class="text-center" style="width:25%"> {{ __('main.total') }} </th>
                                        <th class="text-center" style="width:10%"> {{ __('main.actions') }} </th>
                                        </thead>
                                        <tbody id="invoice-details">

                                        </tbody>
                                    </table>
                                </div>


                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.total') }} </label>
                                        <input type="text" name="total" id="total"
                                               class="form-control @error('total') is-invalid @enderror"
                                               placeholder="" autofocus  readonly required />
                                        @error('total')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.discount') }} </label>
                                        <input type="number" step="any" name="discount" id="discount"
                                               class="form-control @error('discount') is-invalid @enderror"
                                               placeholder="" autofocus required/>
                                        @error('discount')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px ;">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.net') }} </label>
                                        <input type="text" name="net" id="net"
                                               class="form-control @error('net') is-invalid @enderror"
                                               placeholder="" autofocus  readonly required />
                                        @error('net')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>

                                </div>
                            </div>
                            <div class="row" style="margin-top: 40px">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-warning" onclick="valdiateRequest()">{{ __('main.save_btn') }}</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @include('layouts.footer')
                @include('Reports.Items')
                @include('Sales.deleteItemModal')

            </div>
        </div>
    </div>
</div>
<script>
    var items = [] ;
    var deleted_index = 0 ;
    $( document ).ready(function() {
        var date = new Date();
        var currentDate = date.toISOString().substring(0,10);
        $("#date").val(currentDate);
        $("#client_id").val("");
        $("#details").html("");
        $("#notes").val("");
        $("#total").val("");
        $("#discount").val("");
        $("#net").val("");

        $.ajax({
            type:'get',
            url:'sales-get',
            dataType: 'json',
            success:function(response){
                console.log(response);
                if(response){
                    $('#billNumber').val(response);
                }

            }
        });



        $(document).on('click', '#btnItemsShow', function(event) {
            console.log('clicked');
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#createModal').modal("show");
                    $('.modal-body #id').val("0");
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

        $('#createModal').on('hidden.bs.modal', function () {
          var id =   $(".modal-body #id").val();
          if(id > 0){
              if(items.filter(c=> c.item_id == id).length == 0){
                  addItemToTable(id);
              } else {
                  alert("هذا المنتج تم إضافته من قبل إلي الفاتورة يمكنك زيادة كميته إذا أردت");
              }

          } else {
              console.log('no item selected');
          }

        });

    });

    function addItemToTable(id){
        $.ajax({
            type:'get',
            url:'item-get' + '/' + id,
            dataType: 'json',
            success:function(response){
                var item = {
                    'details_id': 0 ,
                    'item_id': response['id'],
                    'code': response['code'],
                    'name': response['name'],
                    'quantity': 0 ,
                    'weight': 0 ,
                    'price': 0 ,
                    'total': 0
                }
                items.push(item);

                if(response){
                    setItems();
                }

            }
        });
    }

    $(document).on('change','.quantity',function () {
        var row = $(this).closest('tr');
        var index = row.attr('data-item-index');


        var quantity = parseFloat($(this).val()) ;


        items[index]['quantity']= quantity;




        setItems();

    });

    $(document).on('change','.weight',function () {
            var row = $(this).closest('tr');
            var index = row.attr('data-item-index');


            var weight = parseFloat($(this).val()) ;
            var price = items[index]['price'] ;

            items[index]['weight']= weight;
            items[index]['total']= weight * price;

            console.log(row.childNodes);


            setItems();

        });

    $(document).on('change','.price',function () {
        var row = $(this).closest('tr');
        var index = row.attr('data-item-index');

        var price = parseFloat($(this).val()) ;
        var weight = items[index]['weight'] ;
        var total = price * weight ;

        items[index]['price']= price;
        items[index]['total']= total;
        console.log(items);
        setItems();

    });

    $(document).on('click','.deleteBtn',function () {
        deleted_index = event.currentTarget.value ;
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#deleteItemModal').modal("show");
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


    $(document).on('change keyup','#discount',function () {

        var discount = parseFloat($(this).val()) ;
        var total = parseFloat($('#total').val())  ;
        var net = total - discount ;

        $('#net').val(net.toFixed(2))

    });

    function setItems(){
        var total = 0 ;
        var body = document.getElementById('invoice-details');
        var html = '' ;
        for (let i = 0 ; i < items.length ; i ++)
        {

            html += '<tr data-item-index="'+i+'">\
                        <td class="text-center" hidden="hidden"> <input type="hidden" class="form-control" id="details_id[]" name="details_id[]" value=' + items[i]['details_id'] + ' /> </td>\
                         <td class="text-center" hidden="hidden"> <input type="hidden" class="form-control" id="item_id[]" name="item_id[]" value=' + items[i]['item_id'] + ' /> </td>\
                         <td class="text-center"> ' + items[i]['code'] + '--' + items[i]['name'] + '  </td>\
                         <td class="text-center"> <input type="number" step="any"  class="form-control quantity" id="quantity[]" name="quantity[]"  autofocus  value=' + items[i]['quantity'] + '  /> </td>\
                         <td class="text-center"> <input type="number" step="any" class="form-control weight" id="weight[]" name="weight[]"  value=' + items[i]['weight'] + ' /> </td>\
                         <td class="text-center"> <input type="number" step="any" class="form-control price" id="price[]" name="price[]"  value=' + items[i]['price'] + ' /> </td>\
                         <td class="text-center"> <input type="number" step="any" class="form-control total" id="totalRow[]" name="totalRow[]"  value=' + items[i]['total'] + ' /> </td>\
                         <td class="text-center">  <button style="border-radius: 15px ; width: 60px ; height: 40px" type="button" class="btn btn-danger deleteBtn" value=' + i + '> <iconify-icon icon="mynaui:trash-solid" style="font-size: 20px"></iconify-icon> </button> </td>\
                     </tr>';
            total += (items[i]['weight'] * items[i]['price']);
        }
        body.innerHTML = html ;
        $('#total').val(total.toFixed(2));
        var discount = $('#discount').val();
        if(discount == ""){
            $('#discount').val(0);
            $('#net').val(total.toFixed(2));
        } else {
            var net = Number(total) - Number(discount);
            $('#net').val(net.toFixed(2));
        }
    }

    function valdiateRequest(){
        var msg = '' ;
        if($('#client_id').val() == "")
            msg =  'برجاء إختيار العميل' + "\n" ;
        if(items.length == 0)
            msg += 'برجاء إدخال أصناف في تفاصيل الفاتورة' + "\n" ;
        if(items.filter(c => c.quantity == 0 || c.weight == 0 || c.price == 0 || c.total == 0).length > 0)
            msg += 'عفوا هناك صنف او أكثر لم يتم إدخال بياناته بشكل صحيح' + "\n" ;
        if($('#total').val() == "")
            msg += 'عفوا لا يمكن حفظ فاتورة إجمالي المستحق بصفر' + "\n" ;
        if(msg == ''){
             $('#invoiceForm').submit();

        } else {
            alert(msg);
            return ;
        }
    }

    $(document).on('click', '.btnConfirmDelete', function(event) {
        confirmDelete();
    });
    $(document).on('click', '.cancel-modal', function(event) {
        $('#deleteItemModal').modal("hide");
        deleted_index = 0 ;
    });
    function confirmDelete(){
        console.log('clicked');
       items.splice(deleted_index , 1);
        $('#deleteItemModal').modal("hide");
       setItems();
    }


</script>

</body>

</html>

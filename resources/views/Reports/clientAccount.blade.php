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
                        <div class="card-header"style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.client_account') }}</h5>


                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                @include('flash-message')

                            </div>
                            <div class="table-wrapper">
                                <div class="table-responsive">
                                    <table class="table table table-striped  table-bordered table-hover"  id="mtable">
                                        <thead>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> {{ __('main.type') }} </th>
                                        <th class="text-center"> {{ __('main.client') }} </th>
                                        <th class="text-center"> {{ __('main.date') }} </th>
                                        <th class="text-center"> {{ __('main.docNumber') }} </th>
                                        <th class="text-center"> {{ __('main.credit') }} </th>
                                        <th class="text-center"> {{ __('main.debit') }} </th>

                                        <th class="text-center"> {{ __('main.balance') }} </th>

                                        </thead>
                                        <tbody >
                                        @foreach ( $accounts as $account )
                                            <tr >
                                                <td class="text-center"> -- </td>
                                                <td class="text-center"> الرصيد الإفتتاحي </td>
                                                <td class="text-center"> {{ $account -> client_name	 }} </td>
                                                <td class="text-center"> ---- </td>
                                                <td class="text-center"> ----</td>
                                                <td class="text-center text-danger" style="font-size: 15px ; font-weight: bold ;"> {{$account -> beforeBalanceCredit}} </td>
                                                <td class="text-center text-success" style="font-size: 15px ; font-weight: bold ;"> {{$account -> beforeBalanceDebit}} </td>

                                                <td style="font-size: 15px ; font-weight: bold ;" class="text-center @if( $account -> beforeBalanceDebit - $account -> beforeBalanceCredit > 0 )  text-success @else text-danger @endif"> {{  $account -> beforeBalanceDebit - $account -> beforeBalanceCredit}} </td>
                                            </tr>
                                        @endforeach
                                        @foreach ( $brfors as $brfore )
                                        <tr>
                                            <td class="text-center"> -- </td>
                                            <td class="text-center">  رصيد ما قبل الفترة </td>
                                            <td class="text-center"> {{ $brfore['client_name']	 }} </td>
                                            <td class="text-center"> ---- </td>
                                            <td class="text-center"> ----</td>
                                            <td class="text-center text-danger" style="font-size: 15px ; font-weight: bold ;"> {{$brfore['credit']}} </td>
                                            <td class="text-center text-success" style="font-size: 15px ; font-weight: bold ;"> {{$brfore['debit']}} </td>

                                            <td style="font-size: 15px ; font-weight: bold ;" class="text-center @if( $brfore['debit']  - $brfore['credit'] > 0 )  text-success @else text-danger @endif"> {{  $brfore['debit'] - $brfore['credit']}} </td>
                                        </tr>
                                        @endforeach

                                        @foreach ( $data as $doc )
                                            <tr >
                                                <td class="text-center"> {{ $loop -> index + 1}} </td>
                                                <td class="text-center">
                                                <span @if ($doc -> type == 2 || $doc -> type == 4 || $doc -> type == 12) class="badge
                                                    text-bg-success" @else class="badge text-bg-danger" @endif>
                                                    @if($doc -> type == 1)
                                                        {{__('main.doc1')}}
                                                    @elseif($doc -> type == 2)
                                                        {{__('main.doc2')}}
                                                    @elseif($doc -> type == 3)
                                                        {{__('main.doc3')}}
                                                    @elseif($doc -> type == 4)
                                                        {{__('main.doc4')}}
                                                    @elseif($doc -> type == 5)
                                                        {{__('main.doc5')}}
                                                    @elseif($doc -> type == 6)
                                                        {{__('main.doc6')}}
                                                    @elseif($doc -> type == 7)
                                                        {{__('main.doc7')}}
                                                    @elseif($doc -> type == 8)
                                                        {{__('main.doc8')}}
                                                    @elseif($doc -> type == 9)
                                                        {{__('main.doc9')}}
                                                    @elseif($doc -> type == 10)
                                                        {{__('main.doc10')}}
                                                    @elseif($doc -> type == 11)
                                                        {{__('main.doc11')}}
                                                    @elseif($doc -> type == 12)
                                                        {{__('main.doc12')}}
                                                    @endif
                                                </span>
                                                </td>
                                                <td class="text-center"> {{ $doc -> client	 }} </td>
                                                <td class="text-center"> {{ \Carbon\Carbon::parse($doc -> docDate) ->format('Y-m-d')  }} </td>
                                                <td class="text-center"> {{ $doc -> docNumber	 }} </td>
                                                <td class="text-center text-danger" style="font-size: 18px ; font-weight: bold ;"> {{  ($doc -> type == 2 || $doc -> type == 4 || $doc -> type == 12 )  ? 0 : $doc -> amount }} </td>
                                                <td class="text-center text-success" style="font-size: 18px ; font-weight: bold ;"> {{  ($doc -> type == 2 || $doc -> type == 4 || $doc -> type == 12)  ?  $doc -> amount : 0}} </td>

                                                <td  style="font-size: 18px ; font-weight: bold ;" class="text-center @if($doc -> type == 2 || $doc -> type == 4 || $doc -> type == 12)  text-success @else text-danger @endif"> {{  ($doc -> type == 2 || $doc -> type == 4 || $doc -> type == 12)  ? $doc -> amount : -1 * $doc -> amount}} </td>
                                            </tr>



                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr >
                                            <td class="text-center" >   </td>
                                            <td class="text-center" >   </td>
                                            <td class="text-center" style="font-size: 18px ; font-weight: bold"> إجمالي الحساب </td>
                                            <td class="text-center" >   </td>
                                            <td class="text-center" >   </td>
                                            <td class="text-center text-danger" id="credit" style="font-size: 18px ; font-weight: bold ;"></td>
                                            <td class="text-center text-success" id="debit" style="font-size: 18px ; font-weight: bold ;"></td>

                                            <td class="text-center text-primary" id="total" style="font-size: 18px ; font-weight: bold ;"></td>

                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>


                            </div>


                        </div>
                    </div>

                    @include('Reports.AddPaymnet')

                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

    <script >

    $(document).on('click', '.payBtn', function (event) {
        var id = 0;
        var type = 0 ;
         id = event.currentTarget.value ;
        type = event.currentTarget.id ;

        addPayment(id , type);
    });

    function  addPayment(id , type){
        $.ajax({
            type:'get',
            url:'/operation_get' + '/' + id + '/' + type,
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
                            var date = new Date();
                            var currentDate = date.toISOString().substring(0,10);
                            console.log(response);
                            $('#createModal').modal("show");
                            $(".modal-body #type").val(response.type);
                            $(".modal-body #taxType").val(response.type);

                            $(".modal-body #code").val(response.code);
                            $(".modal-body #operation_id").val(response.id);
                            $(".modal-body #date").val(currentDate);
                            $(".modal-body #amount").val(Number(response.remain));
                            $(".modal-body #description").val("");
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
    }

    function totalAccountPrint(){
        var client_account = document.getElementById('client_id').value ;
        if(client_account != ""){
            let url = "{{ route('client_Account_print', ':id') }}";
            url = url.replace(':id', client_account);

            window.open(url, '_blank').focus();

        } else {
            alert('برجاء اختيار عميل لعرض حسابه الإجمالي');
        }


    }


    var table = $('#mtable').DataTable({
        "dom": 'Blfrtip',
        "lengthMenu": [
            [ 50, 100, 1000, -1],
            [ 50, 100, 1000, "All"]
        ],
        "initComplete": function() {
            $("#table").show();
        },
        "buttons": [
            {
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: [ 8 , 7 ,6 , 5, 4, 3 , 2 , 1 , 0 ] ,
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 8 , 7 ,6 , 5, 4, 3 , 2 , 1 , 0 ] ,

                }
            },
            // {
            //     extend: 'pdfHtml5',
            //     exportOptions: {
            //         columns: [ 0, 1, 2, 5 ]
            //     }
            // },
            'colvis'
        ]
    });
    table.buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');

        var debit = 0 ;
        var credit = 0 ;
        var total = 0 ;

        var obj = table
        .column( 5, {page: 'current'} )
        .data() ;
        var obj2 = table
            .column( 6, {page: 'current'} )
            .data() ;
        var obj3 = table
            .column( 7, {page: 'current'} )
            .data() ;

             var i = 0 ;
            for (var key in obj) {
                if (obj.hasOwnProperty(key)) {

                    if(i < table.rows().count()){
                        credit += Number(obj[key].replace(/,/g, ''));
                    }
                    i ++ ;

                }
            }
            i=  0 ;

        for (var key2 in obj2) {
            if (obj2.hasOwnProperty(key2)) {
                if(i < table.rows().count()){
                    debit += Number(obj2[key2].replace(/,/g, ''));
                }
                i ++ ;

            }
        }
    i=  0 ;

    for (var key3 in obj3) {
        if (obj3.hasOwnProperty(key3)) {
            if(i < table.rows().count()){
                total += Number(obj3[key3].replace(/,/g, ''));
            }
            i ++ ;

        }
    }


    document.getElementById('debit').innerHTML = debit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); ;
    document.getElementById('credit').innerHTML = credit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); ;
    document.getElementById('total').innerHTML = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); ;


    $('#mtable').on('search.dt', function (e, settings) {
        console.log(e);
        var table = $('#mtable').DataTable();
        var debit = 0 ;
        var credit = 0 ;
        var total = 0 ;
        var obj = table
            .column( 5, {page: 'current'} )
            .data() ;
        var obj2 = table
            .column( 6, {page: 'current'} )
            .data() ;
        var obj3 = table
            .column( 7, {page: 'current'} )
            .data() ;

        var i = 0 ;
        for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
                if(i < table.rows({search:'applied'}).count()){
                    credit += Number(obj[key].replace(/,/g, ''));
                }
                i ++ ;

            }
        }
        i=  0 ;

        for (var key2 in obj2) {
            if (obj2.hasOwnProperty(key2)) {
                if(i < table.rows({search:'applied'}).count()){
                    debit += Number(obj2[key2].replace(/,/g, ''));
                }
                i ++ ;

            }
        }
        i=  0 ;

        for (var key3 in obj3) {
            if (obj3.hasOwnProperty(key3)) {
                if(i < table.rows({search:'applied'}).count()){
                    total += Number(obj3[key3].replace(/,/g, ''));
                }
                i ++ ;

            }
        }


        document.getElementById('debit').innerHTML = debit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); ;
        document.getElementById('credit').innerHTML = credit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); ;
        document.getElementById('total').innerHTML = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");;



    });
    </script>


</body>

</html>



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
                    <div class="card-header">
                        <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">كشف حساب عميل إجمالي</h5>

                    </div>
                    <div class="table-wrapper">
                        <table class="table table table-striped  table-bordered table-hover"  id="table" >
                            <thead>
                            <th class="text-center"> اسم العميل </th>
                            <th class="text-center"> مدين </th>
                            <th class="text-center">  دائن </th>
                            <th class="text-center"> إجمالي الحساب </th>
                            </thead>
                            <tbody>
                            @foreach($data as $account)
                                <tr>
                                    <td class="text-center" style="font-size: 18px ; font-weight: bold ;"> {{$account -> client_name}} </td>
                                    <td class="text-center  text-danger" style="font-size: 18px ; font-weight: bold ;">{{ number_format($account -> debit + $account -> beforeBalanceCredit , 2) }}  </td>
                                    <td class="text-center  text-success" style="font-size: 18px ; font-weight: bold ;"> {{number_format($account -> credit + $account -> beforeBalanceDebit  ,2)}}  </td>


                                    <td class="text-center @if( ($account -> debit + $account -> beforeBalanceCredit) - ($account -> credit + $account -> beforeBalanceDebit)> 0) text-success @else  text-danger @endif" style="font-size: 18px ; font-weight: bold ;"> {{ number_format( ($account -> debit + $account -> beforeBalanceCredit) - ($account -> credit + $account -> beforeBalanceDebit) , 2)}} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>


                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>

<script >





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
                    columns: [3 , 2 , 1 , 0 ] ,
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [  3 , 2 , 1 , 0 ] ,

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

</script>


</body>

</html>


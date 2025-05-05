<div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="" target="_blank"
                class="pe-1 text-primary text-decoration-underline">DEV TEAM</a></p>
          </div>

  <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('assets/js/app.min.js')}}"></script>
  <script src="{{asset('assets/js/dashboard.js')}}"></script>
  <!-- solar icons -->
  <script src="{{asset('assets/js/iconify-icon.min.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap.js"></script>
  <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
  <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.bootstrap.js"></script>

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

  <script>

    $( document ).ready(function() {
        // new DataTable('#table', {
        //         rowReorder: true
        //     });

        var table = $('#table').DataTable({
            "dom": 'Blfrtip',
            "lengthMenu": [
                [5 , 10 , 50, 100, 1000, -1],
                [5 , 10 , 50, 100, 1000, "All"]
            ],
            "initComplete": function() {
                $("#table").show();
            },
            "buttons": [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ ':visible:not(:last-child)' ] ,
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible',

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
    });

  </script>


<script>
if($('.date').length){
    flatpickr(".date", {
        dateFormat: "d-m-Y", // dd-mm-yyyy
    });
}
if($('.search').length){


  new Choices('.search', {
        searchEnabled: true
    });
}
    
   
</script>




<div class="modal fade" id="invoiceItemsModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.items')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                              aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body" id="smallBody">
                <input type="hidden" value="22" id="id" name="id">

                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header"
                             style="display: flex ; justify-content: space-between ; align-items: center">
                            <h5 class="card-title fw-semibold " style="margin-bottom: 0 !important; color: #3cacc8 ">{{
                                __('main.items') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                @include('flash-message')

                            </div>
                            <div class="table-wrapper">
                                <div class="table-responsive">
                                    <table class="table table-striped  table-bordered table-hover" >
                                        <thead>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> {{ __('main.id') }} </th>
                                        <th class="text-center"> {{ __('main.name') }} </th>
                                        <th class="text-center"> {{ __('main.quantity') }} </th>
                                        <th class="text-center"> {{ __('main.weight') }} </th>
                                        <th class="text-center"> {{ __('main.actions') }} </th>
                                        </thead>
                                        <tbody id="invoice-items">

                                        </tbody>
                                    </table>
                                </div>


                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.editBtn', function(event) {
            let id = event.currentTarget.value ;
            console.log(id);
            $('.modal-body #id').val(id);
            $('#invoiceItemsModal').modal("hide");

        });
    </script>
</div>

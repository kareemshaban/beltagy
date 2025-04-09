<div class="modal fade" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background: #F8F8F8 ; border-radius: 8px">
                <label class="modelTitle"> {{__('main.excelFile')}}</label>

                <iconify-icon icon="mdi:close-outline" style="color: red ; font-size: 30px; " data-bs-dismiss="modal"
                              aria-label="Close" class="modal-close"></iconify-icon>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('importFile') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excel-file"> Upload Excel File: </label>
                        <input class="form-control" type="file" name="file" id="file" required>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{ __('main.cancel_btn') }} </button>
                <button type="button" class="btn btn-warning" onclick="submitForm()"> {{ __('main.attach_btn') }} </button>
            </div>

        </div>
    </div>
</div>
<script>
    function  submitForm(){
        document.getElementById('myForm').submit();
    }
</script>

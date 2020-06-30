<div class="modal modal-danger fade" id="modal-confirm-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{$title}}</h4>
            </div>
            <div class="modal-body">
                <p>{{$message}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" id="alert-danger-confirm" class="btn btn-outline">Confirm</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@push('scripts')
<script type="text/javascript">

       $(document).on("click",".modal-confirm-danger-btn",function(){
            window.ajx = $(this).data();
       });

        $("#alert-danger-confirm").click(function(){
            $("#modal-confirm-danger").modal('toggle');
            firePost(function(response){
                    var data = response.data;
                {{isset($callBack) ? $callBack : ""}}

            });

        });
</script>
@endpush
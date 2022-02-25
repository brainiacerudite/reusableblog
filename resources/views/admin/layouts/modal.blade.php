{{-- Delete Modal --}}
<!-- sample modal content -->
<div id="delModal" class="delModal modal fade" tabindex="-1" aria-labelledby="delModalLabel" style="display: none;"
    aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delModalLabel">Are you sure you want to delete this?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="font-size-16">Are you sure you want to delete '<span class="delTitle"></span>' ?</h5>
                {{-- <p>.</p> --}}
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" id="confirmDelete" class="btn btn-secondary waves-effect"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.sample modal content -->


{{-- Approving Modal --}}
<!-- sample modal content -->
<div id="aprModal" class="aprModal modal fade" tabindex="-1" aria-labelledby="aprModalLabel" style="display: none;"
    aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aprModalLabel">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="font-size-16">Are you sure you want to <span class="aprTitle"></span> ?</h5>
                {{-- <p>.</p> --}}
            </div>
            <div class="modal-footer">
                <form id="approvingForm" method="POST">
                    @csrf
                    <button type="button" id="confirmApproving" class="btn btn-secondary waves-effect"
                        data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Yes</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.sample modal content -->


{{-- Reply Modal --}}
<!-- sample modal content -->
<div id="replyModal" class="replyModal modal fade" tabindex="-1" aria-labelledby="replyModalLabel"
    style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel">Reply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="font-size-16">Reply to <span class="replyTitle"></span> comment.</h5>
                {{-- <p>.</p> --}}
            </div>
            <form id="replyForm" method="POST">
                @csrf
                <div class="col-md-12 px-5">
                    <div class="mb-3">
                        <label class="form-label">Comment</label>
                        <textarea id="comment" class="form-control" name="comment" rows="8" maxlength="65525"
                            required="required">{{ old('comment') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label"></label>
                        <input type="hidden" class="form-control" name="comment_parent" id="comment_parent">
                    </div>
                    <div class="form-group">
                        <label class="form-label"></label>
                        <input type="hidden" class="form-control" name="comment_post_ID" id="comment_post_ID">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmReply" class="btn btn-secondary waves-effect"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Reply</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.sample modal content -->

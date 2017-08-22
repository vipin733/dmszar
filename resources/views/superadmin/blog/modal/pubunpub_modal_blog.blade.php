<div class="modal fade" tabindex="-1" role="dialog" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> @if($blog->published == 0)
                Published
                @else
                Unpublished
                @endif Confirmation</h4>
            </div>
            <div class="modal-body">
                <h1>Are you sure you, want to  @if($blog->published == 0)
                Published
                @else
                Unpublished
                @endif?</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-succes" id="delete-btn"> @if($blog->published == 0)
                Published
                @else
                Unpublished
                @endif</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
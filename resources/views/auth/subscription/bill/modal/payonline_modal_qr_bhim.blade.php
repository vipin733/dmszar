<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#qr-1"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="qr-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">QR CODE</h4>
      </div>
      <div class="modal-body">
        <div class="row">
         <div class="col-md-10 col-md-offset-1">
           <a href="#" class="thumbnail">
              <img src="{{ URL::to('/image/bhim.jpg') }}" class="img-responsive img-rounded" alt="Bhim qr">
          </a>
          </div>
         </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>

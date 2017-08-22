<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#{{$user->id}}"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User School Logo</h4>
      </div>
      <div class="modal-body">
        <div class="row">
         <div class="col-md-4 col-md-offset-4">
           <a href="#" class="thumbnail">
            @if($user->schoolprofile['logo'])
             <img src="{{ $user->schoolprofile['logo'] }}" class="{{$user->name}}" alt="Responsive image">
             @else
             <img src="{{ URL::to('/image/no-image-found.jpg') }}" class="img-responsive img-rounded" alt="School logo">
             @endif
          </a>
          </div>
         </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bank{{$bankdetail->id}}"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="bank{{$bankdetail->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Bank Details More..</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
                <table class=" table table-bordered  table-hover">
                   <thead >          
                       <tr>
                        <th class="text-center">Bank Address</th>
                        <th class="text-center">Bank MICR Code</th>
                        <th class="text-center">Description</th>
                       </tr>                                                              
                   </thead>
                   <tbody class="text-center">
                    <tr>
                       <td>
                         @if($bankdetail['bank_address'])
                          {{$bankdetail['bank_address'] }}
                          @else
                          N/A
                         @endif
                       </td> 
                       <td>
                         @if($bankdetail['bank_micr_code'])
                          {{$bankdetail['bank_micr_code'] }}
                          @else
                          N/A
                         @endif
                       </td>
                       <td>
                         @if($bankdetail['description'])
                          {{$bankdetail['description'] }}
                          @else
                          N/A
                          @endif
                       </td>
                    </tr>
                   </tbody>      
                </table>          
          </div>
          </div>
         </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
      </div>
  </div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 <i class="fa fa-eye fa-lg faa-pulse animated" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registration Fee Structure({{ $activesessionid['name'] }})</h4>
      </div>
      <div class="modal-body">
        <table class=" table table-bordered  table-hover">
            <thead>
              <tr>
                <th class="text-center">Serial No.</th>
                <th class="text-center">Course Name</th>
                <th class="text-center">Registration Fee</th>
                <th class="text-center">Late Fee</th>
                <th class="text-center">Fee Details</th>
                <th class="text-center">Remarks</th>
              </tr>
            </thead>
          <tbody class="text-center">
              <?php $i = 0 ?>
            @foreach($registraionfees as $registraionfee)
                <?php $i++ ?>
              <tr>
                  <td>{{$i}}</td>
                  <td>{{ $registraionfee->courses['name'] }}</td>
                  <td>
                  <i class="fa fa-inr" aria-hidden="true"></i>  {{ $registraionfee['registraion_fee'] }}
                  </td>
                  <td>
                  <i class="fa fa-inr" aria-hidden="true"></i> 
                  @if($registraionfee['late_fee'])
                  {{ $registraionfee['late_fee'] }}
                  @else
                  0
                  @endif
                  </td>
                  <td>
                  {{ $registraionfee['fee_details'] }}
                  </td>
                  <td>
                    @if($registraionfee['remarks'])
                    {{ $registraionfee['remarks'] }}
                    @else
                    N/A
                    @endif
                  </td>
              </tr>
             @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

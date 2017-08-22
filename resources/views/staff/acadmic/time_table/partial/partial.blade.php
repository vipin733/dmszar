




    <div class="table-responsive">
                      <table class=" table table-bordered  table-hover">
                        <thead>

                            <tr>
                                <th class="text-center col-sm-2">Day</th>
                                <th class="text-center col-sm-2">Start</th>              
                              <th class="text-center col-sm-2">End</th>                   
                              <th class="text-center">Subject</th>              
                              <th class="text-center">Teacher</th>
                              <th class="text-center col-sm-2">Remarks(if any)</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                           @foreach($days as $day)
                          <tr>                        
                                  <th  class="text-center col-sm-2"><br>{{ $day->name }}</th>

                                  <td>
                                     <br>
                                      <input type="text" class="form-control text-center col-sm-2" id="start-{{$day->id}}" name="start[]" value="{{ old('start') }}" required=""/>
                                  </td>

                                  <td>
                                      <br>
                                    <input type="text" class=" form-control text-center col-sm-2" id="end-{{$day->id}}" name="end[]" value="{{ old('end') }}" required="">
                                  </td>

                                  <td>
                                      <br>
                          <select class="form-control" id="subject-{{$day->id}}" name="subject[]" required="">
                            <option value="">--Select Subject</option>
                            @foreach($subjects as $key=>$value)
                            @if (Input::old('subject') == $key)
                            <option value="{{ $key }}" selected>{{ $value }}</option>
                            @else
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endif
                            @endforeach
                          </select>
                                  </td>

                                  <td>
                                      
                            <select name="teacher[]" id="teacher-{{$day->id}}" class="form-control" required="">
                            <option value="">--Select Teacher</option>
                          </select>
                        
                                  </td>

                                  <td>
                           <textarea name="remarks[]" id="remarks" class="form-control  col-sm-2">{{old('remarks[]')}}</textarea>
                          
                        
                                  </td>

                          </tr>
                          @endforeach
                        </tbody>
                          </table>
                      </div>
                    </div>     







                <div class="col-sm-8 col-sm-offset-2">
                    <button type="button" class="btn btn-primary btn-block">School Break Time({{$activesession->name}})</button>
                  <div class="table-responsive">
                  <table class=" table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th class="text-center col-sm-2">Break Start</th>
                            <th class="text-center col-sm-2">Break End</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                              <td>
                                  <input type="text" class="form-control text-center col-sm-2" id="break_start" name="break_start" value="{{ old('break_start') }}" required="" />
                              </td>
                              <td>
                                <input type="text" class=" form-control text-center col-sm-2" id="break_end" name="break_end" value="{{ old('break_end') }}" required="">
                              </td>
                          </tr>   
                    </tbody>
                      </table>
                  </div>
                </div>  



                <script type="text/javascript">
 $('.add_row').on('click',function(){
    add_row();
 });
  function add_row(){
    var tr =   '<tr>'+
                    '<td class="col-sm-1">'+
                         '<br>'+
                            '<div class="form-group">'+
                            '<input type="text" class="form-control" id="start" name="start[]" value="{{ old('start[]') }}" required="" />'+
                           '</div>'+
                           '<br>'+
                            '<div class="form-group">'+                                     
                                '<input type="text" class=" form-control" id="end" name="end[]" value="{{ old('end[]') }}" required="" >'+
                            '</div>'+
                        '</td>' +

                         '<td>'+
                              
                              '<div class="form-group">'+
                '<select class="form-control" id="monday_subject[]" name="monday_subject[]" required="">'+
                  '<option value="">--Select Subject</option>'+
                  '@foreach($subjects as $key=>$value)'+
                  '@if (Input::old('monday_subject[]') == $key)'+
                  '<option value="{{ $key }}" selected>{{ $value }}</option>'+
                  '@else'+
                  '<option value="{{ $key }}">{{ $value }}</option>'+
                  '@endif'+
                  '@endforeach'+
                '</select>'+
              '</div>'+

              '<div class="form-group">'+
                        
                '<select name="teacher_subject[]" id="teacher_subject[]" class="form-control" required="">'+
                    '<option value="">--Select Teacher</option>'+
                '</select>'+
              '</div>'+

              '<div class="form-group">'+
                   
                   '<textarea  name="monday_remarks[]" id="monday_remarks[]" class="form-control">{{old('monday_remarks[]')}}</textarea>'+     
                
              '</div>'+

                         '</td>'+

                '</tr>';

                  $('tbody').append(tr);
  }
</script>

<a class="btn btn-primary btn-sm pull-right add_row" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>

<div class="row">
  <div class="col-sm-8 col-sm-offset-2 text-center">
    <div class="table-responsive text-center">
      <table class=" table table-bordered  table-hover">        
          <thead>
            <tr>
              <th>Start</th>
              <th>End</th>                 
            </tr>
          </thead>
          <tbody>
            <form method="post" action="/staff/acadmic/{{$lunchtime->id}}/school_break_update" data-parsley-validate ="">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <tr>
                  <td>
                    <input type="text" class="form-control" id="start" name="start" value="{{ old('start',$lunchtime->start->format('h:i A')) }}" required="" />
                  </td>
                  
                  <td>
                    <input type="text" class="form-control" id="end" name="end" value="{{ old('end',$lunchtime->end->format('h:i A')) }}" required="" />
                  </td>
                </tr>
              <div class="col-sm-6 col-sm-offset-3">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </div>  
            </form>
          </tbody>                    
      </table>
    </div> 
  </div>  
</div>   
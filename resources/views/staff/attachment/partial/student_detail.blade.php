        <div class="col-md-6 col-md-offset-3">
           <div class="panel panel-default">
                <div class="panel-heading">
                 <a class="btn btn-primary btn-block" href="">Student Section Details({{ $courseid->name }})</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                             	<th class="text-center">Serial No.</th>
                             	<th class="text-center">Section</th>
                             	<th class="text-center">No of student</th>
                             </tr>
                           </thead>
                           <tbody class="text-center">
                           	<?php $i = 0 ?>
                            @foreach($studentscounts as $studentscount)
                             <?php $i++ ?>
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $studentscount->sections['name'] }}</td>
                                <td>{{ $studentscount->student_count }}</td>
                              </tr>
                            @endforeach 
                           </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>     
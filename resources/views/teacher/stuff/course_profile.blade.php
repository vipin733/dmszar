@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')

<div class="row">
 
   <div class="col-md-12">
     <div class="panel panel-default">
      <div class="panel-heading"><button class="btn btn-primary btn-block">My Academic Profile</button></div>
        <div class="panel-body">
            <div class="table-responsive text-center">
                <table class="table table-bordered  table-hover">
                   <thead>
                     <tr>
                         <th class="text-center">My Registration no.</th>
                         <td class="text-center">{{ Auth::user()->reg_no }}</td>
                         <th class="text-center">My Status</th>
                         <td class="text-center">
                         @if(Auth::user()->isActive())
                         Active
                         @else
                         De-active
                         @endif
                         </td>
                      </tr>

                       <tr>
                         <th class="text-center">Class Teacher</th>
                         <td class="text-center">
                          {{ $teacheracadmic->courses['name'] or 'N/A'}}
                         </td>
                         <th class="text-center">Class Section Teacher</th>
                         <td class="text-center">
                         	 {{ $teacheracadmic->sections['name'] or 'N/A' }}
                         </td>
                       </tr>


                    </thead>                  
                </table>
              </div>
        </div>
   </div> 
       <button class="btn btn-warning btn-xs btn-block"><b>Disclaimer</b></button>
    <p style="text-align: justify;">This result is issued on the basis of information available in the office of records on the date of its issue and the School reserves the right to update/change any information contained here in without further notice. The School expressly disclaims all obligations to confirm the accuracy of any of the particulars in this result based upon information submitted by the candidate. For any Result/Mapping query Consult School  Management.</p>       
</div>

</div>

@stop
@extends('layouts.app')
@section('nav')
@if(Auth::user()->isStaff())
@include('staff.staff_nav')
@else
@include('teacher.teacher_nav')
@endif
@stop
@section('content')

  <div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel-heading">
                      <button class="btn btn-primary btn-block">Student Information</button>
                </div>
                <div class="panel-body">
                      <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                              <th class="text-center">Reg No.</th>
                              <th  class="text-center">Student Name</th>
                              <th  class="text-center">Father Name</th>
                              <th class="text-center">View Profile</th>                          
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $student['reg_no'] }}</td>
                               <td>{{ $student['name'] }}</td>
                               <td>{{ $student['father_name'] }}</td>
                               <td>
                               <a href="/st/student/{{$student['reg_no']}}" class="btn btn-primary">
                               <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                               </a>
                               </td>
                             </tr>
                           </tbody>
                        </table>
                      </div>
                </div>
        </div>
    </div>  

    <div class="col-md-8 col-md-offset-2">
    	<button class="btn btn-primary btn-xs btn-block">Grades</button><br>
    	<div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-default btn-block"><b>Session: 2012-13; Class: V; TGPA: 7.90</b></button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                            <thead>
                             <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Grade</th>
                             </tr>
                            </thead> 
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>CHEMISTRY</td>
                                    <td>C</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>CHEMISTRY LABORATORY</td>
                                    <td>C</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>FOUNDATIONS OF COMPUTING</td>
                                    <td>D</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>COMMUNICATION SKILLS-IV</td>
                                    <td>C</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>ENGINEERING MECHANICS</td>
                                    <td>B-</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>ENGINEERING MATHEMATICS-I</td>
                                    <td>C</td>
                                </tr>
                                
                            </tbody>                 
                        </table>
                     </div>
                </div>
                <div class="panel-heading"><button class="btn btn-default btn-block"><b>Session: 2013-14; Class: VI; TGPA: 8.20</b></button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                            <thead>
                             <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Grade</th>
                             </tr>
                            </thead> 
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>COMMUNICATION SKILLS-VI</td>
                                    <td>D</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>ENGINEERING GRAPHICS</td>
                                    <td>B-</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>EXCITEMENT OF ENGINEERING</td>
                                    <td>B</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>ENGINEERING MATHEMATICS-II</td>
                                    <td>B</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>WAVES ELECTRICITY AND MAGNETISM</td>
                                    <td>B</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>PHYSICS LABORATORY</td>
                                    <td>C</td>
                                </tr>
                                
                            </tbody>                 
                        </table>
                     </div>
                </div>
                <div class="panel-heading"><button class="btn btn-default btn-block"><b>Session: 2014-15; Class: VII; TGPA: 7.20</b></button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                            <thead>
                             <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Grade</th>
                             </tr>
                            </thead> 
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ELECTRICAL ENGINEERING</td>
                                    <td>B</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>FUNCTIONAL COMMUNICATION SKILLS-III</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>MECHANICS OF SOLIDS</td>
                                    <td>C-</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>FLUID MECHANICS</td>
                                    <td>B-</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>METROLOGY AND MEASUREMENT</td>
                                    <td>B</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>STRENGTH OF MATERIAL AND MEASUREMENT LABORATORY</td>
                                    <td>C-</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>ANALYTICAL SKILLS-I</td>
                                    <td>B</td>
                                </tr>
                                
                            </tbody>                 
                        </table>
                     </div>
                </div>
                <div class="panel-heading"><button class="btn btn-default btn-block"><b>Session: 2015-16; Class: VIII; TGPA: 7.80</b></button></div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                            <thead>
                             <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Grade</th>
                             </tr>
                            </thead> 
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ENGINEERING THERMODYNAMICS</td>
                                    <td>A+</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>MANUFACTURING TECHNOLOGY</td>
                                    <td>B-</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>MATERIAL SCIENCE AND METALLURGY</td>
                                    <td>C</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>MACHINES AND MECHANISMS</td>
                                    <td>C</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>COMPUTER AIDED MACHINE DRAWING</td>
                                    <td>A</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>ENGINEERING MATHEMATICS-III</td>
                                    <td>B</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>PHYSICS OF SENSORS</td>
                                    <td>B-</td>
                                </tr>
                                
                            </tbody>                 
                        </table>
                     </div>
                </div>
            </div>

    </div>
</div>

@endsection
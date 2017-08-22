<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Student Till Now</div>
        <div class="panel-body">
           <h1 class="text-center">{{$students}}</h1>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Active Student</div>
        <div class="panel-body">
           <h1 class="text-center">{{$active_students}}</h1>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Teacher Till Now</div>
        <div class="panel-body">
           <h1 class="text-center">{{$teachers}}</h1>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Active Teacher</div>
        <div class="panel-body">
           <h1 class="text-center">{{$active_teachers}}</h1>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Staff Till Now</div>
        <div class="panel-body">
           <h1 class="text-center">{{$staffs}}</h1>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Active Staff Now</div>
        <div class="panel-body">
           <h1 class="text-center">{{$active_staffs}}</h1>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Tuition Fee Collection</div>
        <div class="panel-body">
           <h1 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> {{$total_tution_fee}}</h1>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Registration Fee Collection</div>
        <div class="panel-body">
           <h1 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> {{$total_registration_fee}}</h1>
        </div>
    </div>
</div>

@if(!$user->schoolprofile['transport_service']==0)
@if(!$user->schoolprofile['hostel_service']==0)
<div class="col-md-6">
@else
<div class="col-md-6 col-md-offset-3">
@endif
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Transport Fee Collection</div>
        <div class="panel-body">
           <h1 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> {{$total_transport_fee}}</h1>
        </div>
    </div>
</div>
@endif

@if(!$user->schoolprofile['hostel_service']==0)
@if(!$user->schoolprofile['transport_service']==0)
<div class="col-md-6">
@else
<div class="col-md-6 col-md-offset-3">
@endif
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Total Hostel Fee Collection</div>
        <div class="panel-body">
           <h1 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> {{$total_hostel_fee}}</h1>
        </div>
    </div>
</div>
@endif



<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Comparing Students with previous Year students</div>
        <div class="panel-body" >
           <canvas id="Compairing_student_line" height="400" width="600"></canvas>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Comparing fee Collection with previous Year(in <i class="fa fa-inr" aria-hidden="true"></i> 1000).</div>
        <div class="panel-body">
           <canvas id="Compairing_fee_line" height="400" width="600"></canvas>
        </div>
    </div>
</div>


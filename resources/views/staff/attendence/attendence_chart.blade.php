@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

  <div class="row">
        <a class="btn btn-primary pull-right" href="/staff/attendence/details">Details</a>
        @include('teacher_staff_student.attendence.attendence_view')
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
@include('teacher_staff_student.attendence.attendence_chart')
@endsection
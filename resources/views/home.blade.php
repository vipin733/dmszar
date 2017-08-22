@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

    <div class="row">
         
        @include('auth.home.auth_home')

    </div>
 <br><br>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
<script type="text/javascript" src="/js/utils.js"></script>
@include('auth.graph.javascript.bar.Compairing_student_bar')
@include('auth.graph.javascript.bar.Compairing_fee_bar')
@stop

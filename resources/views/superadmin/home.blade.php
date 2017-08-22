@extends('layouts.app')
@section('nav')
@include('superadmin.layouts.superadmin_nav')
@stop
@section('content')

<div class="row">

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Total User Register</div>
                <div class="panel-body">
                   <h1 class="text-center">12</h1>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Total Active User</div>
                <div class="panel-body">
                   <h1 class="text-center">10</h1>
                </div>
            </div>
        </div>

         <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Compairing User with previous year</div>
                <div class="panel-body">
                   <canvas id="Compairing_user_line" height="280" width="600"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Compairing Income Collection with previous Year(in <i class="fa fa-inr" aria-hidden="true"></i> 1000).</div>
                <div class="panel-body">
                   <canvas id="Compairing_fee_line" height="280" width="600"></canvas>
                </div>
            </div>
        </div>

</div>       

@stop


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
@include('superadmin.graph.javascript.line.Compairing_user_line')
@include('superadmin.graph.javascript.line.Compairing_fee_line')
@stop
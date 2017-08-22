@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button class="btn btn-primary btn-block">
                    <b>Students(Active)</b>
                </button>
            </div>  
            <div class="panel-body">      
            <canvas id="Chart61" height="280" width="600"></canvas>
            </div>
        </div>    
    </div>


    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button class="btn btn-primary btn-block">
                    <b>Students (Gender wise)</b>
                </button>
            </div>  
            <div class="panel-body">      
                <canvas id="Chart2" height="280" width="600"></canvas>
            </div>
        </div>    
    </div>


    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button class="btn btn-primary btn-block">
                    <b>Students(Comparing to session wise)</b>
                </button>
            </div>  
            <div class="panel-body">      
                <canvas id="Chart8" height="280" width="600"></canvas>
            </div>
        </div>    
    </div>


    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button class="btn btn-primary btn-block">
                    <b>Revenue Session wise (Per <i class="fa fa-inr" aria-hidden="true"></i> 1000)</b>
                </button>
            </div>  
            <div class="panel-body">      
                <canvas id="Chart13" height="280" width="600"></canvas>
            </div>
        </div>    
    </div>
    

</div>     

 @stop

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
@include('staff.analysis.javascript.bar_analysis_javasrcipt')
@include('staff.analysis.javascript.line_analysis_javasrcipt')
@include('staff.analysis.javascript.pie_analysis_javasrcipt')
@include('staff.analysis.javascript.radar_analysis_javasrcipt')

@endsection    
<script type="text/javascript">
   
    var data_2016  = [5,1,2,1,0,5,7,2,1,0,5,6];
    var data_2017  = [5,4,0,1,3,1,7,4,1,10,1,4];
    var data_month_name   = ["January","Fabruary","March","April","May","June","July","Agust","September","October","Navember","December"];
    
var ctx = document.getElementById("Compairing_user_line");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: data_month_name,
        datasets: [{
            label: '2016',
            data: data_2016,
             fill: false,
            lineTension: 0.1,
            backgroundColor: "#6e3d0e",
            borderColor: "#6e3d0e",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "#6e3d0e",
            pointBackgroundColor: "#6e3d0e",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#6e3d0e",
            pointHoverBorderColor: "#6e3d0e",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            spanGaps: false
        },{
            label: '2017',
            data: data_2017,
             fill: false,
            lineTension: 0.1,
            backgroundColor: "#0b0d3e",
            borderColor: "#0b0d3e",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "#0b0d3e",
            pointBackgroundColor: "#0b0d3e",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#0b0d3e",
            pointHoverBorderColor: "#0b0d3e",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            spanGaps: false
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

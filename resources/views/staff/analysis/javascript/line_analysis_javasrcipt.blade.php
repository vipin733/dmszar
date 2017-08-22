<script type="text/javascript">
   
    var fees                 = <?php echo $fees; ?>;
    var fee_sessions         = <?php echo $fee_sessions; ?>;

    
var ctx = document.getElementById("Chart13");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: fee_sessions,
        datasets: [{
            label: 'Fees',
            data: fees,
             fill: false,
            lineTension: 0.1,
            backgroundColor: "#337ab7",
            borderColor: "#337ab7",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "#337ab7",
            pointBackgroundColor: "#337ab7",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#337ab7",
            pointHoverBorderColor: "#337ab7",
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
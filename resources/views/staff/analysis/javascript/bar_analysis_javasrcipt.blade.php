

<script type="text/javascript">
   
    var data_student        = <?php echo $totalstudentssessions; ?>;
    var session             = <?php echo $sessions; ?>;

var ctx = document.getElementById("Chart8");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: session,
        datasets: [{
            label: 'Students',
            data: data_student,
            backgroundColor:'#337ab7',
            hoverBackgroundColor:'#337ab7', 
            borderWidth: 1
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
<script type="text/javascript">
   
   
    var studentsmale         = <?php echo $totalstudentsmale; ?>;
    var studentsfemale       = <?php echo $totalstudentsfemale; ?>;
    var studentsother        = <?php echo $totalstudentsother; ?>;
    var courses              = <?php echo $totalcourses; ?>;
    

var ctx = document.getElementById("Chart2");
var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
        labels: courses,
    datasets: [
        {
            label: "Female",
            backgroundColor: "rgba(179,181,198,0.2)",
            borderColor: "rgba(179,181,198,1)",
            pointBackgroundColor: "rgba(179,181,198,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(179,181,198,1)",
            data: studentsfemale
        },
        {
            label: "Male",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            pointBackgroundColor: "rgba(255,99,132,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(255,99,132,1)",
            data: studentsmale
        },
        {
            label: "Other",
            backgroundColor: "rgba(50,99,132,0.2)",
            borderColor: "rgba(50,99,132,1)",
            pointBackgroundColor: "rgba(50,99,132,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(50,99,132,1)",
            data: studentsother
        }]
    },
    options: {
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero:true
                },
                 gridLines: {
                    display:false
                }
            }]
        }
    }
});
</script>
<script type="text/javascript">
      
      
   var feesfirstsession       = <?php echo $feesfirstsession; ?>;
   var feessecondsession      = <?php echo $feessecondsession; ?>;
   var course_names           = <?php echo $course_names; ?>;
   var firstsession           = <?php echo $first_session; ?>;
   var secondsession          = <?php echo $second_session; ?>;

var ctx = document.getElementById("Compairing_fee_line");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: course_names,
        datasets: [{
            label: secondsession,
            data: feessecondsession,
            backgroundColor:'rgb(54, 162, 235)',
            hoverBackgroundColor:'rgb(54, 162, 235)', 
            borderWidth: 1
        },{
            label: firstsession,
            data: feesfirstsession,
            backgroundColor:'rgb(255, 99, 132)',
            hoverBackgroundColor:'rgb(255, 99, 132)', 
            borderWidth: 1,
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

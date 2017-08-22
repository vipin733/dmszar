<script type="text/javascript">
   
  var firstsession_students  = <?php echo $firstsession_students; ?>;
   var secondsession_students = <?php echo $secondsession_students; ?>;
   var course_names           = <?php echo $course_names; ?>;
   var firstsession           = <?php echo $first_session; ?>;
   var secondsession          = <?php echo $second_session; ?>;

var ctx = document.getElementById("Compairing_student_line");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: course_names,
        datasets: [{
            label: secondsession,
            data: secondsession_students,
            backgroundColor:'rgb(54, 162, 235)',
            hoverBackgroundColor:'rgb(54, 162, 235)', 
            borderWidth: 1
        },{
            label: firstsession,
            data: firstsession_students,
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

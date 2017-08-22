<script type="text/javascript">
   
   
      var data_student       = <?php echo $totalstudents; ?>;
      var course             = <?php echo $totalcourses; ?>;


    var data_color = ["#FF6384","#36A2EB","#FFCE56",'#E54320','#F5DC0B','#BB1AEA','#30B960','#EE0E8C','#808000','#3C25E3','#2B3D27','#CD853F','#DDA0DD','#663399','#FF0000','#C0C0C0','#DC143C','#FF4500','#FF8C00','#800080','#006400','#00FFFF','#181818','#267373'];
    

var ctx = document.getElementById("Chart61").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: course,
    datasets:[
        {
            data: data_student,
            backgroundColor:data_color,
            hoverBackgroundColor:data_color
        }]
    }
});
</script>

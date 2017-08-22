
  <script type="text/javascript">
  var month = <?php echo $date; ?>;
  var tota = <?php echo $tota; ?>;
      var ctx = document.getElementById("myChart");
       var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
          labels: month,
        datasets: [{
            label: 'attendance',
            data: tota,
            backgroundColor:'#3097D1',
            hoverBackgroundColor:'#3097D1', 
           
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                   min: 0,
                   max: 100,
                      callback: function(value){return value+ "%"} 
                    },
                    scaleLabel: {
                   display: true
                
                }
               
            }]
        }
    }
});
  </script>


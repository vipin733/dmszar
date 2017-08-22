<script type="text/javascript">
     $('#capture').on('click',function(){
    $("#imgggg").css('display', '');
    $("#tttttttt").hide()
});
   </script>

   <script type="text/javascript">
     $('#videobb').on('click',function(){
    $("#tttttttt").show(),
    $("#imgggg").hide()
});
   </script>

   <script type="text/javascript">
     $('#transportation').on('change',function(){
    if( $(this).val()==="1"){
    $("#stopeages").show()
    }
    else{
    $("#stopeages").hide()
    }
});
   </script>

   
   <script type="text/javascript">
     
    if( $('#transportation').val()==="1"){
    $("#stopeages").show()
    }
    else{
    $("#stopeages").hide()
    };

 
   </script>

   <script type="text/javascript">
     $('#hostel').on('change',function(){
    if( $(this).val()==="1"){
    $("#hostel_type").show()
    }
    else{
    $("#hostel_type").hide()
    }
});
   </script>

   <script type="text/javascript">
     
    if( $('#hostel').val()==="1"){
    $("#hostel_type").show()
    }
    else{
    $("#hostel_type").hide()
    };

 
   </script>
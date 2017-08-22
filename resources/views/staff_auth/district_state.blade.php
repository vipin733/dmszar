<script type="text/javascript">
    $(document).ready(function() {
        $('select[id="state"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/staff/city_state/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[id="district"]').empty();
                        $.each(data, function(key, value) {
                            $('select[id="district"]').append('<option value="'+ value +'">'+ key +'</option>');
                        });

                    }
                });
            }else{
                $('select[id="district"]').empty();
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[id="cstate"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/staff/city_state/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {


                        $('select[id="cdistrict"]').empty();
                        $.each(data, function(key, value) {
                            $('select[id="cdistrict"]').append('<option value="'+ value +'">'+ key +'</option>');
                        });

                    }
                });
            }else{
                $('select[id="cdistrict"]').empty();
            }
        });
    });
</script>

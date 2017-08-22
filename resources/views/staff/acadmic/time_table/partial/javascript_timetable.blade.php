<script type="text/javascript">
  
 $(document).ready(function(){

    $('select[name="sunday_subject"]').on('change', function() {
            var subjectID = $(this).val();
            if(subjectID) {
                $.ajax({
                    url: '/staff/acadmic/teacher_subject_ajax/'+subjectID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       
                        $('select[name="sunday_teacher"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="sunday_teacher"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="sunday_teacher"]').empty();
            }
        });


    $('select[name="monday_subject"]').on('change', function() {
            var subjectID = $(this).val();
            if(subjectID) {
                $.ajax({
                    url: '/staff/acadmic/teacher_subject_ajax/'+subjectID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       
                        $('select[name="monday_teacher"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="monday_teacher"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="monday_teacher"]').empty();
            }
        });

        $('select[name="tuesday_subject"]').on('change', function() {
            var subjectID = $(this).val();
            if(subjectID) {
                $.ajax({
                    url: '/staff/acadmic/teacher_subject_ajax/'+subjectID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       
                        $('select[name="tuesday_teacher"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="tuesday_teacher"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="tuesday_teacher"]').empty();
            }
        });

        $('select[name="wednesday_subject"]').on('change', function() {
            var subjectID = $(this).val();
            if(subjectID) {
                $.ajax({
                    url: '/staff/acadmic/teacher_subject_ajax/'+subjectID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       
                        $('select[name="wednesday_teacher"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="wednesday_teacher"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="wednesday_teacher"]').empty();
            }
        });

        $('select[name="thursday_subject"]').on('change', function() {
            var subjectID = $(this).val();
            if(subjectID) {
                $.ajax({
                    url: '/staff/acadmic/teacher_subject_ajax/'+subjectID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       
                        $('select[name="thursday_teacher"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="thursday_teacher"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="thursday_teacher"]').empty();
            }
        });

        $('select[name="friday_subject"]').on('change', function() {
            var subjectID = $(this).val();
            if(subjectID) {
                $.ajax({
                    url: '/staff/acadmic/teacher_subject_ajax/'+subjectID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       
                        $('select[name="friday_teacher"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="friday_teacher"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="friday_teacher"]').empty();
            }
        });

        $('select[name="saturday_subject"]').on('change', function() {
            var subjectID = $(this).val();
            if(subjectID) {
                $.ajax({
                    url: '/staff/acadmic/teacher_subject_ajax/'+subjectID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       
                        $('select[name="saturday_teacher"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="saturday_teacher"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="saturday_teacher"]').empty();
            }
        });

    })
</script>



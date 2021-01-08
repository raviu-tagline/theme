</div>
<script>
    $(document).ready(function(){

        $('#ddlState').attr('disabled',true);
        $('#ddlCity').attr('disabled',true);

        $("#ddlCountry").on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo base_url();?>Register_Controller/getState',
                method: 'post',
                data: {id : id},
                success: function (response){
                    $('#ddlState').attr('disabled',false);
                    $('#ddlState').html(response);
                },
                error: function(){
                    console.log("Error :: ",id);
                }
            });
        });

        $("#ddlState").on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo base_url();?>Register_Controller/getCity',
                method: 'post',
                data: {id : id},
                success: function (response){
                    $('#ddlCity').attr('disabled',false);
                    $('#ddlCity').html(response);
                },
                error: function(){
                    alert("There is something wrong");
                }
            });
        });
    })
</script>
</body>
</html>
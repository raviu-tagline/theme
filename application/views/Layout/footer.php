<div id="footer">
            <div>
                <div class="connect">
                    <a href="http://twitter/" class="twitter">twitter</a>
                    <a href="http://facebook/" class="facebook">facebook</a>
                    <a href="http://googleplus/" class="googleplus">googleplus</a>
                    <a href="http://pinterest.com/" class="pinterest">pinterest</a>
                </div>
                <p>&copy; 2023 by RNRNR. All rights reserved.</p>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){

        $("#ddlCountry").on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo base_url();?>Register_Controller/getState',
                method: 'post',
                data: {id : id},
                success: function (response){
                    $('#ddlState').html(response);
                    $('#ddlState').attr('disabled',false);
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

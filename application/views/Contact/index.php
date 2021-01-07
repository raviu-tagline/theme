<?php
    $this->load->view('Layout/header.php',"contact");
?>
<div id="body" class="contact">
	<div>
		<h1>Contact us</h1>
		<img src="<?php echo base_url()?>images/map.png" alt="">
		<h2>ADDRESS</h2>
		<p>This is just a placeholder so that you would know what the site would look like.</p>
		<h2>NUMBERS</h2>
		<a href=" <?php echo base_url();?>index.php/home/">+91 8900890089</a>
		<h2>Email</h2>
		<a href="<?php echo base_url();?>index.php/home/">info@rnrnr.com</a>
		<h4>JOIN RNRNR NOW</h4>

		<div style="background: transparent;padding: 0px;"><label id="msg"></label></div>

		<?php 
			$ency = array('enctype' => 'multipart/form-data'); 
			// $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');
            // echo validation_errors();
			echo form_open('',$ency); 
		?>
			<input type="text" name="name" id="name" value="<?php echo set_value('name');?>" placeholder="Enter your name"/>
			<p id="name_err"></p>

			<input type="email" name="email" id="email" value="<?php echo set_value('email');?>" placeholder="Enter your email"/>
			<p id="mail_err"></p>

			<input type="number" name="number" id="number" value="<?php echo set_value('number');?>" placeholder="Enter your mobile number"/>
			<p id="num_err"></p>


			<div id="chk">
				<input type="checkbox" name="chkContact" id="cInqury" value="1" <?php echo set_value('chkContact') == '1' ? 'checked' : '';?> />Inquiry
				<input type="checkbox" name="chkContact" id="cPrtcipt" value="2" <?php echo set_value('chkContact') == '2' ? 'checked' : '';?> />Participation
				<input type="checkbox" name="chkContact" id="cWinnner" value="3" <?php echo set_value('chkContact') == '3' ? 'checked' : '';?> />Winners
			</div>
			<p id="chk_err"></p>


			<div class="radio">
				<input type="radio" id="rdbMale" name="gender" Value="1" <?php echo set_value('gender') == '1' ? "checked" : "";?> /> 
				<label>Male</label>

				<input type="radio" id="rdbFemale" name="gender" Value="2" <?php echo set_value('gender') == '2' ? "checked" : "";?> /> 
				<label>Female</label>
			</div>
			<p id="rdb_err"></p>


			<textarea id="addr" name="addr" placeholder="Enter address"><?php echo set_value('addr');?></textarea>
			<p id="addr_err"></p>
			
			<input type="file" id="imgUpload" name='imgUpload' accept='image/*'/>
			<p id="img_err"></p>

			<button type="submit" id='submit'>Submit</button>
			<!-- <input type="button" name="submit" id="submit" value="Submit"/> -->
		</form>
	</div>
</div>

<script>

	$(document).ready(function(){

		function get_values()
		{
			var data = [];
			var tmp;
			$.each($('input[name="chkContact"]:checked'),function(){
				data.push(parseInt($(this).val()));
			});

			return data;
		}

		$('form').on('submit', function(e){
			e.preventDefault();
			var chkVals = get_values();
			var fdata = new FormData(this);
			fdata.append('chk',chkVals);

			$.ajax({
				url: '<?php echo base_url();?>Contact_Controller/submit',
				type: 'post',
				data: fdata,
				processData: false,
				contentType: false,
				success: function(resp){
					console.log(resp);
					var tmp = JSON.parse(resp);
					console.log(tmp);
					if(tmp.value == undefined || tmp.value == '')
					{
						console.log('asdf');
						$.each(tmp, function(index, value){
							$('#'+index).html(value);
						})
						// $('body').find('#msg').html(tmp.errors);
					}
					else
					{
						console.log('asdfsdfasdf :::::: ');
						$("#msg").html("<p style='color: green; margin: 0 auto; font-size: inherit'>"+tmp.values+"</p>");
						$('#name').val('');
						$('#email').val('');
						$('#number').val('');
						$('#addr').val('');
						$('input[name="chkContact"]').prop('checked',false);
						$('input[name="gender"]').prop('checked',false);
						$('imgUpload').text('');
					}
				}
			});
		});
	})

</script>
<?php
    $this->load->view('Layout/footer.php',"contact");
?>
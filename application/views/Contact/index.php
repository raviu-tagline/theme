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
		<?php
			echo form_open('Home_Controller/index');
			echo form_input(array('type'=>'text','name'=>'name','placeholder'=>'Enter name','required'=>'required','onblur'=>'this.value=!this.value?:this.value;'));
			echo "<br>";
			
			echo form_input(array('type'=>'text','name'=>'addr','placeholder'=>'Enter address','required'=>'required','onblur'=>'this.value=!this.value?:this.value;'));
			echo "<br>";

			echo form_input(array('type'=>'email','name'=>'mail','placeholder'=>'Enter email','required'=>'required','onblur'=>'this.value=!this.value?:this.value;'));
			echo "<br>";

			echo "<textarea name='meassage' cols='50' rows='7' placeholder='Message	'></textarea>";
			echo "<br>";

			echo form_input(array('id'=>'submit','value'=>'submit','type'=>'submit'));
			echo "<br>";

		?>
	</div>
</div>
<?php
    $this->load->view('Layout/footer.php',"contact");
?>
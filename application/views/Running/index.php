<?php
    $this->load->view('Layout/header.php',"running");
?>
<div id="body" class="running">
	<div>
		<h1>Running</h1>
		<ul class="gallery">
			<li>
				<a href=" <?php echo base_url("runningsinglepost");?>"><img src="<?php echo base_url()?>images/running-image1.png" alt=""></a>
			</li>
			<li>
				<a href="<?php echo base_url("runningsinglepost");?>"><img src="<?php echo base_url()?>images/running-image2.png" alt=""></a>
			</li>
			<li>
				<a href="<?php echo base_url("runningsinglepost");?>"><img src="<?php echo base_url()?>images/running-image3.png" alt=""></a>
			</li>
		</ul>
		<h3><span>What’s more, they’re absolutely free! You can do a lot with them. You can modify them.</span></h3>
		<p>Our website templates are created with inspiration, checked for quality and originality and meticulously sliced and coded. What’s more, they’re absolutely free! You can do a lot with them. You can modify them. You can use them to design websites for clients, so long as you agree with the Terms of Use. You can even remove all our links if you want to. Looking for more templates? Just browse through all our Free Website Templates and find what you’re looking for.</p>
		<p>But if you don’t find any website template you can use, you can try our Free Web Design service and tell us all about it. Maybe you’re looking for something different, something special. And we love the challenge of doing something different and something special. If you’re experiencing issues and concerns about this website template, join the discussion on our forum and meet other people in the community who share the same interests with you.</p>
	</div>
</div>
<?php
    $this->load->view('Layout/footer.php',"running");
?>
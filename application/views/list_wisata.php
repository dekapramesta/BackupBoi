<style>
.login-page-demo {
	background-image: url(<?php echo base_url()?>assets/images/bg/1.jpg);
}
</style>
<section class="awe-parallax login-page-demo" style="background-position: 50% 12px;">
    <div class="awe-overlay"></div>
    <div class="container">
    <div class="blog-heading-content text-uppercase">
        <h2>Destinasi Wisata</h2>
    </div>
    </div>
</section>
<section class="masonry-section-demo">
		<div class="container">
			<div class="destination-grid-content">
				<div class="row">
					<div id="results">
				</div>
				<div class="more-destination">
					<a href="#">Destinasi Wisata Lainnya</a>
				</div>
			</div>
		</div>
</section>
<script> id=0; </script>
<script>
		var total_record = 0;
		var total_groups = <?php echo $total_data;?>; 	
		
		$('#results').load("<?php echo site_url('Wisata/load_wisata/'.$jenis) ?>", {'offset':total_record}, function() {total_record++;});
		
		
</script>
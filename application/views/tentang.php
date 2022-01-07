<style>
.page-heading-demo {
	background-image: url(<?php echo base_url()?>assets/images/img/<?php echo $bg_icon->fc_isi?>);
}
</style>
<section class="awe-parallax page-heading-demo" style="background-position: 50% 12px;">
    <div class="awe-overlay"></div>
    <div class="container">
    <div class="blog-heading-content text-uppercase">
        <h2><?php echo get_phrase('Tentang Kami');?></h2>
    </div>
    </div>
</section>

<section class="blog-page">
	<div class="container">
		<div class="row">
				<div class="blog-page__content blog-single">
					<div class="post">
						<div align="center"><img src="<?php echo base_url().'uploads/about/'.$tentang->about_logo; ?>"></div>
						<?php 
							if ($this->session->userdata('current_language')=='english'){
								$deskripsi = $tentang_en->about_deskripsi;
							}else{
								$deskripsi = $tentang->about_deskripsi;
							}
						?>
						<div class="post-body"><div class="post-content">
							<p><?php echo $deskripsi?></p>
						</div></div>
					</div>
				</div>
		</div>
	</div>
</section>	
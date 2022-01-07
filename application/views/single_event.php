<body class="single-post"><!--<![endif]--><div id="page-wrap"><div class="preloader" style="display: none;"></div></div>
<style>
.page-heading-demo {
	background-image: url(<?php echo base_url()?>assets/images/img/16.jpg);
}
</style>
<section class="awe-parallax page-heading-demo" style="background-position: 50% 12px;">
    <div class="awe-overlay"></div>
    <div class="container">
    <div class="blog-heading-content text-uppercase">
        <h2><?php echo get_phrase('Event Wisata');?></h2>
    </div>
    </div>
</section>
<section class="blog-page">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="blog-page__content blog-single">
					<div class="post">
						
						<?php 
							if ($this->session->userdata('current_language')=='english'){
								$gambar = '<img src="'.base_url().'uploads/event/'.$detail_event_en->event_foto.'">';
								
								$data =  @$data."
									<div class='post-title'><h1>".$detail_event_en->event_judul."</h1></div>";
									
									$data_awal = $detail_event_en->event_tag;
									$array =  explode(' ', $data_awal);
													
									foreach ($array as $item) {
										$link = base_url('Event/tag_event/'.$item);
										$data =  @$data."<a href=".$link.">".$item."</a> ";
									}		
									
									
									$data =  @$data."
									<br /><br /><br />
									<div class='post-media'><div class='image-wrap'>".$gambar."</div></div>
									<div class='product-detail__info'>
									<div class='rating-trip-reviews'>
										<div class='item good'>
											<span class='count'><i class='fa fa-calendar' aria-hidden='true'></i></span>
												<h6>Tanggal Event</h6>
													<p>".longdate_indo($detail_event_en->event_tgl_pelaksanaan)."</p>
										</div>
										<div class='item good'>
											<span class='count'><i class='fa fa-users' aria-hidden='true'></i></span>
												<h6>Penyelenggara</h6>
													<p>".$detail_event_en->event_penyelenggara."</p>
										</div>
										<div class='item good'>
											<span class='count'><i class='fa fa-fire' aria-hidden='true'></i></span>
												<h6>Lokasi</h6>
													<p></p>
										</div>
									</div>
									</div>
									<div class='post-body'><div class='post-content'>
									<p>".$detail_event_en->event_deskripsi."</p>
									</div></div>
								";
							}else{
								$gambar = '<img src="'.base_url().'uploads/event/'.$detail_event->event_foto.'">';
								
								$data =  @$data."
									<div class='post-title'><h1>".$detail_event->event_judul."</h1></div>";
									
									$data_awal = $detail_event->event_tag;
									$array =  explode(' ', $data_awal);
													
									foreach ($array as $item) {
										$link = base_url('Event/tag_event/'.$item);
										$data =  @$data."<a href=".$link.">".$item."</a> ";
									}		
									
									
									$data =  @$data."
									<br /><br /><br />
									<div class='post-media'><div class='image-wrap'>".$gambar."</div></div>
									<div class='product-detail__info'>
									<div class='rating-trip-reviews'>
										<div class='item good'>
											<span class='count'><i class='fa fa-calendar' aria-hidden='true'></i></span>
												<h6>Tanggal Event</h6>
													<p>".longdate_indo($detail_event->event_tgl_pelaksanaan)."</p>
										</div>
										<div class='item good'>
											<span class='count'><i class='fa fa-users' aria-hidden='true'></i></span>
												<h6>Penyelenggara</h6>
													<p>".$detail_event->event_penyelenggara."</p>
										</div>
										<div class='item good'>
											<span class='count'><i class='fa fa-fire' aria-hidden='true'></i></span>
												<h6>Lokasi</h6>
													<p></p>
										</div>
									</div>
									</div>
									<div class='post-body'><div class='post-content'>
									<p>".$detail_event->event_deskripsi."</p>
									</div></div>
								";
							}	
						?>
						<?php echo $data?>
					</div>
					
				</div>
			</div>
			<div class="col-md-3">
				<div class="page-sidebar">
				<div class="widget widget_search">
                    <h3><?php echo get_phrase('Cari Event');?></h3>
                        <form action="<?php echo site_url('Event/search_event');?>" method="POST">
							<input type="search" name="cari" value="<?php echo get_phrase('Masukkan Nama Event');?>">
						</form>
                </div>
				<div class="widget widget_categories">
					<h3><?php echo get_phrase('Direktori Event');?></h3>
					<ul class="css-treeview">
					            <?php foreach($tahun_event as $thn):?>
					            <li>
					                <input type="checkbox" class="expander" checked>
					                <span class="expander"></span>
					                <label><?php echo $thn['thn']?></label>
					        
					                <!-- The child nodes. -->
					                <ul class="css-treeview">
					                    <li>
					                        <input type="checkbox" class="expander" disabled>
					                        <span class="expander"></span>
					                        <label><a href="<?php echo base_url('Event/event_thn/'.$thn['bulan']) ?>"><?php echo $thn['bln']?></a></label>
					                    </li>
					                </ul>
					            </li>
					            <?php endforeach?>
					</ul>
				</div>
							
                <div class="widget widget_tag_cloud">
                    <h3><?php echo get_phrase('Tags Event');?></h3>
                        <div class="tagcloud">
						<?php 
						if ($this->session->userdata('current_language')=='english'){
							$data_awal = $detail_event_en->event_tag;
						}else{
							$data_awal = $detail_event->event_tag;
						}
							$array =  explode(' ', $data_awal);
							foreach ($array as $item) {
						?>
							<a href="<?php echo base_url('Event/tag_event/'.$item) ?>"><?php echo $item?></a>
						<?php } ?>
                        </div>
                </div>
				</div>
			</div>
		</div>
	</div>	
</section>

<!-- Mirrored from envato.megadrupal.com/html/gofar/single-post.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2017 02:03:01 GMT -->
</body>
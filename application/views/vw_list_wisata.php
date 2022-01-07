<style>
.login-page-demo {
	background-image: url(<?php echo base_url()?>assets/images/bg/1.jpg);
}
</style>

<title>Tempat Wisata - Beauty Of Indonesia</title>
<section class="awe-parallax login-page-demo" style="background-position: 50% 12px;">
    <div class="awe-overlay"></div>
    <div class="container">
    <div class="blog-heading-content text-uppercase">
	<h2><?php echo get_phrase('Tempat Wisata');?></h2>
    </div>
    </div>
</section>
<section class="masonry-section-demo">
		<div class="container">
			<div class="destination-grid-content">
				<div class="row">
					<div class="col-md-6" style="margin-top:10px;">
							<select id="province" class="form-control">
								<option disabled selected value="0">Pilih Provinsi</option>
								<?php foreach ($provinces as $province) : ?>
									<option value="<?= $province['nama_provinsi'] ?>"><?= $province['nama_provinsi'] ?></option>
								<?php endforeach; ?>
							</select>
					</div>
					<div class="col-md-6" style="margin-top:10px;">
							<select id="towns" disabled class="form-control">
							<option disabled selected value="0">Pilih Kota / Kabupaten</option>
							</select>
					</div>
				</div>
				<div class="row">
                    <br>
					<div class="awe-masonry">
						<?php
							if ($this->session->userdata('current_language')=='english'){
								foreach ($wisata_en as $m){ 
									if($m['url_file_foto']==''){ $cover = 'no_image.jpg'; }else{ $cover = $m['url_file_foto']; }
									$row5 = '<img src="'.base_url().'uploads/foto_wisata/'.$cover.'">';
									if (strpos($m["wisata_nama"], '-') !== false) {
										$wisataNama = str_replace('-', '_', $m["wisata_nama"]);
								}else{
									$wisataNama = $m["wisata_nama"];
								}
								$link = base_url().'Tempat-Wisata/'.$m['kategori_nama'].'/'.str_replace(' ', '-', $m["nama_provinsi"]).'/'.str_replace(' ', '-', $m["nama_kota_kabupaten"]).'/'.str_replace(' ', '-', $wisataNama);
								$wisatae = @$wisatae."
									<div class='awe-masonry__item'>
										<a href=".$link.">
											<div class='image-wrap image-cover'>
												".$row5."
											</div>
										</a>
										
										<div class='item-available'>
											".$m['wisata_nama']."
										</div>
									</div>
								";
								}
							}else{
								foreach ($wisata as $m){ 
									if($m['url_file_foto']==''){ $cover = 'no_image.jpg'; }else{ $cover = $m['url_file_foto']; }
									$row5 = '<img src="'.base_url().'uploads/foto_wisata/'.$cover.'" alt ="' . $m['wisata_nama'] . ' ' . $m['nama_kota_kabupaten'] . '">';
									if (strpos($m["wisata_nama"], '-') !== false) {
										$wisataNama = str_replace('-', '_', $m["wisata_nama"]);
								}else{
									$wisataNama = $m["wisata_nama"];
								}
								$link = base_url().'Tempat-Wisata/'.$m['kategori_nama'].'/'.str_replace(' ', '-', $m["nama_provinsi"]).'/'.str_replace(' ', '-', $m["nama_kota_kabupaten"]).'/'.str_replace(' ', '-', $wisataNama);
								$wisatae = @$wisatae."
									<div class='awe-masonry__item'>
										<a href=".$link.">
											<div class='image-wrap image-cover'>
												".$row5."
											</div>
										</a>
										
										<div class='item-available'>
											".$m['wisata_nama']."
										</div>
									</div>
								";
								}
							}	
						?>
						<?php echo @$wisatae?>
					</div>
					<div class="page__pagination" align="center">
						<?php echo $halaman;?>
				    </div>
				</div>
				<!-- <div class="more-destination">
					<a href="</a>
				</div> -->
			</div>
		</div>
</section>
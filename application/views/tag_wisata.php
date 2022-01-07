<style>

.login-page-demo {

	background-image: url(<?php echo base_url()?>assets/images/bg/1.jpg);

}

</style>

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

					<div class="awe-masonry">

						<?php foreach ($tag_wisata as $m){ 

						if($m['url_file_foto']==''){ $cover = 'no_image.jpg'; }else{ $cover = $m['url_file_foto']; }

                            $row5 = '<img src="'.base_url().'uploads/foto_wisata/'.$cover.'">';
                                if (strpos($m["wisata_nama"], '-') !== false) {
										$wisataNama = str_replace('-', '_', $m["wisata_nama"]);
                                    }else{
                                        $wisataNama = $m["wisata_nama"];
                                    }
                            $link = base_url().'Tempat-Wisata/'.$m['kategori_nama'].'/'.str_replace(' ', '-', $m["nama_provinsi"]).'/'.str_replace(' ', '-', $m["nama_kota_kabupaten"]).'/'.str_replace(' ', '-', $wisataNama);

						?>

						

						<div class="awe-masonry__item">

							<a href="<?= $link ?>">

								<div class="image-wrap image-cover">

									<?php echo $row5; ?>

								</div>

							</a>

							

							<div class="item-available">

								<?=$m['wisata_nama'];?>

							</div>

						</div>

						<?php } ?>

					</div>
					<div class="page__pagination" align="center">
						<?php echo $halaman;?>
				    </div>

				</div>

				

			</div>

		</div>

</section>
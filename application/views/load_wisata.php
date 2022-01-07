<section class="masonry-section-demo">

		<div class="container">

			<div class="destination-grid-content">

			

				<div class="row">

					<div class="awe-masonry">

						<?php foreach ($wisata as $event){

						?>

						<div class="trip-item">

							<div class="item-media">

								<div class="image-cover">

									<img src="<?php echo base_url().'uploads/foto_wisata/'.$event['nama_foto']; ?>" alt=""></div>

										<div class="trip-icon">

											<img src="<?php echo base_url().'uploads/foto_wisata/'.$event['nama_foto']; ?>" alt="">

										</div>

							</div>

							<div class="item-body">

								<div class="item-title">

									<h2><a href="#"><?=$event['wisata_nama'];?></a></h2>

								</div>

								<hr />

								<?php

									$deskripsi = $event['wisata_deskripsi'];

									$cut=substr($deskripsi,0,100);

								?>								

								<div class="item-list">

								<?= $cut;?>[..]

								</div>

								<div class="item-footer">

									<div class="item-rate">

									</div>

									<div class="item-icon">

									</div>

								</div>

							</div>

							<div class="item-price-more">

								<div class="price">

								</div><a href="<?php echo base_url('Tempat-Wisata/detail_wisata/'.$event['wisata_id']); ?>" class="awe-btn"><?php echo get_phrase('Baca Selengkapnya');?></a>

							</div>

						</div>

						<?php } ?>

					</div>

				</div>

			</div>

		</div>

</section>




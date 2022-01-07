<style>
	.login-page-demo {
		background-image: url(<?php echo base_url() ?>assets/images/bg/1.jpg);
	}
</style>

<title>Tempat Wisata - Beauty Of Indonesia</title>
<section class="awe-parallax login-page-demo" style="background-position: 50% 12px;">
	<div class="awe-overlay"></div>
	<div class="container">
		<div class="blog-heading-content text-uppercase">
			<h2><?php echo get_phrase('Oleh-Oleh'); ?></h2>
		</div>
	</div>
</section>
<section class="masonry-section-demo">
	<div class="container">
		<div class="destination-grid-content">
			<div class="row">
				<div class="col-md-6" style="margin-top:10px;">
					<select id="provinsiktg" class="form-control">
						<option disabled selected value="0">Pilih Provinsi</option>
						<?php foreach ($provinsi as $prov) : ?>
							<option value="<?= $prov['nama_provinsi'] ?>" <?= $prov['nama_provinsi'] == $filterProv ? "selected" : "" ?>><?= $prov['nama_provinsi'] ?></option>
						<?php endforeach; ?>

					</select>
				</div>
				<div class="col-md-6" style="margin-top:10px;">
					<select id="kotaktg" disabled class="form-control">
						<option disabled selected value="0">Pilih Kota / Kabupaten</option>
					</select>
				</div>
			</div>
			<div class="row">
				<br>
				<div class="awe-masonry">
					<?php
					if ($this->session->userdata('current_language') == 'english') {
						foreach ($wisata_en as $m) {
							if ($m['url_file_foto'] == '') {
								$cover = 'no_image.jpg';
							} else {
								$cover = $m['url_file_foto'];
							}
							$row5 = '<img src="' . base_url() . 'uploads/foto_wisata/' . $cover . '">';
							if (strpos($m["wisata_nama"], '-') !== false) {
								$wisataNama = str_replace('-', '_', $m["wisata_nama"]);
							} else {
								$wisataNama = $m["wisata_nama"];
							}
							$link = base_url() . 'Tempat-Wisata/' . str_replace(' ', '-', $m["nama_provinsi"]) . '/' . str_replace(' ', '-', $m["nama_kota_kabupaten"]) . '/' . str_replace(' ', '-', $wisataNama);
							$wisatae = @$wisatae . "
									<div class='awe-masonry__item'>
										<a href=" . $link . ">
											<div class='image-wrap image-cover'>
												" . $row5 . "
											</div>
										</a>
										
										<div class='item-available'>
											" . $m['wisata_nama'] . "
										</div>
									</div>
								";
						}
					} else {
						foreach ($produk as $m) {
							if ($m['url_foto'] == '') {
								$cover = 'no_image.jpg';
							} else {
								$cover = $m['url_foto'];
							}
							$row5 = '<img src="' . base_url() . 'uploads/foto_produk/' . $cover . '" alt ="' . $m['nama_produk'] . ' ' . $m['nama_kota'] . '">';
							if (strpos($m["nama_produk"], '-') !== false) {
								$produkNama = str_replace('-', '_', $m["nama_produk"]);
							} else {
								$produkNama = $m["nama_produk"];
							}
							$link = base_url() . 'Produk/detail/' . str_replace(' ', '-', $m["nama_provinsi"]) . '/' . str_replace(' ', '-', $m["nama_kota"]) . '/' . str_replace(' ', '-', $produkNama);
							$produke = @$produke . "
									<div class='awe-masonry__item'>
										<a href=" . $link . ">
											<div class='image-wrap image-cover'>
												" . $row5 . "
											</div>
										</a>
										
										<div class='item-available'>
											" . $m['nama_produk'] . "
										</div>
									</div>
								";
						}
					}
					?>
					<?php echo @$produke ?>
				</div>
				<div class="page__pagination" align="center">
					<?php echo $halaman; ?>
				</div>
			</div>
			<!-- <div class="more-destination">
					<a href="</a>
				</div> -->
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#provinsiktg').change(function() {
			var provinsi = $("#provinsiktg :selected").val();
			str = provinsi.replace(/\s+/g, '-');
			$(location).attr('href', '<?= base_url("Produk/Jenis/") ?>' + <?php echo $ktg ?> + '/' + str);

		});
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
			csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		var provinsi = $("#provinsiktg :selected").val();
		if (provinsi != null) {
			$('#kotaktg').prop('disabled', false);
			var provinsi = $("#provinsiktg :selected").val();
			str = provinsi.replace(/\s+/g, '-');

			$.ajax({
				type: 'POST',
				url: '<?= base_url("Produk/get_city") ?>',
				data: {
					[csrfName]: csrfHash,
					provinsi: provinsi,
					city: '<?= $this->uri->segment(5) ?>'
				},
				success: function(response) {
					console.log(response);
					$('#kotaktg').html(response);
				}
			})
		}

		$('#kotaktg').change(function() {
			var city = $("#kotaktg :selected").val();
			var provinsi = $("#provinsiktg :selected").val();
			city = city.replace(/\s+/g, '-');
			provinsi = provinsi.replace(/\s+/g, '-');
			$(location).attr('href', '<?= base_url("Produk/Jenis/") ?>' + <?php echo $ktg ?> + '/' + provinsi + '/' + city);
		});

		$(".sendData").click(function() {
			console.log("ok");
			$("#requestNew").submit();
		});


	});
</script>
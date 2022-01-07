<style>
	.page-heading-demo {
		background-image: url(<?php echo base_url() ?>assets/images/img/16.jpg);
	}
</style>
<section class="awe-parallax page-heading-demo" style="background-position: 50% 12px;">
	<div class="awe-overlay"></div>
	<div class="container">
		<div class="blog-heading-content text-uppercase">
			<h2><?php echo get_phrase('Event Wisata'); ?></h2>
		</div>
	</div>
</section>
<section class="blog-page">
	<div class="container">
		<div class="row">
			<?php
			if ($this->session->userdata('current_language') == 'english') {
				foreach ($query_en as $u2) {
					if ($u2['event_foto'] == '') {
						$cover = 'no_image.jpg';
					} else {
						$cover = $u2['event_foto'];
					}
					$row5 = '<img src="' . base_url() . 'uploads/event/' . $cover . '">';
					$link = base_url('Event/event_detail/' . $u2['event_id']);
					$deskripsi = $u2['event_deskripsi'];
					$cut = substr($deskripsi, 0, 200);
					$data =  @$data . "
										<div class='post'>
											<div class='post-media'>
												<a href=" . $link . ">" . $row5 . "</a>
											</div>
											
											<div class='post-body'>
												<div class='post-meta'>
													<div class='date'>" . longdate_indo($u2['event_tgl_pelaksanaan']) . "
													</div>
													<div class='cat'>
														<ul>
															<li>";
					$data_awal = $u2['event_tag'];
					$array =  explode(' ', $data_awal);

					foreach ($array as $item) {
						$link2 = base_url('Event/tag_event/' . $item);
						$data =  @$data . "<a href=" . $link2 . ">" . $item . "&nbsp;</a>";
					}
					$data =  @$data . "</li>
														</ul>
													</div>
												</div>
												<div class='post-title'>
													<h2><a href=" . $link . ">" . $u2['event_judul'] . "</a></h2>
												</div>
												<div class='post-content'>
													<p>" . $cut . "</p>
												</div>
												<div class='post-link'>
													<a href=" . $link . " class='awe-btn awe-btn-style2'>" . get_phrase('Baca Selengkapnya') . "</a>
												</div>
											</div>
										</div>
									";
				}
			} else {
				foreach ($query as $u) {
					if ($u['event_foto'] == '') {
						$cover = 'no_image.jpg';
					} else {
						$cover = $u['event_foto'];
					}
					$row5 = '<img src="' . base_url() . 'uploads/event/' . $cover . '">';
					$link = base_url('Event/event_detail/' . $u['event_id']);
					$deskripsi = $u['event_deskripsi'];
					$cut = substr($deskripsi, 0, 200);



					$data =  @$data . "
										<div class='post'>
											<div class='post-media'>
												<a href=" . $link . ">" . $row5 . "</a>
											</div>
											
											<div class='post-body'>
												<div class='post-meta'>
													<div class='date'>" . longdate_indo($u['event_tgl_pelaksanaan']) . "
													</div>
													<div class='cat'>
														<ul>
															<li>";
					$data_awal = $u['event_tag'];
					$array =  explode(' ', $data_awal);

					foreach ($array as $item) {
						$link2 = base_url('Event/tag_event/' . $item);
						$data =  @$data . "<a href=" . $link2 . ">" . $item . "&nbsp;</a>";
					}
					$data =  @$data . "</li>
														</ul>
													</div>
												</div>
												<div class='post-title'>
													<h2><a href=" . $link . ">" . $u['event_judul'] . "</a></h2>
												</div>
												<div class='post-content'>
													<p>" . $cut . "</p>
												</div>
												<div class='post-link'>
													<a href=" . $link . " class='awe-btn awe-btn-style2'>" . get_phrase('Baca Selengkapnya') . "</a>
												</div>
											</div>
										</div>
									";
				}
			}
			?>
			<div class="col-md-9">
				<div class="blog-page__content">
					<?php echo $data; ?>
					<div class="page__pagination">
						<?php echo $halaman; ?>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="page-sidebar">
					<div class="widget widget_search">
						<h3><?php echo get_phrase('Cari Event'); ?></h3>
						<form action="<?php echo site_url('Event/search_event'); ?>" method="POST">
							<input type="search" name="cari" value="<?php echo get_phrase('Masukkan Nama Event'); ?>">
						</form>
					</div>

					<div class="widget widget_categories">
						<h3><?php echo get_phrase('Direktori Event'); ?></h3>
						<ul class="css-treeview">
							<?php foreach ($tahun_event as $thn) : ?>
								<li>
									<input type="checkbox" class="expander" checked>
									<span class="expander"></span>
									<label><?php echo $thn['thn'] ?></label>

									<!-- The child nodes. -->
									<?php $bulan = $this->Model->sitemap_event_bulan($thn['thn'])->result_array();
									foreach ($bulan as $bln) {
									?>
										<ul class="css-treeview">
											<li>
												<input type="checkbox" class="expander" disabled>
												<span class="expander"></span>
												<label><a href="<?php echo base_url('Event/event_thn/' . $bln['bulan']) ?>"><?php echo $bln['bln'] ?></a></label>
											</li>
										</ul>
									<?php } ?>
								</li>
							<?php endforeach ?>
						</ul>
					</div>

					<div class="widget widget_tag_cloud">
						<h3><?php echo get_phrase('Tags Event'); ?></h3>
						<div class="tagcloud">

							<?php
							$data_awal = $tag->event_tag;
							$array =  explode(' ', $data_awal);
							foreach ($array as $item) {
							?>
								<a href="<?php echo base_url('Event/tag_event/' . $item) ?>"><?php echo $item ?></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>
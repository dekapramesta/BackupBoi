<section class="hero-section">
    <div id="slider-revolution">
        <ul>
            <?php
            if ($this->session->userdata('current_language') == 'english') {
                foreach ($tampil_slider_en as $slider) {
                    $gambar = base_url() . 'uploads/event/' . $slider['event_foto'];
                    $link = base_url('Event/event_detail/' . $slider['event_id']);
                    $slidere =  @$slidere . "
								<li data-slotamount='7' data-masterspeed='500' data-title=''>
									<img src=" . $gambar . " data-bgposition='left center' data-duration='14000' data-bgpositionend='right center' alt=''>
								</li>
							";
                }
            } else {
                foreach ($tampil_slider as $slider) {
                    $gambar = base_url() . 'uploads/event/' . $slider['event_foto'];
                    $link = base_url('Event/event_detail/' . $slider['event_id']);
                    $slidere =  @$slidere . "
								<li data-slotamount='7' data-masterspeed='500' data-title=''>
									<img src=" . $gambar . " data-bgposition='left center' data-duration='14000' data-bgpositionend='right center' alt=''>
								</li>
							";
                }
            }
            ?>
            <?php echo $slidere; ?>
        </ul>
    </div>
</section>
<section class="masonry-section-demo">
    <div align='center'>
        <h2 style="font-size:20px">Beauty Of Indonesia ~ This is Indonesia !!!</h2>
    </div>

    <div class="container">
        <div class="destination-grid-content">
            <div class="section-title">
                <!-- <h2 style="font-size:20px;">Beauty Of Indonesia ~ This is Indonesia !!!</h2> -->
            </div>
            <div class="row">
                <div class="awe-masonry">
                    <?php
                    if ($this->session->userdata('current_language') == 'english') {
                        foreach ($home_en as $m) {
                            if ($m['url_file_foto'] == '') {
                                $cover = 'no_image.jpg';
                            } else {
                                $cover = $m['url_file_foto'];
                            }
                            $row5 = '<img src="' . base_url() . 'uploads/foto_wisata/' . $cover . '" alt="' . $m['wisata_nama'] . '">';
                            if (strpos($m["wisata_nama"], '-') !== false) {
                                $wisataNama = str_replace('-', '_', $m["wisata_nama"]);
                            } else {
                                $wisataNama = $m["wisata_nama"];
                            }
                            $link = base_url() . 'Tempat-Wisata/' . $m['kategori_nama'] . '/' . str_replace(' ', '-', $m["nama_provinsi"]) . '/' . str_replace(' ', '-', $m["nama_kota_kabupaten"]) . '/' . str_replace(' ', '-', $wisataNama);
                            $covere = @$covere . "
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
                        foreach ($home as $m) {
                            if ($m['url_file_foto'] == '') {
                                $cover = 'no_image.jpg';
                            } else {
                                $cover = $m['url_file_foto'];
                            }
                            $row5 = '<img src="' . base_url() . 'uploads/foto_wisata/' . $cover . '" alt ="' . $m['wisata_nama'] . ' ' . $m['nama_kota_kabupaten'] . '">';
                            if (strpos($m["wisata_nama"], '-') !== false) {
                                $wisataNama = str_replace('-', '_', $m["wisata_nama"]);
                            } else {
                                $wisataNama = $m["wisata_nama"];
                            }
                            $link = base_url() . 'Tempat-Wisata/' . $m['kategori_nama'] . '/' . str_replace(' ', '-', $m["nama_provinsi"]) . '/' . str_replace(' ', '-', $m["nama_kota_kabupaten"]) . '/' . str_replace(' ', '-', $wisataNama);
                            $covere = @$covere . "
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
                    }
                    ?>
                    <?php echo @$covere; ?>
                </div>
            </div>
            <div class="more-destination">
                <a href="<?php echo base_url('Tempat-Wisata') ?>"><?php echo get_phrase('Destinasi Wisata Lainnya'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="blog-page">
    <div class="container">
        <div class="row">

            <?php
            if ($this->session->userdata('current_language') == 'english') {
                foreach ($query2 as $u2) {
                    if ($u2->berita_foto == '') {
                        $cover = 'no_image.jpg';
                    } else {
                        $cover = $u2->berita_foto;
                    }
                    $row5 = '<img src="' . base_url() . 'uploads/berita/' . $cover . '">';
                    $link = base_url('Berita/detail_berita/' . $u2->berita_id);
                    $deskripsi = $u2->berita_deskripsi;
                    $cut = substr($deskripsi, 0, 200);

                    $data_awal = $u2->berita_tag;
                    $array =  explode(' ', $data_awal);

                    foreach ($array as $item) {
                        $link2 = base_url('Berita/tag_berita/' . $item);
                        $tag = @$tag . "
												<a href=" . $link2 . ">" . $item . "</a> 
											";
                    }
                    $data =  @$data . "
										<div class='post'>
											<div class='post-media'>
												<a href=" . $link . ">" . $row5 . "</a>
											</div>
											
											<div class='post-body'>
												<div class='post-meta'>
													
													<div class='cat'>
														<ul>
															<li>";
                    $data_awal = $u2->berita_tag;
                    $array =  explode(' ', $data_awal);

                    foreach ($array as $item) {
                        $link2 = base_url('Berita/tag_berita/' . $item);
                        $data =  @$data . "<a href=" . $link2 . ">" . $item . "&nbsp;</a>";
                    }
                    $data =  @$data . "</li>
														</ul>
													</div>
												</div>
												<div class='post-title'>
													<h2><a href=" . $link . ">" . $u2->berita_judul . "</a></h2>
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
                    if ($u->berita_foto == '') {
                        $cover = 'no_image.jpg';
                    } else {
                        $cover = $u->berita_foto;
                    }
                    $row5 = '<img src="' . base_url() . 'uploads/berita/' . $cover . '" alt="' . $u->berita_judul . '">';
                    $link = base_url('Artikel/detail_artikel/' . $u->berita_id);
                    $url_title = url_title($u->berita_judul, '-', TRUE);
                    $linkslug = base_url('Artikel/' . $url_title);
                    $deskripsi = $u->berita_deskripsi;
                    $cut = substr($deskripsi, 0, 200);
                    $csrf = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    );

                    $data_awal = $u->berita_tag;
                    $array =  explode(' ', $data_awal);

                    foreach ($array as $item) {
                        $link2 = base_url('Berita/tag_berita/' . $item);
                        $tag = @$tag . "
												<a href=" . $link2 . ">" . $item . "</a> 
											";
                    }


                    $data =  @$data . "
										<div class='post'>
											<form action=" . $linkslug . " method='post'>
                                            <input type='hidden' name=" . $this->security->get_csrf_token_name() . " value=" . $this->security->get_csrf_hash() . ">

											<div class='post-media'>
												<a class='klik-id' href='javascript:void(0)'>" . $row5 . "</a>
											</div>
											
											<div class='post-body'>
												<div class='post-meta'>
													
													<div class='cat'>
														";
                    // $data_awal = $u->berita_tag;
                    // $array =  explode(' ', $data_awal);

                    // foreach ($array as $item) {
                    //     $link2 = base_url('Artikel/Tags/' . $item);
                    //     $data =  @$data . "<a href=" . $link2 . ">" . $item . "&nbsp;</a>";
                    // }
                    $data =  @$data . "
													</div>
												</div>
												<div class='post-title'>
													
													 <form action=" . $linkslug . " method='post'>
                                                    <input type='hidden' name=" . $this->security->get_csrf_token_name() . " value=" . $this->security->get_csrf_hash() . ">

                                                    <input type='hidden' name='id_artikel' value=" . $u->berita_id . ">
                                                    <button style='text-align: left;background: rgba(0,0,0,0.0);border-style: none;'><h2 id='linkSlug'>
                                                            " . $u->berita_judul . "</h2></button>
                                                </form>
													
												</div>
												<div class='post-content'>
													<p>" . $cut . "</p>
												</div>
												<div class='post-link'>
													 <form action=" . $linkslug . " method='post'>
                                                    <input type='hidden' name=" . $this->security->get_csrf_token_name() . " value=" . $this->security->get_csrf_hash() . ">

                                                        <input type='hidden' name='id_artikel' value=" . $u->berita_id . ">
                                                        <button style='text-align: left;background: rgba(0,0,0,0.0);border-style: none;'><a class='awe-btn awe-btn-style2 klik-id'>
                                                                " . get_phrase('Baca Selengkapnya') . "</a></button>
                                                    </form>
												</div>
											</div>
										</div>
									";
                }
            }
            ?>
            <div class="col-md-9">
                <div class="blog-page__content">
                    <?php echo @$data; ?>
                    <div class="page__pagination">
                        <?php echo $halaman; ?>
                    </div>

                    <hr />
                    <!-- <div class="hotel-item">
							<div class="item-price-more">
								<div class="price"><?php if ($this->session->userdata('current_language') == 'english') {
                                                        echo "Income";
                                                    } else {
                                                        echo "Total Pendapatan";
                                                    } ?>
									<span class="amount"><?php
                                                            if ($grafik_pendapatan) {
                                                                echo number_format($grafik_pendapatan->info_pendapatan);
                                                            } else {
                                                                echo "0";
                                                            }
                                                            ?></span>
								</div>
							</div>
							<div class="item-price-more">
								<div class="price"><?php if ($this->session->userdata('current_language') == 'english') {
                                                        echo "Intl. Tourist";
                                                    } else {
                                                        echo "Wisatawan Intl.";
                                                    } ?>
									<span class="amount"><?php echo $grafik_suminter->sum_inter; ?></span>
								</div><br />
								<button data-toggle="modal" data-target="#myModal" class="awe-btn"><?php if ($this->session->userdata('current_language') == 'english') {
                                                                                                        echo "See";
                                                                                                    } else {
                                                                                                        echo "Lihat";
                                                                                                    } ?></button>
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-body">
											<div class="contact-form">
											
												<div class="alert alert-success">
												  <strong><?php if ($this->session->userdata('current_language') == 'english') {
                                                                echo "International Tourist Chart";
                                                                $a = "International Tourist";
                                                            } else {
                                                                echo "Grafik Wisatawan Internasional";
                                                                $a = "Wisatawan Internasional";
                                                            } ?></strong>
												</div>
												<script src="<?php echo base_url() ?>/assets/js/Chart.js"></script>
											      <canvas id="demobar_inter" width="100" height="100"></canvas>
											      <script  type="text/javascript">

                                            	  var ctx = document.getElementById("demobar_inter").getContext("2d");
                                            	  var data = {
                                            	            labels: [
                                                            '<?php foreach ($grafik_inter as $lokal) {
                                                                    echo $lokal["bulan"] ?>','<?php } ?>' ],
                                            	            datasets: [
                                            	            {
                                            	              label: "<?php echo $a; ?>",
                                                            fill: false,
                                                            lineTension: 0.1,
                                                            backgroundColor: "rgba(59, 100, 222, 1)",
                                                            borderColor: "rgba(59, 100, 222, 1)",
                                                            pointHoverBackgroundColor: "rgba(59, 100, 222, 1)",
                                        						        pointHoverBorderColor: "rgba(59, 100, 222, 1)",
                                            	              data: [<?php $total = 0;
                                                                        foreach ($grafik_inter as $lokal) {
                                                                            $total = $total + $lokal['nilai'];
                                                                            echo '"' . $total . '",';
                                                                        } ?>]
                                            	            }
                                            	            ]
                                            	            };
                                        
                                            	  var myBarChart = new Chart(ctx, {
                                            	            type: 'line',
                                            	            data: data,
                                            	            options: {
                                            	            barValueSpacing: 20,
                                            	            scales: {
                                            	              yAxes: [{
                                            	                  ticks: {
                                            	                      min: 0,
                                            	                  }
                                            	              }],
                                            	              xAxes: [{
                                            	                          gridLines: {
                                            	                              color: "rgba(0, 0, 0, 0)",
                                            	                          }
                                            	                      }]
                                            	              }
                                            	          }
                                            	        });
                                            	</script>
											</div>	
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="item-price-more">
								<div class="price"><?php if ($this->session->userdata('current_language') == 'english') {
                                                        $b = "Local Tourist";
                                                        echo $b;
                                                    } else {
                                                        $b = "Wisatawan Lokal";
                                                        echo $b;
                                                    } ?>
									<span class="amount"><?php echo $grafik_sumlokal->sum_lokal; ?></span>
								</div><br />
								<button data-toggle="modal" data-target="#myModal2" class="awe-btn"><?php if ($this->session->userdata('current_language') == 'english') {
                                                                                                        echo "See";
                                                                                                    } else {
                                                                                                        echo "Lihat";
                                                                                                    } ?></button>
								<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-body">
											<div class="contact-form">
											
												<div class="alert alert-success">
												  <strong><?php if ($this->session->userdata('current_language') == 'english') {
                                                                echo "Local Tourist Chart";
                                                            } else {
                                                                echo "Grafik Wisatawan Lokal";
                                                            } ?></strong>
												</div>
												
											      <script src="<?php echo base_url() ?>/assets/js/Chart.js"></script>
											      <canvas id="demobar" width="100" height="100"></canvas>
											      <script  type="text/javascript">

                                            	  var ctx = document.getElementById("demobar").getContext("2d");
                                            	  var data = {
                                            	            labels: [
                                                            '<?php foreach ($grafik_lokal as $lokal) {
                                                                    echo $lokal["bulan"] ?>','<?php } ?>' ],
                                            	            datasets: [
                                            	            {
                                            	              label: "<?php echo $b; ?>",
                                                            fill: false,
                                                            lineTension: 0.1,
                                                            backgroundColor: "rgba(59, 100, 222, 1)",
                                                            borderColor: "rgba(59, 100, 222, 1)",
                                                            pointHoverBackgroundColor: "rgba(59, 100, 222, 1)",
                                        						        pointHoverBorderColor: "rgba(59, 100, 222, 1)",
                                            	              data: [<?php $total = 0;
                                                                        foreach ($grafik_lokal as $lokal) {
                                                                            $total = $total + $lokal['nilai'];
                                                                            echo '"' . $total . '",';
                                                                        } ?>]
                                            	            }
                                            	            ]
                                            	            };
                                        
                                            	  var myBarChart = new Chart(ctx, {
                                            	            type: 'line',
                                            	            data: data,
                                            	            options: {
                                            	            barValueSpacing: 20,
                                            	            scales: {
                                            	              yAxes: [{
                                            	                  ticks: {
                                            	                      min: 0,
                                            	                  }
                                            	              }],
                                            	              xAxes: [{
                                            	                          gridLines: {
                                            	                              color: "rgba(0, 0, 0, 0)",
                                            	                          }
                                            	                      }]
                                            	              }
                                            	          }
                                            	        });
                                            	</script>
											</div>	
									  </div>
									</div>
								  </div>
								</div>
								
							</div>
							<div class="item-price-more">
								<div class="price"><?php if ($this->session->userdata('current_language') == 'english') {
                                                        echo "Year";
                                                    } else {
                                                        echo "Tahun";
                                                    } ?>
									<span class="amount"><?php echo date('Y'); ?></span>
								</div>
							</div>
							<div class="item-price-more">
								<?php echo 'bahasa' . $this->session->userdata('current_language'); ?>						
								<?php if ($this->session->userdata('current_language') == 'english') { ?>
								<div class="price"><a href="#" class="awe-btn" >Chart Info</a></div>
								<?php } else { ?>
								<div class="price"><a href="#" class="awe-btn" >Info Grafis</a></div>
								<?php } ?>
							</div>
						</div>		 -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="page-sidebar">
                    <div class="widget widget_search">
                        <h3><?php echo get_phrase('Cari Artikel'); ?></h3>
                        <form onsubmit="search_artikel(this);" method="POST">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <input type="search" required name="cari_artikel" id="cari_artikel" value="<?php echo get_phrase('Masukkan Kata'); ?>">
                        </form>
                    </div>

                    <div class="widget widget_tag_cloud">
                        <h3><?php echo get_phrase('Tags Artikel'); ?></h3>
                        <div class="tagcloud">
                            <?php foreach ($kategori as $row) : ?>

                                <?php
                                $data_awal = $row['berita_tag'];
                                $array =  explode(' ', $data_awal);
                                foreach ($array as $item) {
                                ?>
                                    <a href="<?php echo base_url('Artikel/Tags/' . $item); ?>"><?php echo $item ?></a>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="widget widget_categories">
                        <h3><?php echo get_phrase('Direktori Artikel'); ?></h3>
                        <ul class="css-treeview">
                            <?php foreach ($tahun as $thn) : ?>
                                <li>
                                    <input type="checkbox" class="expander" checked>
                                    <span class="expander"></span>
                                    <label><?php echo $thn['thn'] ?></label>

                                    <!-- The child nodes. -->
                                    <?php $bulan = $this->Model->sitemap_bulan($thn['thn'])->result_array();
                                    foreach ($bulan as $bln) {
                                        $bulantags = date('F', mktime(0, 0, 0, $bln['bulan'], 10));
                                    ?>
                                        <ul class="css-treeview">
                                            <li>
                                                <input type="checkbox" class="expander" disabled>
                                                <span class="expander"></span>
                                                <label><a href="<?php echo base_url('Artikel/' . $thn['thn'] . '/' . $bulantags) ?>"><?php echo $bln['bln'] ?></a></label>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
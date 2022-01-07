<style>
    .login-page-demo {

        background-image: url(<?php echo base_url() ?>assets/images/bg/1.jpg);

    }
</style>

<section class="awe-parallax login-page-demo" style="background-position: 50% 12px;">

    <div class="awe-overlay"></div>

    <div class="container">

        <div class="blog-heading-content text-uppercase">

            <h2><?php echo get_phrase('Profil Produsen'); ?></h2>

        </div>

    </div>

</section>

<br>
<br>

<div class="destination-grid-content">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="jumbotron" style="padding-top:2px; padding-bottom:5px; padding-right:20px; padding-left:20px">
                    <center>
                        <h2> <?php echo $nama_produsen ?> </h2>
                        <span>
                            <p style="font-size: 11px;"> <i>Bergabung sejak <?php echo longdate_indo($tahun_gabung)   ?></i> </p>
                        </span>
                    </center>

                    <p style="text-align:justify; font-size: 14px; "> <?php echo $deskripsi_produsen ?></p>
                    <!-- </div> -->
                </div>
            </div>
        </div>

        <div class="col-md-1"></div>
        <hr>
        </hr>
        <div class="container">

            <div class="destination-grid-content">

                <div class="row">

                    <div class="awe-masonry">

                        <?php

                        if ($this->session->userdata('current_language') == 'english') {

                            foreach ($wisata_en as $m) {

                                if ($m['urlfoto'] == '') {
                                    $cover = 'no_image.jpg';
                                } else {
                                    $cover = $m['url_file_foto'];
                                }

                                $row5 = '<img src="' . base_url() . 'uploads/foto_wisata/' . $cover . '">';

                                $link = base_url('Wisata/detail_wisata/' . $m['wisata_id']);

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

                            foreach ($produk as $p) {

                                if ($p['url_foto'] == '') {
                                    $cover = 'no_image.jpg';
                                } else {
                                    $cover = $p['url_foto'];
                                }
                                $row5 = '<img src="' . base_url() . 'uploads/foto_produk/' . $cover . '" alt ="' . $p['nama_produk'] . ' ' . $p['nama_kota'] . '">';
                                if (strpos($p["nama_produk"], '-') !== false) {
                                    $ProdukNama = str_replace('-', '_', $m["nama_produk"]);
                                } else {
                                    $ProdukNama  = $p["nama_produk"];
                                }
                                $link = base_url() . 'Produk/' . $p['nama_kategori'] . '/' . str_replace(' ', '-', $p["nama_provinsi"]) . '/' . str_replace(' ', '-', $p["nama_kota"]) . '/' . str_replace(' ', '-', $ProdukNama);
                                $Produke = @$Produke . "
									<div class='awe-masonry__item'>
										<a href=" . $link . ">
											<div class='image-wrap image-cover'>
												" . $row5 . "
											</div>
										</a>
										
										<div class='item-available'>
											" . $p['nama_produk'] . "
										</div>
									</div>
								";
                            }
                        }

                        ?>

                        <?php echo @$Produke ?>

                    </div>

                </div>

                <!-- <div class="more-destination">

					<a href="<?php echo base_url('Produk') ?>"><?php echo get_phrase('Destinasi Produk Lainnya'); ?></a>

				</div> -->
                <br>

                <div class="page__pagination" align="center">
                    <?php echo $halaman; ?>
                </div>

            </div>

        </div>



    </div>
    <br>

    <hr>
    </hr>

</div>




<script type='text/javascript' language='javascript'>
    var total_record = 0;

    var total_groups = <?php echo $total_data; ?>;

    $(document).ready(function() {



        $('#results').load("<?php echo site_url('Wisata/load_wisata' . $jenis) ?>", {
            'offset': total_record
        }, function() {
            total_record++;
        });

        $(window).scroll(function() {

            if ($(window).scrollTop() + $(window).height() == $(document).height())

            {

                if (total_record <= total_groups)

                {

                    loading = true;

                    $('.loader_image').show();

                    $.post('<?php echo site_url('Wisata/load_wisata/' . $jenis) ?>', {
                            'offset': total_record
                        },

                        function(data) {

                            if (data != "") {

                                $("#results").append(data);

                                $('.loader_image').hide();

                                total_record++;

                            }

                        });

                }

            }

        });

    });



    function load_more() {

        if (total_record <= total_groups)

        {

            loading = true;

            $('.loader_image').show();

            $.post('<?php echo site_url('Wisata/load_wisata/' . $jenis) ?>', {
                    'offset': total_record
                },

                function(data) {

                    if (data != "") {

                        $("#results").append(data);

                        $('.loader_image').hide();

                        total_record++;

                    }

                });

        }

    }
</script>

<!-- <section class="masonry-section-demo">

        <div class="container">

            <div class="destination-grid-content">

                <div class="row">       

                <span id="results">

                </span>

                <div align = "center">

                </div>

                <div class="more-destination">

                    <a href = "javascript:void(0)" onclick = "load_more()"><?php //echo get_phrase('Destinasi Wisata Lainnya');
                                                                            ?></a>


                </div>

                </div>

                </div>
         <br></br>

        </div>

</section> -->
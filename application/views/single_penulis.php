<style>
    .page-heading-demo {

        background-image: url(<?php echo base_url() ?>assets/images/img/<?php echo $bg_icon->fc_isi ?>);

    }
</style>

<section class="awe-parallax page-heading-demo" style="background-position: 50% 12px;">

    <div class="awe-overlay"></div>

    <div class="container">

        <div class="blog-heading-content text-uppercase">

            <h2><?php echo get_phrase('Artikel - Penulis'); ?></h2>

        </div>

    </div>

</section>



<section class="blog-page">

    <div class="container">

        <div class="row">

            <?php

            if ($this->session->userdata('current_language') == 'english') {

                foreach ($query as $u2) {

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

													<div class='date'>" . longdate_indo($u2->berita_tgl) . "

													</div>

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

                    $row5 = '<img src="' . base_url() . 'uploads/berita/' . $cover . '" alt ="' . $u->berita_judul . '">';

                    $link = base_url('Artikel/detail_artikel/' . $u->berita_id);

                    $url_title = url_title($u->berita_judul, '-', TRUE);

                    $linkslug = base_url('Artikel/' . $url_title);

                    $deskripsi = $u->berita_deskripsi;

                    $cut = substr($deskripsi, 0, 200);



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

                    //     $link2 = base_url('Artikel/tag_artikel/' . $item);

                    //     $data =  @$data . "<a href=" . $link2 . ">" . $item . "&nbsp;</a>";
                    // }

                    $data =  @$data . "

													</div>

												</div>

												<div class='post-title'>

												<form action=".$linkslug." method='post'>
                                                    <input type='hidden' name='id_artikel' value=".$u->berita_id.">
                                                    <button style='text-align: left;background: rgba(0,0,0,0.0);border-style: none;'><h2 id='linkSlug'>
                                                            " . $u->berita_judul . "</h2></button>
                                                </form>

												</div>

												<div class='post-content'>

													<p>" . $cut . "</p>

												</div>

												<div class='post-link'>

												<form action=".$linkslug." method='post'>
                                                        <input type='hidden' name='id_artikel' value=".$u->berita_id.">
                                                        <button style='text-align: left;background: rgba(0,0,0,0.0);border-style: none;'><a class='awe-btn awe-btn-style2 klik-id'>
                                                                " . get_phrase('Baca Selengkapnya') . "</a></button>
                                                    </form>

												</div>

											</div>

											</form>

										</div>

									";
                }
            }

            ?>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="jumbotron" style="padding-top:2px; padding-bottom:5px; padding-right:20px; padding-left:20px">
                        <?php //foreach ($penulis as $u) : 
                        ?>
                        <center>
                            <h3> <?php echo $penulis->penulis_nama  ?></h3>
                            <strong> <i><?php echo $penulis->penulis_profesi ?> </i></strong>
                            <p style="font-size: 10px;"> <i>Bergabung sejak <?php echo longdate_indo($penulis->penulis_tahun_bergabung)   ?></i> </p>
                        </center>
                        <p style="text-align:justify; font-size: 14px; "> <?php echo $penulis->penulis_deskripsi ?></p>
                    </div>
                </div>

                <div class="col-md-1"></div>

                <?php // endforeach 
                ?>
            </div>

            <div class="col-md-9">

                <div class="blog-page__content">

                    <?php echo @$data; ?>

                    <div class="page__pagination">

                        <?php echo $halaman; ?>

                    </div>

                </div>



            </div>





            <div class="col-md-3">

                <div class="page-sidebar">

                    <div class="widget widget_search">

                        <h3><?php echo get_phrase('Cari Artikel'); ?></h3>

                        <form onsubmit="search_artikel(this);" method="POST">
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

                                                <label><a href="<?php echo  base_url('Artikel/' . $thn['thn'] . '/' . $bulantags) ?>"><?php echo bulan($bln['bulan'])  ?></a></label>

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
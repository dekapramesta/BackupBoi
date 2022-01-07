<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from envato.megadrupal.com/html/gofar/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2017 01:58:03 GMT -->

<head>
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/icon.ico" type="image/x-icon">
	<meta charset="utf-8">
	<?php if (isset($title)) : ?>
		<title><?= $title . " | Artikel" ?></title>
	<?php elseif (isset($tahun)) : ?>
		<title><?= "Direktori Artikel \"" . $bulan . " " . $tahun . "\" | BeautyOfIndonesia.com" ?></title>
	<?php elseif (isset($tag_artikel)) : ?>
		<title><?= "Direktori Artikel Dengan Tag \"" . $tag_artikel . "\" | BeautyOfIndonesia.com" ?></title>
	<?php else : ?>
		<title>Artikel & Tips Seputar Wisata | BeautyOfIndonesia.com</title>
	<?php endif; ?>
	<!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/icon.png" type="image/x-icon" /> -->

	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:700,600,400,300" rel="stylesheet" type="text/css">

	<link href="http://fonts.googleapis.com/css?family=Oswald:400" rel="stylesheet" type="text/css">

	<link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/awe-booking-font.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/owl.carousel.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/magnific-popup.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lib/jquery-ui.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/revslider-demo/css/settings.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/demo.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/balloon.css-master/balloon.min.css">

	<link id="colorreplace" rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/colors/blue.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/css-treeview.css">
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?

					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;

			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;

			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window,

			document, 'script', '../../../connect.facebook.net/en_US/fbevents.js');



		fbq('init', '1031554816897182');

		fbq('track', "PageView");
	</script>
	<!-- <script>
	function get_action(form) {
		form.action = '<?= site_url('Tempat-Wisata/Kata-Kunci/'); ?>'+document.getElementById("cari").value;
	}
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
 </script> -->

	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1031554816897182&amp;ev=PageView&amp;noscript=1" /></noscript>
	<script>
		function search_artikel(form) {
			form.action = '<?= base_url('Artikel/Kata-Kunci/'); ?>' + document.getElementById("cari_artikel").value;
		}
	</script>

	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>



</head>
<!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<body>
	<!--<![endif]-->

	<div id="page-wrap">

		<div class="preloader">

		</div>

		<header id="header-page">

			<div class="header-page__inner">

				<div class="container">

					<div class="logo">

						<a href="<?php echo base_url('') ?>"><img src="<?php echo base_url(); ?>assets/images/logo-beautiful-of-indonesia.png" alt=""></a>

					</div>

					<nav class="navigation awe-navigation" data-responsive="1200">

						<ul class="menu-list">

							<li class="menu-item-has-children">

								<a href="<?php echo base_url('') ?>"><?php echo get_phrase('Beranda'); ?></a>

							</li>

							<li class="menu-item-has-children">

								<a href="<?php echo base_url('Tempat-Wisata') ?>"><?php echo get_phrase('Tempat Wisata'); ?></a>

								<ul class="sub-menu">

									<?php foreach ($menu_kategori as $menu_asli) : ?>

										<li>

											<a href="<?php echo base_url('Tempat-Wisata/' . $menu_asli['kategori_nama']) ?>"><?php echo get_phrase($menu_asli['kategori_nama']); ?></a>

										</li>

									<?php endforeach ?>

								</ul>

							</li>
							<li class="menu-item-has-children ">
								<a href="<?php echo base_url('Produk') ?>"><?php echo get_phrase('Oleh-Oleh'); ?></a>
								<ul class="sub-menu">
									<?php foreach ($menu_produk as $menuproduk) : ?>
										<li>
											<a href="<?php echo base_url('Produk/Jenis/' . $menuproduk['nama_kategori']) ?>"><?php echo get_phrase($menuproduk['nama_kategori']); ?></a>
										</li>
									<?php endforeach ?>
								</ul>
							</li>

							<li class="menu-item-has-children current-menu-parent">

								<a href="<?php echo base_url('Artikel') ?>"><?php echo get_phrase('Artikel'); ?></a>

							</li>

							<li class="menu-item-has-children">

								<a href="<?php echo base_url('Tentang-Kami') ?>"><?php echo get_phrase('Tentang Kami'); ?></a>

							</li>

							<li class="menu-item-has-children">

								<a href="<?php echo base_url('Kontak-Kami') ?>"><?php echo get_phrase('Kontak Kami'); ?></a>

							</li>




						</ul>

					</nav>

					<!-- <div class="search-box">
						<span class="searchtoggle">
							<i class="awe-icon awe-icon-search" id="icon_cari"></i>
						</span>
						<form class="form-search" onsubmit="get_action(this);" method="POST">
							<div class="form-item">
								<input type="text" name="cari" id="cari" placeholder="Masukkan Kata &amp; Tekan Enter" autofocus="autofocus">

								<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

								<script>
									$("#icon_cari").hover(function() {
										$("#cari").focus();
									});
								</script>
							</div>
						</form>

					</div> -->

					<a class="toggle-menu-responsive" href="#">

						<div class="hamburger">

							<span class="item item-1"></span>

							<span class="item item-2"></span>

							<span class="item item-3"></span>

						</div>
					</a>

				</div>

			</div>

		</header>
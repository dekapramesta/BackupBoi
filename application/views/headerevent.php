<!DOCTYPE html><html lang="en">
<!-- Mirrored from envato.megadrupal.com/html/gofar/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2017 01:58:03 GMT -->
<head><meta charset="utf-8"><title>Event Wisata - Beauty Of Indonesia</title>
<!-- <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/icon.png" type="image/x-icon" /> -->
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="format-detection" content="telephone=no"><meta name="apple-mobile-web-app-capable" content="yes">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:700,600,400,300" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Oswald:400" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/lib/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/lib/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/lib/awe-booking-font.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/lib/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/lib/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/lib/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/revslider-demo/css/settings.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/balloon.css-master/balloon.min.css">
<link id="colorreplace" rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/colors/blue.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/css-treeview.css"><!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]--><script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','../../../connect.facebook.net/en_US/fbevents.js');

fbq('init', '1031554816897182');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1031554816897182&amp;ev=PageView&amp;noscript=1"
/></noscript>
</head><!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]--><!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]--><!--[if IE 9]><body class="ie9 lt-ie10"><![endif]--><!--[if (gt IE 9)|!(IE)]><!-->
<body><!--<![endif]-->
<div id="page-wrap">
	<div class="preloader">
	</div>
	<header id="header-page">
		<div class="header-page__inner">
			<div class="container">
				<div class="logo">
					<a href="index-2.html"><img src="<?php echo base_url();?>assets/images/logo-beautiful-of-indonesia.png" alt=""></a>
				</div>
				<nav class="navigation awe-navigation" data-responsive="1200">
					<ul class="menu-list">
						<li class="menu-item-has-children">
							<a href="<?php echo base_url('') ?>"><?php echo get_phrase('Beranda');?></a>
						</li>
						<li class="menu-item-has-children">
							<a href="<?php echo base_url('Destinasi-Wisata')?>"><?php echo get_phrase('Tempat Wisata Wisata');?></a>
							<ul class="sub-menu">
							<?php foreach($menu_kategori as $menu_asli):?>
								<li>
									<a href="<?php echo base_url('Destinasi-Wisata/'.$menu_asli['kategori_nama']) ?>"><?php echo get_phrase($menu_asli['kategori_nama']);?></a>
								</li>
							<?php endforeach?>	
							</ul>
						</li>
						<li class="menu-item-has-children current-menu-parent">
							<a href="<?php echo base_url('Event') ?>"><?php echo get_phrase('Event Wisata');?></a>
						</li>
						<li class="menu-item-has-children">
							<a href="<?php echo base_url('Artikel') ?>"><?php echo get_phrase('Artikel');?></a>
						</li>
						<li class="menu-item-has-children">
							<a href="<?php echo base_url('Tentang-Kami') ?>"><?php echo get_phrase('Tentang Kami');?></a>
						</li>
						<li class="menu-item-has-children">
							<a href="<?php echo base_url('Kontak-Kami') ?>"><?php echo get_phrase('Kontak Kami');?></a>
						</li>

					<li class="menu-item-has-children">

					<a href="#"><?php echo get_phrase('Pilih Bahasa');?><b class="caret"></b></a>

					<!-- Language Selector -->

                        <ul class="sub-menu">

                            <?php

                            $fields = $this->db->list_fields('language');

                            foreach ($fields as $field)

                            {

                                if($field == 'phrase_id' || $field == 'phrase')continue;

                                ?>

                                    <li>

                                        <a href="<?php echo base_url();?>Multilanguage/select_language/<?php echo $field;?>">

                                            <?php echo $field;?>

                                            <?php //selecting current language

                                                if($this->session->userdata('current_language') == $field):?>

                                                    <i class="icon-ok"></i>

                                            <?php endif;?>

                                        </a>

                                    </li>

                                <?php

                            }

                            ?>

                        </ul>

                	<!-- Language Selector -->

					</li>
					</ul>
				</nav>
				<div class="search-box">
					<span class="searchtoggle">
						<i class="awe-icon awe-icon-search"></i>
					</span>
					<form class="form-search" action="<?php echo site_url('Wisata/search_wisata');?>" method="POST">
						<div class="form-item">
							<input type="text" name="cari" value="Masukkan Kata &amp; Tekan Enter">
						</div>
					</form>
				</div>
				<a class="toggle-menu-responsive" href="#">
				<div class="hamburger">
					<span class="item item-1"></span>
					<span class="item item-2"></span>
					<span class="item item-3"></span>
				</div></a>
			</div>
		</div>
</header>
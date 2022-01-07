<footer id="footer-page">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="widget widget_contact_info">
					<div class="widget_background">
						<div class="widget_background__half">
							<div class="bg">
							</div>
						</div>
						<div class="widget_background__half">
							<div class="bg"></div>
						</div>
					</div>
					<div class="logo">
						<img src="<?php

									use Hamcrest\Type\IsString;

									echo base_url(); ?>assets/images/logo-beautiful-of-indonesia.png" alt="">
					</div>
					<div class="widget_content">

					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="widget widget_about_us">
					<h3><?php echo get_phrase('Sekilas Pandang'); ?></h3>
					<div class="widget_content">
						<?php
						if ($this->session->userdata('current_language') == 'english') {
							$sekilas = $sekilas_icon_en->fc_isi;
						} else {
							$sekilas = $sekilas_icon->fc_isi;
						}
						?>
						<p><?php echo $sekilas; ?></p>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="widget widget_categories">
					<h3><?php echo get_phrase('Jenis Wisata'); ?></h3>
					<?php foreach ($menu_kategori as $menu_asli) : ?>
						<ul>
							<li><a href="<?php echo base_url('Tempat-Wisata/' . $menu_asli['kategori_nama']) ?>"><?php echo get_phrase($menu_asli['kategori_nama']); ?></a></li>
						</ul>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col-md-2">
				<div class="widget widget_recent_entries">
					<h3>Playstore</h3>
					<ul>
						<li><a href='#'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' /></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="widget widget_follow_us">
					<h3>Follow Me</h3>
					<div class="widget_content">
						<div class="awe-social">
							<a href="https://www.instagram.com/beautyofindonesia.com_" target="_blank"><i class="fa fa-instagram"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<p>Beauty Of Indonesia © 2021 All rights reserved</p>
		</div>
	</div>
</footer>
</div>

<?php if ($this->uri->segment(2) == 'detail') : ?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php elseif ($this->uri->segment(5) == is_string(str_replace(' ', '-', $this->uri->segment(5)))) : ?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php endif; ?>
<script style="display: none !important;">
	! function(e, t, r, n, c, a, l) {
		function i(t, r) {
			return r = e.createElement('div'), r.innerHTML = '<a href="' + t.replace(/"/g, '&quot;') + '"></a>', r.childNodes[0].getAttribute('href')
		}

		function o(e, t, r, n) {
			for (r = '', n = '0x' + e.substr(t, 2) | 0, t += 2; t < e.length; t += 2) r += String.fromCharCode('0x' + e.substr(t, 2) ^ n);
			return i(r)
		}
		try {
			for (c = e.getElementsByTagName('a'), l = '/cdn-cgi/l/email-protection#', n = 0; n < c.length; n++) try {
				(t = (a = c[n]).href.indexOf(l)) > -1 && (a.href = 'mailto:' + o(a.href, t + l.length))
			} catch (e) {}
			for (c = e.querySelectorAll('.__cf_email__'), n = 0; n < c.length; n++) try {
				(a = c[n]).parentNode.replaceChild(e.createTextNode(o(a.getAttribute('data-cfemail'), 0)), a)
			} catch (e) {}
		} catch (e) {}
	}(document);
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/theia-sticky-sidebar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/theia-sticky-sidebar.js"></script>
<script src="<?php echo base_url(); ?>assets/sliderengine/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/sliderengine/amazingslider.js"></script>
<script src="<?php echo base_url(); ?>assets/sliderengine/initslider-1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/css/chart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/css/chart/exporting.js"></script>

<script>
	(function(i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function() {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-20585382-5', 'megadrupal.com');
	ga('send', 'pageview');
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/revslider-demo/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/revslider-demo/js/jquery.themepunch.tools.min.js"></script>
<script>
	$(document).ready(function() {
		$(document).on("click", ".klik-id", function() {
			var form = $(this).closest("form");
			// console.log(form);
			form.submit();
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#province').change(function() {
			console.log('tes');
			var province = $("#province :selected").val();
			str = province.replace(/\s+/g, '-');
			$(location).attr('href', '<?= base_url("Tempat-Wisata/" . $kategori . "/") ?>' + str);
		});
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
			csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		var province = $("#province :selected").val();
		if (province != 0) {
			console.log('oi');
			$('#towns').prop('disabled', false);
			var province = $("#province :selected").val();
			str = province.replace(/\s+/g, '-');

			$.ajax({
				type: 'POST',
				url: '<?= base_url("Wisata/get_town") ?>',
				data: {
					[csrfName]: csrfHash,
					province: province,
					towns: '<?= $this->uri->segment(4) ?>'
				},
				success: function(response) {
					console.log(response);
					$('#towns').html(response);
				}
			})
		}

		$('#towns').change(function() {
			var towns = $("#towns :selected").val();
			var province = $("#province :selected").val();
			towns = towns.replace(/\s+/g, '-');
			province = province.replace(/\s+/g, '-');
			$(location).attr('href', '<?= base_url("Tempat-Wisata/" . $kategori . "/") ?>' + province + '/' + towns);
		});

		$(".sendData").click(function() {
			console.log("ok");
			$("#requestNew").submit();
		});

	});
</script>
<!-- <script>
	$(document).ready(function() {
		$('#provinsi').change(function(){
			var province = $("#provinsi :selected").val();
			str = province.replace(/\s+/g, '-');
			$(location).attr('href', '<?= base_url("Produk/") ?>'+str);
		});

		var province = $("#provinsi :selected").val();
		if (province != 0) {
			$('#kotakab').prop('disabled', false);
			var province = $("#provinsi :selected").val();
			str = province.replace(/\s+/g, '-');
			
			$.ajax({
				type: 'POST',
				url: '<?= base_url("Produk/get_city") ?>',
				data: {province: province, city: '<?= $this->uri->segment(2) ?>'},
				success: function(response){
					console.log('asu');
					$('#kotakab').html(response);
				}
			})
		}
		
		$('#kotakab').change(function(){
			var towns = $("#kotakab :selected").val();
			var province = $("#provinsi :selected").val();
			towns = towns.replace(/\s+/g, '-');
			province = province.replace(/\s+/g, '-');
			$(location).attr('href', '<?= base_url("Produk/") ?>'+province+'/'+towns);
		});
	
	});
</script> -->
<script>

</script>
<script type="text/javascript">
	if ($('#slider-revolution').length) {
		$('#slider-revolution').show().revolution({
			ottedOverlay: "none",
			delay: 10000,
			startwidth: 1600,
			startheight: 650,
			hideThumbs: 200,

			thumbWidth: 100,
			thumbHeight: 50,
			thumbAmount: 5,


			simplifyAll: "off",

			navigationType: "none",
			navigationArrows: "solo",
			navigationStyle: "preview4",

			touchenabled: "on",
			onHoverStop: "on",
			nextSlideOnWindowFocus: "off",

			swipe_threshold: 0.7,
			swipe_min_touches: 1,
			drag_block_vertical: false,

			parallax: "mouse",
			parallaxBgFreeze: "on",
			parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],


			keyboardNavigation: "off",

			navigationHAlign: "center",
			navigationVAlign: "bottom",
			navigationHOffset: 0,
			navigationVOffset: 20,

			soloArrowLeftHalign: "left",
			soloArrowLeftValign: "center",
			soloArrowLeftHOffset: 20,
			soloArrowLeftVOffset: 0,

			soloArrowRightHalign: "right",
			soloArrowRightValign: "center",
			soloArrowRightHOffset: 20,
			soloArrowRightVOffset: 0,

			shadow: 0,
			fullWidth: "on",
			fullScreen: "off",

			spinner: "spinner2",

			stopLoop: "off",
			stopAfterLoops: -1,
			stopAtSlide: -1,

			shuffle: "off",

			autoHeight: "off",
			forceFullWidth: "off",



			hideThumbsOnMobile: "off",
			hideNavDelayOnMobile: 1500,
			hideBulletsOnMobile: "off",
			hideArrowsOnMobile: "off",
			hideThumbsUnderResolution: 0,

			hideSliderAtLimit: 0,
			hideCaptionAtLimit: 0,
			hideAllCaptionAtLilmit: 0,
			startWithSlide: 0
		});

	}
</script>
<script>
	$(document).ready(function() {
		$(document).on("click", ".klik-id", function() {
			var form = $(this).closest("form");
			// console.log(form);
			form.submit();
		});
	});
</script>
</body>
<!-- Mirrored from envato.megadrupal.com/html/gofar/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2017 02:00:59 GMT -->

</html>
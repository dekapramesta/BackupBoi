<script     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFTimIhQoFCg8bF7PAMgDWi38QqqvaCx8">
  </script>
<body style="transform: none;"><!--<![endif]--><div id="page-wrap"><div class="preloader" style="transform: none;"></div></div>
<style>
.login-page-demo {
	background-image: url(<?php echo base_url()?>assets/images/bg/1.jpg);
}
</style>
<section class="awe-parallax login-page-demo" style="background-position: 50% 12px;">
    <div class="awe-overlay"></div>
    <div class="container">
    <div class="blog-heading-content text-uppercase">
        <h2><?php echo get_phrase('Fasilitas Pendukung');?></h2>
    </div>
    </div>
</section>


<section class="product-detail" style="transform: none;"><div class="container" style="transform: none;"><div class="row">
<div class="col-md-9">
<div class="post">
	<div class="post-title"><h1><?php echo @$fasilitas_pendukung->wiskung_nama?></h1></div>
	<hr />
	<div class="post-media">
		<div class="image-wrap">
			<img src="<?php echo base_url().'uploads/fasilitas_pendukung/'.$fasilitas_pendukung->wiskung_url_foto;?>" alt="">
		</div>
	</div>
	<div class="post-body"><div class="post-content"><br />
		<div class="checkout-page__sidebar">
			<ul>
				<li>
					<a href="#">Alamat : <?php echo @$fasilitas_pendukung->wiskung_alamat?></a>
				</li>
				<li >
					<a href="#">Telp : <?php echo @$fasilitas_pendukung->wiskung_telp?></a>
				</li>
				<li>
					<a href="#">Website : <?php echo @$fasilitas_pendukung->wiskung_website?></a>
				</li>
			</ul>
		</div>
	</div></div> 
</div>
</div>

<div class="col-md-3">
	<div class="page-sidebar">
	<div class="widget widget_search">
		<h3><?php echo get_phrase('Lokasi');?></h3>
		<hr />
		<div id="peta" style="width:100%;height:500px;"></div>
	</div>	
	</div>
</div>


</div></div>
</section>
</body>


<script type="text/javascript">
		(function() {
		window.onload = function() {
		var map;
		//Parameter Google maps
		var options = {
		zoom: 16, //level zoom
		//posisi tengah peta
		center:new google.maps.LatLng('<?php echo @$fasilitas_pendukung->wiskung_latitude?>' ,'<?php echo @$fasilitas_pendukung->wiskung_longitude?>'),
		mapTypeId: google.maps.MapTypeId.ROADMAP
		};
 
		// Buat peta di 
		var map = new google.maps.Map(document.getElementById('peta'), options);
		// Tambahkan Marker 
		var locations = [
			['<?php echo @$fasilitas_pendukung->wiskung_nama?>', '<?php echo @$fasilitas_pendukung->wiskung_latitude?>' ,'<?php echo @$fasilitas_pendukung->wiskung_longitude?>'],
		];
		var infowindow = new google.maps.InfoWindow();
 
		var marker, i;
		/* kode untuk menampilkan banyak marker */
		for (i = 0; i < locations.length; i++) {  
			marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
		});
		/* menambahkan event clik untuk menampikan
		infowindows dengan isi sesuai denga
		marker yang di klik */
 
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
		return function() {
		infowindow.setContent(locations[i][0]);
		infowindow.open(map, marker);
		}
		})(marker, i));
		}
 
 
		};
		})(); 
 
	</script>
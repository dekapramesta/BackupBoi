<?php $title = "<i class='fa fa-file-image-o'></i>&nbsp;Detail Oleh-oleh"; ?>
<?php $key = $this->uri->segment(2); ?>

<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url(); ?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
	<div class="page-header">
		<h1>
			<?php echo $title; ?>
		</h1>
	</div><!-- /.page-header -->
	<script>
		$(document).ready(function() {
			$('.search-dropdown').select2();
		});
	</script>
	<div id="panel-data">
		<div class="widget-box">
			<div class="widget-header">

				<div class="widget-toolbar">
					<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>

					<a href="#" data-action="close">
						<i class="ace-icon fa fa-times"></i>
					</a>
				</div>
			</div>

			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<div class="box-header">
								<button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
								<button class="btn btn-danger" onclick="Tambah()"><i class="fa fa-plus"></i> Tambah Data</button>
								<button class="btn btn-primary" onclick="goBack()"><i class="fa fa-arrows-h"></i> Back</button>
							</div><br />
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Nama Oleh-oleh</th>
										<th>Deskripsi</th>
										<th>Produsen</th>
										<th>Tag</th>
										<th>Slug produk</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div><!-- /.span -->
					</div>
				</div><!-- /.row -->
			</div>
		</div>
	</div>

	</section>
</div>
</div>

<script type="text/javascript">
	var zonk = ''
	var save_method;
	var table;
	var link = "<?php echo site_url('Kategori_produk') ?>";
	var kdKat = "<?php echo @$id_kategori_produk; ?>";

	function goBack() {
		window.history.back();
	}

	function reload_table() {
		table.ajax.reload(null, false);
	}

	$(document).ready(function() {
		//$('#idImgLoader').show(2000);
		$('#idImgLoader').fadeOut(2000);
		setTimeout(function() {
			data();
		}, 2000);
		setTimeout(function() {
			ckeditor();
		}, 2000);
	});

	function ckeditor() {
		tinymce.init({
			selector: "textarea"
		});
	}

	function data() {
		$('#data').fadeIn();
	}

	var link_sub = '<?php echo $this->session->userdata('current_language') == 'english' ?>';
	$(document).ready(function() {
		if (link_sub) {
			produk_en();
		} else {
			produk();
		}

	}).fnDestroy();

	function produk() {
		table = $('#dynamic-table').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"bDestroy": true,
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": link + "/ajax_listid/" + kdKat,
				"type": "POST"
			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
			}, ],

		});
	}

	function wisata_en() {
		table = $('#dynamic-table').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"bDestroy": true,
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": link + "/ajax_listid_en/" + kdKat,
				"type": "POST"
			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
			}, ],

		});
	}

	function Tambah() {
		document.getElementById('formAksi').reset();
		save_method = 'add';
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow');
	}

	function save() {
		$('#btn_save').text('Saving...');
		$('#btn_save').attr('disabled', true);

		var url;
		if (save_method == 'add') {
			url = link + "/ajax_adddet";
		} else {
			url = link + "/ajax_updatedet";
		}

		tinyMCE.triggerSave();
		$.ajax({
			url: url,
			type: "POST",
			data: $('#formAksi').serialize(),
			dataType: "JSON",
			success: function(result) {
				if (result.status) {

					setTimeout(function() {
						Batal();
					}, 1000);

					setTimeout(function() {
						reload_table();
					}, 1000);
				}
				setTimeout(function() {
					$('#btn_save').text('Save');
					$('#btn_save').attr('disabled', false);
					document.getElementById('formAksi').reset();
				}, 1000);
				swal_berhasil();
				setTimeout(function() {
					reload_table();
				}, 1000);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				// alert('Error adding/update data');
				swal({
					title: "ERROR",
					text: "Error adding / update data",
					type: "warning",
					closeOnConfirm: true
				});
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled', false);
			}
		});
	}

	function Batal() {
		$('#form-data').slideUp(500, 'swing');
		$('#panel-data').fadeIn(1000);
	}

	function edite(id) {
		save_method = 'update';
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow');
		document.getElementById('formAksi').reset();
		var link_sub = '<?php echo $this->session->userdata('current_language') == 'english' ?>';
		if (link_sub) {
			link_edit = "ajax_editdet_en";
		} else {
			link_edit = "ajax_editdet";
		}
		$.ajax({
			url: link + "/" + link_edit + "/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(result) {
				//document.getElementById('fc_kdbahan').setAttribute('readonly','readonly');
				$('[name="id_produk"]').val(result.id_produk);
				$('[name="nama_produk"]').val(result.nama_produk);
				tinymce.editors[0].setContent(result.deskripsi_produk);
				$('[name="tag_produk"]').val(result.tag_produk);
				$('[name="slug_produk"]').val(result.slug_produk);
				$('[name="id_produsen"]').val(result.id_produsen);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function hapuse(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax({
				url: "<?php echo site_url('Kategori_produk/ajax_delete_det') ?>/" + id,
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					setTimeout(function() {
						Batal();
					}, 1000);

					setTimeout(function() {
						reload_table();
					}, 1000);
					swal_berhasil();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					swal({
						title: "ERROR",
						text: "Error delete data",
						type: "warning",
						closeOnConfirm: true
					});
					$('#btnSave').text('save');
					$('#btnSave').attr('disabled', false);
				}
			});
		}
	}
</script>

<div class="row">
	<div class="col-xs-12">
		<div id="form-data" style="display:none;">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Form Oleh-oleh</h4>

					<div class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="ace-icon fa fa-chevron-up"></i>
						</a>

						<a onclick="Batal()" data-action="close">
							<i class="ace-icon fa fa-times"></i>
						</a>
					</div>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" role="form" id="formAksi">
									<input type="hidden" name="id_kategori_produk" value="<?php echo $key; ?>">
									<input type="hidden" name="id_produk">
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama OLeh-oleh </label>
										<div class="col-sm-10">
											<input type="text" id="nama_produk" name="nama_produk" placeholder="Nama Produk" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field nama harus diisi')" oninput="this.setCustomValidity('')" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Pilih Provinsi </label>
										<div class="col-sm-10">
											<select id="provinsiproduk" name="provinsiprd" class="ui search-dropdown" style="width: 300px;">
												<option disabled selected value="0">Pilih Provinsi</option>
												<?php foreach ($provinces as $prov) : ?>
													<option value="<?php echo $prov['nama_provinsi'] ?>"><?php echo $prov['nama_provinsi'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Pilih Kota </label>
										<div class="col-sm-10">
											<select id="cityproduk" name="cityprd" class="ui search-dropdown" style="width: 300px;">
												<option disabled selected value="0">Pilih Kota/Kabupaten</option>
												<?php

												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi Wisata </label>
										<div class="col-sm-6">
											<textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" placeholder="Deskripsi Produk" class="col-xs-10 col-sm-5"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Produsen </label>
										<div class="col-sm-10">
											<select class="ui search-dropdown" style="width: 300px;" id="id_produsen" name="id_produsen">
												<?php foreach ($produsen as $pro) : ?>
													<option value="<?php echo $pro['id_produsen'] ?>"><?php echo $pro['nama_produsen'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Oleh-oleh Tag </label>
										<div class="col-sm-10">
											<input type="text" id="tag_produk" name="tag_produk" placeholder="Tag Produk" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field tag harus diisi')" oninput="this.setCustomValidity('')" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Slug Produk </label>
										<div class="col-sm-10">
											<input type="text" id="slug_produk" name="slug_produk" placeholder="Slug Produk" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="col-md-offset-2 col-md-9">
										<button class="btn btn-info" type="button" id="btn_save" onclick="save()">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Submit
										</button>

										&nbsp; &nbsp; &nbsp;
										<button class="btn" type="reset">
											<i class="ace-icon fa fa-undo bigger-110"></i>
											Reset
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div><!-- /.row -->
			</div>
		</div><!-- /.row -->
	</div>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			console.log('tes');
			$('#provinsiproduk').change(function() {
				var prov = $('#provinsiproduk').val();
				console.log(prov);
				if (prov != '') {
					$.ajax({
						url: "<?php echo base_url('kategori_produk/getCity') ?>",
						type: "POST",
						data: {
							nama_provinsi: prov
						},
						success: function(response) {
							console.log(response);
							$('#cityproduk').html(response);
						}
					})
				}
			})
		})
	</script>
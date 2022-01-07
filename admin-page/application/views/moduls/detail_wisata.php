<?php $title = "<i class='fa fa-file-image-o'></i>&nbsp;Detail Wisata"; ?>
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
										<th>Nama Wisata</th>
										<th>Deskripsi</th>
										<th>Nama Penulis</th>
										<th>Tag</th>
										<th>Latitude</th>
										<th>Longitude</th>
										<th>Htm Lokal</th>
										<th>Htm Intl</th>
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
	var link = "<?php echo site_url('Kategori') ?>";
	var kdKat = "<?php echo @$kategori_id; ?>";

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
			wisata_en();
		} else {
			wisata();
		}

	}).fnDestroy();

	function wisata() {
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
				$('[name="wisata_id"]').val(result.wisata_id);
				$('[name="wisata_url_video"]').val(result.wisata_url_video);
				$('[name="wisata_nama"]').val(result.wisata_nama);
				tinymce.editors[0].setContent(result.wisata_deskripsi);
				$('[name="wisata_tag"]').val(result.wisata_tag);
				$('[name="wisata_htm_lokal"]').val(result.wisata_htm_lokal);
				$('[name="wisata_htm_intl"]').val(result.wisata_htm_intl);
				$('[name="wisata_latitude"]').val(result.wisata_latitude);
				$('[name="wisata_longitude"]').val(result.wisata_longitude);
				$('[name="penulis_id"]').val(result.penulis_id);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function hapuse(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax({
				url: "<?php echo site_url('Kategori/ajax_delete_det') ?>/" + id,
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
					<h4 class="widget-title">Form Wisata</h4>

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
									<input type="hidden" name="kategori_id" value="<?php echo $key; ?>">
									<input type="hidden" name="wisata_id">
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Wisata Url Video </label>
										<div class="col-sm-10">
											<input type="text" id="wisata_url_video" name="wisata_url_video" placeholder="Wisata Url Video" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Wisata </label>
										<div class="col-sm-10">
											<input type="text" id="wisata_nama" name="wisata_nama" placeholder="Nama Wisata" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field nama harus diisi')" oninput="this.setCustomValidity('')"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi Wisata </label>
										<div class="col-sm-6">
											<textarea class="form-control" id="wisata_deskripsi" name="wisata_deskripsi" placeholder="Deskripsi Wisata" class="col-xs-10 col-sm-5"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Penulis </label>
										<div class="col-sm-10">
											<select class="ui search-dropdown" style="width: 300px;" id="penulis_id" name="penulis_id">
												<?php foreach ($penulis_wisata as $penulis) : ?>
													<option value="<?php echo $penulis['penulis_id'] ?>"><?php echo $penulis['penulis_nama'] . ' - ' . $penulis['penulis_profesi'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Wisata Tag </label>
										<div class="col-sm-10">
											<input type="text" id="wisata_tag" name="wisata_tag" placeholder="Nama Wisata" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field tag harus diisi')" oninput="this.setCustomValidity('')"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Htm Lokal </label>
										<div class="col-sm-10">
											<input type="text" id="wisata_htm_lokal" name="wisata_htm_lokal" placeholder="Htm Lokal" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Htm Intl </label>
										<div class="col-sm-10">
											<input type="text" id="wisata_htm_intl" name="wisata_htm_intl" placeholder="Htm Intl" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Latitude </label>
										<div class="col-sm-10">
											<input type="text" id="wisata_latitude" name="wisata_latitude" placeholder="Latitude" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Longitude </label>
										<div class="col-sm-10">
											<input type="text" id="wisata_longitude" name="wisata_longitude" placeholder="Longitude" class="col-xs-10 col-sm-5" />
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
<?php $title = "<i class='fa fa-users'></i>&nbsp;Produsen"; ?>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url(); ?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
	<div class="page-header">
		<h1>
			<?php echo $title; ?>
		</h1>
	</div><!-- /.page-header -->

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
							</div><br />
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Produsen</th>
										<th>Alamat Produsen</th>
										<th>Tahun Bergabung Produsen</th>
										<th>Deskripsi Produsen</th>
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

<div class="row">
	<div class="col-xs-12">
		<div id="form-data" style="display:none;">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Form Penulis</h4>

					<div class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="ace-icon fa fa-chevron-up"></i>
						</a>

						<a onclick="Batal()" data-action="close">
							<i class="ace-icon fa fa-times"></i>
						</a>
					</div>
				</div>

				<!-- Form Tambah Data-->
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<style type="text/css">
									#loader {
										display: none
									}

									#preview {
										display: none
									}
								</style>
								<form id="form-add" class="form-horizontal" action="<?= site_url('Produsen/ajax_add') ?>" method="POST" role="form" enctype="multipart/form-data">
									<input type="hidden" name="penulis_id">
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Produsen </label>
										<div class="col-sm-10">
											<input type="text" id="penulis_nama" name="nama_produsen" placeholder="Nama Produsen" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field nama harus diisi')" oninput="this.setCustomValidity('')"/>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Alamat Produsen </label>
										<div class="col-sm-10">
											<input type="text" id="penulis_profesi" name="alamat_produsen" placeholder="Alamat Produsen" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field profesi harus diisi')" oninput="this.setCustomValidity('')"/> <span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi Produsen </label>
										<div class="col-sm-6">
											<textarea class="form-control" id="penulis_deskripsi" name="produsen_deskripsi" placeholder="Deskripsi Produsen" class="col-xs-10 col-sm-5" cols="30" rows="10"></textarea>
											<span class="help-block"></span>
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Penulis Penulis </label>
										<div class="col-sm-10">
											<input type="text" id="penulis_penulis" name="penulis_penulis" placeholder="Penulis Penulis" class="col-xs-10 col-sm-5" />
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Penulis Tag </label>
										<div class="col-sm-6">
											<input type="text" id="penulis_tag" name="penulis_tag" placeholder="Penulis Tag" class="col-xs-10 col-sm-5" />
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gambar </label>
										<div class="col-sm-10">
											<input type="file" name="userfile" id="userfile" required>
											<span class="help-block"></span>
											<img id="loader" src="<?php //base_url(); 
																	?>uploads/load.gif" style="height: 30px;">
											<img id="preview" src="#" style="height: 100px;border: 1px solid #DDC; " />
										</div>
									</div> -->
									<div class="col-md-offset-2 col-md-9">
										<input type="submit" value="Add" id="btnSave" class="btn btn-primary">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div><!-- /.row -->
			</div>
		</div><!-- /.row -->
	</div>


	<!-- Form Edit Data-->
	<style type="text/css">
		#loader-upload {
			display: none
		}
	</style>
	<div id="form-update" style="display:none;">
		<div class="tabbable">
			<ul class="nav nav-tabs" id="formAksi">
				<li class="active">
					<a data-toggle="tab" href="#home">
						<i class="green ace-icon fa fa-home bigger-120"></i>
						Form
					</a>
				</li>
				<!-- <li>
					<a data-toggle="tab" href="#messages">
						<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
						Gambar
					</a>
				</li> -->
			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="id_produsen" />
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Produse </label>
							<div class="col-sm-10">
								<input type="text" id="nama_produsen" name="nama_produsen" placeholder="Nama Produsen" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field nama harus diisi')" oninput="this.setCustomValidity('')"/>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Alamat Produsen </label>
							<div class="col-sm-10">
								<input type="text" id="alamat_produsen" name="alamat_produsen" placeholder=" Alamat Produsen" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field profesi harus diisi')" oninput="this.setCustomValidity('')"></input>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi Produsen </label>
							<div class="col-sm-6">
								<textarea class="form-control" id="produsen_deskripsi" name="produsen_deskripsi" placeholder="Deskripsi Produsen" class="col-xs-10 col-sm-5" cols="30" rows="10"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
						<!-- <div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Penulis Penulis </label>
							<div class="col-sm-10">
								<input type="text" id="penulis_penulis" name="penulis_penulis" placeholder="Penulis Penulis" class="col-xs-10 col-sm-5" />
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Penulis Tag </label>
							<div class="col-sm-6">
								<input type="text" id="penulis_tag" name="penulis_tag" placeholder="Penulis Tag" class="col-xs-10 col-sm-5" />
								<span class="help-block"></span>
							</div> -->
						<br /><br /><br /><br />
						<div class="col-md-offset-2 col-md-9">
							<button type="button" value="Add" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-danger" onclick="Batal2()">Cancel</button>
						</div>
				</div>

				</form>
			</div>

			<!-- <div id="messages" class="tab-pane fade">
				<form id="form-upload" class="form-horizontal" role="form" action="<?php //site_url('C_penulis/upload')
																					?>" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="penulis_id" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Pilih File</label>
							<div class="input-group col-md-6">
								<input type="file" name="file-upload" id="file-upload">
								<span class="help-block"></span>
								<div class="input-group-btn">
									<button type="submit" class="btn btn-primary">Upload</button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Preview</label>
							<div class="input-group col-md-9">
								<img id="loader-upload" src="<?php //base_url(); 
																?>uploads/load.gif" style="height: 30px;">
								<img id="preview-upload" src="#" style="height: 100px;border: 1px solid #DDC; " />
							</div>
						</div>
					</div>
				</form>
			</div> -->

		</div>
	</div>
</div>

<script>
	var zonk = '';
	var save_method;
	var link = "<?php echo site_url('Produsen') ?>";
	var table;

	//ajax tambah data	
	$(document).ready(function() {
		$('#form-add').submit(function(e) {
			tinyMCE.triggerSave();
			e.preventDefault();
			var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"),
				type: 'POST',
				dataType: 'json',
				data: formData,
				async: true,
				beforeSend: function() {
					$('#btnSave').text('saving...');
					$('#btnSave').attr('disabled', true);
				},
				success: function(response) {
					if (response.status) {
						Batal();
						reload_table();
						swal_berhasil();
					} else {
						Batal();
						reload_table();
						swal_error(response.error);
					}
				},
				complete: function() {
					$('#btnSave').text('save');
					$('#btnSave').attr('disabled', false);
				},
				cache: false,
				contentType: false,
				processData: false
			});
			return false;
		});

		function readURL(input) {
			$("#preview").show();
			if (input.files && input.files[0]) {
				var rd = new FileReader();
				rd.onload = function(e) {
					$('#preview').attr('src', e.target.result);
				};
				rd.readAsDataURL(input.files[0]);
			}
		}
		$("#userfile").change(function() {
			readURL(this);
		});

	});


	//ajax update
	$(document).ready(function() {
		$('#form-upload').submit(function(e) {
			tinyMCE.triggerSave();
			e.preventDefault();
			var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"),
				type: 'POST',
				dataType: 'json',
				data: formData,
				async: true,
				beforeSend: function() {
					$('#btnSave').text('saving...');
					$('#btnSave').attr('disabled', true);
				},
				success: function(response) {
					if (response.status) {
						Batal2();
						reload_table();
						swal_berhasil();
					} else {
						Batal2();
						reload_table();
						swal_error(response.error);
					}
				},
				complete: function() {
					$('#btnSave').text('save');
					$('#btnSave').attr('disabled', false);
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader();
				rd.onload = function(e) {
					$('#preview-upload').attr('src', e.target.result);
				};
				rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload").change(function() {
			readURL(this);
		});
	});

	function save() {
		var url;
		url = "<?= site_url() ?>Produsen/update/";
		tinyMCE.triggerSave();
		$('#btnSave').text('saving...');
		$('#btnSave').attr('disabled', true);
		$.ajax({
			url: url,
			type: "POST",
			dataType: "JSON",
			data: $('#form').serialize(),
			success: function(data) {
				if (data.status) {
					Batal2();
					reload_table();
					swal_berhasil();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
					}
				}
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled', false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
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

	$(document).ready(function() {
		$('#idImgLoader').fadeOut(2000);
		setTimeout(function() {
			data();
		}, 2000);
		setTimeout(function() {
			ckeditor();
		}, 2000);
		setTimeout(function() {
			ckeditor2();
		}, 2000);
	});

	function ckeditor() {
		// tinymce.init({
		// 	selector: "textarea"
		// });
	}

	function ckeditor2() {
		tinymce.init({
			selector: "#teksarea"
		});
	}

	function data() {
		$('#data').fadeIn();
	}

	var link_sub = '<?php echo $this->session->userdata('current_language') == 'english' ?>';
	$(document).ready(function() {
		if (link_sub) {
			penulis_en();
		} else {
			produsen();
		}

	}).fnDestroy();

	function produsen() {

		table = $('#dynamic-table').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"bDestroy": true,
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('Produsen/ajax_list') ?>",
				"type": "POST"
			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
			}, ],

		});
	}

	function penulis_en() {

		table = $('#dynamic-table').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"bDestroy": true,
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('C_penulis/ajax_list_en') ?>",
				"type": "POST"
			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
			}, ],

		});
	}

	$(document).ready(function() {
		$("input").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("textarea").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
	});

	function Tambah() {
		document.getElementById('form-add').reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		save_method = 'add';
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow');
		$('[name="userfile"]').val(zonk);

	}

	function reload_table() {
		table.ajax.reload(null, false);
	}

	function Batal() {
		$('#form-data').slideUp(500, 'swing');
		$('#panel-data').fadeIn(1000);
	}

	function Batal2() {
		$('#form-update').slideUp(500, 'swing');
		$('#panel-data').fadeIn(1000);
	}

	function update(id) {
		save_method = 'update';
		$('#panel-data').fadeOut('slow');
		$('#form-update').fadeIn('slow');
		var link_sub = '<?php echo $this->session->userdata('current_language') == 'english' ?>';
		if (link_sub) {
			link_edit = "ajax_edit_en";
		} else {
			link_edit = "ajax_edit";
		}
		$.ajax({
			url: link + "/" + link_edit + "/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(result) {
				$('[name="id_produsen"]').val(result.id_produsen);
				$('[name="nama_produsen"]').val(result.nama_produsen);
				$('[name="alamat_produsen"]').val(result.alamat_produsen);
				$('[name="produsen_deskripsi"]').val(result.produsen_deskripsi);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}


	function hapus(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax({
				url: "<?php echo site_url('Produsen/ajax_delete') ?>/" + id,
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
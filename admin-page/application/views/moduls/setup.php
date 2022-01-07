<?php $title = "<i class='fa fa-cogs'></i>&nbsp;Setup Content"; ?>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url(); ?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
	<section class="content">
		<div class="page-header">
			<h1>
				<?php echo $title; ?>
			</h1>
		</div>
		<div class="tabbable">
			<ul class="nav nav-tabs" id="formAksi">
				<!-- <li class="active">
			<a data-toggle="tab" href="#home">
			<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
				Gambar Wisata
			</a>
		</li> -->

				<li class="active">
					<a data-toggle="tab" href="#header">
						<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
						Gambar Header
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#link">
						<i class="green ace-icon fa fa-link bigger-120"></i>
						Link
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#sekilas">
						<i class="green ace-icon fa fa-newspaper-o bigger-120"></i>
						Sekilas info & Lain-Lain
					</a>
				</li>


			</ul>

			<div class="tab-content">
				<!-- <div id="home" class="tab-pane fade in active">
					<form action="#" id="formAksine" name="formAksine" class="form-horizontal" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Wisata 1 </label>
							<div class="col-sm-6">
								<select name="a1" id="wisata_id" class="form-control">
									<option>--Pilih Wisata--</option>
									<?php
									//$wisata = $this->db->get('wisata')->result();
									//foreach($wisata as $row_kat)	{	
									?>
									<option value="<?php //echo $row_kat->wisata_id
													?>"><?php //echo $row_kat->wisata_nama
																						?></option>
									<?php //} 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Wisata 2 </label>
							<div class="col-sm-6">
								<select name="a2" id="wisata_id2" class="form-control">
									<option>--Pilih Wisata--</option>
									<?php
									//$wisata = $this->db->get('wisata')->result();
									//foreach($wisata as $row_kat)	{	
									?>
									<option value="<?php //echo $row_kat->wisata_id
													?>"><?php //echo $row_kat->wisata_nama
																						?></option>
									<?php //} 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Wisata 3 </label>
							<div class="col-sm-6">
								<select name="a3" id="wisata_id3" class="form-control">
									<option>--Pilih Wisata--</option>
									<?php
									//$wisata = $this->db->get('wisata')->result();
									//foreach($wisata as $row_kat)	{	
									?>
									<option value="<?php //echo $row_kat->wisata_id
													?>"><?php //echo $row_kat->wisata_nama
																						?></option>
									<?php //} 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Wisata 4 </label>
							<div class="col-sm-6">
								<select name="a4" id="wisata_id4" class="form-control">
									<option>--Pilih Wisata--</option>
									<?php
									//$wisata = $this->db->get('wisata')->result();
									//foreach($wisata as $row_kat)	{	
									?>
									<option value="<?php //echo $row_kat->wisata_id
													?>"><?php //echo $row_kat->wisata_nama
																						?></option>
									<?php //} 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Wisata 5 </label>
							<div class="col-sm-6">
								<select name="a5" id="wisata_id5" class="form-control">
									<option>--Pilih Wisata--</option>
									<?php //
									//$wisata = $this->db->get('wisata')->result();
									//foreach($wisata as $row_kat)	{	
									?>
									<option value="<?php //echo $row_kat->wisata_id
													?>"><?php //echo $row_kat->wisata_nama
																						?></option>
									<?php //} 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">

							<div class="col-md-offset-2 col-md-9">
								<button class="btn btn-info" type="submit" id="btn_save">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Update
								</button>
							</div>
						</div>
					</form>
				</div> -->

				<div id="header" class="tab-pane fade in active">
					<div class="form-body">
						<form id="form-upload" class="form-horizontal" role="form" action="<?= site_url('Setup/upload') ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label col-md-3">Pilih File</label>
								<div class="input-group col-md-6">
									<input type="file" name="file-upload" id="file-upload" required>
									<span class="help-block"></span>
									<div class="input-group-btn">
										<button type="submit" class="btn btn-primary">Upload</button>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Header Wisata</label>
								<div class="input-group col-md-9">
									<img id="preview-upload" src="#" style="height: 100px;border: 1px solid #DDC; " />
								</div>
							</div>
						</form>
						<form id="form-upload2" class="form-horizontal" role="form" action="<?= site_url('Setup/upload_event') ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label col-md-3">Pilih File</label>
								<div class="input-group col-md-6">
									<input type="file" name="file-upload2" id="file-upload" required>
									<span class="help-block"></span>
									<div class="input-group-btn">
										<button type="submit" class="btn btn-primary">Upload</button>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Header Event</label>
								<div class="input-group col-md-9">
									<img id="preview-upload2" src="#" style="height: 100px;border: 1px solid #DDC; " />
								</div>
							</div>
						</form>
						<form id="form-upload3" class="form-horizontal" role="form" action="<?= site_url('Setup/upload_berita') ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label col-md-3">Pilih File</label>
								<div class="input-group col-md-6">
									<input type="file" name="file-upload3" id="file-upload" required>
									<span class="help-block"></span>
									<div class="input-group-btn">
										<button type="submit" class="btn btn-primary">Upload</button>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Header Berita</label>
								<div class="input-group col-md-9">
									<img id="preview-upload3" src="#" style="height: 100px;border: 1px solid #DDC; " />
								</div>
							</div>
						</form>
						<form id="form-upload4" class="form-horizontal" role="form" action="<?= site_url('Setup/upload_about') ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label col-md-3">Pilih File</label>
								<div class="input-group col-md-6">
									<input type="file" name="file-upload4" id="file-upload" required>
									<span class="help-block"></span>
									<div class="input-group-btn">
										<button type="submit" class="btn btn-primary">Upload</button>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Header About</label>
								<div class="input-group col-md-9">
									<img id="preview-upload4" src="#" style="height: 100px;border: 1px solid #DDC; " />
								</div>
							</div>
						</form>
						<form id="form-upload5" class="form-horizontal" role="form" action="<?= site_url('Setup/upload_kontak') ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label col-md-3">Pilih File</label>
								<div class="input-group col-md-6">
									<input type="file" name="file-upload5" id="file-upload" required>
									<span class="help-block"></span>
									<div class="input-group-btn">
										<button type="submit" class="btn btn-primary">Upload</button>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Header Kontak</label>
								<div class="input-group col-md-9">
									<img id="preview-upload5" src="#" style="height: 100px;border: 1px solid #DDC; " />
								</div>
							</div>
						</form>
					</div>



				</div>

				<div id="link" class="tab-pane fade">
					<form id="formAksi" class="form-horizontal" role="form" action="#" method="POST">
						<input type="hidden" name="faspen_id" />
						<div class="form-body">
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> FaceBook </label>
								<div class="col-sm-10">
									<input type="text" id="facebook" name="facebook" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Twitter </label>
								<div class="col-sm-10">
									<input type="text" id="twitter" name="twitter" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Istagram </label>
								<div class="col-sm-10">
									<input type="text" id="instagram" name="instagram" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Youtube </label>
								<div class="col-sm-10">
									<input type="text" id="youtube" name="youtube" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">

								<div class="col-md-offset-2 col-md-9">
									<button class="btn btn-info" type="submit" id="btn_save" onclick="save()">
										<i class="ace-icon fa fa-check bigger-110"></i>
										Update
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>

				<div id="sekilas" class="tab-pane fade">
					<form id="formAksi2" class="form-horizontal" role="form" action="#" method="POST">
						<div class="form-group">

							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Sekilas Pandang </label>
							<div class="col-sm-6">
								<textarea class="form-control" id="sekilas_info" name="sekilas_info"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jumlah Wisata </label>
							<div class="col-sm-10">
								<input type="text" id="judul" name="judul" class="col-xs-10 col-sm-5" />
							</div>
						</div>
						<div class="form-group">

							<div class="col-md-offset-2 col-md-9">
								<button class="btn btn-info" type="submit" id="btn_save">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Update
								</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>

</div>
</section>

<script type="text/javascript">
	var zonk = '';
	var link = "<?php echo site_url('Setup') ?>";
	$(document).ready(function() {
		ubah();
	});

	function data() {
		$('#data').fadeIn();
	}

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
						swal_berhasil();
						ubah();

					} else {
						swal_berhasil();
						ubah();
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

	$(document).ready(function() {
		$('#form-upload2').submit(function(e) {
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
						swal_berhasil();
						ubah();

					} else {
						swal_berhasil();
						ubah();
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
					$('#preview-upload2').attr('src', e.target.result);
				};
				rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload2").change(function() {
			readURL(this);
		});
	});

	$(document).ready(function() {
		$('#form-upload3').submit(function(e) {
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
						swal_berhasil();
						ubah();

					} else {
						swal_berhasil();
						ubah();
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
					$('#preview-upload3').attr('src', e.target.result);
				};
				rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload3").change(function() {
			readURL(this);
		});
	});

	$(document).ready(function() {
		$('#form-upload4').submit(function(e) {
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
						swal_berhasil();
						ubah();

					} else {
						swal_berhasil();
						ubah();
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
					$('#preview-upload4').attr('src', e.target.result);
				};
				rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload4").change(function() {
			readURL(this);
		});
	});

	$(document).ready(function() {
		$('#form-upload5').submit(function(e) {
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
						swal_berhasil();
						ubah();

					} else {
						swal_berhasil();
						ubah();
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
					$('#preview-upload5').attr('src', e.target.result);
				};
				rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload5").change(function() {
			readURL(this);
		});
	});

	$(document).ready(function() {
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

	function ubah() {
		var link_sub = '<?php echo $this->session->userdata('current_language') == 'english' ?>';
		if (link_sub) {
			link_edit = "ajax_edit_en";
		} else {
			link_edit = "ajax_edit";
		}
		$.ajax({
			url: link + "/" + link_edit + "/",
			type: "GET",
			dataType: "JSON",
			success: function(result) {
				var img = '<?= base_url(); ?>../assets/images/img/' + result.set_wisata12;
				var img2 = '<?= base_url(); ?>../assets/images/img/' + result.set_wisata13;
				var img3 = '<?= base_url(); ?>../assets/images/img/' + result.set_wisata14;
				var img4 = '<?= base_url(); ?>../assets/images/img/' + result.set_wisata15;
				var img5 = '<?= base_url(); ?>../assets/images/img/' + result.set_wisata16;
				$("#wisata_id").val(result.set_wisata1);
				$("#wisata_id2").val(result.set_wisata2);
				$("#wisata_id3").val(result.set_wisata3);
				$("#wisata_id4").val(result.set_wisata4);
				$("#wisata_id5").val(result.set_wisata5);
				$("input[name='facebook']").val(result.set_wisata6);
				$("input[name='twitter']").val(result.set_wisata7);
				$("input[name='instagram']").val(result.set_wisata8);
				$("input[name='youtube']").val(result.set_wisata9);
				$("#sekilas_info").val(result.set_wisata10);
				$("input[name='judul']").val(result.set_wisata11);
				$('#preview-upload').attr('src', img);
				$('#preview-upload2').attr('src', img2);
				$('#preview-upload3').attr('src', img3);
				$('#preview-upload4').attr('src', img4);
				$('#preview-upload5').attr('src', img5);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	$(document).on('submit', '#formAksi', function(e) {
		tinyMCE.triggerSave();
		e.preventDefault();
		var link_sub = '<?php echo $this->session->userdata('current_language') == 'english' ?>';
		if (link_sub) {
			link_edit = "update_link_en";
		} else {
			link_edit = "update_link";
		}
		$.ajax({
			url: link + "/" + link_edit + "/",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				swal_berhasil();
				ubah();
				//$('#a7').val();  
				setTimeout(function() {
					$('#btn_save').text('Ubah');
					$('#btn_save').attr('disabled', false);
					//document.getElementById('formAksi').reset();
				}, 1000);

			}
		});
		return false;
	});

	$(document).on('submit', '#formAksi2', function(e) {
		tinyMCE.triggerSave();
		e.preventDefault();
		var link_sub = '<?php echo $this->session->userdata('current_language') == 'english' ?>';
		if (link_sub) {
			link_edit = "update_sekilas_en";
		} else {
			link_edit = "update_sekilas";
		}
		$.ajax({
			url: link + "/" + link_edit + "/",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				swal_berhasil();
				ubah();
				//$('#a7').val();  
				setTimeout(function() {
					$('#btn_save').text('Update Berhasil');
					$('#btn_save').attr('disabled', false);
					//document.getElementById('formAksi').reset();
				}, 1000);

			}
		});
		return false;
	});

	$(document).on('submit', '#formAksine', function(e) {
		tinyMCE.triggerSave();
		e.preventDefault();
		var link_sub = '<?php echo $this->session->userdata('current_language') == 'english' ?>';
		if (link_sub) {
			link_edit = "update_wisata_en";
		} else {
			link_edit = "update_wisata";
		}
		$.ajax({
			url: link + "/" + link_edit + "/",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				swal_berhasil();
				ubah();
				//$('#a7').val();  
				setTimeout(function() {
					$('#btn_save').text('Update Berhasil');
					$('#btn_save').attr('disabled', false);
					//document.getElementById('formAksi').reset();
				}, 1000);

			}
		});
		return false;
	});
</script>
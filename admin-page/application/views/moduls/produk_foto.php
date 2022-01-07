<?php $title = "<i class='fa fa-file-image-o'></i>&nbsp;Foto oleh-oleh"; ?>
<?php $key = $this->uri->segment(2); $key2 = $this->uri->segment(4); ?>

<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<div class="page-header">
	<h1>
		<?php echo $title;?>
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
	<button class="btn btn-danger" onclick="Tambah()"><i class="fa fa-plus"></i> Tambah</button>
	<button class="btn btn-primary" onclick="goBack()"><i class="fa fa-arrows-h"></i> Back</button>
</div><br />
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
			<th>Nama Oleh-oleh</th>
            <th>Foto</th>
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

<div class="row">
<div class="col-xs-12">
<div id="form-data" style="display:none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Form Foto</h4>

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
<style type="text/css"> #loader{display: none} #preview{display: none}</style>
<form id="form-add" class="form-horizontal" action="<?= site_url('Berfoto_produk/ajax_add')?>" method="POST" role="form" enctype="multipart/form-data">
<!-- <form class="form-horizontal" action="<?= site_url('Berfoto/ajax_add')?>" method="POST" role="form" enctype="multipart/form-data"> -->
	<input type="hidden" name="id_produk" value="<?php echo @$key2?>">
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gambar </label>
		<div class="col-sm-10">
			<input type="file" name="userfile" id="userfile" required>
			<span class="help-block"></span>
			<img id="loader" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>
	<div class="col-md-offset-2 col-md-9">
		<input type="submit" value="Add" id="btnSave" class="btn btn-primary">
		<!-- <input type="submit" value="Add" class="btn btn-primary"> -->
	</div>
</form>
</div>
</div>
</div>					
</div><!-- /.row -->
</div>
</div><!-- /.row -->
</div>

<div class="row">
<div class="col-xs-12">
<div id="form-update" style="display:none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Form Update Foto</h4>

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
<style type="text/css"> #loader-upload{display: none}</style>
<form id="form-upload" class="form-horizontal" role="form" action="<?= site_url('Berfoto_produk/upload')?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="id_foto"/> 
	<div class="form-body">
			<div class="form-group" >
			<label class="control-label col-md-3">Pilih File</label>
			<div class="input-group col-md-6">
				<input type="file" name="file-upload" id="file-upload">
				<span class="help-block"></span>
				<div class="input-group-btn">
					<button type="submit" class="btn btn-primary">Upload</button>
				</div>
			</div>
			</div>
			<div class="form-group" >
				<label class="control-label col-md-3">Preview</label>
					<div class="input-group col-md-9">
						<img id="loader-upload" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
						<img id="preview-upload" src="#" style="height: 100px;border: 1px solid #DDC; " />
					</div>
			</div>
	</div>
</form>
</div>
</div>
</div>					
</div><!-- /.row -->
</div>
</div><!-- /.row -->
</div>

<script type="text/javascript">
	var zonk =''
	var save_method;
	var table;
	var link = "<?php echo site_url('Berfoto_produk')?>";
	var kdFoto = "<?php echo @$key2;?>";
	var kdWis = "<?php echo @$key;?>";
	
	function goBack() {
		window.history.back();
	}
	
	$(document).ready(function(){
	$('#form-add').submit(function(e) {
		tinyMCE.triggerSave();
		e.preventDefault(); var formData = new FormData($(this)[0]);
		$.ajax({
			url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
			beforeSend: function() { $('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true); },
			success: function(response) {
				if(response.status) { Batal(); reload_table(); swal_berhasil();
				} else { Batal(); reload_table(); swal_error(response.error); }
			},
			complete: function() { $('#btnSave').text('save'); $('#btnSave').attr('disabled',false); },
			cache: false, contentType: false, processData: false
		});
		return false;
	});
	
	function readURL(input) {
		$("#preview").show();
		if (input.files && input.files[0]) {
			var rd = new FileReader(); 
			rd.onload = function (e) { $('#preview').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
		}
	}
	$("#userfile").change(function(){ readURL(this); });

	});
	
	$(document).ready(function(){
		$('#form-upload').submit(function(e) {
			tinyMCE.triggerSave();
			e.preventDefault(); var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
				beforeSend: function() { $('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true); },
				success: function(response) {
					if(response.status) { Batal2(); reload_table(); swal_berhasil();
					} else { Batal2(); reload_table(); swal_error(response.error); }
				},
				complete: function() { $('#btnSave').text('save'); $('#btnSave').attr('disabled',false); },
				cache: false, contentType: false, processData: false
			});
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload").change(function(){ readURL(this); });
	});
	
	function reload_table() {
    	table.ajax.reload(null, false);
	}
	
	$(document).ready(function(){
      //$('#idImgLoader').show(2000);
	  $('#idImgLoader').fadeOut(2000);
	  setTimeout(function(){
            data();
      }, 2000);
	  
    });
	
	function data(){
		$('#data').fadeIn();
	}
	
	$(document).ready(function() {
	  table = $('#dynamic-table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy": true,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": link+"/ajax_listid/"+kdFoto,
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
	
	}).fnDestroy();
	
	function Tambah() {
		$('.form-group').removeClass('has-error');
		$('.help-block').empty(); 
		save_method = 'add'; 
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow'); 
		$('[name="userfile"]').val(zonk);
		
	}
	
	function Batal() { 
		$('#form-data').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function Batal2() { 
		$('#form-update').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function edit(id) {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-update').fadeIn('slow');
			//document.getElementById('formAksi').reset();
			$.ajax({
				url : link+"/ajax_edit/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
				var img = '<?= base_url(); ?>../uploads/foto_produk/'+result.url_foto;
				$('[name="id_foto"]').val(result.id_foto);
				$('#preview-upload').attr('src', img);

				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}
	
	function hapus(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax ({
				url : "<?php echo site_url('Berfoto_produk/ajax_delete')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					setTimeout(function(){
                        Batal();
                    }, 1000);
					
					setTimeout(function(){
                        reload_table();
					}, 1000);
					swal_berhasil(); 
				}, error: function (jqXHR, textStatus, errorThrown) {
					swal({ title:"ERROR", text:"Error delete data", type: "warning", closeOnConfirm: true}); 
					$('#btnSave').text('save'); $('#btnSave').attr('disabled',false); 
				}
			});
		}
	}
</script>	
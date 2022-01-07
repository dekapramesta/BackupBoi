<?php $title = "<i class='fa fa-binoculars'></i>&nbsp;Fasilitas Wisata"; ?>
<div class='alert alert-success' id='berhasil' style='display: none;'>Proses Berhasil</div>
<div class='alert alert-danger' id='gagal' style='display: none;'>Proses Gagal</div>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<section class="content">
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
	<button class="btn btn-danger" onclick="Tambah()"><i class="fa fa-plus"></i> Tambah Data</button>
</div><br />
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
			<th>Gambar</th>
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

<div class="row">
<div class="col-xs-12">
<div id="form-data" style="display:none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Form Fasilitas Wisata</h4>

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
<style type="text/css"> #loader{display: none} #preview{display: none}</style>
<form id="form-add" class="form-horizontal" action="<?= site_url('Fasilitas_wisata/ajax_add')?>" method="POST" role="form" enctype="multipart/form-data">
	
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama </label>
		<div class="col-sm-10">
			<input type="hidden" id="faswis_id" name="faswis_id" placeholder="Judul" class="col-xs-10 col-sm-5" />
			<input type="text" id="faswis_nama" name="faswis_nama" placeholder="Judul" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gambar </label>
		<div class="col-sm-10">
			<input type="file" name="userfile" id="userfile">
			<span class="help-block"></span>
			<img id="loader" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
		</div>
	</div>
	<div class="form-group" >
				<label class="control-label col-md-3">Preview</label>
					<div class="input-group col-md-9">
						<img id="preview-upload" src="#" style="height: 100px;border: 1px solid #DDC; " />
					</div>
			</div>
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
			
<script>
	var zonk='';
	var save_method;
	var link = "<?php echo site_url('Fasilitas_wisata')?>";
	var table;
	
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
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload").change(function(){ readURL(this); });

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
	
	function save() {
		var url;
		url = "<?= site_url()?>Slider/update/";
		tinyMCE.triggerSave();
		$('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true);
		$.ajax({
			url : url, type: "POST", dataType: "JSON", data: $('#form').serialize(),
			success: function(data) {
				if(data.status) {  Batal2(); reload_table(); swal_berhasil(); 
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
					}
				}
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false); 
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal({ title:"ERROR", text:"Error adding / update data", type: "warning", closeOnConfirm: true}); 
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false);  
			}
		});
	}
	
	function update(id) {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-data').fadeIn('slow');
			var link_sub = '<?php echo $this->session->userdata('current_language')=='english'?>';
			if(link_sub){
				link_edit = "ajax_edit_en";
			}else{
				link_edit = "ajax_edit";
			}
			$.ajax({
				url : link+"/"+link_edit+"/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
				var img = '<?= base_url(); ?>../uploads/fasilitas_wisata/'+result.faswis_icon;
				$('[name="faswis_id"]').val(result.faswis_id);
				$('[name="faswis_nama"]').val(result.faswis_nama);
				$('#preview-upload').attr('src', img);
				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}
	
	$(document).ready(function(){
      //$('#idImgLoader').show(2000);
	  $('#idImgLoader').fadeOut(2000);
	  setTimeout(function(){
            data();
      }, 2000);
	  setTimeout(function(){
            ckeditor();
      }, 2000);
    });
	
	function ckeditor(){
		tinymce.init({
			selector: "textarea"
		});
	}
	
	function data(){
		$('#data').fadeIn();
	}
	
	var link_sub = '<?php echo $this->session->userdata('current_language')=='english'?>';
	$(document).ready(function() {
		if(link_sub){
			fasilitas_wisata_en();
		}else{
			fasilitas_wisata();
		}
	
	}).fnDestroy();

	function fasilitas_wisata(){
		table = $('#dynamic-table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy": true,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Fasilitas_wisata/ajax_list')?>",
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
	}

	function fasilitas_wisata_en(){
		table = $('#dynamic-table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy": true,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Fasilitas_wisata/ajax_list_en')?>",
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
	}
	
	$(document).ready(function() {
		$("input").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
		$("textarea").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
		$("select").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
	});
	
	function Tambah() {
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

	$(function() {
		var oTable1 = $('#dynamic-table').dataTable( {
		"aoColumns": [,
			 null, null, null, null, null,
		] } );
				
				
		$('table th input:checkbox').on('click' , function(){
			var that = this;
			$(this).closest('table').find('tr > td:first-child input:checkbox')
				.each(function(){
					this.checked = that.checked;
					$(this).closest('tr').toggleClass('selected');
				});
						
			});
			
			
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
			function tooltip_placement(context, source) {
				var $source = $(source);
				var $parent = $source.closest('table')
				var off1 = $parent.offset();
				var w1 = $parent.width();
			
				var off2 = $source.offset();
				var w2 = $source.width();
			
				if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
				return 'left';
		}
	})
			
	//$('#dynamic-table').dataTable( {
		//paging: false,
		//searching: false
	//} );	
		
	function reload_table() {
		table.ajax.reload(null, false);
	}

	function Batal() { 
		$('#form-data').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function Batal2() { 
		$('#form-update').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function hapus(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax ({
				url : "<?php echo site_url('Fasilitas_wisata/ajax_delete')?>/"+id,
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



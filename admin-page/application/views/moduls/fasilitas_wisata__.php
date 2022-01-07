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
			<th>Icon</th>
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
<form class="form-horizontal" role="form" id="formAksi">
<input type="hidden" id="faswis_id" name="faswis_id" placeholder="Judul" class="col-xs-10 col-sm-5" />
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama </label>
		<div class="col-sm-10">
			<input type="text" id="faswis_nama" name="faswis_nama" placeholder="Judul" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Icon </label>
		<div class="col-sm-10">
			<input type="text" id="faswis_icon" name="faswis_icon" placeholder="Icon" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
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
			
<script>
	var zonk='';
	var save_method;
	var link = "<?php echo site_url('Fasilitas_wisata')?>";
	var table;
	
	function update(id) {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-data').fadeIn('slow');
			//document.getElementById('formAksi').reset();
			$.ajax({
				url : link+"/ajax_edit/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
				$('[name="faswis_id"]').val(result.faswis_id);
				$('[name="faswis_nama"]').val(result.faswis_nama);
				$('[name="faswis_icon"]').val(result.faswis_icon);

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
	
	$(document).ready(function() {
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
	
	}).fnDestroy();
	
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
	
	function save() {
			$('#btn_save').text('Saving...');
			$('#btn_save').attr('disabled', true);

			var url;
			if (save_method == 'add') {
				url = link+"/ajax_add";
			} else {
				url = link+"/ajax_update"; 
			}
			
			tinyMCE.triggerSave();
			$.ajax({
				url: url,
				type: "POST",
				data: $('#formAksi').serialize(),
				dataType: "JSON",
				success: function(result) {
					if (result.status) {
						
							setTimeout(function(){
								Batal();
							}, 1000);
						
						setTimeout(function(){
							reload_table();
						}, 1000);
					}
					setTimeout(function(){
						$('#btn_save').text('Save');
						$('#btn_save').attr('disabled', false);
						document.getElementById('formAksi').reset();
					}, 1000);
					swal_berhasil(); 
					setTimeout(function(){
							reload_table();
					}, 1000);
				}, error: function(jqXHR, textStatus, errorThrown) {
					// alert('Error adding/update data');
					swal({ title:"ERROR", text:"Error adding / update data", type: "warning", closeOnConfirm: true}); 
					$('#btnSave').text('save'); $('#btnSave').attr('disabled',false);  
				}
			});
	}
	
</script>



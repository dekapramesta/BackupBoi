<div id="panel-data">
<div class="row">
<div class="col-xs-12">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Pendapatan</h4>

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
<div class="box-header">
	<button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
	<button class="btn btn-danger" onclick="Tambah()"><i class="fa fa-plus"></i> Tambah Data</button>
</div><br />
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Info Tahun</th>
            <th>Info Wisatawan Lokal</th>
			<th>Info Wisatawan Internasional</th>
			<th>Info Pendapatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    var save_method;
    var table;
    var link = "<?php echo site_url('Pendapatan')?>";
	
	$(document).ready(function() {
		table = $('#dynamic-table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy": true,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url":  link+"/ajax_list/",
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
	
	function reload_table() {
		table.ajax.reload(null, false);
	}
	
	function Batal() { 
		$('#form-data').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function Tambah() {
		save_method = 'add'; 
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow'); 
		document.getElementById('formAksi').reset();
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
	
	function edit(id) {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-data').fadeIn('slow');
			document.getElementById('formAksi').reset();
			$.ajax({
				url : link+"/ajax_edit/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
					//document.getElementById('fc_kdbahan').setAttribute('readonly','readonly');
					$('[name="info_tahun"]').val(result.info_tahun);
					$('[name="info_jum_lokal"]').val(result.info_jum_lokal);
					$('[name="info_jum_manca"]').val(result.info_jum_manca);
					$('[name="info_pendapatan"]').val(result.info_pendapatan);
					document.getElementById('info_tahun').setAttribute('readonly','readonly');

				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}
	
	function hapus(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax ({
				url : "<?php echo site_url('Pendapatan/ajax_delete')?>/"+id,
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

<div class="row">
<div class="col-xs-12">
<div id="form-data" style="display:none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Form Info</h4>

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
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Info Tahun</label>
		<div class="col-sm-10">
			<input type="text" id="info_tahun" name="info_tahun" placeholder="Info Tahun" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Info Jumlah Lokal </label>
		<div class="col-sm-10">
			<input type="text" id="info_jum_lokal" name="info_jum_lokal" placeholder="Info Jumlah Lokal" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Info Jumlah Manca </label>
		<div class="col-sm-10">
			<input type="text" id="info_jum_manca" name="info_jum_manca" placeholder="Info Jumlah Manca " class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Info Pendapatan </label>
		<div class="col-sm-10">
			<input type="text" id="info_pendapatan" name="info_pendapatan" placeholder="Info Pendapatan " class="col-xs-10 col-sm-5" />
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
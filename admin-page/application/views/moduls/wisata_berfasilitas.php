<?php $title = "<i class='fa fa-file-image-o'></i>&nbsp;Wisata Berfasilitas"; ?>
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

<div class="widget-box">
<div class="widget-body">
<div class="widget-main">
<div class="row">
<div class="col-xs-12">
<form class="form-horizontal" role="form" id="formAksi">
<input type="hidden" name="wisata_id" value="<?php echo $key2;?>"/> 
<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Fasilitas Wisata </label>
		<div class="col-sm-10">
			<select name="faswis_id" id="faswis_id" class="form-control">
			<option>--Pilih Fasilitas--</option>
			<?php 
			if($this->session->userdata('current_language')=='english'){
				$fasilitas = $this->db2->get('fasilitas_wisata')->result();
			}else{
				$fasilitas = $this->db->get('fasilitas_wisata')->result();
			}	
			foreach($fasilitas as $row_kat)	{	?>
				<option value="<?php echo $row_kat->faswis_id?>"><?php echo $row_kat->faswis_nama?></option>
			<?php } ?>
			</select>
		</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status </label>
		<div class="col-sm-10">
			<select name="wistas_status" id="wistas_status" class="form-control">
			<option>--Pilih Status--</option>
			<option value="Y">Y</option>
			<option value="N">N</option>
			</select>
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
</div><!-- /.span -->
</div>					
</div><!-- /.row -->
</div>
</div>
<br /><br />

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
	<button class="btn btn-primary" onclick="goBack()"><i class="fa fa-arrows-h"></i> Back</button>
</div><br />
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Fasilitas Wisata</th>
            <th>Status</th>
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

<script type="text/javascript">
	var zonk =''
	var save_method;
	var table;
	var link = "<?php echo site_url('Berfasilitas')?>";
	var kdFas = "<?php echo @$key2;?>";
	var kdWis = "<?php echo @$key;?>";
	
	function goBack() {
		window.history.back();
	}
	
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
	
	var link_sub = '<?php echo $this->session->userdata('current_language')=='english'?>';
	$(document).ready(function() {
		if(link_sub){
			berfasilitas_en();
		}else{
			berfasilitas();
		}
	
	}).fnDestroy();
	
	function berfasilitas(){
		table = $('#dynamic-table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy": true,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": link+"/ajax_listid/"+kdFas,
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

	function berfasilitas_en(){
		table = $('#dynamic-table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy": true,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": link+"/ajax_listid_en/"+kdFas,
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
	
	function save() {
			$('#btn_save').text('Saving...');
			$('#btn_save').attr('disabled', true);

			var url;
			
			url = link+"/ajax_add";

			$.ajax({
				url: url,
				type: "POST",
				data: $('#formAksi').serialize(),
				dataType: "JSON",
				success: function(result) {
					if (result.status) {
						
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
	
	function hapus(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax ({
				url : "<?php echo site_url('Berfasilitas/ajax_delete')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data) {
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
	
	function edit(id) {
		save_method = 'update';
		$('#form')[0].reset();
		var link_sub = '<?php echo $this->session->userdata('current_language')=='english'?>';
			if(link_sub){
				link_edit = "ajax_edit_fas_en";
			}else{
				link_edit = "ajax_edit_fas";
			}
		$.ajax({
			url : link+"/"+link_edit+"/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(result) {
				$('[name="wistas_id"]').val(result.wistas_id);
				$('[name="wistas_status"]').val(result.wistas_status);
				$('#modal-table').modal('show');
				//$('.modal-title').text('Edit Jenjang');
			}, error: function (jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}
	
	function simpan() {
			$('#btn_save').text('Saving...');
			$('#btn_save').attr('disabled', true);

			var url;
			
			url = link+"/ajax_update";

			$.ajax({
				url: url,
				type: "POST",
				data: $('#form').serialize(),
				dataType: "JSON",
				success: function(result) {
					if (result.status) {
						
						setTimeout(function(){
							$('#btn_close').click();
						}, 1000);
						
						setTimeout(function(){
							reload_table();
						}, 1000);
					}
					setTimeout(function(){
						$('#btn_save').text('Save');
						$('#btn_save').attr('disabled', false);
						document.getElementById('form').reset();
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

<div id="modal-table" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header no-padding">
									<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									Status
									</div>
								</div>

								<div class="modal-body no-padding">
								<div align="center">
								<form id="form" class="form-horizontal"><br />
								<input type="hidden" value="" name="wistas_id"> 
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status </label>
										<div class="col-sm-6">
											<select name="wistas_status" id="wistas_status" class="form-control">
											<option>--Pilih Status--</option>
											<option value="Y">Y</option>
											<option value="N">N</option>
											</select>
										</div>
								</div><br />
								<div class="form-group no-padding-right">
									<button class="btn btn-info" type="button" id="btn_save" onclick="simpan()">
										<i class="ace-icon fa fa-pencil bigger-110"></i>
										Ubah
									</button>
									<button type="button" id="btn_close" class="btn btn-default hide" data-dismiss="modal">Close</button>
								</div>
								</form>
								</div>		
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
</div>	


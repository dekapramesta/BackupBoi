<?php $title = "<i class='fa fa-book'></i>&nbsp;Kontak"; ?>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<section class="content">
<div class="page-header">
	<h1>
		<?php echo $title;?>
	</h1>
</div>
<div class="row">
<div class="col-xs-12">
<div id="form-data" style="display:none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Form Kontak</h4>

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
	 <input type="hidden" name="id_kontak">
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kontak Latitude </label>
		<div class="col-sm-10">
			<input type="text" id="kontak_lat" name="kontak_lat" placeholder="Kontak Latitude" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kontak Longtitude </label>
		<div class="col-sm-10">
			<input type="text" id="kontak_long" name="kontak_long" placeholder="Kontak Longtitude" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kontak Judul </label>
		<div class="col-sm-10">
			<input type="text" id="kontak_judul" name="kontak_judul" placeholder="Kontak judul" class="col-xs-10 col-sm-5" required oninvalid="this.setCustomValidity('Field kontak harus diisi')" oninput="this.setCustomValidity('')"/>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kontak Deskripsi </label>
		<div class="col-sm-6">
			<textarea class="form-control" id="kontak_deskripsi" name="kontak_deskripsi" placeholder="Kontak Deskripsi" class="col-xs-10 col-sm-5"></textarea>
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
</div>

<script>
	var save_method;
	var link = "<?php echo site_url('Kontak')?>";
	var table;
	
	$(document).ready(function(){
		
			edit();
		
    });

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
	
	function Batal() { 
		$('#form-data').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function save() {
			$('#btn_save').text('Saving...');
			$('#btn_save').attr('disabled', true);

			var link_sub = '<?php echo $this->session->userdata('current_language')=='english'?>';
			if (link_sub){
				url = link+"/ajax_update_en";
			}else{	
				url = link+"/ajax_update";
			}	
			tinyMCE.triggerSave();	
			$.ajax({
				url: url,
				type: "POST",
				data: $('#formAksi').serialize(),
				dataType: "JSON",
				success: function(result) {
					setTimeout(function(){
						$('#btn_save').text('Save');
						$('#btn_save').attr('disabled', false);
					}, 1000);
					swal_berhasil(); 
					
					var link_sub = '<?php echo $this->session->userdata('current_language')=='english'?>';
					if (link_sub){
						edite();
					}else{
						edit();
					}
				}, error: function(jqXHR, textStatus, errorThrown) {
					// alert('Error adding/update data');
					swal({ title:"ERROR", text:"Error adding / update data", type: "warning", closeOnConfirm: true}); 
					$('#btnSave').text('save'); $('#btnSave').attr('disabled',false);  
				}
			});
	}
	
	function edit() {
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
				url : link+"/"+link_edit+"/",
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
					//document.getElementById('fc_kdbahan').setAttribute('readonly','readonly');
					$('[name="id_kontak"]').val(result.id_kontak);
					$('[name="kontak_lat"]').val(result.kontak_lat);
					$('[name="kontak_long"]').val(result.kontak_long);
					$('[name="kontak_deskripsi"]').val(result.kontak_deskripsi);
					$('[name="kontak_judul"]').val(result.kontak_judul);

				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}
	
</script>


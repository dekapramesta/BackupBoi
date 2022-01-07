<div class="row">
<div class="col-xs-12">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Grafik Wisatawan</h4>

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
	<div class="form-group">
			<label class="col-sm-2 control-label">Pilih Wisatawan</label>
				<div class="col-sm-4">
					<select name="turis" id="turis" class="form-control">
						<option>--Wisatawan--</option>
							<option value="0">Lokal</option>
							<option value="1">Internasional</option>
								
					</select>
				</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<span id="admin"></span>

<script>
$(function(){ // sama dengan $(document).ready(function(){

		$('#turis').change(function(){


			$('#admin').html("<img style='display: block; margin: 0 auto; text-align: center; ' src='<?php echo base_url();?>assets/images/loader-dark.gif'>"); //Menampilkan loading selama proses pengambilan data kota

			var id = $(this).val(); //Mengambil id provinsi
                      
			$.get("<?php echo base_url('Grafik/create_load'); ?>", {id:id}, function(data){
				$('#admin').html(data);
			});
      //setTimeout(function(){
              //$("#example1").dataTable();
      //}, 3000);
		});

});
</script>
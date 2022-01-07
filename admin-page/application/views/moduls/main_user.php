<div class="row">
<div class="col-xs-12">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Pilih User</h4>

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
			<label class="col-sm-2 control-label">Pilih User</label>
				<div class="col-sm-4">
					<select name="user" id="user" class="form-control">
						<option>--User--</option>
							<?php $user = $this->db->get('user_type')->result();?>
							<?php foreach($user as $row_kat)	{	?>
								<option value="<?php echo $row_kat->user_type_id?>"><?php echo $row_kat->user_type_name?></option>
									<?php } ?>
					</select>
				</div>
				 <div class="btn-group">
				  <button type="button" class="btn btn-danger"><i class="glyph-icon icon-plus"></i>&nbsp;Pilih Menu</button>
				  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
					  <span class="caret"></span>
					  <span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
					  <li><a href="#" onclick="Tambah()">Mainmenu</a></li>
					  <li><a href="#" onclick="Tambah2()">Submenu</a></li>
				  </ul>
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

<div class="row" id="form-data" style="display: none;">
<div class="row">
<div class="col-xs-12">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Tambah Akses Mainmenu</h4>

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
	 <form class="form-horizontal bordered-row" id="formAksi2">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                            <th>User</th>
                            <th>Menu</th>
                            <th>Read</th>
                            <th>Action</th>
                      </tr>     
                    </thead>
                    <tbody>
                      <tr>
                          <td><div class="col-md-12">
                             <select name="a1" id="a1" value="" class="form-control">
                               <option value="">-Pilih User-</option>
                                   <?php
                                        $get_user = $this->db->get('user_type');
                                             foreach ($get_user->result() as $row) {
                                             ?>
                                                <option value="<?php echo $row->user_type_id;?>"><?php echo $row->user_type_name;?></option>
                                    <?php }?>
                            </select>
                            </div></td>
                           <td><div class="col-md-12">
                             <select name="a2" id="a2" value="" class="form-control">
                               <option value="">-Pilih Menu-</option>
                                   <?php
                                        $get_user = $this->db->get('mainmenu');
                                             foreach ($get_user->result() as $row) {
                                             ?>
                                                <option value="<?php echo $row->idmenu;?>"><?php echo $row->nama_menu;?></option>
                                    <?php }?>
                            </select>
                           </div></td>>
                           <td><div class="col-md-3">
                              <input type="checkbox" name="a6" id="a6" value="1"><span class='lbl'></span>
                           </div></td>
                           <td><div class="col-sm-6">
                                <button type="button" id="btn_save" onclick="save2()" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div></td>  
                      </tr>
                </table>
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="row" id="form" style="display: none;">
<div class="row">
<div class="col-xs-12">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Tambah Akses Submenu</h4>

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
	 <form class="form-horizontal bordered-row" id="formAksi">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                            <th>User</th>
                            <th>Submenu</th>
                            <th>Read</th>
                            <th>Action</th>
                      </tr>     
                    </thead>
                    <tbody>
                      <tr>
                          <td><div class="col-md-12">
                             <select name="a1" id="a1" value="" class="form-control">
                               <option value="">-Pilih User-</option>
                                   <?php
                                        $get_user = $this->db->get('user_type');
                                             foreach ($get_user->result() as $row) {
                                             ?>
                                                <option value="<?php echo $row->user_type_id;?>"><?php echo $row->user_type_name;?></option>
                                    <?php }?>
                            </select>
                            </div></td>
                           <td><div class="col-md-12">
                             <select name="a2" id="a2" value="" class="form-control">
                               <option value="">-Pilih Submenu-</option>
                                   <?php
                                        $get_user = $this->db->get('submenu');
                                             foreach ($get_user->result() as $row) {
                                             ?>
                                                <option value="<?php echo $row->id_sub;?>"><?php echo $row->nama_sub;?></option>
                                    <?php }?>
                            </select>
                           </div></td>>
                           <td><div class="col-md-3">
                              <input type="checkbox" name="a6" id="a6" value="1"><span class='lbl'></span>
                           </div></td>
                           <td><div class="col-sm-6">
                                <button type="button" id="btn_save" onclick="save()" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div></td>  
                      </tr>
                </table>
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script>
var link = "<?php echo site_url('User')?>";

$(function(){ // sama dengan $(document).ready(function(){

		$('#user').change(function(){


			$('#admin').html("<img style='display: block; margin: 0 auto; text-align: center; ' src='<?php echo base_url();?>assets/images/loader-dark.gif'>"); //Menampilkan loading selama proses pengambilan data kota

			var id = $(this).val(); //Mengambil id provinsi
                      
			$.get("<?php echo base_url('User/create_load'); ?>", {id:id}, function(data){
				$('#admin').html(data);
			});
      //setTimeout(function(){
              //$("#example1").dataTable();
      //}, 3000);
		});

});

function Tambah() {
        save_method = 'add'; 
        $('#panel-data').fadeOut('slow');
        $('#form-data').fadeIn('slow'); 
        $('#form').fadeOut('slow'); 
        document.getElementById('formAksi2').reset();
}

function Tambah2() {
        save_method = 'add2'; 
        $('#panel-data').fadeOut('slow');
        $('#form').fadeIn('slow'); 
        $('#form-data').fadeOut('slow'); 
        document.getElementById('formAksi').reset();
}

function save2() {

    var url;
    if (save_method == 'add') {
        url = link+"/ajax_add_menu";
    } else {
        url = link+"/ajax_update_menu"; 
    }

    $.ajax({
            url: url,
            type: "POST",
            data: $('#formAksi2').serialize(),
            dataType: "JSON",
            success: function(result) {
                setTimeout(function(){
                    document.getElementById('formAksi2').reset();
                }, 1000);
                swal_berhasil();
				$('#form-data').fadeOut('slow'); 
            }, error: function(jqXHR, textStatus, errorThrown) {
                // alert('Error adding/update data');
                setTimeout(function(){
                    $('#btn_save').text('Save');
                    $('#btn_save').attr('disabled', false);
                }, 1000);
                swal_gagal();
            }
    });    

}  

function save() {

    var url;
    if (save_method == 'add2') {
        url = link+"/ajax_add_sub";
    } else {
        url = link+"/ajax_update_sub"; 
    }

    $.ajax({
            url: url,
            type: "POST",
            data: $('#formAksi').serialize(),
            dataType: "JSON",
            success: function(result) {
                setTimeout(function(){
                    document.getElementById('formAksi').reset();
                }, 1000);
                swal_berhasil();
				$('#form').fadeOut('slow');
            }, error: function(jqXHR, textStatus, errorThrown) {
                // alert('Error adding/update data');
                setTimeout(function(){
                    $('#btn_save').text('Save');
                    $('#btn_save').attr('disabled', false);
                }, 1000);
                swal_gagal();
            }
    });    

}    
</script>
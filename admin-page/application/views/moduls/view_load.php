<?php	
    $id_get = $_GET['id']; 
    $where = array('id_level' => $id_get);
    $join = array('user_type', 'user_type.user_type_id=tab_akses_submenu.id_level');
   	$join = array('submenu','submenu.id_sub=tab_akses_submenu.id_sub_menu');
    $query = $this->db->join($join[0], $join[1])->get_where('tab_akses_submenu', $where);
?>
<div id="frame"> 
<div class="row">
<div class="col-xs-6">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Submenu</h4>

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
 <form method="post" id="formAksi">
      <table id="table_book" class="table table-striped table-bordered">
      <thead>
    <tr>
            <th>No.</th>
            <th>Sub Menu</th>
            <th>Aksi</th>
      </tr>     
      </thead>
      <tbody>
      <tr>
      <?php
           $no=1;
           foreach ($query->result() as $r)
            {
       ?>
           <td><?php echo $no++;?></td> 
           <td><?php echo $r->nama_sub; ?></td>
           <td><a href="javascript:void(0)" onclick="edit(<?php echo $r->id_sub;?>)"><span class="label label-danger"><i class="fa fa-pencil"></i></span></a></td>
           </tr>
           <?php }?>
      </tbody>
      </table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>


<?php
	$id_get = $_GET['id']; 
    $where = array('id_level' => $id_get);
    $join = array('user_type', 'user_type.user_type_id=tab_akses_mainmenu.id_level');
   	$join = array('mainmenu','mainmenu.idmenu=tab_akses_mainmenu.id_menu');
    $data = $this->db->join($join[0], $join[1])->get_where('tab_akses_mainmenu', $where);
?>

<div class="col-xs-6">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Mainmenu</h4>

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
 <form method="post" id="formAksi2">
      <table class="table table-striped table-bordered">
      <thead>
	  <tr>
            <th>No.</th>
            <th>Main menu</th>
            <th>Aksi</th>
      </tr>     
      </thead>
      <tbody>
      <tr>
      <?php
           $no=1;
           foreach ($data->result() as $r)
            {
       ?>
           <td><?php echo $no++;?></td>	
           <td><?php echo $r->nama_menu; ?></td>
           <td><a href="javascript:void(0)" onclick="edit_main(<?php echo $r->idmenu;?>)"><span class="label label-danger"><i class="fa fa-pencil"></i></span></a></td>
           </tr>
           <?php }?>
      </tbody>
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
function edit(id) {
    save_method = 'update';
    $('#frame').fadeOut('slow');
    $('#form-data').fadeIn('slow');

    $.ajax({
      url : "<?php echo site_url('User/ajax_edit_sub')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(result) {
        $('[name="id_sub"]').val(result.id_sub);
        $('[name="id_sub_menu"]').val(result.id_sub_menu);
        $('[name="a1"]').val(result.id_level);
        $('[name="a2"]').val(result.mainmenu_idmenu);
        $('[name="a3"]').val(result.nama_sub);
        $('[name="a4"]').val(result.link_sub);  
          $('#aa5').val(result.r); 
          if(result.r == '1'){
            document.getElementById('aa5').setAttribute('checked','checked');
          }else{
            document.getElementById('aa5').RemoveAttribute('checked');
          }
        $('.modal-title').text('Edit');
      }, error: function (jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }
  
  function save_sub() {

    var url;
    url = "<?php echo site_url('User/ajax_update_sub') ?>";
  
    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_update').serialize(),
      dataType: "JSON",
      success: function(data) {
			swal_berhasil();
      }, error: function(jqXHR, textStatus, errorThrown) {
       swal_berhasil();
      }
    });
  }
  
   function edit_main(id) {
    save_method = 'update2';
    $('#frame').fadeOut('slow');
    $('#form-data2').fadeIn('slow');

    $.ajax({
      url : "<?php echo site_url('User/ajax_edit_main')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(result) {
        $('[name="a1"]').val(result.id_level);
        $('[name="a2"]').val(result.nama_menu);
        $('[name="a3"]').val(result.link_menu);
        $('[name="a4"]').val(result.icon_class);
        $('[name="a5"]').val(result.idmenu);
        $('#a6').val(result.r); 
          if(result.r == '1'){
            document.getElementById('a6').setAttribute('checked','checked');
          }else{
            document.getElementById('a6').RemoveAttribute('checked');
          }
        $('.modal-title').text('Edit');
      }, error: function (jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }
  
  function Batal1() { 
	  $('#form-data').fadeOut('slow');
  }

  function Batal() { 
	  $('#form-data2').fadeOut('slow');
  }
  
  function save_main() {

    var url;

    if (save_method == 'update2') {
      url = "<?php echo site_url('User/ajax_update_main') ?>";
    } else {
      url = "<?php echo site_url('User/ajax_update_main') ?>";
    }

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_update2').serialize(),
      dataType: "JSON",
      success: function(data) {
          swal_berhasil();
      }, error: function(jqXHR, textStatus, errorThrown) {
         swal_berhasil();
      }
    });
  }

</script>

<div class="row" id="form-data" style="display: none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Submenu</h4>

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
		<form class="form-horizontal bordered-row" id="form_update">
            <input type="hidden" value="" name="id_sub"> 
            <input type="hidden" value="" name="id_sub_menu"> 
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                            <th>User</th>
                            <th>Menu</th>
                            <th>Submenu</th>
                            <th>Link</th>
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
                               <option value="">-Menu-</option>
                                   <?php
                                        $get_menu = $this->db->get('mainmenu');
                                             foreach ($get_menu->result() as $row) {
                                             ?>
                                                <option value="<?php echo $row->idmenu;?>"><?php echo $row->nama_menu;?></option>
                                    <?php }?>
                            </select>
                            </div></td>
                           <td><div class="col-md-12">
                              <input type="text" name="a3" placeholder="Submenu" id="a3" class="form-control">
                           </div></td>
                           <td><div class="col-md-12">
                              <input type="text" name="a4" placeholder="Link" id="a4" class="form-control">
                           </div></td>
                           <td><div class="col-md-3">
                              <input type="checkbox" name="aa5" id="aa5" ><span class='lbl'></span>
                           </div></td>
                           <td><div class="col-sm-6">
                                <button type="button" id="btn_save" onclick="save_sub()" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
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

<div class="row" id="form-data2" style="display: none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Mainmenu</h4>

	<div class="widget-toolbar">
		<a href="#" data-action="collapse">
			<i class="ace-icon fa fa-chevron-up"></i>
		</a>

		<a onclick="Batal2()" data-action="close">
			<i class="ace-icon fa fa-times"></i>
		</a>
	</div>
</div>

<div class="widget-body">
<div class="widget-main">
<div class="row">
<div class="col-xs-12">
	<form class="form-horizontal bordered-row" id="form_update2">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                            <th>User</th>
                            <th>Menu</th>
                            <th>Link</th>
                            <th>Icon</th>
                            <th>Id Menu</th>
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
                              <input type="text" name="a2" placeholder="Mainmenu" id="a2" class="form-control">
                           </div></td>
                           <td><div class="col-md-12">
                              <input type="text" name="a3" placeholder="Link" id="a3" class="form-control">
                           </div></td>
                           <td><div class="col-md-12">
                              <input type="text" name="a4" placeholder="Icon" id="a4" class="form-control">
                           </div></td>
                           <td><div class="col-md-6">
                              <input type="text" name="a5" placeholder="Id Menu" id="a5" class="form-control">
                           </div></td>
                           <td><div class="col-md-3">
                              <input type="checkbox" name="a6" id="a6" ><span class='lbl'></span>
                           </div></td>
                           <td><div class="col-sm-6">
                                <button type="button" id="btn_save2" onclick="save_main()" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
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
<?php $user = $this->uri->segment(3);?>
<div class="widget-body">
<div class="widget-main">
<div class="row">
<div class="col-xs-12">
<div class="box-header">
	<button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
	<button class="btn btn-primary" onclick="goBack()"><i class="fa fa-arrows-h"></i> Back</button>
</div><br />
<form method="post" id="formAksi">

<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Check</th>
            <th>Mainmenu</th>
        </tr>
    </thead>
    <tbody></tbody>
</table><br />
<button class="btn btn-danger" type="submit"><i class="fa fa-pencil"></i> Update</button>
</form>
</div><!-- /.span -->

</div>					
</div><!-- /.row -->
</div>


<script type="text/javascript">
	var zonk =''
	var save_method;
	var table;
	var link = "<?php echo site_url('User')?>";
	var kdLevel = "<?php echo @$user;?>";
	
	function goBack() {
		window.history.back();
	}
	
	$(document).on('submit', '#formAksi', function(e) {  
      e.preventDefault();
      if (confirm('Are you sure update this data?')) {
            $.ajax({
                url : "<?php echo site_url('User/ajax_update_main')?>/",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){  
                setTimeout(function(){
                    reload_table();
                }, 1000);

                swal_berhasil();
                }           
            });
        }
        return false;
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
            "url": link+"/ajax_list_main/"+kdLevel,
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
	
	$(document).on('submit', '#formAksi', function(e) {  
      e.preventDefault();
      if (confirm('Are you sure update this data?')) {
            $.ajax({
                url : "<?php echo site_url('User/ajax_update_main')?>/",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){  
                setTimeout(function(){
                    reload_table();
                }, 1000);

                swal_berhasil();
                }           
            });
        }
        return false;
   }); 
</script>	
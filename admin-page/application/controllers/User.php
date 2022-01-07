<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_user');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	 function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/user";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_user->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->admin_user;
			$row[] = $user->admin_user;
			$row[] = $user->user_type_name;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$user->admin_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$user->admin_id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_user->count_all(),
						"recordsFiltered" => $this->Mdl_user->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'admin_user'         => $this->input->post('admin_username'),
				'admin_password' 	     => md5($this->input->post('admin_password')),
				'admin_view_password' 	     => $this->input->post('admin_password'),
				'admin_hak_akses'        	 => $this->input->post('admin_hak_akses'),
			);
		$insert = $this->Mdl_user->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_user->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'admin_user'         => $this->input->post('admin_username'),
				'admin_password' 	     => md5($this->input->post('admin_password')),
				'admin_hak_akses'        	 => $this->input->post('admin_hak_akses'),
			);
		$this->Mdl_user->update(array('admin_id' => $this->input->post('admin_id')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_user->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }
	
	function user_level(){
		$data['view_file']    = "moduls/level_user";
        $this->load->view('admin_view',$data);
	}
	
	public function ajax_level() {
		$list = $this->Mdl_user->get_datatables_level();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $level) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $level->user_type_id;
			$row[] = $level->user_type_name;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$level->user_type_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$level->user_type_id."'".')">Delete</a></li>
							<li><a href="level/'.$level->user_type_id.'/privillage">Set Permission</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_user->count_all_level(),
						"recordsFiltered" => $this->Mdl_user->count_filtered_level(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add_level() {
		$data = array(
				'user_type_name'         => $this->input->post('user_type_name')
			);
		$insert = $this->Mdl_user->add_level($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit_level($id) {
		$data = $this->Mdl_user->get_by_level($id);
		echo json_encode($data);
	}
	
	public function ajax_update_level() {
		$data = array(
				'user_type_name'         => $this->input->post('user_type_name')
			);
		$this->Mdl_user->update_level(array('user_type_id' => $this->input->post('user_type_id')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete_level($id) {
      $this->Mdl_user->delete_by_level($id);
      echo json_encode(array("status" => TRUE));
    }
	
	function user_maintenance(){
		$data['view_file']    = "moduls/main_user";
        $this->load->view('admin_view',$data);
	}
	
	function create_load(){
		
        $this->load->view('moduls/view_load');
	}

   function ajax_edit_sub($id) {
    $data = $this->Mdl_user->get_by_submenu($id);
    echo json_encode($data);
   }	
   
   function ajax_update_sub() {
    $data_update1 = array(
        'id_sub'   => $this->input->post('id_sub'),
        'nama_sub' => $this->input->post('a3'),
        'link_sub' => $this->input->post('a4'),
        'mainmenu_idmenu' => $this->input->post('a2'),
      );
    $this->Mdl_user->update_submenu(array('id_sub' => $this->input->post('id_sub')), $data_update1);
   // print_r($this->db->last_query());
    $data_update2 = array(
        'id_sub_menu' => $this->input->post('id_sub_menu'),
        'id_level' => $this->input->post('a1'),
        'r' => $this->input->post('aa5'),
      );
    $this->Mdl_user->update_submenu2(array('id_sub_menu' => $this->input->post('id_sub_menu')), $data_update2);

    //print_r($this->db->last_query());
    //echo json_encode(array("status" => TRUE));
  }
  
   function ajax_edit_main($id) {
    $data = $this->Mdl_user->get_by_mainmenu($id);
    echo json_encode($data);
  }
  
   function ajax_update_main() {
    $data_mainupdate1 = array(
        'nama_menu' => $this->input->post('a2'),
        'link_menu' => $this->input->post('a3'),
        'icon_class' => $this->input->post('a4'),
        'idmenu' => $this->input->post('a5'),
      );
    $this->Mdl_user->update_menu1(array('idmenu' => $this->input->post('a5')), $data_mainupdate1);
    //print_r($this->db->last_query());
    $data_mainupdate2 = array(
       'id_menu' => $this->input->post('a5'),
       'id_level' => $this->input->post('a1'),
       'r' => $this->input->post('a6'),
      );
    $this->Mdl_user->update_menu2(array('id_menu' => $this->input->post('a5')), $data_mainupdate2);
    print_r($this->db->last_query());
    //echo json_encode(array("status" => TRUE));
  }
  
  public function ajax_add_menu() {
          $data_subinsert = array (
                         'id_menu' => $this->input->post('a2'),
                         'id_level' => $this->input->post('a1'),
                         'r' => $this->input->post('a6'),
                        );
          $this->Mdl_user->input_menu2($data_subinsert);
		  echo json_encode(array('status' => TRUE));
  }
  
   public function ajax_add_sub() {
          $data_sub2 = array (
                         'id_sub_menu' => $this->input->post('a2'),
                         'id_level' => $this->input->post('a1'),
                         'r' => $this->input->post('a6'),
                        );
          $this->Mdl_user->input_sub2($data_sub2);
    echo json_encode(array('status' => TRUE));
   }

}
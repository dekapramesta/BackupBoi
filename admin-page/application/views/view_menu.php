<ul class="nav nav-list">

				<?php

				$id_level=$this->session->userdata('admin_hak_akses');

				$main_menu=$this->db->join('mainmenu','mainmenu.idmenu=tab_akses_mainmenu.id_menu')

									->where('tab_akses_mainmenu.id_level',$id_level)

									->where('tab_akses_mainmenu.r','1')

									->order_by('mainmenu.idmenu','asc')

									->get('tab_akses_mainmenu')

									->result();

				foreach ($main_menu as $rs) {

				?>

				<?php

				$row = $this->db->where('mainmenu_idmenu',$rs->idmenu)->get('submenu')->num_rows();

					if($row>0){

						$sub_menu=$this->db->join('submenu','submenu.id_sub=tab_akses_submenu.id_sub_menu')

										   ->where('submenu.mainmenu_idmenu',$rs->idmenu)

										   ->where('tab_akses_submenu.id_level',$id_level)

										   ->where('tab_akses_submenu.r','1')

										   ->get('tab_akses_submenu')

										   ->result();

				?>



					<li class="hover">

						<a class="dropdown-toggle">

						<?php $ro = '<img src="' . base_url() . 'assets/images/' . $rs->icon_class . '" style="width:25px; height:23px; display: flex;  margin-left: auto; margin-right: auto; margin-top: 7px; margin-bottom: 5px; ">';
							echo $ro; ?>

							<span class="menu-text">

								<?=$rs->nama_menu?>

							</span>



							<b class="arrow fa fa-angle-down"></b>

						</a>



						<b class="arrow"></b>



						<?php

						echo "<ul class='submenu'>";

						foreach ($sub_menu as $rsub){

						?>

							<li class="hover">

								<a href="<?=base_url().$rsub->link_sub?>">

									<i class="menu-icon fa fa-caret-right"></i>

									<?=$rsub->nama_sub?>

								</a>



								<b class="arrow"></b>

							</li>





						<?php

						}

							echo "</ul>";

						}else{ 

						?>

						</li>

						<li class="hover">

							<a href="<?=base_url().$rs->link_menu?>">

							<?php $ro = '<img src="' . base_url() . 'assets/images/' . $rs->icon_class . '" style="width:25px; height:23px; display: block; margin-left: auto; margin-right: auto; margin-top: 7px; margin-bottom: 5px; ">';
							echo $ro; ?>

								<span class="menu-text"><?=$rs->nama_menu?> </span>

							</a>



							<b class="arrow"></b>

						</li>

						<?php

						}

						}

						?>

						<?php

							if ($id_level==1){?>

					

						<?php

						}

						?>

						



</ul><!-- /.nav-list -->
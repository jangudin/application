   <div  class="collapse navbar-collapse main-menu-item justify-content-center"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
							<?php
							foreach($menu_utama as $key_menu_utama => $value_menu_utama){
								$fix_nama_menu=htmlspecialchars(strtolower($value_menu_utama['nama_menu']),ENT_QUOTES);
							?>
							 <li class="nav-item <?=($value_menu_utama['dropdown'] =='active' ? 'dropdown' : '')?>  ">
                                    <a class="nav-link <?=($value_menu_utama['dropdown'] =='active' ? 'dropdown-toggle' : '')?>" href="<?php echo base_url('home/index')."/utama/".$value_menu_utama['id']; ?>" id="<?=$fix_nama_menu.'_'.$value_menu_utama['id']; ?>" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $value_menu_utama['nama_menu']; ?></a>
                               
								<?php
							
								if($value_menu_utama['dropdown']=='active' ){
										
									?>
									 <div class="dropdown-menu" aria-labelledby="<?=$fix_nama_menu.'_'.$value_menu_utama['id']; ?>">
									<?php
									foreach($menu_turunan as $key_menu_turunan => $value_menu_turunan){
										if($value_menu_turunan['id_header']==$value_menu_utama['id']){
								?>
										<a class="dropdown-item" href="<?php echo base_url('home/index')."/turunan/".$value_menu_turunan['id']; ?>"><?=$value_menu_turunan['nama_menu']?></a>
							<?php
										}
									}
									?>
									  </div>
									  
							<?php
								}
								?>
								 </li>
								<?php
							}
							?>
                               

                     
                            </ul>
                        </div>
					
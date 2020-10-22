<div class="navbar-header">
            <a class="navbar-brand" href="home.html"><img src="<?php echo base_url(); ?>media/admin/limitless/assets/images/logo_light.png" alt=""></a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                <li><a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li>
                    <a class="sidebar-control sidebar-main-toggle hidden-xs">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>

                <li>
                    <a class="sidebar-control sidebar-secondary-hide hidden-xs" title="sembunyikan">
                        <i class="icon-transmission"></i>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Updates">
                        <i class="icon-git-compare"></i>
                        <span class="visible-xs-inline-block position-right">Updates Terkini</span>
                        <span class="badge bg-warning-400">1</span>
                    </a>

                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            Update Terkini
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-sync"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body width-350">
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                                </div>

                                <div class="media-body">
                                    Pembaruan <a href="#">point of sales</a> interface. Sekarang penggunaan program menjadi lebih mudah
                                    <div class="media-annotation">4 minutes ago</div>
                                </div>
                            </li>

                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"onclick="refresh_karyawan();" >
                        <i class="icon-people"></i>
                        <span class="visible-xs-inline-block position-right">Users</span>
                    </a>

                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            List Karyawan
                            <ul class="icons-list">
                                <li><a href="javascript:void" data-popup="tooltip" title="Refresh" onclick="refresh_karyawan();" ><i class="icon-spinner11 text-size-mini position-left"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body width-300" id="navbar_karyawan_isi">

                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All users"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"onclick="refresh_message();" >
                        <i class="icon-bubbles4"></i>
                        <span class="visible-xs-inline-block position-right">Messages</span>
                        <?php 
						$pesan=$this->model_system->count_unread_message($this->session->userdata('user_id'));
						if($pesan->jumlah!=0){
						echo '<span class="badge bg-warning-400">';
						echo $pesan->jumlah;
						echo '</span>';}
						
						?>
						
						
						
                    </a>

                    <div class="dropdown-menu dropdown-content width-350">
                        <div class="dropdown-content-heading">
                            Pesan
                            <ul class="icons-list">
                                <li><a href="<?php echo base_url() ?>create_message.html" title="Kirim Pesan"><i class="icon-compose"></i></a></li>
								 <li><a href="javascript:void" data-popup="tooltip" title="Refresh" onclick="refresh_message();" ><i class="icon-spinner11 text-size-mini position-left"></i></a></li>
                            </ul>
                        </div>

                           <ul class="media-list dropdown-content-body width-300" id="navbar_inbox_list">

                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="<?php echo base_url() ?>inbox.html" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span><?php echo $this->session->userdata('user_name');?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="myaccount.html"><i class="icon-user-plus"></i> Akun</a></li>
                        <li><a href="komisi_ku.html"><i class="icon-coins"></i> Komisi Saya</a></li>
                        <li><a href="javascript:void(0)" onclick="alert('belum aktif!');"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
                        <li class="divider"></li>
                        <li><a href="changepassword.html" <i class="icon-cog5"></i>Ubah Password</a></li>
                        <li><a href="logout.html"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
		<script>

		</script>
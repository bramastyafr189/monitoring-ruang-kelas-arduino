<?php
if(current_url() == base_url().'pointofsales.html' || current_url() == base_url().'pointofsales.html#' || current_url() == base_url().'pointofsales.html/'){
    $sidebar_fixed='';
}else{
    $sidebar_fixed='sidebar-fixed';
}
    $user_detail = $this->model_master->beranda_user_detail();
    if( is_array($user_detail )){
            $outlet_user = $user_detail['store_name'];
            $photo_user = $user_detail['user_image'];
            $photo_user_img=$photo_user;
            if($photo_user == ""){
                    $photo_user_img="no_user.jpg";
            }
    }
    ?>
<div class="sidebar sidebar-main <?php echo $sidebar_fixed;?>">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left"><img src="<?php echo path_img_adm();?>uploads/user/<?php echo $photo_user_img;?>" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold"><?php echo $this->session->userdata('user_name');?></span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp;<?php echo $outlet_user;?>
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="#"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li><a href="home.html"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                        <?php
                        $arr_menu = menu();
                        if (array_key_exists(0, $arr_menu)) {
                            ksort($arr_menu[0]);
                        }
                        $generate_menu = '';
                        // ekstrak root menu
                        if (count($arr_menu) > 0) {
                            if (array_key_exists(0, $arr_menu)) {
                                foreach ($arr_menu[0] as $rootmenu_sort => $rootmenu_value) {

                                    // set menu icon
                                    $rootmenu_icon = ' ';
                                    if ($rootmenu_value->user_menu_icon != '') {
                                        $rootmenu_icon = $rootmenu_value->user_menu_icon;
                                    } else {
                                        $rootmenu_icon = 'icon-folder2';
                                    }

                                    // cari submenu 1
                                    if (array_key_exists($rootmenu_value->user_menu_id, $arr_menu)) {
                                        $generate_menu .= '<li class="dropdown"><a href=""><i class="' . $rootmenu_icon . '"></i> <span>' . $rootmenu_value->user_menu_title . '</span></a>';
                                        $generate_menu .= '<ul  ">';

                                        // urutkan submenu 1 berdasarkan menu_order_by
                                        ksort($arr_menu[$rootmenu_value->user_menu_id]);

                                        // ekstrak submenu 1 yang par_id adalah menu_id dari root menu
                                        foreach ($arr_menu[$rootmenu_value->user_menu_id] as $submenu_1_sort => $submenu_1_value) {
                                            /*
                                              if($submenu_1_value->user_menu_link == '#') {
                                              $generate_menu .= '<li open="1"><a href="#">' . $submenu_1_value->user_menu_title . '</a></li>';
                                              } else {
                                              $generate_menu .= '<li><a href="' . base_url() . $submenu_1_value->user_menu_link . '">' . $submenu_1_value->user_menu_title . '</a></li>';
                                              }
                                             */
                                            // cari submenu 2
                                            if (array_key_exists($submenu_1_value->user_menu_id, $arr_menu)) {
                                                $generate_menu .= '<li><a href="#"><span>' . $submenu_1_value->user_menu_title . '</span></a>';
                                                $generate_menu .= '<ul>';

                                                // urutkan submenu 1 berdasarkan menu_order_by
                                                ksort($arr_menu[$submenu_1_value->user_menu_id]);

                                                // ekstrak submenu 1 yang par_id adalah menu_id dari root menu
                                                foreach ($arr_menu[$submenu_1_value->user_menu_id] as $submenu_2_sort => $submenu_2_value) {
                                                    /*
                                                      if($submenu_2_value->user_menu_link == '#') {
                                                      $generate_menu .= '<li open="1"><a href="#">' . $submenu_2_value->user_menu_title . '</a></li>';
                                                      } else {
                                                      $generate_menu .= '<li><a href="' . base_url() . $submenu_2_value->user_menu_link . '">' . $submenu_2_value->user_menu_title . '</a></li>';
                                                      }
                                                     */
                                                    // cari submenu 3
                                                    if (array_key_exists($submenu_2_value->user_menu_id, $arr_menu)) {
                                                        $generate_menu .= '<li><a href="#"><span>' . $submenu_2_value->user_menu_title . '</span></a>';
                                                        $generate_menu .= '<ul>';

                                                        // urutkan submenu 2 berdasarkan menu_order_by
                                                        ksort($arr_menu[$submenu_2_value->user_menu_id]);

                                                        // ekstrak submenu 2 yang par_id adalah menu_id dari root menu
                                                        foreach ($arr_menu[$submenu_2_value->user_menu_id] as $submenu_3_sort => $submenu_3_value) {

                                                            if ($submenu_3_value->user_menu_link == '#') {
                                                                $generate_menu .= '<li open="1"><a href="#"><span>' . $submenu_3_value->user_menu_title . '</span></a></li>';
                                                            } else {
                                                                $generate_menu .= '<li><a class="link_menu" href="' . base_url() . $submenu_3_value->user_menu_link . '">' . $submenu_3_value->user_menu_title . '</a></li>';
                                                            }
                                                        }
                                                        $generate_menu .= '</ul>';
                                                        $generate_menu .= '</li>';
                                                    } else {
                                                        if ($submenu_2_value->user_menu_link == '#') {
                                                            $generate_menu .= '<li><a href="#"><span>' . $submenu_2_value->user_menu_title . '</a></span></li>';
                                                        } else {
                                                            $generate_menu .= '<li><a class="link_menu" href="' . base_url() . $submenu_2_value->user_menu_link . '">' . $submenu_2_value->user_menu_title . 'ssss' . '</a></li>';
                                                        }
                                                    }
                                                }
                                                $generate_menu .= '</ul>';
                                                $generate_menu .= '</li>';
                                            } else {
                                                $rootmenu_icon_sub = '';
                                                if ($submenu_1_value->user_menu_icon != '') {
                                                    $rootmenu_icon_sub = $submenu_1_value->user_menu_icon;
                                                } else {
                                                    $rootmenu_icon_sub = 'icon-arrow-right32';
                                                }

                                                if ($submenu_1_value->user_menu_link == '#') {
                                                    $generate_menu .= '<li><a href="#">' . $submenu_1_value->user_menu_title . '</a></li>';
                                                } else {
                                                    $generate_menu .= '<li><a href="' . base_url() . $submenu_1_value->user_menu_link . '"><i class="' . $rootmenu_icon_sub . '"></i> ' . $submenu_1_value->user_menu_title . '</a></li>';
                                                }
                                            }
                                        }

                                        $generate_menu .= '</ul>';
                                    }
                                }
                            }
                        } else {
                            $generate_menu = '';
                        }
                        ?>

                    <?php echo $generate_menu; ?>

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>

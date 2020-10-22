<div class="sidebar sidebar-secondary sidebar-default">
    <div class="sidebar-content">
        <div id="panel_kiri_pembayaran">
        </div>


        <!-- Nota  Terakhir -->
        <div class="sidebar-category">
            <div class="category-title category-collapsed">
                <span>Preview</span>
                <ul class="icons-list">
                    <li><a href="#" data-action="collapse" ></a></li>
                </ul>
            </div>

            <div class="category-content"   style="display: none;">
                <div id="div_preview_nota">
                </div>
                    <center>
                        <button class="btn btn-info" type="button" id="btnNotaPreview" onclick="lihat_preview_nota();">Preview</button>
                    </center>
            </div>
        </div>
        <!--  -->

        <!-- Sub navigation -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>TRANSAKSI</span>
                <ul class="icons-list">
                    <li><a href="#" data-action="collapse"></a></li>
                </ul>
            </div>

            <div class="category-content no-padding">
                <ul class="navigation navigation-alt navigation-accordion">
                    <li class="navigation-header">BARU</li>
                    <li><a href="#tabcustbaru" data-toggle="tab" onclick="tampilkan_pos_area();tab_home();sembunyikan_menu_bayar();"><i class="icon-plus-circle2"></i> Tambah Transaksi</a></li>
                    <li><a href="javascript:void(0);" onclick="tampilkan_data_pos();sembunyikan_menu_bayar();"><i class="icon-menu6"></i> Data Transaksi Kasir</a></li>
                    <li><a href="javascript:void(0);" onclick="tampilkan_data_pos_redeem();sembunyikan_menu_bayar();"><i class="icon-make-group"></i> Redeem Point</a></li>
                    <li class="navigation-divider"></li>
                    <li><a href="#"><i class="icon-search4"></i> Cek Voucher </a></li>
                    <li><a href="#"><i class="icon-search4"></i> Cek Customer </a></li>
                    <li><a href="#"><i class="icon-search4"></i> Cek Karyawan </a></li>
                </ul>
            </div>
        </div>
        <!-- /sub navigation -->


        <!-- Nota  Terakhir -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>Nota Terakhir</span>
                <ul class="icons-list">
                    <li><a href="#" data-action="collapse"></a></li>
                </ul>
            </div>

            <div class="category-content"  id="div_nota_terakhir">
                <center>
                    <button class="btn btn-info" type="button" id="btnNotaTerakhir" onclick="lihat_nota_terakhir();">Lihat Nota</button>
                </center>
            </div>
        </div>
        <!--  -->

    </div>
</div>



<script>
    function lihat_nota_terakhir(){
        $("#div_nota_terakhir" ).html("<br><center><img src='<?php echo path_img_adm(); ?>loaders/loadergreen_pulsate.gif'></center> ");
        $('#div_nota_terakhir').load('transpos/nota_terakhir');
    }

    function tampilkan_data_pos(){
        $('#div_content_pos').hide();
        $('#div_page_header').hide();
        $('#div_content_datapos').show();
        $("#div_content_datapos" ).html("<br><center><img src='<?php echo path_img_adm(); ?>loaders/loadergreen_pulsate.gif'></center> ");
        $('#div_content_datapos').load('transpos/datapos');
    }

    function tampilkan_data_pos_redeem(){
        $('#div_content_pos').hide();
        $('#div_page_header').hide();
        $('#div_content_datapos').show();
        $("#div_content_datapos" ).html("<br><center><img src='<?php echo path_img_adm(); ?>loaders/loadergreen_pulsate.gif'></center> ");
        $('#div_content_datapos').load('transpos/datapos_redeem');
    }

    function tampilkan_pos_area(){
        $('#div_content_pos').show();
        $('#div_page_header').show();
        $('#div_content_datapos').hide();
        $("#div_content_datapos" ).html("");
    }
    </script>
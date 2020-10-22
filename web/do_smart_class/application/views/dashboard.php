<!doctype html>
<head>
  <!--- TRY -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/limitless/assets/js/pages/form_layouts.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>media/admin/limitless/assets/js/plugins/notifications/pnotify.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>media/admin/limitless/assets/js/pages/components_notifications_pnotify.js"></script>

  <!-- Auto refresh -->
  <script type="text/javascript">
    function AutoRefresh (t) {
      setTimeout("location.reload(true);",t);
    }
  </script>

</head>
<body onload = "JavaScript:AutoRefresh(60000);">
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat">
          <div class="panel-heading">
            <form method="post">
                <h6 class="panel-title">
                  <i class="icon-file-text"></i> 
                  Status Ruang 
                </h6>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-1 text-right">
                        </div>

                    </div>

                    <table class="table table-striped" style="margin-bottom: 10px" id="tabelflog1">
                    <thead>   
                      <tr align="center">
                        <td align="center"><b>No</b></td>
                        <td align="center"><b>Nama Ruang</b></td>
                        <td align="center"><b>Status Ruang</b></td>
                        <td align="center"><b>Riwayat</b></td>
                        <td align="center"><b>Jadwal</b></td>
                        <td align="center"><b>Pinjam Ruang</b></td>
                        <td align="center"><b>Cek Status Peminjaman</b></td>
                        <td align="center"><b>ID Alat</b></td>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $start=0;
                        foreach ($status_ruang as $value)
                        {
                            ?>
                            <tr>
                               <td width="50px"><?php echo ++$start; ?></td>
                               <td><?php echo $value->ruang_nama; ?></td>
                               <td>
                                 <?php 
                                      if($value->ruang_is_active==0){ ?>
                                          <span class="label label-default" title="Disable" style="cursor: pointer;">Tidak Aktif</span>
                                        </a>
                                    <?php }else{ ?>
                                          <span class="label label-primary" title="Enable" >Aktif</span>
                                        </a>
                                 <?php }  ?>
                               </td>
                              <td align="center">
                                <a href="monitoring_penggunaan_ruang.html?id=<?php echo $value->ruang_id; ?>">
                                  <label class="label label-success"><i class="icon-files-empty2"></i></label>
                                </a>
                              </td>
                              <td align="center">
                                <a href="cari_jadwal.html?id=<?php echo $value->ruang_id; ?>">
                                  <label class="label label-info"><i class="icon-clipboard3"></i> List</label>
                                </a>
                                <a href="jadwal_sekarang.html?id=<?php echo $value->ruang_id; ?>">
                                  <label class="label label-info"><i class="icon-alarm"></i> Sekarang</label>
                                </a>
                              </td>
                              <td align="center">
                                <?php
                                  if ($value->ruang_is_active==0) { ?>
                                    <a href="pinjam_kunci_ruang.html?id=<?php echo $value->ruang_id; ?>">
                                      <label class="label label-warning" disable="enable" style="cursor : pointer;"><i class="icon-key"></i>   Pinjam</label>
                                    </a>
                                <?php }else{?>
                                    <label class="label label-default" style="cursor : pointer;"><i class="icon-key"></i> Pinjam</label>
                                <?php } ?>

                                <?php
                                  if ($value->ruang_is_active==1) { ?>
                                    <a href="kembalikan_kunci_ruang.html?id=<?php echo $value->ruang_id; ?>">
                                      <label class="label label-warning" disable="enable" style="cursor : pointer;"><i class="icon-exit3"></i>   Kembalikan</label>
                                    </a>
                                <?php }else{?>
                                    <label class="label label-default" style="cursor : pointer;"><i class="icon-exit3"></i> Kembalikan</label>
                                <?php } ?>
                              </td>
                              <td align="center">
                                <?php
                                  if ($value->ruang_is_active==0) { ?>
                                  <label class="label label-rounded label-default" style="cursor : pointer;"><i class="icon-alarm-check"></i></label>
                                <?php }else{?>
                                    <a href="status_peminjaman.html?id=<?php echo $value->ruang_id; ?>">
                                    <label class="label label-rounded label-success" disable="enable" style="cursor : pointer;"><i class="icon-alarm-check"></i></label>
                                    </a>
                                <?php } ?>
                              </td>
                              <td>
                                <a href="edit_data_ruang.html?id=<?php echo $value->ruang_id; ?>">
                                  <label class="label label-info"><?php echo $value->id_alat; ?></label>
                                </a>
                              </td>
                              
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            </form>

  </div>

</div>
</div>
</div>
</div>
<div style="display:none">
    <?php $this->load->view('limitless/not_visible/not_usable'); ?>
</div>
</body>
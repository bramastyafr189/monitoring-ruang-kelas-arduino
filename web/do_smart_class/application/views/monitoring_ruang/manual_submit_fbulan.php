
<!doctype html>
<head>
<!--- TRY -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>
<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/limitless/assets/js/pages/form_layouts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/admin/limitless/assets/js/plugins/notifications/pnotify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/admin/limitless/assets/js/pages/components_notifications_pnotify.js"></script>
</head>

<body>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-file-text"></i>
                  <?php
                    foreach ($data_ruang as $val_ruang) {
                      $id_ruang   = $val_ruang->ruang_id;
                      $nama_ruang =  $val_ruang->ruang_nama;
                    }
                    // /echo $id_ruang." - ";
                    echo $nama_ruang;
                  ?>
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
                    <div class="row" style="margin-bottom:30px">
                      <div class="col-md-4"> </div>
                      <div class="col-md-4">
                        <form action="manual_exe_fbulan.html" method="post">
                          <table border="0" rules="0">
                            <tr>
                              <td width="70">Pilih bulan</td>
                              <td width="20" align="center"> : </td>
                              <td width="100">
                                <select class="form-control" name="bulan" id="bulan" required>
                                  <?php
                                    $selected="";
                                    foreach ($bulan_monitoring as $bulan) {
                                      echo "<option value='".$bulan->bulan."' ".$selected."><b>".$bulan->bulan."</b> </option>";
                                      $selected="";
                                    }
                                    ?>
                                </select>
                              </td>
                              <td>
                                <input type="hidden" name="id_ruang" value=<?php echo $id_ruang; ?>>
                              </td>
                              <td>
                                <input type="hidden" name="tahun_monitoring" value=<?php echo $tahun_monitoring; ?>>
                              </td>
                              <td width="100" align="center">
                                <input type="submit" value="Submit" class="btn btn-primary btn-sm">
                              </td>
                            </tr>
                            
                          </table>
                        </form>
                      </div>
                      <div class="col-md-4"> </div>
                    </div>

                    <table class="table table-striped" style="margin-bottom: 10px" id="tabelflog1">
                      <thead>   
                      <tr>
                        <th align="center">No</th>
                        <th align="center">ID Log</th>
                        <th align="center">Peminjam</th>
                        <th align="center">Telp</th>
                        <th align="center">Mata Kuliah</th>
                        <th align="center">Tanggal</th>
                        <th align="center">Masuk</th>
                        <th align="center">Keluar</th>
                        <th align="center">Kunci</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php
                        $start = 0;
                        foreach ($data_log_tahunan as $value)
                        {
                            ?>
                            <tr>
                              <td><?php echo ++$start; ?></td>
                               <td><?php echo $value->id_log_manual; ?></td>
                               <td><?php echo $value->peminjam_manual; ?></td>
                               <td><?php echo $value->telp_peminjam_manual; ?></td>
                               <td><?php echo $value->nama_mapen; ?></td>
                               <td><?php echo $value->tanggal_log_manual; ?></td>
                               <td><?php echo $value->waktu_masuk_manual; ?></td>
                               <td><?php echo $value->waktu_selesai_manual; ?></td>
                               <td>
                                  <?php 
                                      if($value->kunci_kembali==0){ ?>
                                          <span class="label label-default" title="Disable" style="cursor: pointer;">Belum Kembali</span>
                                    <?php }else{ ?>
                                          <span class="label label-primary" title="Enable" >Sudah Kembali</span>
                                 <?php }  ?>
                                </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        <script>
             $('#tabelflog1').dataTable();
         </script> 
         <div class="col-md-6 text-right">

         </div>
     </div>
     </body>
<div style="display:none">
    <?php $this->load->view('limitless/not_visible/not_usable'); ?>
</div>

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
                    

                    <table class="table table-striped" style="margin-bottom: 10px" id="tabelflog1">
                      <thead>   
                      <tr>
                        <th align="center">ID Log</th>
                        <th align="center">Nomor RFID</th>
                        <th align="center">Nama Kelas</th>
                        <th>Semester</th>
                        <th>Mapel</th>
                        <th>Status</th>
                        <th>Hari</th>
                        <th>Waktu</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php
                        $start = 1;
                        foreach ($data_log_harian as $data)
                        {
                            ?>
                           <tr>
                               <td><?php echo $start++; ?></td>
                               <td><?php echo $data->rfid_penanggung_jawab; ?></td>
                               <td><?php echo $data->rfid_no_handpon_pj; ?></td>
                               <td align="center"><?php echo $data->kelas_nama; ?></td>
                               <td align="center"><?php echo $data->semester_nama; ?></td>
                               <td><?php echo $data->makul_nama; ?></td>
                               <td align="center"><?php echo $data->log_tanggal; ?></td>
                               <td align="center"><?php echo $data->log_jam_masuk; ?></td>
                               <td align="center"><?php
                                    if (is_null($data->log_jam_keluar)) { ?>
                                       <span class="label label-flat label-primary text-blue" title="Enable" >Ruang masih digunakan</span>
                                    <?php }else{ ?>
                                      <span class="label label-primary" title="Enable" ><?php echo $data->log_jam_keluar ?></span>
                                    <?php } 
                                      //echo $value->log_jam_keluar;
                                    ?>
                                </td>
                                <td align="center">
                                  <?php
                                    if ($data->log_status == 'By RFID') { ?>
                                      <span class="label label-primary" title="Enable" ><?php echo $data->log_status; ?></span>
                                  <?php
                                    }else{ ?>
                                      <span class="label label-default" title="Enable" ><?php echo $data->log_status; ?></span>
                                  <?php } ?>
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
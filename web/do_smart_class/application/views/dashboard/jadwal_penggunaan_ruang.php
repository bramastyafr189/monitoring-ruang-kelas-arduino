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
                    foreach ($ruang_nama as $value) {
                      $nama_ruang =  $value->ruang_nama;
                    }

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
                          <th align="center">No</th>
                          <th align="center">Hari</th>
                          <th align="center">Sesi</th>
                          <th align="center">Jam Mulai</th>
                          <th align="center">Jam Selesai</th>
                          <th align="center">Nama Makul</th>
                          <th align="center">Semester</th>
                          <th align="center">Kelas</th>
                          <th align="center">SKS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $start=0;
                        foreach ($jadwal_senin as $value)
                        {
                            ?>
                            <tr>
                               <td width="50px"><?php echo ++$start ?></td>
                               <td><?php echo $value->jadwal_hari; ?></td>
                               <td><?php echo $value->jadwal_sesi; ?></td>
                               <td><?php echo $value->jadwal_jam_mulai; ?></td>
                               <td><?php echo $value->jadwal_jam_akhir; ?></td>
                               <td><?php echo $value->makul_nama; ?></td>
                               <td><?php echo $value->jadwal_semester_id; ?></td>
                               <td><?php echo "Kelas ".$value->kelas_nama; ?></td>
                               <td><?php echo $value->makul_sks; ?></td>
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
        
        <br>
        <hr>
        <br>

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

                    <table class="table table-striped" style="margin-bottom: 10px" id="tabelflog2">
                      <thead>
                        <tr>
                          <th align="center">No</th>
                          <th align="center">Hari</th>
                          <th align="center">Sesi</th>
                          <th align="center">Jam Mulai</th>
                          <th align="center">Jam Selesai</th>
                          <th align="center">Nama Makul</th>
                          <th align="center">Semester</th>
                          <th align="center">Kelas</th>
                          <th align="center">SKS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $start=0;
                        foreach ($jadwal_selasa as $value)
                        {
                            ?>
                            <tr>
                               <td width="50px"><?php echo ++$start ?></td>
                               <td><?php echo $value->jadwal_hari; ?></td>
                               <td><?php echo $value->jadwal_sesi; ?></td>
                               <td><?php echo $value->jadwal_jam_mulai; ?></td>
                               <td><?php echo $value->jadwal_jam_akhir; ?></td>
                               <td><?php echo $value->makul_nama; ?></td>
                               <td><?php echo $value->jadwal_semester_id; ?></td>
                               <td><?php echo "Kelas ".$value->kelas_nama; ?></td>
                               <td><?php echo $value->makul_sks; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        <script>
             $('#tabelflog2').dataTable();
         </script> 
         <div class="col-md-6 text-right">

      </div> <!--END DIV TABLE -->

      <br>
      <hr>
      <br>

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

                    <table class="table table-striped" style="margin-bottom: 10px" id="tabelflog3">
                      <thead>
                        <tr>
                          <th align="center">No</th>
                          <th align="center">Hari</th>
                          <th align="center">Sesi</th>
                          <th align="center">Jam Mulai</th>
                          <th align="center">Jam Selesai</th>
                          <th align="center">Nama Makul</th>
                          <th align="center">Semester</th>
                          <th align="center">Kelas</th>
                          <th align="center">SKS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $start=0;
                        foreach ($jadwal_rabu as $value)
                        {
                            ?>
                            <tr>
                               <td width="50px"><?php echo ++$start ?></td>
                               <td><?php echo $value->jadwal_hari; ?></td>
                               <td><?php echo $value->jadwal_sesi; ?></td>
                               <td><?php echo $value->jadwal_jam_mulai; ?></td>
                               <td><?php echo $value->jadwal_jam_akhir; ?></td>
                               <td><?php echo $value->makul_nama; ?></td>
                               <td><?php echo $value->jadwal_semester_id; ?></td>
                               <td><?php echo "Kelas ".$value->kelas_nama; ?></td>
                               <td><?php echo $value->makul_sks; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        <script>
             $('#tabelflog3').dataTable();
         </script> 
         <div class="col-md-6 text-right">

      </div><!--END DIV TABLE -->

      <br>
      <hr>
      <br>


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

                    <table class="table table-striped" style="margin-bottom: 10px" id="tabelflog4">
                      <thead>
                        <tr>
                          <th align="center">No</th>
                          <th align="center">Hari</th>
                          <th align="center">Sesi</th>
                          <th align="center">Jam Mulai</th>
                          <th align="center">Jam Selesai</th>
                          <th align="center">Nama Makul</th>
                          <th align="center">Semester</th>
                          <th align="center">Kelas</th>
                          <th align="center">SKS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $start=0;
                        foreach ($jadwal_kamis as $value)
                        {
                            ?>
                            <tr>
                               <td width="50px"><?php echo ++$start ?></td>
                               <td><?php echo $value->jadwal_hari; ?></td>
                               <td><?php echo $value->jadwal_sesi; ?></td>
                               <td><?php echo $value->jadwal_jam_mulai; ?></td>
                               <td><?php echo $value->jadwal_jam_akhir; ?></td>
                               <td><?php echo $value->makul_nama; ?></td>
                               <td><?php echo $value->jadwal_semester_id; ?></td>
                               <td><?php echo "Kelas ".$value->kelas_nama; ?></td>
                               <td><?php echo $value->makul_sks; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        <script>
             $('#tabelflog4').dataTable();
         </script> 
         <div class="col-md-6 text-right">
         
      </div><!--END DIV TABLE -->

      <br>
      <hr>
      <br>

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

                    <table class="table table-striped" style="margin-bottom: 10px" id="tabelflog5">
                      <thead>
                        <tr>
                          <th align="center">No</th>
                          <th align="center">Hari</th>
                          <th align="center">Sesi</th>
                          <th align="center">Jam Mulai</th>
                          <th align="center">Jam Selesai</th>
                          <th align="center">Nama Makul</th>
                          <th align="center">Semester</th>
                          <th align="center">Kelas</th>
                          <th align="center">SKS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $start=0;
                        foreach ($jadwal_jumat as $value)
                        {
                            ?>
                            <tr>
                               <td width="50px"><?php echo ++$start ?></td>
                               <td><?php echo $value->jadwal_hari; ?></td>
                               <td><?php echo $value->jadwal_sesi; ?></td>
                               <td><?php echo $value->jadwal_jam_mulai; ?></td>
                               <td><?php echo $value->jadwal_jam_akhir; ?></td>
                               <td><?php echo $value->makul_nama; ?></td>
                               <td><?php echo $value->jadwal_semester_id; ?></td>
                               <td><?php echo "Kelas ".$value->kelas_nama; ?></td>
                               <td><?php echo $value->makul_sks; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        <script>
             $('#tabelflog5').dataTable();
         </script> 
         <div class="col-md-6 text-right">
         
      </div><!--END DIV TABLE -->












     </div>
     </body>

     <div id="modal_theme_primary" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h6 class="modal-title">Menambah Data Mapel</h6>
          </div>
          <div class="modal-body">
              <div class="form-group">
              <form action="siswa_input_mapel.html" method="post">
                <div class="col-md-16">
                  <label for="varchar">Nama Mapel</label>
                  <input type="text" class="form-control" name="nama_mapel"  />
                  <input type="hidden" class="form-control" name="flag"  />
              </div>

          </div>
         
  <div class="modal-footer">

    <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
    <input type="submit" class="btn btn-primary" value='Simpan'></input>
    </div>
       </form>
</div>

  </div>

</div>
</div>
</div>
</div>
<div style="display:none">
    <?php $this->load->view('limitless/not_visible/not_usable'); ?>
</div>
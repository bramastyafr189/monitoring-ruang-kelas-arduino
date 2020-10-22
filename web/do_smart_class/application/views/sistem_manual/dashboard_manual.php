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

                <button class="btn btn-warning" style="float: right;"><a style='color:white' href="form_input_log_manual.html">Pakai Ruang</a></button>
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
                        <th align="center">ID Log</th>
                        <th align="center">Peminjam</th>
                        <th align="center">Telp</th>
                        <th align="center">Nama Ruang</th>
                        <th align="center">Mata Kuliah</th>
                        <th align="center">Tanggal</th>
                        <th align="center">Masuk</th>
                        <th align="center">Kunci</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $start=0;
                        foreach ($manual as $value)
                        {
                            ?>
                            <tr>
                               <td width="50px"><?php echo ++$start; ?></td>
                               <td><?php echo $value->id_log_manual; ?></td>
                               <td><?php echo $value->peminjam_manual; ?></td>
                               <td><?php echo $value->telp_peminjam_manual; ?></td>
                               <td><?php echo $value->nama_ruang; ?></td>
                               <td><?php echo $value->nama_mapen; ?></td>
                               <td><?php echo $value->tanggal_log_manual; ?></td>
                               <td><?php echo $value->waktu_masuk_manual; ?></td>
                               <td><?php 
                                  if($value->kunci_kembali==0){ ?>
                                    <a href="mengembalikan_kunci.html?id_ruang=<?php echo $value->ruang_id; ?>&id_log=<?php echo $value->id_log_manual; ?>">
                                      <span class="label label-default" title="Kembalikan Kunci" style="cursor: pointer;">Belum Kembali</span>
                                    </a>
                                  <?php } ?>
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
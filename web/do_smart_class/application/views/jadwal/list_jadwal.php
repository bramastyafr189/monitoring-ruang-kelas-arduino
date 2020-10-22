
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

<div class=row>
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-file-text"></i> Daftar Ujian</h6>

                
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

                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label><b>Semester:</b> </label> <br>
                              <?php
                                foreach ($list_semester as $data) { 
                                  if ($data->tahun_semester_is_active == 1) { ?>
                                    <label class="label label-success">
                                      <?php echo $data->tahun_semester_nama; ?></i>
                                    </label>
                              <?php  }else{ ?>
                                <a href="aktifkan_semester.html?id=<?php echo $data->tahun_semester_id; ?>">
                                  <label class="label label-default"><?php echo $data->tahun_semester_nama; ?></i></label>
                                </a>
                            <?php } 
                            } ?>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label><b>Semester:</b> </label> <br>
                              <?php
                                foreach ($list_tahun as $data) { 
                                  if ($data->tahun_ajaran_is_active == 1) { ?>
                                    <label class="label label-primary"><?php echo $data->tahun_ajaran_nama; ?></i></label>
                              <?php  }else{ ?>
                                <a href="aktifkan_tahun_ajaran.html?id=<?php echo $data->tahun_ajaran_id; ?>">
                                  <label class="label label-default"><?php echo $data->tahun_ajaran_nama; ?></i></label>
                                </a>
                            <?php } 
                            } ?>
                        </div>
                      </div>
                    </div>
     </div>


  </div>

</div>
</div>
</div>
</div>
<div style="display:none">
    <?php $this->load->view('limitless/not_visible/not_usable'); ?>
</div>
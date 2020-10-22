
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

<!-- <?php
// $cek_tag = mysqli_fetch_array($data_tag);
// $tag = $cek_tag['tag'];
?> -->
<div class=row>
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-file-text"></i> Daftar RFID</h6>

                <button class="btn btn-warning" style="float: right;" data-toggle="modal" data-target="#modal_theme_primary" >Tambah Data</button>
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
                      <thead align="center">   
                      <tr>
                        <td align="center"><b>ID RFID</b></td>
                        <td align="center"><b>Nomer RFID</b></td>
                        <td align="center"><b>Semester</b></td>
                        <td align="center"><b>Kelas</b></td>
                        <td align="center"><b>Penanggung Jawab</b></td> 
                        <td align="center"><b>Nomer Telepon</b></td>                        
                        <td align="center"><b>Option</b></td>
                      </tr>
                    </thead>
                      <tbody>
                        <?php
                        $start = 1;
                        foreach ($list_data_rfid as $value)
                        {
                            ?>
                            <tr>
                               <td align="center"><?php echo $start++; ?></td>
                               <td align="center"><?php echo $value->rfid_number; ?></td>
                               <td align="center"><?php echo $value->semester_nama; ?></td>
                               <td align="center"><?php echo $value->kelas_nama; ?></td>
                               <td align="center"><?php echo $value->rfid_penanggung_jawab; ?></td>
                               <td align="center"><?php echo $value->rfid_no_handpon_pj; ?></td>
                               <td align="center">
                               	<button class="btn btn-small btn-info"><a href="edit_data_rfid.html?id=<?php echo $value->rfid_id; ?>" style="color:#FFFFFF">Edit</a></button>
                               	<button class="btn btn-small btn-danger"><a href="hapus_data_rfid.html?id=<?php echo $value->rfid_id; ?>" style="color:#FFFFFF">Hapus</button>
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

     <div id="modal_theme_primary" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h6 class="modal-title">Menambah Data RFID</h6>
          	</div>
          	<div class="modal-body">
              <div class="form-group">
              	<form action="input_data_rfid.html" method="post">
                	<div class="col-md-16">
                  		<label for="varchar"><b>Nomer RFID</b></label>
                  		<input type="text" class="form-control" name="nomer_rfid" value="<?php foreach ($data_tag as $tag) { echo $tag->notag; } ?>"placeholder="no rfid" required/>
                      <label for="varchar"><b>Semester</b></label>
                      <select class="form-control" name="semester" id="semester" required>
                        <?php
                            foreach ($list_semester as $semester) { ?>
                                <option value="<?php echo $semester->semester_id; ?>"><?php echo $semester->semester_nama;?></option>
                            
                         <?php   }
                        ?>
                       </select>
		                  <label for="varchar"><b>Kelas</b></label>
		                  <select class="form-control" name="kelas" id="kelas" required>
		                    <?php
		                        foreach ($list_kelas as $kelas) { ?>
		                            <option value="<?php echo $kelas->kelas_id; ?>"><?php echo $kelas->kelas_nama;?></option>
		                        
		                     <?php   }
		                    ?>
		                   </select>
                      <label for="varchar"><b>Nama Penanggung Jawab</b></label>
                      <input type="text" class="form-control" name="penanggung_jawab" placeholder="Nama penagnggung jawab" required/>
                      <label for="varchar"><b>No telp</b></label>
                      <input type="text" class="form-control" name="no_telp" placeholder="Nomer HP yang dapat dihubungi" required/>
             		 </div>
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
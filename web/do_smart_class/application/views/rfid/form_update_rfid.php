<!doctype html>
<html>
    <head>
        <title>
            RFID | Edit
        </title>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title"><b><i class="icon-rocket"></i>Edit Data RFID</b></h6>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable">
                            <h2 style="margin-top:0px"> </h2>
                                <form action="exe_update_data_rfid.html" method="post">
                                    <div class="form-group">
                                        <?php
                                            foreach ($rfid as $value) {
                                                $id_rfid    = $value->rfid_id;
                                                $no_rfid    = $value->rfid_number;
                                                $kelas      = $value->rfid_kelas_id;
                                                $semester   = $value->rfid_semester_id;
                                                $pj         = $value->rfid_penanggung_jawab;
                                                $no_hp      = $value->rfid_no_handpon_pj;
                                            }
                                        ?>
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td width="250"><input type="hidden" value="<?php echo $id_rfid; ?>" name='id_rfid'></td>
                                            </tr>
                                            <tr>
                                                <td width="130"><label for="varchar"><b>Nomor Kartu RFID</b></label></td>
                                                <td width="10">:</td>
                                                <td><input type="text" class="form-control" value="<?php echo $no_rfid; ?>" name='nomer_rfid' required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="varchar"><b>Kelas</b></label></td>
                                                <td>:</td>
                                                <td>
                                                    <select class="form-control" name="kelas" id="kelas" required>
                                                    <?php foreach ($list_kelas as $kls) { ?>
                                                        <option value="<?php echo $kls->kelas_id; ?>" 
                                                            <?php if($kelas == $kls->kelas_id){
                                                                echo "selected='selected'"; }
                                                            ?>>
                                                            <?php echo $kls->kelas_nama;?> 
                                                        </option>
                                                    <?php   } ?>
                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="varchar"><b>Semester</b></label></td>
                                                <td>:</td>
                                                <td>
                                                    <select class="form-control" name="semester" id="semester" required>
                                                    <?php foreach ($list_semester as $smt) { ?>
                                                        <option value="<?php echo $smt->semester_id; ?>" <?php if($semester == $smt->semester_id){ echo "selected='selected'"; }?>>
                                                        <?php echo $smt->semester_nama;?> 
                                                        </option>
                                                    <?php   } ?>
                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="varchar"><b>Penanggung Jawab</b></label></td>
                                                <td width="10">:</td>
                                                <td><input type="text" class="form-control" value="<?php echo $pj; ?>" name='penanggung_jawab' required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="varchar"><b>No Telepon</b></label></td>
                                                <td>:</td>
                                                <td><input type="text" class="form-control" name="no_hp" placeholder="Nomer HP yang dapat dihubungi" value="<?php echo $no_hp; ?>" required/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="submit" class="btn btn-primary" value='Update'></input></td>
                                                <td></td>
                                                <td></td>
                                            </tr>    
                                        </table>
                                    </div>

        
        
        
    </form>
</div>
</div>
</div>
</div>
    </body>
</html>
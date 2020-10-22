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
                        <h6 class="panel-title"><b><i class="icon-rocket"></i>Penanggung Jawab Kunci</b></h6>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable">
                            <h2 style="margin-top:0px"> </h2>
                                <form action="exe_input_log_manual.html" method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="varchar"><b>Nama Peminjam</b></label>
                                                <input type="text" class="form-control" name="nama_peminjam">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="varchar"><b>Telepon</b></label>
                                                <input type="text" class="form-control" name="telp_peminjam">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="varchar"><b>Semester</b></label>
                                                <select class="form-control" name="semesetr" id="semester" required>
                                                    <?php
                                                    foreach ($semester as $smt) { ?>
                                                        <option value="<?php echo $smt->semester_mapen; ?>"><?php echo $smt->semester_mapen;?></option>
                                                 <?php   } ?>
                                                        
                                                    </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="varchar"><b>Kelas</b></label>
                                                <select class="form-control" name="kelas" id="kelas" required>
                                                    <?php
                                                    foreach ($kelas as $kls) { ?>
                                                        <option value="<?php echo $kls->NAMAKELAS; ?>"><?php echo $kls->NAMAKELAS;?></option>
                                                 <?php   } ?>
                                                        
                                                    </select>
                                            </div>
                                            <div class="col-md-2">
                                                <br> <br>
                                                <button>Save</button>
                                            </div>
                                        </div> 
                                    </div>


        
        
        
    </form>
</div>
</div>
</div>
</div>
    </body>
</html>
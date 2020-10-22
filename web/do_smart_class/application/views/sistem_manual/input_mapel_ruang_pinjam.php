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
                        <h6 class="panel-title"><b><i class="icon-rocket"></i>Penanggung Jawab Kunci</b> </h6>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable">
                            <h2 style="margin-top:0px"> </h2>
                                <form action="exe_data_peminjam_fix.html" method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="varchar"><b>Mata Kuliah</b></label>
                                                <select class="form-control" name="mapel" id="mapel" required>
                                                    <?php
                                                    foreach ($mapel as $mpl) { ?>
                                                        <option value="<?php echo $mpl->id_mapen; ?>"><?php echo $mpl->nama_mapen;?></option>
                                                 <?php   } ?>
                                                        
                                                    </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="varchar"><b>Ruang</b></label>
                                                <select class="form-control" name="ruang" id="ruang" required>
                                                    <?php
                                                    foreach ($ruang as $r) { ?>
                                                        <option value="<?php echo $r->ruang_id; ?>"><?php echo $r->nama_ruang;?></option>
                                                 <?php   } ?>
                                                        
                                                    </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="hidden" name="id_log_manual" value="<?php echo $id_log; ?>" placeholder="id_log"> <br>
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
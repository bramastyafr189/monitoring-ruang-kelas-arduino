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
                        <h6 class="panel-title"><b><i class="icon-rocket"></i>Edit Data Ruang</b></h6>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable">
                            <h2 style="margin-top:0px"> </h2>
                                <form action="exe_update_ruang.html" method="post">
                                    <div class="form-group">
                                        <?php
                                            foreach ($ruang as $value) {
                                                $id_ruang    = $value->ruang_id;
                                                $alat_id    = $value->id_alat;
                                            }
                                        ?>
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td width="250"><input type="hidden" value="<?php echo $id_ruang; ?>" name='id_ruang'></td>
                                            </tr>
                                            <tr>
                                                <td width="130"><label for="varchar"><b>ID Alat</b></label></td>
                                                <td width="10">:</td>
                                                <td><input type="text" class="form-control" value="<?php echo $alat_id; ?>" name='alat_id' required></td>
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
<?php
error_reporting(0);
require_once 'core/harviacode.php';
require_once 'core/helper.php';
require_once 'core/process.php';
?>
<!doctype html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="core/bootstrap.min.css"/>
        <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css"/>
        <link rel="stylesheet" href="../assets/bower_components/fontawesome/css/all.css"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <form action="index.php" method="POST">

                    <div class="form-group">
                        <label>Select Table - <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Refresh</a></label>
                        <select id="table_name" name="table_name" class="form-control" onchange="setname()">
                            <option value="">Please Select</option>
                            <?php
                            $table_list = $hc->table_list();
                            $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                            foreach ($table_list as $table) {
                                if($table['table_name'] != 'users' && $table['table_name'] != 'users_groups' && $table['table_name'] != 'menu' && $table['table_name'] != 'menu_type' && $table['table_name'] != 'login_attempts' && $table['table_name'] != 'groups' && $table['table_name'] != 'groups_menu'){

                               
                                ?>
                                <option value="<?php echo $table['table_name'] ?>" <?php echo $table_list_selected == $table['table_name'] ? 'selected="selected"' : ''; ?>><?php echo $table['table_name'] ?></option>
                                <?php
                                
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <?php $jenis_tabel = isset($_POST['jenis_tabel']) ? $_POST['jenis_tabel'] : 'reguler_table'; ?>
                            <div class="col-md-5">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_tabel" value="reguler_table" <?php echo $jenis_tabel == 'reguler_table' ? 'checked' : ''; ?>>
                                        Reguler Table
                                    </label>
                                </div>                            
                            </div>
                            <div class="col-md-7">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_tabel" value="datatables" <?php echo $jenis_tabel == 'datatables' ? 'checked' : ''; ?>>
                                        Serverside Datatables
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <?php $isai = isset($_POST['isai']) ? $_POST['isai'] : 'yes'; ?>
                            <div class="col-md-5">
                                PK Is Auto Increment ?<br/>
                            </div>
                            <div class="col-md-3">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="isai" value="1" <?php echo $isai == '1' ? 'checked' : ''; ?>>
                                        YES
                                    </label>
                                </div>                            
                            </div>
                            <div class="col-md-4">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="isai" value="0" <?php echo $isai == '0' ? 'checked' : ''; ?>>
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_pdf = isset($_POST['export_pdf']) ? $_POST['export_pdf'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_pdf" value="1" <?php echo $export_pdf == '1' ? 'checked' : '' ?>>
                                Print Preview
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_excel = isset($_POST['export_excel']) ? $_POST['export_excel'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                                Export Excel
                            </label>
                        </div>
                    </div>    

                    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_word = isset($_POST['export_word']) ? $_POST['export_word'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                                Export Word
                            </label>
                        </div>
                    </div>    

                        

                    <!--                    <div class="form-group">
                                            <div class="checkbox  <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : 'disabled';   ?>">
                    <?php // $export_pdf = isset($_POST['export_pdf']) ? $_POST['export_pdf'] : ''; ?>
                                                <label>
                                                    <input type="checkbox" name="export_pdf" value="1" <?php // echo $export_pdf == '1' ? 'checked' : ''   ?>
                    <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : 'disabled'; ?>>
                                                    Export PDF
                                                </label>
                    <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : '<small class="text-danger">mpdf required, download <a href="http://harviacode.com">here</a></small>'; ?>
                                            </div>
                                        </div>-->


                    <div class="form-group">
                        <label>Custom Controller Name</label>
                        <input type="text" id="controller" name="controller" value="<?php echo isset($_POST['controller']) ? $_POST['controller'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <div class="form-group">
                        <label>Custom Model Name</label>
                        <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                   <!--  <div class="form-group">
                        <label>Icon</label>
                        <div class="input-group">
                            <span class="input-group-addon">fa </span>
                            <input type="text" class="form-control" placeholder="Username">
                            <span class="input-group-addon"><a target="_blank" href="https://fontawesome.com/icons?d=gallery&m=free"> <i class="fa fa-question-circle" ></i> </a></span>

                        </div>
                                    
                    </div> -->
                    <input type="submit" value="Generate" name="generate" class="btn btn-primary" onclick="javascript: return confirm('This will overwrite the existing files. Continue ?')" />
                    <input type="submit" value="Generate All" name="generateall" class="btn btn-danger" onclick="javascript: return confirm('WARNING !! This will generate code for ALL TABLE and overwrite the existing files\
                    \nPlease double check before continue. Continue ?')" />
                    <a href="core/setting.php" class="btn btn-default">Setting</a>
                </form>
                <br>

               
            </div>
            <div class="col-md-8 col-xs-12">
                <h3> Hasil</h3>
                 <pre style="min-height: 250px">
                 <?php
                foreach ($hasil as $h) {
                    echo '<p>' . $h . '</p>';
                }
                ?>
                </pre>
            </div>
        </div>
        <script type="text/javascript">
            function capitalize(s) {
                return s && s[0].toUpperCase() + s.slice(1);
            }

            function setname() {
                var table_name = document.getElementById('table_name').value.toLowerCase();
                if (table_name != '') {
                    document.getElementById('controller').value = capitalize(table_name);
                    document.getElementById('model').value = capitalize(table_name) + '_model';
                } else {
                    document.getElementById('controller').value = '';
                    document.getElementById('model').value = '';
                }
            }
        </script>
    </body>
</html>

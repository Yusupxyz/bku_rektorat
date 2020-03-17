<script type="text/javascript" src="<?= base_url();?>assets/plugins/iconpicker/js/bootstrap-iconpicker.bundle.min.js"></script>
    
        <script type="text/javascript">
            $('#target').on('change', function(e) {
                        
                $("#icon").val(e.icon);
            });
            $('#id_groups').selectpicker('val', [<?= $id_groupss;?>]);
            console.log(<?= $id_groupss;?>);
           // $("#id_groups").val("1,2");
            function getval(div){
                //console.log($(div).val());
                $("#id_groupss").val($(div).val());
            }
        </script>

<?php 

$string = "<div class=\"row\">
    <div class=\"col-xs-12 col-md-6\">
        <div class=\"box\">
            <div class=\"box-header\">
                <h3 class=\"box-title\"><?= \$button;?> ".ucfirst($table_name)."</h3>
                <div class=\"box-tools pull-right\">
                    <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\" data-toggle=\"tooltip\"
                    title=\"Collapse\">
                    <i class=\"fa fa-minus\"></i></button>
                     <button type=\"button\" class=\"btn btn-box-tool\" onclick=\"location.reload()\" title=\"Collapse\">
              <i class=\"fa fa-refresh\"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class=\"box-body\">
        <form action=\"<?php echo \$action; ?>\" method=\"post\">";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["column_name"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
        </div>";
    } else
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["data_type"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
        </div>";
    }
}
if($isai){


    $string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
}
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a>";
$string .= "\n\t</form>
         </div>
        </div>
    </div>
</div>";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>
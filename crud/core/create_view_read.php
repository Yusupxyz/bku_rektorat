<?php 

$string = "<div class=\"row\">
    <div class=\"col-xs-12 col-md-6\">
        <div class=\"box\">
            <div class=\"box-header\">
                <h3 class=\"box-title\">".label($table_name)." Detail</h3>
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
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn bg-purple\">Cancel</a></td></tr>";
$string .= "\n\t</table>
            </div>
        </div>
    </div>
</div>";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>
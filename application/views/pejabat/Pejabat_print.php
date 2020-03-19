<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Tbl Pejabat</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Pejabat Id</th>
		<th>Pejabat Nama</th>
		<th>Pejabat Jabatan</th>
		<th>Pejabat Nip</th>
		
            </tr><?php
            foreach ($pejabat_data as $pejabat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pejabat->pejabat_id ?></td>
		      <td><?php echo $pejabat->pejabat_nama ?></td>
		      <td><?php echo $pejabat->pejabat_jabatan ?></td>
		      <td><?php echo $pejabat->pejabat_nip ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>
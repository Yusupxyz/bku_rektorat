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
    <h3 align="center">DATA Tbl Nomor Bukti</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nb Id</th>
		<th>Nb No</th>
		<th>Nb Tanggal</th>
		<th>Uraian</th>
		<th>Tbl Pengeluaran</th>
		
            </tr><?php
            foreach ($nomor_bukti_data as $nomor_bukti)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $nomor_bukti->nb_id ?></td>
		      <td><?php echo $nomor_bukti->nb_no ?></td>
		      <td><?php echo $nomor_bukti->nb_tanggal ?></td>
		      <td><?php echo $nomor_bukti->uraian ?></td>
		      <td><?php echo $nomor_bukti->tbl_pengeluaran ?></td>	
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
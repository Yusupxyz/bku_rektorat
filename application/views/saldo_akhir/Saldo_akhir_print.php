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
    <h3 align="center">DATA Tbl Saldo Akhir</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Sak Id</th>
		<th>Sak Jumlah</th>
		<th>Sak Id Bulan</th>
		<th>Sak Id Tahun</th>
		
            </tr><?php
            foreach ($saldo_akhir_data as $saldo_akhir)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $saldo_akhir->sak_id ?></td>
		      <td><?php echo $saldo_akhir->sak_jumlah ?></td>
		      <td><?php echo $saldo_akhir->sak_id_bulan ?></td>
		      <td><?php echo $saldo_akhir->sak_id_tahun ?></td>	
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
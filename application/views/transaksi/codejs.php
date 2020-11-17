<script>
    function confirmdelete(linkdelete) {
        alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
            location.href = linkdelete;
        }, function() {
            alertify.error("Penghapusan data dibatalkan.");
        });
        $(".ajs-header").html("Konfirmasi");
        return false;
    }
    $(':checkbox[name=selectall]').click(function () {
        $(':checkbox[name=id]').prop('checked', this.checked);
    });

    $("#formbulk").on("submit", function () {
        var rowsel = [];
        $.each($("input[name='id']:checked"), function () {
            rowsel.push($(this).val());
        });
        if (rowsel.join(",") == "") {
            alertify.alert('', 'Tidak ada data terpilih!', function () {});

        } else {
            var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?',
                'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
                ok: 'Yakin',
                cancel: 'Batal!'
            }).set('onok', function (closeEvent) {

                $.ajax({
                    url: "transaksi/deletebulk",
                    type: "post",
                    data: "msg = " + rowsel.join(","),
                    success: function (response) {
                        if (response == true) {
                            location.reload();
                        }
                        //console.log(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });
            $(".ajs-header").html("Konfirmasi");
        }
        return false;
    });

    $("#trx_jenis").change(function(){
        if(this.value=='0'){
            document.getElementById("trx_penerimaan").readOnly = false;
            document.getElementById("trx_pengeluaran").value = "0";
            document.getElementById("trx_jml_kotor").readOnly = true;
            document.getElementById("trx_ppn").readOnly = true;
            document.getElementById("trx_pph_21").readOnly = true;
            document.getElementById("trx_pph_22").readOnly = true;
            document.getElementById("trx_pph_23").readOnly = true;
            document.getElementById("trx_pph_4_2").readOnly = true;
            document.getElementById("trx_jml_kotor").value = "0";
            document.getElementById("trx_ppn").value = "0";
            document.getElementById("trx_pph_21").value = "0";
            document.getElementById("trx_pph_22").value = "0";
            document.getElementById("trx_pph_23").value = "0";
            document.getElementById("trx_pph_4_2").value = "0";
        }else if(this.value=='1'){ 
            document.getElementById("trx_penerimaan").readOnly = true;
            document.getElementById("trx_penerimaan").value = "0";
            var ppn=document.getElementById("trx_ppn").value==""?'0':document.getElementById("trx_ppn").value;
            var pph21=document.getElementById("trx_pph_21").value==""?'0':document.getElementById("trx_pph_21").value;
            var pph22=document.getElementById("trx_pph_22").value==""?'0':document.getElementById("trx_pph_22").value;
            var pph23=document.getElementById("trx_pph_23").value==""?'0':document.getElementById("trx_pph_23").value;
            var pph42=document.getElementById("trx_pph_4_2").value==""?'0':document.getElementById("trx_pph_4_2").value;
            var jumlah_kotor=document.getElementById("trx_jml_kotor").value==""?'0':document.getElementById("trx_jml_kotor").value;
            var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(pph22)+parseInt(pph23)+parseInt(pph42);
            var bersih=parseInt(jumlah_kotor)-pajak;
            document.getElementById("trx_jml_bersih").value=bersih;
            document.getElementById("trx_pengeluaran").value=jumlah_kotor;
            document.getElementById("trx_jml_kotor").readOnly = false;
            document.getElementById("trx_ppn").readOnly = false;
            document.getElementById("trx_pph_21").readOnly = false;
            document.getElementById("trx_pph_22").readOnly = false;
            document.getElementById("trx_pph_23").readOnly = false;
            document.getElementById("trx_pph_4_2").readOnly = false;
        }else{
            document.getElementById("trx_penerimaan").readOnly = true;
            document.getElementById("trx_penerimaan").value = "0";
            document.getElementById("trx_pengeluaran").value = "0";
            document.getElementById("trx_jml_kotor").readOnly = true;
            document.getElementById("trx_ppn").readOnly = true;
            document.getElementById("trx_pph_21").readOnly = true;
            document.getElementById("trx_pph_22").readOnly = true;
            document.getElementById("trx_pph_23").readOnly = true;
            document.getElementById("trx_pph_4_2").readOnly = true;
            document.getElementById("trx_jml_kotor").value = "0";
            document.getElementById("trx_ppn").value = "0";
            document.getElementById("trx_pph_21").value = "0";
            document.getElementById("trx_pph_22").value = "0";
            document.getElementById("trx_pph_23").value = "0";
            document.getElementById("trx_pph_4_2").value = "0";
            
        }

    });

    $("#trx_jml_kotor").keyup(function(){
        var jenis=$('select[name=trx_jenis]').val();
        if (jenis=='1'){
            var ppn=document.getElementById("trx_ppn").value==""?'0':document.getElementById("trx_ppn").value;
            var pph21=document.getElementById("trx_pph_21").value==""?'0':document.getElementById("trx_pph_21").value;
            var pph22=document.getElementById("trx_pph_22").value==""?'0':document.getElementById("trx_pph_22").value;
            var pph23=document.getElementById("trx_pph_23").value==""?'0':document.getElementById("trx_pph_23").value;
            var pph42=document.getElementById("trx_pph_4_2").value==""?'0':document.getElementById("trx_pph_4_2").value;
            var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(pph22)+parseInt(pph23)+parseInt(pph42);
            var bersih=parseInt(this.value)-pajak;
            document.getElementById("trx_jml_bersih").value=bersih;
            document.getElementById("trx_pengeluaran").value=this.value;
        }
    });

    $("#trx_ppn").keyup(function(){
        var jenis=$('select[name=trx_jenis]').val();
        if (jenis=='1'){
            var trx_jml_kotor=document.getElementById("trx_jml_kotor").value==""?'0':document.getElementById("trx_jml_kotor").value;
            var pph21=document.getElementById("trx_pph_21").value==""?'0':document.getElementById("trx_pph_21").value;
            var pph22=document.getElementById("trx_pph_22").value==""?'0':document.getElementById("trx_pph_22").value;
            var pph23=document.getElementById("trx_pph_23").value==""?'0':document.getElementById("trx_pph_23").value;
            var pph42=document.getElementById("trx_pph_4_2").value==""?'0':document.getElementById("trx_pph_4_2").value;
            var pajak=parseInt(this.value)+parseInt(pph21)+parseInt(pph22)+parseInt(pph23)+parseInt(pph42);
            var bersih=parseInt(trx_jml_kotor)-pajak;
            document.getElementById("trx_jml_bersih").value=bersih;
            document.getElementById("trx_pengeluaran").value=trx_jml_kotor;
        }
    });

    $("#trx_pph_21").keyup(function(){
        var jenis=$('select[name=trx_jenis]').val();
        if (jenis=='1'){
            var ppn=document.getElementById("trx_ppn").value==""?'0':document.getElementById("trx_ppn").value;
            var trx_jml_kotor=document.getElementById("trx_jml_kotor").value==""?'0':document.getElementById("trx_jml_kotor").value;
            var pph22=document.getElementById("trx_pph_22").value==""?'0':document.getElementById("trx_pph_22").value;
            var pph23=document.getElementById("trx_pph_23").value==""?'0':document.getElementById("trx_pph_23").value;
            var pph42=document.getElementById("trx_pph_4_2").value==""?'0':document.getElementById("trx_pph_4_2").value;
            var pajak=parseInt(ppn)+parseInt(this.value)+parseInt(pph22)+parseInt(pph23)+parseInt(pph42);
            var bersih=parseInt(trx_jml_kotor)-pajak;
            document.getElementById("trx_jml_bersih").value=bersih;
            document.getElementById("trx_pengeluaran").value=trx_jml_kotor;
        }
    });

    $("#trx_pph_22").keyup(function(){
        var jenis=$('select[name=trx_jenis]').val();
        if (jenis=='1'){
            var ppn=document.getElementById("trx_ppn").value==""?'0':document.getElementById("trx_ppn").value;
            var pph21=document.getElementById("trx_pph_21").value==""?'0':document.getElementById("trx_pph_21").value;
            var trx_jml_kotor=document.getElementById("trx_jml_kotor").value==""?'0':document.getElementById("trx_jml_kotor").value;
            var pph23=document.getElementById("trx_pph_23").value==""?'0':document.getElementById("trx_pph_23").value;
            var pph42=document.getElementById("trx_pph_4_2").value==""?'0':document.getElementById("trx_pph_4_2").value;
            var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(this.value)+parseInt(pph23)+parseInt(pph42);
            var bersih=parseInt(trx_jml_kotor)-pajak;
            document.getElementById("trx_jml_bersih").value=bersih;
            document.getElementById("trx_pengeluaran").value=trx_jml_kotor;
        }
    });

    $("#trx_pph_23").keyup(function(){
        var jenis=$('select[name=trx_jenis]').val();
        if (jenis=='1'){
            var ppn=document.getElementById("trx_ppn").value==""?'0':document.getElementById("trx_ppn").value;
            var pph21=document.getElementById("trx_pph_21").value==""?'0':document.getElementById("trx_pph_21").value;
            var pph22=document.getElementById("trx_pph_22").value==""?'0':document.getElementById("trx_pph_22").value;
            var trx_jml_kotor=document.getElementById("trx_jml_kotor").value==""?'0':document.getElementById("trx_jml_kotor").value;
            var pph42=document.getElementById("trx_pph_4_2").value==""?'0':document.getElementById("trx_pph_4_2").value;
            var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(pph22)+parseInt(this.value)+parseInt(pph42);
            var bersih=parseInt(trx_jml_kotor)-pajak;
            document.getElementById("trx_jml_bersih").value=bersih;
            document.getElementById("trx_pengeluaran").value=trx_jml_kotor;
        }
    });

    $("#trx_pph_4_2").keyup(function(){
        var jenis=$('select[name=trx_jenis]').val();
        if (jenis=='1'){
            var ppn=document.getElementById("trx_ppn").value==""?'0':document.getElementById("trx_ppn").value;
            var pph21=document.getElementById("trx_pph_21").value==""?'0':document.getElementById("trx_pph_21").value;
            var pph22=document.getElementById("trx_pph_22").value==""?'0':document.getElementById("trx_pph_22").value;
            var pph23=document.getElementById("trx_pph_23").value==""?'0':document.getElementById("trx_pph_23").value;
            var trx_jml_kotor=document.getElementById("trx_jml_kotor").value==""?'0':document.getElementById("trx_jml_kotor").value;
            var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(pph22)+parseInt(pph23)+parseInt(this.value);
            var bersih=parseInt(trx_jml_kotor)-pajak;
            document.getElementById("trx_jml_bersih").value=bersih;
            document.getElementById("trx_pengeluaran").value=trx_jml_kotor;
        }
    });

    
    $('#bulan').on('change', function() {
        var nb=$('select[name=trx_nomor_bukti]').val();
        if (this.value=="" && nb==""){
            window.location.href = "<?php echo base_url().'transaksi'?>";
        }else if(this.value!="" && nb==""){
            window.location.href = "<?php echo base_url().'transaksi?bulan='?>"+this.value;
        }else if(this.value=="" && nb!=""){
            window.location.href = "<?php echo base_url().'transaksi?nb='?>"+nb;
        }else{
            window.location.href = "<?php echo base_url().'transaksi?bulan='?>"+this.value+"&nb="+nb;
        }
    }); 

    $('#nb').on('change', function() {
        var bulan=$('select[name=trx_bulan]').val();
        if (this.value=="" && bulan==""){
            window.location.href = "<?php echo base_url().'transaksi'?>";
        }else if(this.value!="" && bulan==""){
            window.location.href = "<?php echo base_url().'transaksi?nb='?>"+this.value;
        }else if(this.value=="" && bulan!=""){
            window.location.href = "<?php echo base_url().'transaksi?bulan='?>"+bulan;
        }else{
            window.location.href = "<?php echo base_url().'transaksi?bulan='?>"+bulan+"&nb="+this.value;
        }
    }); 

    $( document ).ready(function() {
        var jenis=$('select[name=trx_jenis]').val();
        if (jenis=='0'){
            document.getElementById("trx_penerimaan").readOnly = false;  
        }else if(jenis=='1'){
            document.getElementById("trx_penerimaan").readOnly = true;
            document.getElementById("trx_penerimaan").value = "0";
            var ppn=document.getElementById("trx_ppn").value==""?'0':document.getElementById("trx_ppn").value;
            var pph21=document.getElementById("trx_pph_21").value==""?'0':document.getElementById("trx_pph_21").value;
            var pph22=document.getElementById("trx_pph_22").value==""?'0':document.getElementById("trx_pph_22").value;
            var pph23=document.getElementById("trx_pph_23").value==""?'0':document.getElementById("trx_pph_23").value;
            var pph42=document.getElementById("trx_pph_4_2").value==""?'0':document.getElementById("trx_pph_4_2").value;
            var jumlah_kotor=document.getElementById("trx_jml_kotor").value==""?'0':document.getElementById("trx_jml_kotor").value;
            var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(pph22)+parseInt(pph23)+parseInt(pph42);
            var bersih=parseInt(jumlah_kotor)-pajak;
            document.getElementById("trx_jml_bersih").value=bersih;
            document.getElementById("trx_pengeluaran").value=jumlah_kotor;
            document.getElementById("trx_jml_kotor").readOnly = false;
            document.getElementById("trx_ppn").readOnly = false;
            document.getElementById("trx_pph_21").readOnly = false;
            document.getElementById("trx_pph_22").readOnly = false;
            document.getElementById("trx_pph_23").readOnly = false;
            document.getElementById("trx_pph_4_2").readOnly = false;
        }
    });



     
</script>
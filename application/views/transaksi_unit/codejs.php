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
                    url: "transaksi_unit/deletebulk",
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

    $("#trxu_jml_kotor").keyup(function(){
        var ppn=document.getElementById("trxu_ppn").value==""?'0':document.getElementById("trxu_ppn").value;
        var pph21=document.getElementById("trxu_pph_21").value==""?'0':document.getElementById("trxu_pph_21").value;
        var pph22=document.getElementById("trxu_pph_22").value==""?'0':document.getElementById("trxu_pph_22").value;
        var pph23=document.getElementById("trxu_pph_23").value==""?'0':document.getElementById("trxu_pph_23").value;
        var pph42=document.getElementById("trxu_pph_4_2").value==""?'0':document.getElementById("trxu_pph_4_2").value;
        var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(pph22)+parseInt(pph23)+parseInt(pph42);
        var bersih=parseInt(this.value)-pajak;
        document.getElementById("trxu_jml_bersih").value=bersih;
    });

    $("#trxu_ppn").keyup(function(){
        var trxu_jml_kotor=document.getElementById("trxu_jml_kotor").value==""?'0':document.getElementById("trxu_jml_kotor").value;
        var pph21=document.getElementById("trxu_pph_21").value==""?'0':document.getElementById("trxu_pph_21").value;
        var pph22=document.getElementById("trxu_pph_22").value==""?'0':document.getElementById("trxu_pph_22").value;
        var pph23=document.getElementById("trxu_pph_23").value==""?'0':document.getElementById("trxu_pph_23").value;
        var pph42=document.getElementById("trxu_pph_4_2").value==""?'0':document.getElementById("trxu_pph_4_2").value;
        var pajak=parseInt(this.value)+parseInt(pph21)+parseInt(pph22)+parseInt(pph23)+parseInt(pph42);
        var bersih=parseInt(trxu_jml_kotor)-pajak;
        document.getElementById("trxu_jml_bersih").value=bersih;
    });

    $("#trxu_pph_21").keyup(function(){
        var ppn=document.getElementById("trxu_ppn").value==""?'0':document.getElementById("trxu_ppn").value;
        var trxu_jml_kotor=document.getElementById("trxu_jml_kotor").value==""?'0':document.getElementById("trxu_jml_kotor").value;
        var pph22=document.getElementById("trxu_pph_22").value==""?'0':document.getElementById("trxu_pph_22").value;
        var pph23=document.getElementById("trxu_pph_23").value==""?'0':document.getElementById("trxu_pph_23").value;
        var pph42=document.getElementById("trxu_pph_4_2").value==""?'0':document.getElementById("trxu_pph_4_2").value;
        var pajak=parseInt(ppn)+parseInt(this.value)+parseInt(pph22)+parseInt(pph23)+parseInt(pph42);
        var bersih=parseInt(trxu_jml_kotor)-pajak;
        document.getElementById("trxu_jml_bersih").value=bersih;
    });

    $("#trxu_pph_22").keyup(function(){
        var ppn=document.getElementById("trxu_ppn").value==""?'0':document.getElementById("trxu_ppn").value;
        var pph21=document.getElementById("trxu_pph_21").value==""?'0':document.getElementById("trxu_pph_21").value;
        var trxu_jml_kotor=document.getElementById("trxu_jml_kotor").value==""?'0':document.getElementById("trxu_jml_kotor").value;
        var pph23=document.getElementById("trxu_pph_23").value==""?'0':document.getElementById("trxu_pph_23").value;
        var pph42=document.getElementById("trxu_pph_4_2").value==""?'0':document.getElementById("trxu_pph_4_2").value;
        var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(this.value)+parseInt(pph23)+parseInt(pph42);
        var bersih=parseInt(trxu_jml_kotor)-pajak;
        document.getElementById("trxu_jml_bersih").value=bersih;
    });

    $("#trxu_pph_23").keyup(function(){
        var ppn=document.getElementById("trxu_ppn").value==""?'0':document.getElementById("trxu_ppn").value;
        var pph21=document.getElementById("trxu_pph_21").value==""?'0':document.getElementById("trxu_pph_21").value;
        var pph22=document.getElementById("trxu_pph_22").value==""?'0':document.getElementById("trxu_pph_22").value;
        var trxu_jml_kotor=document.getElementById("trxu_jml_kotor").value==""?'0':document.getElementById("trxu_jml_kotor").value;
        var pph42=document.getElementById("trxu_pph_4_2").value==""?'0':document.getElementById("trxu_pph_4_2").value;
        var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(pph22)+parseInt(this.value)+parseInt(pph42);
        var bersih=parseInt(trxu_jml_kotor)-pajak;
        document.getElementById("trxu_jml_bersih").value=bersih;
    });

    $("#trxu_pph_4_2").keyup(function(){
        var ppn=document.getElementById("trxu_ppn").value==""?'0':document.getElementById("trxu_ppn").value;
        var pph21=document.getElementById("trxu_pph_21").value==""?'0':document.getElementById("trxu_pph_21").value;
        var pph22=document.getElementById("trxu_pph_22").value==""?'0':document.getElementById("trxu_pph_22").value;
        var pph23=document.getElementById("trxu_pph_23").value==""?'0':document.getElementById("trxu_pph_23").value;
        var trxu_jml_kotor=document.getElementById("trxu_jml_kotor").value==""?'0':document.getElementById("trxu_jml_kotor").value;
        var pajak=parseInt(ppn)+parseInt(pph21)+parseInt(pph22)+parseInt(pph23)+parseInt(this.value);
        var bersih=parseInt(trxu_jml_kotor)-pajak;
        document.getElementById("trxu_jml_bersih").value=bersih;
    });
     
</script>
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

    $("#trx_jml_kotor2").change(function(){
        var uang=document.getElementById('trx_jml_kotor2').value;
        var ppn=0,pph21=0, pph22=0, pph23=0, pph42=0;
        document.getElementById('trx_jml_kotor').value = uang;
        if (uang>1500000){
            ppn = (uang/11).toFixed(0); 
        }
        if (uang>2000000){
            pph22 = (ppn*0.15).toFixed(0); 
        } 
        pph23=(ppn*0.02).toFixed(0);
        document.getElementById('trx_ppn').value = parseInt(ppn).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        document.getElementById('trx_pph_21').value = parseInt(pph21).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
        document.getElementById('trx_pph_22').value = parseInt(pph22).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
        document.getElementById('trx_pph_23').value = parseInt(pph23).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
        document.getElementById('trx_pph_4_2').value = parseInt(pph42).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
        uang = parseInt(uang).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
        $('input[name=trx_jml_kotor2]').val(uang);

    });
     

    $('#buku').on('change', function() {
        var bulan = $("#bulan option:selected").val();
        if (this.value==""){
            window.location.href = "<?php echo base_url().'buku'?>";
        }else{
            window.location.href = "<?php echo base_url().'buku?buku='?>"+this.value+"&bulan="+bulan;
        }
    });

    $('#bulan').on('change', function() {
        var buku = $("#buku option:selected").val();
        if (this.value==""){
            window.location.href = "<?php echo base_url().'buku'?>";
        }else{
            window.location.href = "<?php echo base_url().'buku?buku='?>"+buku+"&bulan="+this.value;
        }
    });
</script>
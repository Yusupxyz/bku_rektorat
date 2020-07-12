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

 
     

    $('#buku').on('change', function() {
        var bulan = $("#bulan option:selected").val();
        var unit = $("#unit option:selected").val();
        if (this.value==""){
            window.location.href = "<?php echo base_url().'buku'?>";
        }else if(this.value=="bku_unit"){
            window.location.href = "<?php echo base_url().'buku?buku='?>"+this.value+"&bulan="+bulan+"&unit="+unit;
        }else{
            window.location.href = "<?php echo base_url().'buku?buku='?>"+this.value+"&bulan="+bulan;
        }
    });

    $('#bulan').on('change', function() {
        var buku = $("#buku option:selected").val();
        var unit = $("#unit option:selected").val();
        if (this.value==""){
            window.location.href = "<?php echo base_url().'buku'?>";
        }else if(buku=="bku_unit"){
            window.location.href = "<?php echo base_url().'buku?buku='?>"+buku+"&bulan="+this.value+"&unit="+unit;
        }else{
            window.location.href = "<?php echo base_url().'buku?buku='?>"+buku+"&bulan="+this.value;
        }
    });

    $('#unit').on('change', function() {
        var buku = $("#buku option:selected").val();
        var bulan = $("#bulan option:selected").val();
        if (this.value==""){
            window.location.href = "<?php echo base_url().'buku'?>";
        }else{
            window.location.href = "<?php echo base_url().'buku?buku='?>"+buku+"&bulan="+bulan+"&unit="+this.value;
        }
    });

    <?php if ($this->input->get('buku')=="bku_unit") { ?>
        var x = document.getElementById("my_div");
        var selectedText = $("#unit option:selected").html();
            x.style.display = "block";
            $("#top").html("FAKULTAS/UNIT "+selectedText.toUpperCase());
    <?php } ?>
</script>
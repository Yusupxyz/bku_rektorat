<script type="text/javascript">

            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").DataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode != 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    scrollCollapse : true,
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "kegiatan/json", "type": "POST"},
                    columns: [
                        {
                            "className":      'details-control',
                            "orderable":      false,
                            "id" : '1st',
                            "defaultContent": '',
                            "data": "id_kegiatan"
                        },
                        {
                            "data": "id_kegiatan",
                            "orderable": false
                        },
                        {
                            "data": "kode_kegiatan"
                        },
                        {"data": "nama_kegiatan"},{"data": "volume"},{"data": "satuan"},{"data": "jumlah"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[1, 'asc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(1)', row).html(index);
                        var rupiah = formatRupiah(data.jumlah, 'Rp. ' );
                        $('td:eq(6)', row).html(rupiah);
                    }
                });

                $('#mytable tbody').on('click', 'td.details-control', function () {
                    
                    var tr = $(this).closest('tr');
                    var row = t.row( tr );
                    console.log(row);
            
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }else {
                        // Open this row
                        row.child( format(row.data()) ).show();
                        $("#"+row.data().kode_legiatan).DataTable();

                        tr.addClass('shown');
                        var t2= $("#"+row.data().kode_kegiatan).DataTable();
                       
                        $('#mytable tbody').on('click', 'td.details-control2', function () {
                            var tr2 = $(this).closest('tr');
                            var row2 = t2.row( tr2 );
                            if ( row2.child.isShown() ) {
                                alert("y"); 
                                row2.child.hide();
                                tr2.removeClass('shown');
                            }else {
                                // Open this row
                                row2.child( format2(row2.data()) ).show();
                                tr2.addClass('shown');
                            }
                        });
                    }
                });

               
                
                function format ( d ) {
                var data2;
                $.ajax({
						url : "<?php echo base_url() . 'kegiatan_sub/json/'; ?>"+d.id_kegiatan,
						method : "POST",
						async : false,
						dataType : 'json',
						success: function(data){
							// console.log(data);
                            data2=data;
					}
				});

                return '<table style="align:left" id="'+d.kode_kegiatan+'" class="table table-bordered table-striped" cellpadding="10" cellspacing="0" border="1px" style="padding-left:50px;">'+
                    '<tr >'+
                        '<td align="left" class="details-control2" width="65"></td>'+
                        '<td>'+data2.data[0].kode_kegiatan+'</td>'+
                        '<td>'+data2.data[0].nama_kegiatan+'</td>'+
                        '<td>'+data2.data[0].volume+'</td>'+
                        '<td>'+data2.data[0].satuan+'</td>'+
                        '<td>'+data2.data[0].jumlah+'</td>'+
                        '<td>'+data2.data[0].action+'</td>'+
                    '</tr>'+
                    '</table>';

            }
            function format2 ( d ) {
                var data2;
                $.ajax({
						url : "<?php echo base_url() . 'kegiatan_sub/json/2'; ?>",
						method : "POST",
						async : false,
						dataType : 'json',
						success: function(data){
							console.log(data);
                            data2=data;
					}
				});

                return '<table style="align:left" id="baba" class="table table-bordered table-striped" cellpadding="10" cellspacing="0" border="1px" style="padding-left:50px;">'+
                    '<tr >'+
                        
                    '</tr>'+
                    '</table>';

            }

            
               

                $('#myform').keypress(function(e){
                    if ( e.which == 13 ) return false;
                   
                });
                 $("#myform").on('submit', function(e){
                    var form = this
                    var rowsel = t.column(0).checkboxes.selected();
                    $.each(rowsel, function(index, rowId){
                        $(form).append(
                            $('<input>').attr('type','hidden').attr('name','id[]').val(rowId)
                        )
                    });
                    
                    if(rowsel.join(",") == ""){
                        alertify.alert('', 'Tidak ada data terpilih!', function(){ });

                    }else{
                        var prompt =  alertify.confirm('Apakah anda yakin akan menghapus data tersebut?', 'Apakah anda yakin akan menghapus data tersebut?').set('labels', {ok:'Yakin', cancel:'Batal!'}).set('onok',function(closeEvent){ 
                            $.ajax({
                                url: "kegiatan/deletebulk",
                                type: "post",
                                data: "msg = "+rowsel.join(",") ,
                                success: function (response) {
                                    if(response == true){
                                        location.reload();
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                   console.log(textStatus, errorThrown);
                                }
                            });

                        });
                    }
                    $(".ajs-header").html("Konfirmasi");
                });
            });
            function confirmdelete(linkdelete) {
                alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
                    location.href = linkdelete;
                }, function() {
                    alertify.error("Penghapusan data dibatalkan.");
                });
                $(".ajs-header").html("Konfirmasi");
                return false;
            }

            function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
 
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            $(document).ready(function() {
            setTimeout(function(){
                var word = document.getElementsByClassName('details-control');
                    var total_words = 0;
                    for (i = 0; i < word.length; i++) {
                        total_words += word[i].innerHTML.trim().split(' ').length;
                        document.getElementsByClassName("details-control")[i].innerHTML ="";
                    }
            },400);
            });
            

        </script>
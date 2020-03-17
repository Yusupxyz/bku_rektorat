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
                    ajax: {"url": "groups/json", "type": "POST"},
                    columns: [
                         {
                            "data": "id",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        {
                            "data": "id",
                            "orderable": false
                        },{"data": "name"},{"data": "description"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    columnDefs: [
                        {   
                            className: "text-center",
                            targets: 0,
                            checkboxes: {
                                selectRow: true,
                            }
                        }

                    ],
                    select:{
                        style: 'multi'
                    },
                    order: [[1, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(1)', row).html(index);
                    }
                });
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
                                url: "groups/deletebulk",
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
        </script>
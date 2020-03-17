 <form id="myform" method="post" onsubmit="return false">

           <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12 col-md-4">
                <?php echo anchor(site_url('groups/create'), '<i class="fa fa-plus"></i> Tambah', 'class="btn bg-purple"'); ?>

            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 text-right">
         <?php echo anchor(site_url('groups/printdoc'), '<i class="fas fa-print"></i> Print', 'class="btn bg-maroon"'); ?>           
        <?php echo anchor(site_url('groups/excel'), '<i class="fas fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>
        <?php echo anchor(site_url('groups/word'), '<i class="fas fa-file-word"></i> Word', 'class="btn btn-primary"'); ?>

        </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered table-striped" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <th width=""></th>
                    <th width="80px">No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="200px" class="">Action</th>
                </tr>
            </thead>
        
        </table>
        </div>
        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>
</form>
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
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    stateSave: true,
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
                        },
                        {"data": "name"},
                        {"data": "description"},
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
                 $("#myform").on('submit', function(e){
                    var form = this
                    var rowsel = t.column(0).checkboxes.selected();
                    $.each(rowsel, function(index, rowId){
                        $(form).append(
                            $('<input>').attr('type','hidden').attr('name','id[]').val(rowId)
                        )
                    })
                    //$("#view-rows").text(rowsel.join(","))
                    //alert(rowsel.join(","));

                    $.ajax({
                        url: "groups/deletebulk",
                        type: "post",
                        data: "msg = "+rowsel.join(",") ,
                        success: function (response) {
                           // you will get response from your php page (what you echo or print)                 
                           //console.log(response);
                            if(response == true){
                                location.reload();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


                    });
                   // return false;
                })
            });
            
        </script>
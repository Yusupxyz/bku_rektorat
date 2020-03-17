<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List Menu</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
              <i class="fa fa-refresh"></i></button>
          </div>
      </div>

      <div class="box-body">
     
        <form id="myform" method="post" onsubmit="return false">

           <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12 col-md-4">
                <?php echo anchor(site_url('menu/create'), '<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    
                </div>
            </div>
            <div class="col-xs-12 col-md-4 text-right">
                <?php echo anchor(site_url('menu/printdoc'), '<i class="fas fa-print"></i> Print', 'class="btn bg-maroon"'); ?>
                <?php echo anchor(site_url('cms/menu/side-menu'), '<i class="fas fa-sort-amount-down"></i> Sorting Menu', 'class="btn bg-primary"'); ?>
                
	    
         </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered table-striped" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <th width=""></th>
                    <th width="10px">No</th>
                    <th width="80px">Action</th>
        		    <th>Parent Id</th>
        		    <th>Icon</th>
        		    <th>Label</th>
        		    <th>Link</th>
        		    <th>Id</th>
        		    <th>Type</th>
		    
                </tr>
            </thead>
	    
        </table>
         </div>
        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>
        </form>

      </div>
    </div>
  </div>
</div>
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
                    ajax: {"url": "menu/json", "type": "POST"},
                    columns: [
                         {
                            "data": "id_menu",
                            "orderable": false,
                            "className" : "text-center"
                        },
                        {
                            "data": "id_menu",
                            "orderable": false
                        },
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        },{"data": "parent_id"},{"data": "icon"},{"data": "label"},{"data": "link"},{"data": "id"},{"data": "type"}
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
                    })
                    
                    $.ajax({
                        url: "menu/deletebulk",
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
                })
            });
            
        </script>
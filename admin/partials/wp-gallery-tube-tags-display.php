<?php 


function deleteTag($id) {
    global $wpdb;
    if ($wpdb->get_row("SELECT * FROM ".$wpdb->prefix."gallery_tube_tags  where id= ".$id." ;")) {
        return $wpdb->delete($wpdb->prefix."gallery_tube_tags", array("id" => $id));
    } else return false;
}
function updateTag($id, $data) {
    global $wpdb;
    if ( $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."gallery_tube_tags  where id= ".$id." ;")) {
        
        return $wpdb->update($wpdb->prefix."gallery_tube_tags", $data , array("id" => $id) );
    } else return false;
}

$success="";
$error="";

if (isset($_POST['delete_tag']) && isset($_POST['tag_id'])) {
    $res = deleteTag(intval($_POST['tag_id']));
    if ($res) {
        $success="Deleted Tag Successfully !";
    } else {
        $error = "Failed to delete Tag";
    }
}


if (isset($_POST['update_tag']) && isset($_POST['tag_id'])) {
    $tag_id =   intval($_POST['tag_id']);
    $tag_name = trim($_POST['tag_name']);
    

    if ($tag_id && $tag_name) {
        $res = updateTag($tag_id, array('name' => $tag_name) );
        if ($res) {
            $success="Updated Tag Successfully !";
        } else {
            $error = "Failed to Update Tag";
        }
    } else {
        $error = "You must specific the tag name";
    }

}

?>



<link href="<?=plugin_dir_url( dirname( __FILE__ ) )?>/css/bootstrap.min.css" rel="stylesheet" />
<!--  Material Dashboard CSS    -->
<link href="<?=plugin_dir_url( dirname( __FILE__ ) )?>/css/material-dashboard.css?v=1.2.1" rel="stylesheet" />
<!--  CSS for Demo Purpose, don't include it in your project     -->
<link href="<?=plugin_dir_url( dirname( __FILE__ ) )?>/css/demo.css" rel="stylesheet" />
<!--     Fonts and icons     -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Classic Modal -->
<div class="modal fade" id="tagDetail" tabindex="-1" role="dialog" aria-labelledby="tagDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action=""  id="tag-form" onsubmit="return confirm('Update Tag?');">

                <input type="hidden" name="tag_id" id="tag_id" class="form-control" value="">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                    <h4 class="modal-title">Tag</h4>
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tag Name: </label>
                        <input type="text" name="tag_name" id="tag_name" class="form-control" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Update Tag" name="update_tag" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid row">
    <div class="col-md-12">
        <div class="card" style="max-width: 100%;">

            <div class="card-content">
                <h4 class="card-title alert alert-info">Tag List</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="disabled-sorting text-left">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="disabled-sorting text-left">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row -->

<!--   Core JS Files   -->
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/material.min.js" type="text/javascript"></script>
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/perfect-scrollbar.jquery.min.js" type="text/javascript">
</script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/moment.min.js"></script>

<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/bootstrap-notify.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/bootstrap-datetimepicker.js"></script>


<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/sweetalert2.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?=plugin_dir_url( dirname( __FILE__ ) )?>/js/jasny-bootstrap.min.js"></script>

<script>
    <?php if ($error) { ?>

        $.notify({
            icon: "error",
            message: "<?= $error ?>"

        }, {
            type: "danger",
            timer: 10000,
            placement: {
                from: "top",
                align: "center"
            }
        });

    <?php } ?>
    <?php if ($success) { ?>
        $.notify({
            icon: "check_circle",
            message: "<?= $success ?>"

        }, {
            type: "success",
            timer:5000,
            placement: {
                from: "top",
                align: "center"
            }
        });
    <?php } ?>
</script>

<script type="text/javascript">
    var ktable;
    $(document).ready(function () {
        buttons = '';
        ktable = $('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?=home_url('/wp-admin/admin-ajax.php?action=gallery_tube_get_tags')?>',
                "method": "POST"
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "searchable": false
            }, {
                "targets": [1],
                "searchable": true,
            }, {
                "targets": -1,
                "data": [2]
            }],
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });
    });
    
    $(document).on('click', '.delete', function () {
        let tag_id = $(this).data('id')
        if (tag_id) {
            swal({
                title: 'Are you sure to delete?',
                html: '<div class="alert alert-warning" >This action can not be undo !</div><form action="" method="post" id="delete-form"><div class="form-group">' +
                    '<input name="tag_id" type="hidden" value="' + tag_id + '" />' +
                    '<input name="delete" type="hidden"  value="delete" />' +
                    '</div></form>',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success btn-fill',
                cancelButtonClass: 'btn btn-danger btn-fill',
                confirmButtonText: 'Yes',
                buttonsStyling: false
            }).then(function () {
                $('#delete-form').submit();
            })
        } else {
            swal({
                title: 'error!',
                text: 'Failed to delete Tag ',
                type: 'error',
                confirmButtonClass: "btn btn-success btn-fill",
                buttonsStyling: false
            })
        }
    })


    $(document).on('click', '.view', function(){
        let tag_id = $(this).data('id')
        if (tag_id) {
            $('#tag_id').val(tag_id);
             
            tag_name = (ktable.row($(this).closest('tr')).data()[1]) ;
            
            $('#tag_name').val(tag_name);            

            $('#tagDetail').modal();

        } else {
            swal({
                title: 'error!',
                text: 'Failed to update Tag ',
                type: 'error',
                confirmButtonClass: "btn btn-success btn-fill",
                buttonsStyling: false
            })
        }
    })
</script>
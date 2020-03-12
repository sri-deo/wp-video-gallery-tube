<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/admin/partials
 */




if (isset($_POST['settings'])) {

    update_option('blur',isset($_POST['blur'])?1:0);
	update_option('czechvr',isset($_POST['czechvr'])?1:0);
	update_option('naughtyamerica',isset($_POST['naughtyamerica'])?1:0);
	update_option('badoink',isset($_POST['badoink'])?1:0);
    update_option('vrbcash',isset($_POST['vrbcash'])?1:0);
    
}


$is_blur = get_option('blur');
$czechvr = get_option('czechvr');
$naughtyamerica = get_option('naughtyamerica');
$badoink = get_option('badoink');
$vrbcash = get_option('vrbcash');

function deleteScene($id) {
    global $wpdb;
    if ($wpdb->get_row("SELECT * FROM ".$wpdb->prefix."gallery_tube  where id= ".$id." ;")) {
        return $wpdb->query("DELETE FROM ".$wpdb->prefix."gallery_tube WHERE id=".$id." ;");
    }
}

$success="";
$error="";

if (isset($_POST['save_affiliate'])) {
    if (trim($_POST['save_affiliate'])) {
        update_option("affiliate_code", trim($_POST['save_affiliate']));
    }
}

if (isset($_POST['delete_scene']) && isset($_POST['scene_id'])) {
    $res = deleteScene(intval($_POST['scene_id']));
    if ($res) {
        $success="Deleted Scene Successfully !";
    } else {
        $error = "Failed to delete Scene";
    }
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="max-width:100%;">
                <form action="" method="post">
                    <?php  if (!get_option("first_insert")) {  ?>
                    <input type="submit" value="Start First Raw Insert" name="sub" class="btn btn-warning">
                    <?php } ?>
                </form>
                <div></div>
                <form action="">

                    <div class="form-group">
                      <label for="affilicate_code">Affiliate Code</label>
                      <input type="test" value="<?=get_option('affiliate_code')?>" name="affilicate_code" id="affilicate_code" class="form-control" placeholder="Affiliate Code" aria-describedby="affiliate_help">
                      <small id="affiliate_help" class="text-muted">Affiliate Code in each Scene Link</small>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-success" name="save_affiliate">
                    </div>

                </form>
                <form action="" method="post">
                    <input type="submit" value="Update JSON Data " name="update_json" class="btn btn-primary" >
                </form>

                <form action="" method="post">
                    <div class="form-group">
                      <label for="">Csv File Data Import</label>
                      <input type="file" name="csv_file_import" id="csv_file_import" class="form-control" placeholder="Csv File" aria-describedby="csv_help">
                      
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php 



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


<div class="container-fluid row">
    <div class="col-md-12">
        <div class="card" style="max-width: 100%;">

            <div class="card-content">
                <h4 class="card-title alert alert-info">Scenes List</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="disabled-sorting">Preview Image</th>
                                <th>Identity</th>
                                <th>Release Date</th>
                                <th>Video Length</th>
                                <th>Date Created</th>
                                <th class="disabled-sorting text-left">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th class="disabled-sorting">Preview Image</th>
                                <th>Identity</th>
                                <th>Release Date</th>
                                <th>Video Length</th>
                                <th>Date Created</th>
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



<script type="text/javascript">
    $(document).ready(function () {
        buttons = "";
        $('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?=home_url('/wp-admin/admin-ajax.php?action=gallery_tube_get_tubes')?>',
                "method": "POST",
                dataFilter: function (response) {
                    response = JSON.parse(response);
                    response.data = response.data.map(o => {
                        o[1] = o[1] ?
                            `<img src="${o[1]}" style="height:40px;width:auto;">` :
                            `<img style="height:40px;width:auto;" src="<?=plugin_dir_url(dirname( __FILE__ )).'img/thumbnail-img.jpg'?>">`;
                        return o;
                    })

                    return JSON.stringify(response);
                }
            },
            "order": [
                [5, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],

                "searchable": false
            }, {
                "targets": [1],

                "searchable": false,

            }, {
                "targets": [2],

                "searchable": true,

            }, {
                "targets": [3],

                "searchable": true,

            }, {
                "targets": [4],

            }, {
                "targets": [5],


            }, {
                "targets": -1,
                "data": [6],

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
        let scene_id = $(this).data('id')
        if (scene_id) {
            swal({
                title: 'Are you sure to delete?',
                html: '<div class="alert alert-warning" >This action can not be undo !</div><form action="" method="post" id="delete-form"><div class="form-group">' +
                    '<input name="scene_id" type="hidden" value="' + scene_id + '" />' +
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
                text: 'Failed to delete Scene ',
                type: 'error',
                confirmButtonClass: "btn btn-success btn-fill",
                buttonsStyling: false
            })
        }
    })
</script>
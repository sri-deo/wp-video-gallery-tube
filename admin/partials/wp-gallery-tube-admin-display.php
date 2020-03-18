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
    } else return null;
}

function updateScene($data, $id) {
    global $wpdb;
    if ($wpdb->get_row("SELECT * FROM ".$wpdb->prefix."gallery_tube  where id= ".$id." ;")) {
        return $wpdb->update($wpdb->prefix."gallery_tube", $data, array("id" => ($id) ) );
    } else return null;
}

$success="";
$error="";

if (isset($_POST['save_affiliate'])) {
    $af_badoink_param = trim($_POST['af_badoink_param']);
    $affiliate_code_badoink = trim($_POST['affiliate_code_badoink']);

    $af_vrbanger_param = trim($_POST['af_vrbanger_param']);
    $affiliate_code_vrbanger = trim($_POST['affiliate_code_vrbanger']);

    $af_rjvr_param = trim($_POST['af_rjvr_param']);
    $affiliate_code_rjvr = trim($_POST['affiliate_code_rjvr']);

    $af_sexbabevr_param = trim($_POST['af_sexbabesvr_param']);
    $affiliate_code_sexbabevr = trim($_POST['affiliate_code_sexbabesvr']);

    $af_stasyqvr_param = trim($_POST['af_stasyqvr_param']);
    $affiliate_code_stasyqvr = trim($_POST['affiliate_code_stasyqvr']);

    $af_vrconk_param = trim($_POST['af_vrconk_param']);
    $affiliate_code_vrconk = trim($_POST['affiliate_code_vrconk']);

    update_option("af_badoink_param", $af_badoink_param);
    update_option("affiliate_code_badoink", $affiliate_code_badoink);

    update_option("af_vrbanger_param", $af_vrbanger_param);
    update_option("affiliate_code_vrbanger", $affiliate_code_vrbanger);

    update_option("af_rjvr_param", $af_rjvr_param);
    update_option("affiliate_code_rjvr", $affiliate_code_rjvr);

    update_option("af_sexbabesvr_param", $af_sexbabevr_param);
    update_option("affiliate_code_sexbabesvr", $affiliate_code_sexbabevr);

    update_option("af_stasyqvr_param", $af_stasyqvr_param);
    update_option("affiliate_code_stasyqvr", $affiliate_code_stasyqvr);

    update_option("af_vrconk_param", $af_vrconk_param);
    update_option("affiliate_code_vrconk", $affiliate_code_vrconk);

}


if (isset($_POST['update_scene']) && isset($_POST['scene_id'])) {
    $scene_id = intval($_POST['scene_id']);
    $title = trim($_POST['scene_title']);
    $video_length = $_POST['video_length'];
    $description = trim($_POST['description']);
    $video_url = trim($_POST['video_url']);
    $fps = $_POST['fps'];
    $degrees = $_POST['degrees'];


    $res = updateScene(array(
        'title' => $title,
        'video_length' => $video_length,
        'description' => $description,
        'video_url' => $video_url,
        'fps' => $fps,
        'degrees' => $degrees
    ), $scene_id);

    if ($res) {
        $success="Updated Scene Successfully !";
    } else {
        $error = "Failed to update Scene";
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
<style>
.card-custom {
    max-width:100%;
    margin-bottom:0px!important;
}
</style>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container-fluid">
    
    <div class="row">

        <div class="col-md-12">
            <div class="card" style="max-width:100%;">
            <h2>Settings</h2>
                <form action="" method="post">
                    <?php  if (!get_option("first_insert")) {  ?>
                    <input type="submit" value="Start First Raw Insert" name="sub" class="btn btn-warning">
                    <?php } ?>
                </form>
                <div></div>
                <form action="" method="POST">
                    <div class="row card card-custom">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="af_badoink_param"></label>
                                <input type="test" value="<?=get_option('af_badoink_param')?>" name="af_badoink_param" id="af_badoink_param" class="form-control" placeholder="Affiliate Parameter Badoink" aria-describedby="affiliate_help">
                                <small id="affiliate_help_badoink_param" class="text-muted">Affiliate Parameter in URL Badoink Source</small><br>
                                <small>Preview : www.badoinkvr.com/video/example_video_url_xxx?<?=get_option('af_badoink_param')?>=<?=get_option('affiliate_code_badoink')?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="affiliate_code_badoink"></label>
                                <input type="test" value="<?=get_option('affiliate_code_badoink')?>" name="affiliate_code_badoink" id="affiliate_code_badoink" class="form-control" placeholder="Affiliate Code Badoink" aria-describedby="affiliate_help">
                                <small id="aff_badoink_help" class="text-muted">Affiliate Code in each Scene URL Badoink Source</small>
                            </div>
                        </div>
                    </div>
                    <div class="row card card-custom">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="af_vrbanger_param"></label>
                                <input type="test" value="<?=get_option('af_vrbanger_param')?>" name="af_vrbanger_param" id="af_vrbanger_param" class="form-control" placeholder="Affiliate Parameter VRBanger" aria-describedby="affiliate_help">
                                <small id="affiliate_help_vrbanger_param" class="text-muted">Affiliate Parameter in URL VRBanger Source</small><br>
                                <small>Preview : https://vrbangers.com/video/example_video_url_xxx?<?=get_option('af_vrbanger_param')?>=<?=get_option('affiliate_code_vrbanger')?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="affiliate_code_vrbanger"></label>
                                <input type="test" value="<?=get_option('affiliate_code_vrbanger')?>" name="affiliate_code_vrbanger" id="affiliate_code_vrbanger" class="form-control" placeholder="Affiliate Code VRBanger" aria-describedby="affiliate_help">
                                <small id="aff_vrbanger_help" class="text-muted">Affiliate Code in each Scene URL VRBanger Source</small>
                            </div>
                        </div>
                    </div>
                    <div class="row card card-custom">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="af_rjvr_param"></label>
                                <input type="test" value="<?=get_option('af_rjvr_param')?>" name="af_rjvr_param" id="af_rjvr_param" class="form-control" placeholder="Affiliate Parameter RealJamVR" aria-describedby="affiliate_help">
                                <small id="affiliate_help_rjvr_param" class="text-muted">Affiliate Parameter in URL RealJamVR Source</small><br>
                                <small>Preview : https://www.realjamvr.com/virtualreality/scene/id/example_video_url_xxx?<?=get_option('af_rjvr_param')?>=<?=get_option('affiliate_code_rjvr')?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="affiliate_code_rjvr"></label>
                                <input type="test" value="<?=get_option('affiliate_code_rjvr')?>" name="affiliate_code_rjvr" id="affiliate_code_rjvr" class="form-control" placeholder="Affiliate Code RealJamVR" aria-describedby="affiliate_help">
                                <small id="aff_rjvr_help" class="text-muted">Affiliate Code in each Scene URL RealJamVR Source</small>
                            </div>
                        </div>
                    </div>
                    <div class="row card card-custom">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="af_sexbabesvr_param"></label>
                                <input type="test" value="<?=get_option('af_sexbabesvr_param')?>" name="af_sexbabesvr_param" id="af_sexbabesvr_param" class="form-control" placeholder="Affiliate Parameter SexBabeVR" aria-describedby="affiliate_help">
                                <small id="affiliate_help_sexbabevr_param" class="text-muted">Affiliate Parameter in URL SexBabeVR Source</small><br>
                                <small>Preview : https://www.sexbabesvr.com/virtualreality/scene/id/example_video_url_xxx?<?=get_option('af_sexbabesvr_param')?>=<?=get_option('affiliate_code_sexbabesvr')?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="affiliate_code_sexbabesvr"></label>
                                <input type="test" value="<?=get_option('affiliate_code_sexbabesvr')?>" name="affiliate_code_sexbabesvr" id="affiliate_code_sexbabesvr" class="form-control" placeholder="Affiliate Code SexBabeVR" aria-describedby="affiliate_help">
                                <small id="aff_sexbabevr_help" class="text-muted">Affiliate Code in each Scene URL SexBabeVR Source</small>
                            </div>
                        </div>
                    </div>


                    <div class="row card card-custom">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="af_stasyqvr_param"></label>
                                <input type="test" value="<?=get_option('af_stasyqvr_param')?>" name="af_stasyqvr_param" id="af_stasyqvr_param" class="form-control" placeholder="Affiliate Parameter StasyQVR" aria-describedby="affiliate_help">
                                <small id="affiliate_help_stasyqvr_param" class="text-muted">Affiliate Parameter in URL StasyQVR Source</small><br>
                                <small>Preview : https://www.stasyqvr.com/virtualreality/scene/id/example_video_url_xxx?<?=get_option('af_stasyqvr_param')?>=<?=get_option('affiliate_code_stasyqvr')?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="affiliate_code_stasyqvr"></label>
                                <input type="test" value="<?=get_option('affiliate_code_stasyqvr')?>" name="affiliate_code_stasyqvr" id="affiliate_code_stasyqvr" class="form-control" placeholder="Affiliate Code StasyQVR" aria-describedby="affiliate_help">
                                <small id="aff_stasyqvr_help" class="text-muted">Affiliate Code in each Scene URL StasyQVR Source</small>
                            </div>
                        </div>
                    </div>

                    <div class="row card card-custom">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="af_vrconk_param"></label>
                                <input type="test" value="<?=get_option('af_vrconk_param')?>" name="af_vrconk_param" id="af_vrconk_param" class="form-control" placeholder="Affiliate Parameter VRConk" aria-describedby="affiliate_help">
                                <small id="affiliate_help_vrconk_param" class="text-muted">Affiliate Parameter in URL VRConk Source</small><br>
                                <small>Preview : https://vrconk.com/virtualreality/scene/id/example_video_url_xxx?<?=get_option('af_vrconk_param')?>=<?=get_option('affiliate_code_vrconk')?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="affiliate_code_vrconk"></label>
                                <input type="test" value="<?=get_option('affiliate_code_vrconk')?>" name="affiliate_code_vrconk" id="affiliate_code_vrconk" class="form-control" placeholder="Affiliate Code VRConk" aria-describedby="affiliate_help">
                                <small id="aff_vrconk_help" class="text-muted">Affiliate Code in each Scene URL VRConk Source</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row text-right">
                        <div class="col-md-12">
                            <input type="submit" value="Save" class="btn btn-success" name="save_affiliate">
                        </div>
                    </div>

                </form>
                <form action="" method="post">
                    <input type="submit" value="Update JSON Data " name="update_json" class="btn btn-primary" >
                </form>

                <form action="" method="post">
                    <div class="form-group">
                      <!-- <label for="">Csv File Data Import</label>
                      <input type="file" name="csv_file_import" id="csv_file_import" class="form-control" placeholder="Csv File" aria-describedby="csv_help"> -->
                      
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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



<!-- Classic Modal -->
<div class="modal fade" id="SceneDetail" tabindex="-1" role="dialog" aria-labelledby="SceneDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action=""  id="scene-form" onsubmit="return confirm('Update Scene?');">

                <input type="hidden" name="scene_id" id="scene_id" class="form-control" value="">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                    <h4 class="modal-title">Scene</h4>
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Scene Title: </label>
                        <input type="text" name="scene_title" id="scene_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Scene Image</label>
                        <img src="" class="img-fluid " alt="scene image" id="scene_image" style="height:200px;width:auto;filter:blur(5px);">
                    </div>
                    <div class="form-group">
                        <label for="">Video Length (minutes)</label>
                        <input type="text" name="video_length" id="video_length" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="description"  rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Release Date</label>
                        <input type="text" name="release_date" id="release_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Scene Original Url</label>
                        <input type="text" name="video_url" id="video_url" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">FPS</label>
                        <input type="text" name="fps"  id ="fps" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Degrees</label>
                        <input type="text" name="degrees" id="degrees" class="form-control">
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Update scene" name="update_scene" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

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

    $(document).on('click', '.view', function () {
        let scene_id = $(this).data('id')
        if (scene_id) {
            ajax_get_tube(scene_id);
        } else {
            swal({
                title: 'error!',
                text: 'Failed to View Scene ',
                type: 'error',
                confirmButtonClass: "btn btn-success btn-fill",
                buttonsStyling: false
            })
        }
    })
    function emptyScene(){
        $('#scene_title').val("")
        $('#scene_image').val("")
        $('#video_length').val("")
        $('#description').val("")
        $('#release_date').val("")
        $('#video_url').val("")
        $('#fps').val("")
        $('#degrees').val("")
    }
    function appendDataScene(scene){
        console.log(scene)
        $('#scene_id').val(scene['id'])
        $('#scene_title').val(scene['title'])
        $('#scene_image').attr("src", scene['src_image'])
        $('#video_length').val(scene['video_length'])
        $('#description').val(scene['description'])
        $('#release_date').val(scene['releaseDate'])
        $('#video_url').val(scene['video_url'])
        $('#fps').val(scene['fps'])
        $('#degrees').val(scene['degrees'])
    }

    function ajax_get_tube(id){
        $.ajax({
            type: "POST",
            url: '<?=home_url('/wp-admin/admin-ajax.php?action=gallery_tube_get_tube_by_id')?>',
            data: {
                id: id
            },
            
            success: function (response) {
                emptyScene();
                if (response)  {
                    response = JSON.parse(response);
                    appendDataScene(response);
                    $("#SceneDetail").modal();
                }
            }
        });
    }
    

</script>
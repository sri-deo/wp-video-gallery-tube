<?php 


function deleteStudio($id) {
    global $wpdb;
    if ($wpdb->get_row("SELECT * FROM ".$wpdb->prefix."gallery_studios  where id= ".$id." ;")) {
        return $wpdb->query("DELETE FROM ".$wpdb->prefix."gallery_studios WHERE id=".$id." ;");
    }
}
function updateStudio($id, $data) {
    global $wpdb;
    if ( $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."gallery_tube_studios  where id= ".$id." ;")) {
        
        return $wpdb->update($wpdb->prefix."gallery_tube_studios", $data , array("id" => $id) );
    } else return false;
}
$success="";
$error="";

if (isset($_POST['delete_studio']) && isset($_POST['studio_id'])) {
    $res = deleteStudio(intval($_POST['studio_id']));
    if ($res) {
        $success="Deleted Studio Successfully !";
    } else {
        $error = "Failed to delete Studio";
    }
}


if (isset($_POST['update_studio']) && isset($_POST['studio_id'])) {
    $studio_id =   intval($_POST['studio_id']);
    
    $studio_nicename = trim($_POST['studio_nicename']);

    $studio_logo = trim($_POST['studio_logo']);

    if ($studio_id && $studio_nicename) {
        $res = updateStudio($studio_id, array( 'studio_nicename' => $studio_nicename, 'logo' => $studio_logo  ) );
        if ($res) {
            $success="Updated Studio Successfully !";
        } else {
            $error = "Failed to Update Studio";
        }
    } else {
        $error = "You must specific the Studio name";
    }

}

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
<div class="modal fade" id="studioDetail" tabindex="-1" role="dialog" aria-labelledby="studioDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action=""  id="studio-form" onsubmit="return confirm('Update Studio?');">

                <input type="hidden" name="studio_id" id="studio_id" class="form-control" value="">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                    <h4 class="modal-title">Studio</h4>
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Studio Nice Name: </label>
                        <input type="text" name="studio_nicename" id="studio_nicename" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Studio Logo: </label>
                        <img src="" alt="Preview Image" style="height:80px;width:auto;" id="preview-image-upload">
                        <p>
                        <input id="studio_logo" type="hidden" name="studio_logo" value=""  />
                        <input id="wp_gallery_upload_image_btn" type="button" class="button-primary" value="Insert Image" />
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Update studio" name="update_studio" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid row">
    <div class="col-md-12">
        <div class="card" style="max-width: 100%;">

            <div class="card-content">
                <h4 class="card-title alert alert-info">Studios List</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                        width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="disabled-sorting">Logo</th>
                                <th>Name</th>
                                <th>Date Created</th>

                                <th class="disabled-sorting text-left">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th class="disabled-sorting">Logo</th>
                                <th>Name</th>
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
    var ktable;
    $(document).ready(function () {
        buttons = '';
        ktable = $('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?=home_url('/wp-admin/admin-ajax.php?action=gallery_tube_get_studios')?>',
                "method": "POST",
                dataFilter: function (response) {
                    response = JSON.parse(response);
                    response.data = response.data.map(o => {
                        o[1] = o[1] ?
                            `<img src="${o[1]}" style="height:40px;width:auto;">` :
                            `<img style="height:40px;width:auto;" src="<?=plugin_dir_url(dirname( __FILE__ )).'img/thumbnail-img.jpg'?>">`;
                        o[2]  = o[2] ? o[2] : o[5]
                        return o;
                    })

                    return JSON.stringify(response);
                }
            },
            "order": [
                [4, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "searchable": false
            }, {
                "targets": [1],
                "searchable": true,

            }, {
                "targets": [2],
                "searchable": true,

            }, {
                "targets": [3],
                "searchable": true,

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

        var mediaUploader;

        $(document).on('click','#wp_gallery_upload_image_btn', function(e) {
            e.preventDefault();
                if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                text: 'Choose Image'
            }, multiple: false });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#studio_logo').val(attachment.url);
                $('#photo').val(attachment.url);
                $('#pornstar_photo').val(attachment.url);
                $('#preview-image-upload').attr("src", attachment.url)
                $('#studioDetail').modal('show')
            });
            mediaUploader.open();
        });
        if (mediaUploader) {

            mediaUploader.on('close', function(){
                $('#studioDetail').modal('show');
            })
        }
       

    });
    
    $(document).on('click', '.delete', function () {
        let studio_id = $(this).data('id')
        if (studio_id) {
            swal({
                title: 'Are you sure to delete?',
                html: '<div class="alert alert-warning" >This action can not be undo !</div><form action="" method="post" id="delete-form"><div class="form-group">' +
                    '<input name="studio_id" type="hidden" value="' + studio_id + '" />' +
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
                text: 'Failed to delete Studio ',
                type: 'error',
                confirmButtonClass: "btn btn-success btn-fill",
                buttonsStyling: false
            })
        }
    })

    $(document).on('click', '.view', function(){
        let studio_id = $(this).data('id')
        if (studio_id) {
            $('#studio_id').val(studio_id);             
            
            studio_nicename = (ktable.row($(this).closest('tr')).data()[2]) ;
            studio_logo = (ktable.row($(this).closest('tr')).data()[1]) ;
            
            $('#preview-image-upload').attr("src",$.parseHTML(studio_logo)[0].src)
            $('#studio_logo').val($.parseHTML(studio_logo)[0].src)
            $('#studio_nicename').val(studio_nicename);            

            $('#studioDetail').modal();

        } else {
            swal({
                title: 'error!',
                text: 'Failed to update Studio ',
                type: 'error',
                confirmButtonClass: "btn btn-success btn-fill",
                buttonsStyling: false
            })
        }
    })

    $(document).on('click','#wp_gallery_upload_image_btn', function(){
        $('#studioDetail').modal('hide');
    })

    
		

   

</script>
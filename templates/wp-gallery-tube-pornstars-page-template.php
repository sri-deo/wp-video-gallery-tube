<?php 
/**
* Template name : WP Gallery Tube Template
* author: lampvu
* email: yourmindhasgone@gmail.com
*/

$plugin_name  = 'wp-gallery-tube';
$pornstar_slug = get_query_var('star');


function hoursandmins($time, $format = '%02d:%02d'){
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
function getPornstars($page= null, $sort=null){
    global $wpdb;
    return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."gallery_tube_pornstars ;");
}

function getPornstar($slug) {
    global $wpdb;
    $pornstar =  $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."gallery_tube_pornstars WHERE slug=%s   ;" , array($slug) ) );

    if ($pornstar) {

        
        $pornstar->scenes = $wpdb->get_results("SELECT A.id, A.title, A.video_length, A.fps, A.degrees, A.scene_identity, A.src_image, B.studio_nicename, B.studio_name, B.logo
                                        FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id
                                        JOIN ".$wpdb->prefix."gallery_tube_scene_star C ON C.tube_id = A.id
                                        
                                        WHERE  C.pornstar_id = ".$pornstar->id." 
                                        ORDER BY A.id ASC LIMIT 12");
        if ($pornstar->scenes && count($pornstar->scenes))         {
            foreach ($pornstar->scenes as $key => $scene   ) {
                $pornstar->scenes[$key]->tags = $wpdb->get_results("SELECT A.name FROM ".$wpdb->prefix."gallery_tube_tags A 
                                                                JOIN ".$wpdb->prefix."gallery_tube_scene_tag B ON B.tag_id = A.id 
                                                                WHERE B.tube_id= ".$scene->id."  ORDER BY A.name ASC LIMIT 3 ; " );
            }
            
        }
        
        return $pornstar;                               
    }
    else return 0;

}
$page=0;
$sort=0;
$pornstars = getPornstars($page, $sort);

$pornstar=null;
if ($pornstar_slug){
    $pornstar = getPornstar($pornstar_slug);
}
if ($pornstar !==null){

    if (!$pornstar) {
        wp_redirect(home_url('pornstars'));
    }
}



wp_head();

?>



<?php 


if ($pornstar) {
    include  $plugin_name . '-single-pornstar-page-template.php';
} else { ?>

<article id="page-top" class="gallery-tube-bs">
    <nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="/"><img class="img-fluid" alt=""
                src="<?=the_custom_logo()? the_custom_logo(): (plugins_url('wp-gallery-tube').'/public/img/site-logo.png') ?>"></a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline  osahan-navbar-search" method="get" action="<?=home_url('gallery')?>">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search for Pornstars, Tags, Studios ... ">
                <div class="input-group-append">
                    <button class="btn btn-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
       
    </nav>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="<?=home_url('gallery')?>">
                    <i class="fas fa-vr-cardboard"></i>
                    <span>VR Videos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=home_url('studios')?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Studios</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?=home_url('pornstars')?>">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Porn Stars</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=home_url('tags')?>">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Categories</span>
                </a>
            </li>

        </ul>
        
        <div id="content-wrapper">
            <div class="container-fluid pb-0">
                <div class="video-block section-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                                <div class="btn-group float-right right-action">
                                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top
                                            Rated</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp;
                                            Viewed</a>
                                       
                                    </div>
                                </div>
                                <h6>Pornstars</h6>
                            </div>
                        </div>

                        <?php if ($pornstars && count($pornstars)) {
                            
                            foreach ($pornstars as $key => $pornstar) {
                                # code...
                            
                            ?>
                        
                        <div class="col-xl-3 col-sm-6 mb-3">
                            
                            <div class="channels-card">
                                
                                <div class="channels-card-image">
                                    <a href="<?= home_url('pornstars/'.$pornstar->slug) ?>">
                                        <img class="img-fluid"
                                            src="<?=$pornstar->photo?$pornstar->photo:(plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg') ?>" alt="">
                                    </a>
                                    <div class="channels-card-image-btn">
                                        <a    class="btn btn-outline-danger btn-sm" href="<?=home_url('pornstars/'.$pornstar->slug)?>">View</a>
                                    </div>
                                </div>

                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="<?=home_url('pornstars/'.$pornstar->slug)?>"><?=$pornstar->name?></a>
                                    </div>                                   
                                </div>
                            
                            </div>
                        </div>
                        
                        <?php }} ?>
                        
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center pagination-sm mb-4">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <hr>
                
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-sm-6">
                            <p class="mt-1 mb-0"><strong class="text-dark">Vidoe</strong>.
                                <small class="mt-0 mb-0"><a class="text-primary" target="_blank"
                                        href="https://templatespoint.net/">TemplatesPoint</a>
                                </small>
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-6 text-right">
                            <div class="app">
                                <a href="#"><img alt=""
                                        src="<?=plugins_url('wp-gallery-tube')?>/public/img/google.png"></a>
                                <a href="#"><img alt=""
                                        src="<?=plugins_url('wp-gallery-tube')?>/public/img/apple.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        ^
    </a>
   

</section>


<?php }?>
<?php  wp_footer();?>
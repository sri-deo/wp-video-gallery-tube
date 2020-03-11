<?php 
/**
* Template name : WP Gallery Tube Template Single Scene
* author: lampvu
* email: yourmindhasgone@gmail.com
*/

function hoursandmins($time, $format = '%02d:%02d'){
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function getScene($identity){
    global $wpdb;
    $tube = $wpdb->get_row($wpdb->prepare("SELECT A.id, A.title, A.description, A.video_length,A.video_url,A.releaseDate, A.fps, A.degrees,A.studio, A.scene_identity, A.src_image, B.studio_nicename, B.studio_name, B.logo
                            FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id 
                            WHERE A.scene_identity=%s", array($identity)  ) );
    
    
    $tube->tags = $wpdb->get_results("SELECT A.name FROM ".$wpdb->prefix."gallery_tube_tags A JOIN ".$wpdb->prefix."gallery_tube_scene_tag B ON A.id=B.tag_id WHERE B.tube_id=".$tube->id );
    $tube->pornstars   = $wpdb->get_results("SELECT A.name, A.slug FROM ".$wpdb->prefix."gallery_tube_pornstars A JOIN ".$wpdb->prefix."gallery_tube_scene_star B ON A.id=B.pornstar_id WHERE B.tube_id=".$tube->id );
    
    return $tube;
}

function getRelatedScene($studio_id){
    global $wpdb;
    $tubes = $wpdb->get_results("SELECT A.id, A.title, A.video_length, A.fps, A.degrees, A.scene_identity, A.src_image, B.studio_nicename, B.studio_name
                                FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id 
                                WHERE A.studio = ".$studio_id."
                                ORDER BY A.date_created DESC LIMIT 8
                                " );
    if ($tubes && count($tubes)) {
        foreach ($tubes as $key => $tube) {
            # code...
            $tubes[$key]->tags = $wpdb->get_results("SELECT A.name FROM ".$wpdb->prefix."gallery_tube_tags A JOIN ".$wpdb->prefix."gallery_tube_scene_tag B ON A.id=B.tag_id WHERE B.tube_id=".$tube->id );
            $tubes[$key]->pornstars   = $wpdb->get_results("SELECT A.name, A.slug FROM ".$wpdb->prefix."gallery_tube_pornstars A JOIN ".$wpdb->prefix."gallery_tube_scene_star B ON A.id=B.pornstar_id WHERE B.tube_id=".$tube->id );
                                        
        }
    }
    return $tubes;
}
$tube=null;
$scene_identity = get_query_var('scene_identity');
$related_scenes = array();
if ($scene_identity) {
    $tube = getScene($scene_identity);
    if ($tube->studio) {
        $related_scenes = getRelatedScene($tube->studio);
    }
}


if (!$tube) {
    wp_redirect(home_url('gallery'));
}
wp_head();

?>

<article id="page-top" class="gallery-tube-bs">
    <nav class="navbar navbar-expand navbar-light bg-light static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="<?=home_url('gallery')?>"><img class="img-fluid" alt=""
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
        <ul class="sidebar navbar-nav ">
            <li class="nav-item active">
                <a class="nav-link" href="<?=home_url('gallery')?>">
                    <i class="fas fa-vr-cardboard"></i>
                    <span>VR Videos</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="<?=home_url('studios')?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Studios</span>
                </a>
            </li>
            <li class="nav-item">
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
                        <div class="col-md-8">
                            <div class="single-video-left">
                                <div class="single-video preview-img">
                                    <img src="<?=esc_url($tube->src_image? $tube->src_image : "")    ?>" alt="thumbnail-image" srcset="" height="315">
                                    
                                </div>
                                <div class="single-video-title box mb-3" style="margin-top:30px;">
                                    <h2>
                                        <a href="<?= home_url('studios/'.$tube->studio_name) ?>"><?=esc_html($tube->title)?></a>
                                    <a href="https://<?=$tube->video_url?><?=get_option('affiliate_code')?("?af_code=".get_option('affiliate_code')):""  ?>" class="float-right badge badge-info">Video Scene in Original Site</a>
                                </h2>
                                  
                                </div>
                                <div class="single-video-author box mb-3">
                                    <div class="float-right">
                                        <a class="btn btn-danger" href="<?= home_url('studios/'.$tube->studio_name) ?>">
                                            View Studio
                                        </a> 
                                    </div>
                                    <img class="img-fluid" src="<?= $tube->logo ? $tube->logo:   (plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg') ?>" alt="studio logo">
                                    <p><a href="<?= home_url('studios/'.$tube->studio_name) ?>">
                                    <strong><?=$tube->studio_nicename ? $tube->studio_nicename : $tube->studio_name ?></strong>
                                    </a> <span title=""
                                            data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i
                                                class="fas fa-check-circle text-success"></i></span></p>
                                    <small>&nbsp;</small>
                                </div>
                                <div class="single-video-info-content box mb-3">
                                    
                                    <h6>Specs : <?=$tube->degrees? ($tube->degrees. '&deg;.') : ""?>
                                        <?=$tube->fps? ($tube->fps." FPS."):""?> </h6>
                                   
                                    <h6>Starring:</h6>
                                    <p>
                                        <?php 
                                        
                                            $p = array();
                                            foreach ($tube->pornstars as $key => $pornstar) {
                                                $p[] = '<a href="'.home_url('pornstars/'.$pornstar->slug).'">'.$pornstar->name.'</a>';    
                                            }
                                            echo implode (", ", $p);
                                        ?>
                                    </p>
                                    <h6>Description :</h6>
                                    <p><?=$tube->description?> </p>
                                    <h6>Released: <?=$tube->releaseDate?></h6>
                                    <h6>Tags :</h6>
                                    <p class="tags mb-0">
                                        <?php 
                                            $t = array();
                                            foreach ($tube->tags as $key => $tag) {
                                                $t[] = '<span><a href="'.home_url('tags/'.$tag->name).'">'.$tag->name.'</a></span>';
                                            }
                                            echo implode(" ", $t);
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-video-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <div class="adblock">
                                            <div class="img">
                                                Google AdSense<br>
                                                336 x 280
                                            </div>
                                        </div> -->
                                        <div class="main-title">
                                            
                                            <h6>Related Scenes</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12 related-scene">
                                        <?php 
                                        
                                        if (count($related_scenes)) {
                                            foreach ($related_scenes as $key => $related_scene) {
                                                # code...
                                            
                                        ?>


                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="<?=home_url('scene/'.$related_scene->scene_identity)?>"><i class="fas fa-play-circle"></i></a>
                                                <a href="<?=home_url('scene/'.$related_scene->scene_identity)?>"><img class="img-fluid" src="<?=($related_scene->src_image?$related_scene->src_image:(plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg'))?>" alt=""></a>
                                                <div class="time"><?=hoursandmins($related_scene->video_length, '%02d:%02d')?></div>
                                            </div>
                                            <div class="video-card-body">
                                                
                                                <div class="video-title">
                                                    <a href="<?=home_url('scene/'.$related_scene->scene_identity)?>"><?=(strlen($related_scene->title) > 50 ? substr($related_scene->title,0,50)."..." : $related_scene->title )?></a>
                                                </div>
                                                <div class="video-page text-success">
                                                <?=$related_scene->studio_nicename? $related_scene->studio_nicename: $related_scene->studio_name ?>    
                                                 <a title="" data-placement="top" data-toggle="tooltip"
                                                        href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    <?php 
                                                        $pornstars_view = array();
                                                        if ($related_scene->pornstars && count($related_scene->pornstars)) {
                                                            foreach ($related_scene->pornstars as $key => $pornstar) {
                                                               $pornstars_view[] = '<a href="/pornstars/'.$pornstar->slug.'">'.$pornstar->name.'</a>';
                                                            }
                                                        }
                                                        echo implode(", ", $pornstars_view);
                                                    
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php }} ?>
                                        <!-- 
                                        <div class="adblock mt-0">
                                            <div class="img">
                                                Google AdSense<br>
                                                336 x 280
                                            </div>
                                        </div> -->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-sm-6">
                            
                        </div>
                        <div class="col-lg-6 col-sm-6 text-right">
                            <div class="app">
                               
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
    
</article>

<?php

wp_footer();
?>


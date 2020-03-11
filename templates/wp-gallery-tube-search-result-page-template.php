<article id="page-top" class="gallery-tube-bs">
    <nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="<?=home_url('gallery')?>"><img class="img-fluid" alt=""
                src="<?=the_custom_logo()? the_custom_logo(): (plugins_url('wp-gallery-tube').'/public/img/site-logo.png') ?>"></a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline  osahan-navbar-search" method="get"
            action="<?=home_url('gallery')?>">
            <div class="input-group">
                <input type="text" name="q" class="form-control" value="<?=esc_html($searchString)?>" placeholder="Search for Pornstars, Tags, Studios ... ">
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
            <li class="nav-item active">
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
            <li class="nav-item ">
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
                <div class="video-block section-padding" style="min-height:80vh;">
                    <div class="row">
                        <?php if ($searchedPornstar && count($searchedPornstar)) {   ?>
                        <div class="col-md-12">
                            <div class="main-title">
                                <h6>Pornstar Results: </h6>
                            </div>
                        </div>

                        <?php                           
                            foreach ($searchedPornstar as $key => $pornstar) {                              
                            ?>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="<?= home_url('pornstars/'.$pornstar->slug) ?>">
                                        <img class="img-fluid"
                                            src="<?=$pornstar->photo?$pornstar->photo:(plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg') ?>"
                                            alt="">
                                    </a>

                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="<?=home_url('pornstars/'.$pornstar->slug)?>"><?=$pornstar->name?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>


                    </div>
                    <div class="row">

                        <?php  if ($searchedTags && count($searchedTags)) {      ?>
                        <div class="col-md-12">
                            <div class="main-title">
                                <h6>Tags Results: </h6>
                            </div>
                        </div>

                        <?php                        
                        foreach ($searchedTags as $key => $tag) {                              
                        ?>
                        <div class="col-xl-2 col-sm-6 mb-3 text-center">
                            <a href="<?=home_url('tags/'.$tag->name)?>">
                                <div class="box">
                                    <?=$tag->name?>
                                </div>
                            </a>

                        </div>
                        <?php } } ?>

                    </div>
                    <div class="row">
                        <?php  if ($searchedScene && count($searchedScene)) { 
                        
                        
                        ?>
                        <div class="col-md-12">
                            <div class="main-title">
                                <h6>Scenes Results: </h6>
                            </div>
                        </div>

                        <?php                          
                        foreach ($searchedScene as $key => $scene) {                          
                        ?>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card preview-video">
                                <div class="video-card-image">
                                    <a class="view-lightbox"
                                        href="<?=home_url('scene/'.$scene->scene_identity)?>"><b>VIEW</b></a>
                                    <a href="<?=home_url('scene/'.$scene->scene_identity)?>"><img class="img-fluid"
                                            src="<?=($scene->src_image?$scene->src_image:(plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg'))?>"
                                            alt="previewimg"></a>
                                    <div class="time"><?=hoursandmins($scene->video_length, '%02d:%02d')?></div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="<?=home_url('scene/'.$scene->scene_identity)?>"
                                            class="ellipsis"><?=(strlen($scene->title) > 50 ? substr($scene->title,0,50)."..." : $scene->title )?></a>
                                    </div>
                                    <div class="video-page text-success">
                                        <a href="#" style="    color: #4eda92;">
                                            <?=$scene->studio_nicename? $scene->studio_nicename: $scene->studio_name ?>
                                            <a title="" data-placement="top" data-toggle="tooltip" href="#"
                                                data-original-title=""><i
                                                    class="fas fa-check-circle text-success"></i></a>
                                        </a>
                                    </div>
                                    <div class="video-view">

                                        <?=$scene->degrees? ($scene->degrees. '&deg;') : ""?>
                                        <?=$scene->fps? ($scene->fps." FPS"):""?>
                                        &nbsp;

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>

                    </div>
                    <div class="row">
                        <?php if (!$searchedTags && !$searchedPornstar && !$searchedScene) { ?>
                            <h2>Sorry, we found no result for <?=esc_html($searchString) ?></h2>
                        <?php } ?>

                    </div>
                    <!-- <nav aria-label="Page navigation example">
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
                    </nav> -->
                </div>
                <hr>

            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-sm-6">
                            <p class="mt-1 mb-0"><strong class="text-dark"></strong>.
                                <small class="mt-0 mb-0">
                                </small>
                            </p>
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


    </section>
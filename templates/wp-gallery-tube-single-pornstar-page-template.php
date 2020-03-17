   
<?php 
/**
* Template name : WP Gallery Tube Template Single Studio
* author: lampvu
* email: yourmindhasgone@gmail.com
*/

   
?>
   

<article id="page-top" class="gallery-tube-bs">
    <nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="/"><img class="img-fluid" alt=""
                src="<?=$site_logo[0]? $site_logo[0]: (plugins_url('wp-gallery-tube').'/public/img/site-logo.png') ?>"></a>
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
        <div class="single-channel-page" id="content-wrapper">
            <div class="single-channel-image">
                <img class="img-fluid" alt="" src="<?=plugins_url('wp-gallery-tube')?>/public/img/channel-banner.png" style="max-height:200px;">
                <div class="channel-profile">
                    <img class="channel-profile-img" alt="studio logo" src="<?= $pornstar->photo ? $pornstar->photo:   (plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg') ?>">
                    
                </div>
            </div>
            <div class="box" style="margin:10px 0px;">
               <?php if ($pornstar->country){ ?>
               <h6>Country of Origin: </h6>
               <p><?=$pornstar->country?></p>
               <?php } ?>
               <?php if ($pornstar->aliasses){ ?>
               <h6>Aliasses: </h6>
               <p><?=$pornstar->aliasses?></p>
               <?php } ?>
               <?php if ($pornstar->birth){ ?>
               <h6>Birth: </h6>
               <p><?=$pornstar->birth?></p>
               <?php } ?>
               <?php if ($pornstar->bio){ ?>
               <h6>Bio: </h6>
               <p><?=$pornstar->bio?></p>
               <?php } ?>
            </div>
            <div class="single-channel-nav">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="channel-brand" href="<?= home_url('studios/'.$pornstar->studio_name) ?>">
                    <?=$pornstar->name ?>
                    <span title="" data-placement="top"
                            data-toggle="tooltip" data-original-title="Verified"><i
                                class="fas fa-check-circle text-success"></i></span></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item active">
                                <a class="nav-link" href="#">Videos <span class="sr-only">(current)</span></a>
                            </li>                           
                                                      
                        </ul>                        
                    </div>
                </nav>
            </div>
            <div class="container-fluid">
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
                                        <a class="dropdown-item" href="<?=isset($_GET['sort'])?(preg_replace("#&sort=.*#", '&sort=title', $_SERVER['REQUEST_URI'])):  $_SERVER['REQUEST_URI'].('&sort=title') ?>"><i class="fas fa-fw fa-star"></i> &nbsp; Title</a>
                                        <a class="dropdown-item" href="<?=isset($_GET['sort'])?(preg_replace("#&sort=.*#", '&sort=length', $_SERVER['REQUEST_URI'])): $_SERVER['REQUEST_URI'].('&sort=length') ?>"><i class="fas fa-fw fa-signal"></i> &nbsp;
                                            View Length</a>
                                        
                                    </div>
                                </div>
                                <h6>Videos</h6>
                            </div>
                        </div>


                        <?php if ($pornstar->scenes && count($pornstar->scenes)) {
                            foreach ($pornstar->scenes as $key => $scene) {
                                # code...
                            
                            ?>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card preview-video">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="<?=home_url('scene/'.$scene->scene_identity)?>"><img class="img-fluid"
                                            src="<?=($scene->src_image?$scene->src_image:(plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg'))?>" alt="scene preview"></a>
                                    <div class="time"><?=hoursandmins($scene->video_length, '%02d:%02d')?></div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="<?=home_url('scene/'.$scene->scene_identity)?>" class="ellipsis"><?= str_replace( ["cock","fuck", "dick", "pussy","anal"], ["c*ck", "f*ck","d*ck", "p*ssy","an*l"]  , (strlen($scene->title) > 50 ? substr($scene->title,0,50)."..." : $scene->title  ) ) ?></a>
                                    </div>
                                    <div class="" style="display:flex;justify-content: space-between;">
                                        <a  href="<?=home_url('studios/'.$scene->studio_name)?>" style="color: #4eda92;">
                                            <?=$scene->studio_nicename ? $scene->studio_nicename : $scene->studio_name ?> 
                                            <span title="" data-placement="top" data-toggle="tooltip" href="#"   data-original-title="">
                                                <i  class="fas fa-check-circle text-success"></i>
                                            </span>
                                        </a> 
                                        <a   rel="noreferrer nofollow sponsored " target="_blank" href="https://<?=$scene->video_url?>" class="btn btn-info btn-outline ">VIEW UNSENSORED VERSION</a>
                                    </div>
                                    <div class="video-view">
                                        <?=$scene->degrees? ($scene->degrees. '&deg;') : ""?>
                                        <?=$scene->fps? ($scene->fps." FPS"):""?>
                                        &nbsp;
                                        <span class="float-right">
                                        <?php 
                                        
                                        $p = array();
                                            foreach ($scene->tags as $key => $tag) {
                                                $p[] = '<a href="'.home_url('tags/'.$tag->name).'">'.$tag->name.'</a>';    
                                            }
                                            echo implode (" ", $p).'...';
                                        ?>
                                        </span>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center pagination-sm mb-0">
                            <?php
                            ?>
                            <li class="page-item <?=($page_num<2)?"disabled":""?>">
                                <a class="page-link" href="<?=($page_num >=2)? ("?page_n=".($page_num-1 )) :"?page_n=1" ?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?> " tabindex="-1">Previous</a>
                            </li>
                            
                            <li class="page-item <?=($page_num<2)?"active disabled" :""?>">
                                <a class="page-link" href="<?=($page_num >=2 )? "?page_n=".($page_num-1)   : '?page_n=1'   ?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?>"><?=($page_num >=2 )? ($page_num-1):1   ?></a>
                            </li>
                            <li class="page-item <?=($page_num>=2)?"active disabled" :""  ?>">
                                <a class="page-link" href="?page_n=<?=($page_num>2)? ($page_num):2?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?>"><?=($page_num>2)? ($page_num):2?></a>
                            </li>
                            <li class="page-item ">
                                <a class="page-link" href="?page_n=<?=($page_num>2)?($page_num+1):3  ?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?>"><?=($page_num>2)?($page_num+1):3  ?></a>
                            </li>
                           
                            <li class="page-item  <?=($page_num>=$max_page_num)?"disabled":""?>">
                                <a class="page-link" href="<?=("?page_n=".($page_num+1)) ?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer ml-0">
                <div class="">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-sm-6">
                            <p class="mt-1 mb-0">&copy; Copyright 2020 <strong class="text-dark"></strong>. All
                                Rights Reserved<br>
                               
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
    

</article>


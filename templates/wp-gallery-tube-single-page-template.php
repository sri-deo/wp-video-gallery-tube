<?php 
/**
* Template name : WP Gallery Tube Template Single Scene
* author: lampvu
* email: yourmindhasgone@gmail.com
*/


?>




<?php 


wp_head();

?>

<article id="page-top" class="gallery-tube-bs">
    <nav class="navbar navbar-expand navbar-light bg-dark static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="#"><img class="img-fluid" alt=""
                src="<?=the_custom_logo() ?>"></a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline  osahan-navbar-search" method="get" action="">
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
            <li class="nav-item active">
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
                                <div class="single-video">
                                    <iframe width="100%" height="315"
                                        src="https://www.youtube-nocookie.com/embed/8LWZSGNjuF0?rel=0&amp;controls=0&amp;showinfo=0"
                                        frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                                <div class="single-video-title box mb-3">
                                    <h2><a href="#">Contrary to popular belief, Lorem Ipsum (2020) is not.</a></h2>
                                    <p class="mb-0"><i class="fas fa-eye"></i> 2,729,347 views</p>
                                </div>
                                <div class="single-video-author box mb-3">
                                    <div class="float-right"><button class="btn btn-danger" type="button">Subscribe
                                            <strong>1.4M</strong></button> <button class="btn btn btn-outline-danger"
                                            type="button"><i class="fas fa-bell"></i></button></div>
                                    <img class="img-fluid" src="img/s4.png" alt="">
                                    <p><a href="#"><strong>Osahan Channel</strong></a> <span title=""
                                            data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i
                                                class="fas fa-check-circle text-success"></i></span></p>
                                    <small>Published on Aug 10, 2020</small>
                                </div>
                                <div class="single-video-info-content box mb-3">
                                    <h6>Cast:</h6>
                                    <p>Nathan Drake , Victor Sullivan , Sam Drake , Elena Fisher</p>
                                    <h6>Category :</h6>
                                    <p>Gaming , PS4 Exclusive , Gameplay , 1080p</p>
                                    <h6>About :</h6>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        that it has a more-or-less normal distribution of letters, as opposed to using
                                        'Content here, content here', making it look like readable English. Many desktop
                                        publishing packages and web page editors now use Lorem Ipsum as their default
                                        model text, and a search for 'lorem ipsum' will uncover many web sites still in
                                        their infancy. Various versions have evolved overVarious versions have evolved
                                        over the years, sometimes </p>
                                    <h6>Tags :</h6>
                                    <p class="tags mb-0">
                                        <span><a href="#">Uncharted 4</a></span>
                                        <span><a href="#">Playstation 4</a></span>
                                        <span><a href="#">Gameplay</a></span>
                                        <span><a href="#">1080P</a></span>
                                        <span><a href="#">ps4Share</a></span>
                                        <span><a href="#">+ 6</a></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-video-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="adblock">
                                            <div class="img">
                                                Google AdSense<br>
                                                336 x 280
                                            </div>
                                        </div>
                                        <div class="main-title">
                                            <div class="btn-group float-right right-action">
                                                <a href="#" class="right-action-link text-gray" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i>
                                                        &nbsp; Top Rated</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                                </div>
                                            </div>
                                            <h6>Up Next</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                                <a href="#"><img class="img-fluid" src="img/v1.png" alt=""></a>
                                                <div class="time">3:50</div>
                                            </div>
                                            <div class="video-card-body">
                                                <div class="btn-group float-right right-action">
                                                    <a href="#" class="right-action-link text-gray"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                                    </div>
                                                </div>
                                                <div class="video-title">
                                                    <a href="#">Here are many variati of passages of Lorem</a>
                                                </div>
                                                <div class="video-page text-success">
                                                    Education <a title="" data-placement="top" data-toggle="tooltip"
                                                        href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                                </div>
                                            </div>
                                        </div>
                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                                <a href="#"><img class="img-fluid" src="img/v2.png" alt=""></a>
                                                <div class="time">3:50</div>
                                            </div>
                                            <div class="video-card-body">
                                                <div class="btn-group float-right right-action">
                                                    <a href="#" class="right-action-link text-gray"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                                    </div>
                                                </div>
                                                <div class="video-title">
                                                    <a href="#">Duis aute irure dolor in reprehenderit in.</a>
                                                </div>
                                                <div class="video-page text-success">
                                                    Education <a title="" data-placement="top" data-toggle="tooltip"
                                                        href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                                </div>
                                            </div>
                                        </div>
                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                                <a href="#"><img class="img-fluid" src="img/v3.png" alt=""></a>
                                                <div class="time">3:50</div>
                                            </div>
                                            <div class="video-card-body">
                                                <div class="btn-group float-right right-action">
                                                    <a href="#" class="right-action-link text-gray"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                                    </div>
                                                </div>
                                                <div class="video-title">
                                                    <a href="#">Culpa qui officia deserunt mollit anim</a>
                                                </div>
                                                <div class="video-page text-success">
                                                    Education <a title="" data-placement="top" data-toggle="tooltip"
                                                        href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                                </div>
                                            </div>
                                        </div>
                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                                <a href="#"><img class="img-fluid" src="img/v4.png" alt=""></a>
                                                <div class="time">3:50</div>
                                            </div>
                                            <div class="video-card-body">
                                                <div class="btn-group float-right right-action">
                                                    <a href="#" class="right-action-link text-gray"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                                    </div>
                                                </div>
                                                <div class="video-title">
                                                    <a href="#">Deserunt mollit anim id est laborum.</a>
                                                </div>
                                                <div class="video-page text-success">
                                                    Education <a title="" data-placement="top" data-toggle="tooltip"
                                                        href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                                </div>
                                            </div>
                                        </div>
                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                                <a href="#"><img class="img-fluid" src="img/v5.png" alt=""></a>
                                                <div class="time">3:50</div>
                                            </div>
                                            <div class="video-card-body">
                                                <div class="btn-group float-right right-action">
                                                    <a href="#" class="right-action-link text-gray"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                                    </div>
                                                </div>
                                                <div class="video-title">
                                                    <a href="#">Exercitation ullamco laboris nisi ut.</a>
                                                </div>
                                                <div class="video-page text-success">
                                                    Education <a title="" data-placement="top" data-toggle="tooltip"
                                                        href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                                </div>
                                            </div>
                                        </div>
                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                                <a href="#"><img class="img-fluid" src="img/v6.png" alt=""></a>
                                                <div class="time">3:50</div>
                                            </div>
                                            <div class="video-card-body">
                                                <div class="btn-group float-right right-action">
                                                    <a href="#" class="right-action-link text-gray"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                                    </div>
                                                </div>
                                                <div class="video-title">
                                                    <a href="#">There are many variations of passages of Lorem</a>
                                                </div>
                                                <div class="video-page text-success">
                                                    Education <a title="" data-placement="top" data-toggle="tooltip"
                                                        href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adblock mt-0">
                                            <div class="img">
                                                Google AdSense<br>
                                                336 x 280
                                            </div>
                                        </div>
                                        <div class="video-card video-card-list">
                                            <div class="video-card-image">
                                                <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                                <a href="#"><img class="img-fluid" src="img/v2.png" alt=""></a>
                                                <div class="time">3:50</div>
                                            </div>
                                            <div class="video-card-body">
                                                <div class="btn-group float-right right-action">
                                                    <a href="#" class="right-action-link text-gray"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                                                    </div>
                                                </div>
                                                <div class="video-title">
                                                    <a href="#">Duis aute irure dolor in reprehenderit in.</a>
                                                </div>
                                                <div class="video-page text-success">
                                                    Education <a title="" data-placement="top" data-toggle="tooltip"
                                                        href="#" data-original-title="Verified"><i
                                                            class="fas fa-check-circle text-success"></i></a>
                                                </div>
                                                <div class="video-view">
                                                    1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                                </div>
                                            </div>
                                        </div>
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
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
</article>

<?php

wp_footer();
?>


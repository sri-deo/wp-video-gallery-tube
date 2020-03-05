<?php 
/**
* Template name : WP Gallery Tube Template
* author: lampvu
* email: yourmindhasgone@gmail.com
*/


wp_head();
?>




<section id="page-top" class="gallery-tube-bs">
<nav class="navbar navbar-expand navbar-light bg-dark static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="#"><img class="img-fluid" alt=""
                src="<?=plugins_url('wp-gallery-tube')?>/public/img/logo.png"></a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-5 my-2 my-md-0 osahan-navbar-search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for Pornstars, Tags, Studios ... ">
                <div class="input-group-append">
                    <button class="btn btn-light" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0 osahan-right-navbar">

            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <span class="badge badge-danger">9+</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-edit "></i> &nbsp; Action</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-headphones-alt "></i> &nbsp; Another
                        action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star "></i> &nbsp; Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                    <span class="badge badge-success">7</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-edit "></i> &nbsp; Action</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-headphones-alt "></i> &nbsp; Another
                        action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star "></i> &nbsp; Something else here</a>
                </div>
            </li>

        </ul>
    </nav>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-vr-cardboard"></i>
                    <span>VR Videos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Studios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Porn Stars</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
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
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i>
                                            &nbsp;
                                            Close</a>
                                    </div>
                                </div>
                                <h6>Channels</h6>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s1.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s2.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s3.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-secondary btn-sm">Subscribed
                                            <strong>1.4M</strong></button>
                                    </div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name <span title="" data-placement="top"
                                                data-toggle="tooltip" data-original-title="Verified"><i
                                                    class="fas fa-check-circle"></i></span></a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s4.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s6.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s8.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s5.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s6.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s8.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s7.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-secondary btn-sm">Subscribed
                                            <strong>1.4M</strong></button>
                                    </div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name <span title="" data-placement="top"
                                                data-toggle="tooltip" data-original-title="Verified"><i
                                                    class="fas fa-check-circle"></i></span></a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s1.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/s2.png" alt=""></a>
                                    <div class="channels-card-image-btn"><button type="button"
                                            class="btn btn-outline-danger btn-sm">Subscribe
                                            <strong>1.4M</strong></button></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="#">Channels Name</a>
                                    </div>
                                    <div class="channels-view">
                                        382,323 subscribers
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i>
                                            &nbsp;
                                            Close</a>
                                    </div>
                                </div>
                                <h6>Featured Videos</h6>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/v5.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">There are many variations of passages of Lorem</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#"
                                            data-original-title="Verified"><i
                                                class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/v6.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">There are many variations of passages of Lorem</a>
                                    </div>
                                    <div class="video-page text-danger">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#"
                                            data-original-title="Unverified"><i
                                                class="fas fa-frown text-danger"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/v7.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">There are many variations of passages of Lorem</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#"
                                            data-original-title="Verified"><i
                                                class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid"
                                            src="<?=plugins_url('wp-gallery-tube')?>/public/img/v8.png" alt=""></a>
                                    <div class="time">3:50</div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="#">There are many variations of passages of Lorem</a>
                                    </div>
                                    <div class="video-page text-success">
                                        Education <a title="" data-placement="top" data-toggle="tooltip" href="#"
                                            data-original-title="Verified"><i
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

</section>
<?php  wp_footer();?>
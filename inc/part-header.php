<?php $header_image_url = get_theme_mod('header_image'); ?>
<div class="head-part-top bg-light p-md-4 p-2" style="background-image: url(<?php echo esc_url($header_image_url); ?>);">
    <?php echo the_custom_logo(); ?>
</div>

<div class="velocity-navbar bg-color-theme bg-pattern p-md-2">
    <nav id="main-nav" class="navbar navbar-expand-md d-block navbar-dark bg-transparent shadow-sm p-0" aria-labelledby="main-nav-label">

        <h2 id="main-nav-label" class="screen-reader-text">
            <?php esc_html_e('Main Navigation', 'justg'); ?>
        </h2>

        <div class="head-part-menu">
            <div class="menu-header">
                <button class="navbar-toggler fw-bold" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                    <span class="navbar-toggler-icon"></span>
                    <small>MENU</small>
                </button>

                <div class="offcanvas offcanvas-start bg-color-theme" tabindex="-1" id="navbarNavOffcanvas">

                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close btn-close-white text-reset fw-bold" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div><!-- .offcancas-header -->

                    <!-- The WordPress Menu goes here -->
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container_class' => 'offcanvas-body',
                            'container_id'    => '',
                            'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 pe-3',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-menu',
                            'depth'           => 4,
                            'walker'          => new justg_WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>
                </div><!-- .offcanvas -->
            </div>
        </div>

    </nav><!-- .site-navigation -->
</div>

<div class="container d-md-block d-none last-head-part py-1 border-bottom">
    <div class="row m-0 align-items-center">
        <div class="col-md-7 p-0 d-md-flex d-none align-items-center">
            <nav id="main-nav" class="navbar navbar-expand-md d-block navbar-light p-0" aria-labelledby="main-nav-label">
                <div class="secondary-menu position-relative">
                    <div class="" tabindex="-1" id="navbarsecondarymenu">
                        <!-- The WordPress Menu goes here -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'secondary',
                                'container_class' => 'secondary-menu-body',
                                'container_id'    => '',
                                'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 px-2',
                                'fallback_cb'     => '',
                                'menu_id'         => 'secondary-menu',
                                'depth'           => 1,
                                'walker'          => new justg_WP_Bootstrap_Navwalker(),
                            )
                        );
                        ?>
                    </div><!-- .offcanvas -->
                </div>
            </nav>
        </div>
        <div class="col-md-2 text-end p-0">
            <?php
            $sosmed = ['facebook', 'twitter', 'instagram', 'youtube'];
            foreach ($sosmed as $key) {
                $datalink  = velocitytheme_option('link_sosmed_' . $key);
                if ($datalink) {
                    echo '<a class="btn btn-sm btn-' . $key . ' text-white ms-1" href="' . $datalink . '" target="_blank"><i class="fa fa-' . $key . '"></i></a>';
                }
            }
            ?>
        </div>
        <div class="col-md-3 p-0">
            <div class="search-header float-end">
                <form action="" method="get" id="search" class="d-flex overflow-hidden">
                    <input type="text" name="s" placeholder="Search" class="form-control-sm bg-transparent border-0 rounded-0">
                    <button type="submit" class="btn btn-link text-secondary py-1 px-2">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
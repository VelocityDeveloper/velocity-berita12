<footer class="site-footer container text-white p-0 mb-md-3" id="colophon">
    <div class="widget-footer p-3">
        <div class="velocity-footer">
            <div class="row footer-widget text-start m-0">
                <?php for ($x = 1; $x <= 4; $x++) {
                    if (is_active_sidebar('footer' . $x . '-sidebar')) : ?>
                        <div class="col-md">
                            <?php dynamic_sidebar('footer' . $x . '-sidebar'); ?>
                        </div>
                    <?php endif; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="site-info align-items-center bg-dark text-center py-2">
        <div class="menufooter d-md-block d-none">
            <nav id="footer-nav" class="navbar navbar-expand-md d-block navbar-light p-0" aria-labelledby="main-nav-label">
                <div class="footer-menu position-relative">
                    <div class="" tabindex="-1" id="navbarfootermenu">
                        <!-- The WordPress Menu goes here -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'footer-menu',
                                'container_class' => 'footer-menu-body',
                                'container_id'    => '',
                                'menu_class'      => 'navbar-nav justify-content-center flex-grow-1 px-2',
                                'fallback_cb'     => '',
                                'menu_id'         => 'footer-menu',
                                'depth'           => 1,
                                'walker'          => new justg_WP_Bootstrap_Navwalker(),
                            )
                        );
                        ?>
                    </div><!-- .offcanvas -->
                </div>
            </nav>
        </div>
        <small>
            © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
            <br>
            Design by <a class="text-secondary" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
        </small>
    </div>
    <!-- .site-info -->
</footer>
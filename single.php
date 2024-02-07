<?php

/**
 * The template for displaying all single posts
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container  = velocitytheme_option('justg_container_type', 'container');
$full_url   = get_the_post_thumbnail_url(get_the_ID(), 'full');
$format     = get_post_format() ?: 'standard';
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card shadow-sm bg-dashed pt-2 px-3 mb-3 rounded-0">
            <?php echo justg_breadcrumb(); ?>
        </div>
        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">
                <div class="mb-3">
                    <?php get_berita_iklan('iklan_content'); ?>
                </div>
                <?php

                while (have_posts()) {
                    the_post();
                ?>

                    <?php the_title('<h1 class="entry-title h4 fw-bold">', '</h1>'); ?>
                    <div class="entry-content">
                        <div class="mb-3">
                            <?php get_berita_iklan('iklan_content_2'); ?>
                        </div>
                        <div class="row m-0 align-items-center">
                            <div class="col-md-7 px-1 mb-3">
                                <div class="wallpaper-box-single bg-dashed">
                                    <?php
                                    if ($full_url && $format !== 'video') {
                                        echo '<img class="img-fluid w-100 p-1" src="' . $full_url . '" loading="lazy">';
                                    }
                                    ?>
                                    <div class="nav-post bg-light p-2 my-1">
                                        <div class="btn-group d-flex justify-content-between" role="group" aria-label="Navigation Post">
                                            <?php
                                            $prev_post = get_adjacent_post(false, '', true);
                                            if (!empty($prev_post)) {
                                                echo '<div><a href="' . get_permalink($prev_post->ID) . '" class="btn btn-sm btn-light border" title="' . $prev_post->post_title . '">Prev</a></div>';
                                            }
                                            echo do_shortcode('[review_form]');
                                            $next_post = get_adjacent_post(false, '', false);
                                            if (!empty($next_post)) {
                                                echo '<div><a href="' . get_permalink($next_post->ID) . '" class="btn btn-sm btn-light border" title="' . $next_post->post_title . '">Next</a></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 px-1">
                                <?php echo do_shortcode('[data-post]'); ?>
                                <div class="single-post-nav d-md-flex justify-content-between border-top border-bottom pt-1 my-3">
                                    <div class="share-post">
                                        <?php echo justg_share(); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php the_content(); ?>
                        <div class="mb-3">
                            <?php get_berita_iklan('iklan_content_3'); ?>
                        </div>

                        <?php
                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . __('Pages:', 'justg'),
                                'after'  => '</div>',
                            )
                        );
                        ?>
                    </div><!-- .entry-content -->

                    <div class="related-post">
                        <div class="related-post-title bg-dashed mb-2">
                            <h6 class="fw-bold m-0 p-2 d-inline-block">RELATED POSTS</h6>
                        </div>
                        <div class="related-post-gallery overflow-hidden">
                            <?php
                            module_vdposts(array(
                                'post_type'         => 'post',
                                'posts_per_page'    => 6,
                                'post__not_in'      => [get_the_ID()],
                                'category__in'      => wp_get_post_categories(get_the_ID()),
                            ), 'gallery');
                            ?>
                        </div>
                    </div>

                <?php

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        do_action('justg_before_comments');
                        comments_template();
                        do_action('justg_after_comments');
                    }
                }
                ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();

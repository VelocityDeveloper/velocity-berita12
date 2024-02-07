<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card shadow-sm bg-dashed pt-2 px-3 mb-3 rounded-0">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row m-0">
            <?php echo left_sidebar(); ?>
            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2 px-0" id="main">

                <?php

                if (have_posts()) :
                ?>
                    <header class="page-header block-primary bg-dashed">
                        <?php
                        the_archive_title('<h6 class="single-title fw-bold text-uppercase m-0 p-2">', '</h6>');
                        the_archive_description('<div class="taxonomy-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->
                    <div class="row m-0">
                        <?php
                        // Start the loop.
                        while (have_posts()) :
                            the_post();
                        ?>
                            <article class="block-primary mb-2 col-md-4 col-6 posts-item gallery-post p-2 overflow-hidden">
                                <div class="position-relative bg-dashed p-1">
                                    <div class="ratio ratio-1x1 bg-light mb-2">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a class="text-white" href="<?php echo get_the_permalink(); ?>">
                                                <img src="<?php echo wp_get_attachment_thumb_url(get_post_thumbnail_id()); ?>" alt="" loading="lazy">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="position-absolute post-text text-center p-2 text-white bg-secondary border-top border-bottom border-white">
                                        <h6 class="judul-post">
                                            <a class="fw-bold text-white d-block" href="<?php echo get_the_permalink(); ?>">
                                                <?php echo get_the_title(); ?>
                                            </a>
                                        </h6>
                                    </div>
                                    <div class="views-post position-absolute bottom-0 mb-3 left-0 bg-dark text-white py-1 px-2 opacity-0"><?php echo justg_get_hit(); ?> Views</div>
                                </div>
                                <div class="bg-dashed">
                                    <div class="bg-white border-top border-bottom p-2"><?php echo display_post_rating(get_the_ID()); ?></div>
                                </div>
                            </article>

                        <?php endwhile; ?>
                    </div>
                <?php
                else :
                    get_template_part('loop-templates/content', 'none');
                endif;
                ?>
                <!-- Display the pagination component. -->
                <?php justg_pagination(); ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();

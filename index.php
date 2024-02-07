<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <div class="col-md">
                <main class="site-main col order-2" id="main">
                    <?php
                    $post1_title    = velocitytheme_option('title_posts_home_1', 'Recent Posts');
                    $post1_cat      = velocitytheme_option('cat_posts_home_1');
                    ?>
                    <div class="part_posts_home_1">
                        <div class="part-post-home-1">
                            <?php
                            $post1_args = array(
                                'post_type' => 'post',
                                'cat'       => $post1_cat,
                                'posts_per_page' => 12,
                            );
                            module_vdposts($post1_args, 'gallery');
                            ?>
                        </div>
                        <!-- Display the pagination component. -->
                        <?php justg_pagination(); ?>
                    </div>
                </main><!-- #main -->
            </div>
            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>
        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();

<?php

/**
 * Kumpulan shortcode yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
//[resize-thumbnail width="300" height="150" linked="true" class="w-100"]
add_shortcode('resize-thumbnail', 'resize_thumbnail');
function resize_thumbnail($atts)
{
    ob_start();
    global $post;
    $atribut = shortcode_atts(array(
        'output'    => 'image', /// image or url
        'width'        => '300', ///width image
        'height'    => '150', ///height image
        'crop'      => 'false',
        'upscale'       => 'true',
        'linked'       => 'true', ///return link to post	
        'class'       => 'w-100', ///return class name to img	
        'attachment'     => 'true'
    ), $atts);

    $output            = $atribut['output'];
    $attach         = $atribut['attachment'];
    $width          = $atribut['width'];
    $height         = $atribut['height'];
    $crop           = $atribut['crop'];
    $upscale        = $atribut['upscale'];
    $linked            = $atribut['linked'];
    $class            = $atribut['class'] ? 'class="' . $atribut['class'] . '"' : '';
    $urlimg            = get_the_post_thumbnail_url($post->ID, 'full');

    if (empty($urlimg) && $attach == 'true') {
        $attachments = get_posts(array(
            'post_type'         => 'attachment',
            'posts_per_page'     => 1,
            'post_parent'         => $post->ID,
            'orderby'          => 'date',
            'order'            => 'DESC',
        ));
        if ($attachments) {
            $urlimg = wp_get_attachment_url($attachments[0]->ID, 'full');
        }
    }

    if ($urlimg) :
        $urlresize      = aq_resize($urlimg, $width, $height, $crop, true, $upscale);
        if ($output == 'image') :
            if ($linked == 'true') :
                echo '<a href="' . get_the_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">';
            endif;
            echo '<img src="' . $urlresize . '" width="' . $width . '" height="' . $height . '" loading="lazy" ' . $class . '>';
            if ($linked == 'true') :
                echo '</a>';
            endif;
        else :
            echo $urlresize;
        endif;

    else :
        if ($linked == 'true') :
            echo '<a href="' . get_the_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">';
        endif;
        echo '<svg style="background-color: #ececec;width: 100%;height: auto;" width="' . $width . '" height="' . $height . '"></svg>';
        if ($linked == 'true') :
            echo '</a>';
        endif;
    endif;

    return ob_get_clean();
}

//[excerpt count="150"]
add_shortcode('excerpt', 'vd_getexcerpt');
function vd_getexcerpt($atts)
{
    ob_start();
    global $post;
    $atribut = shortcode_atts(array(
        'count'    => '150', /// count character
    ), $atts);

    $count        = $atribut['count'];
    $excerpt    = get_the_content();
    $excerpt     = strip_tags($excerpt);
    $excerpt     = substr($excerpt, 0, $count);
    $excerpt     = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt     = '' . $excerpt . '...';

    echo $excerpt;

    return ob_get_clean();
}

// [vd-breadcrumbs]
add_shortcode('vd-breadcrumbs', 'vd_breadcrumbs');
function vd_breadcrumbs()
{
    ob_start();
    echo justg_breadcrumb();
    return ob_get_clean();
}

// [data-post]
add_shortcode('data-post', 'vd_datapost');
function vd_datapost()
{
    ob_start();
    global $post;
    $idpost = $post->ID;
    $author_id = get_post_field('post_author', $idpost);
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_link = get_author_posts_url($author_id);
    $categories = get_the_category($idpost);
    $gettags = get_the_tags($idpost);
?>
    <div class="desc-singleproduct">
        <ul class="info-wallpaper bg-dashed">
            <li><strong>Upload by : </strong> <a href="<?= $author_link; ?>"><?= $author_name; ?></a></li>
            <li>
                <strong>Category : </strong>
                <?php
                if (!empty($categories)) :
                    foreach ($categories as $category) :
                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a> ';
                    endforeach;
                endif; ?>
            </li>
            <li>
                <strong>Tags : </strong>
                <?php
                if (!empty($gettags)) :
                    foreach ($gettags as $index => $tag) :
                        echo $index === 0 ? '' : ',';
                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                        if ($index > 1) : break;
                        endif;
                    endforeach;
                endif; ?>
            </li>
            <li><strong>Added : </strong> <?= get_the_date('F j, Y'); ?></li>
            <li><strong>Display : </strong> <?php echo get_post_meta($idpost, 'hit', true); ?> Views</li>
            <li class="d-flex"><strong class="pe-2">Rating : </strong><?php echo display_post_rating(get_the_ID()); ?></li>
        </ul>
    </div>
<?php
    return ob_get_clean();
}

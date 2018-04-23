<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package News
 */

get_header();
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    $class='col-md-12';
}
else{
    $class='col-md-9';
}
?>
    <div class="d-flex">
        <div class="<?php echo $class;?>">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <?php
                    if ( have_posts() ) :
                        woocommerce_content();
                    endif;
                    ?>

                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
        <?php get_sidebar();?>
    </div>
<?php
get_footer();
<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
    <?php get_sidebar();?>
</div>
<?php
get_footer();

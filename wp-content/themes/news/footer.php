<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News
 */

?>

	    </div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer d-flex align-items-center">
        <div class="container">
            <div class="site-info">
                <div class="footer-logo">
                    <a href="/">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/footer-logo.png';?>" alt="">
                    </a>
                </div>
            </div><!-- .site-info -->
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

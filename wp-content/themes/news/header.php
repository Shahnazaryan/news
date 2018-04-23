<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=cyrillic" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">

            <div class="site-branding d-flex align-items-center ">
                <div class="container d-flex justify-content-between">
                    <?php
                      the_custom_logo();
                    ?>
                    <p> +380 689 89 90</p>
                </div>
            </div><!-- .site-branding -->
            <div class="navigation-bar">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                    <nav id="site-navigation" class="navbar navbar-expand-sm main-navigation">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'news' ); ?></button>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'menu-1',
                            'menu_class' => 'navbar-nav',
                            'menu_id'        => 'primary-menu',
                        ) );
                        ?>
                    </nav><!-- #site-navigation -->
                        <div class="search_form">
                            <?php get_search_form(true)?>
                        </div>
                    </div>
                </div>
            </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
        <div class="container">

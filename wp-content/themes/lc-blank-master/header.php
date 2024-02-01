<?php
/**
 * This is the template that displays all of the <head> section.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
        integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php lct_title('|'); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
  <script type="text/javascript">

    /*window.onload = function () {
      window.history.forward();
    }*/
  </script>
</head>
<body <?php body_class(); ?>>

<?php

if ( function_exists( 'dslc_hf_get_header' ) ) {
	echo dslc_hf_get_header();
}

?>

<?php
/**
 * Functions and definitions.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */

// Delcare Header/Footer compatibility.
define( 'DS_LIVE_COMPOSER_HF', true );
define( 'DS_LIVE_COMPOSER_HF_AUTO', false );

// Content Width ( WP requires it and LC uses is to figure out the wrapper width ).
if ( ! isset( $content_width ) )
{
	$content_width = 1180;
}

if ( ! function_exists( 'lct_theme_setup' ) )
{

	/**
	 * Basic theme setup.
	 */
	function lct_theme_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Enable Post Thumbnails ( Featured Image ).
		add_theme_support( 'post-thumbnails' );

		// Enable support for HTML5 markup.
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );
	}
} add_action( 'after_setup_theme', 'lct_theme_setup' );

/**
 * Load JS and CSS files.
 */
function lct_load_scripts()
{
	wp_enqueue_style( 'lct-base-style', get_stylesheet_uri(), array(), '1.0' );
	wp_enqueue_style( 'painel.css', '/wp-content/themes/lc-blank-master/painel.css', array(), '1.0' );
	wp_enqueue_script( 'jquery' );

}

add_action( 'wp_enqueue_scripts', 'lct_load_scripts' );

if ( ! defined( 'DS_LIVE_COMPOSER_VER' ) )
{

	/**
	 * Admin Notice
	 */
	function lct_notification() {
	?>
		<div class="error">
			<p><?php printf( __( '%sLive Composer%s plugin is %srequired%s and has to be active for this theme to function.', 'lc-blank' ), '<a target="_blank" href="https://wordpress.org/plugins/live-composer-page-builder/">', '</a>', '<strong>', '</strong>' ); ?></p>
		</div>
	<?php }
	add_action( 'admin_notices', 'lct_notification' );
}

/**
 * Proper <title> for header.php - Pass your seperator in header.php. Default: '|'
*/
function lct_title( $sep )
{
	the_title();
	echo ' ' . $sep . ' ';
	bloginfo( 'name ' );
}

// Mudar endereço padrão de e-mail
add_filter( 'wp_mail_from', 'sender_email' );
add_filter( 'wp_mail_from_name', 'sender_name' );

function sender_email( $original_email_address )
{
	return 'eleicaocmpu2023@prefeitura.sp.gov.br';
}

function sender_name( $original_email_from )
{
	return 'Eleição CMPU 2023';
}

function f_the_author( $display_name ) {

    // $display_name === string $authordata->display_name

    if ( is_feed() ) {
        return 'admin_smul';
    }

    return 'admin_smul';
}

add_filter( 'the_author', 'f_the_author', PHP_INT_MAX, 1 );
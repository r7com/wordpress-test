<?php
/**
* Plugin Name: Custom Footer Plugin
* Plugin URI: https://github.com/Ronaldo-Maciel/wordpress-test.git
* Description: Plugin custom rodapé para teste r7.com
* Version: 1.0.0
* Author: Ronaldo Maciel
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class r7_options_page {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'r7_settings_page' ) );
	}

	function r7_settings_page() {
		add_options_page(
			'Rodapé Personalizado',
			'R7 Teste',
			'manage_options',
			'r7-teste',
			array(
				$this,
				'r7_settings_page_inner',
			)
		);
	}

	function  r7_settings_page_inner() {
		?>
		<form method="post" action="options.php"> 
			 <?php 
			 settings_fields('r7_main'); 
    		 do_settings_sections('r7_options'); 
    		 submit_button(); 
    		 ?>
		</form> 
		<?php
	}
}

new r7_options_page;

// styles
function r7_plugin_styles() {
	wp_enqueue_style( 'r7-teste-style', plugin_dir_url( __FILE__ ) . 'css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'r7_plugin_styles' );

// admin settings
add_action( 'admin_init', 'r7_admin_init' );

function r7_admin_init() {
	add_settings_section(
		'r7_main', 
		'Rodapé Personalizado',
		'r7_section_text', 
		'r7_options');
	add_settings_field(
		'active_check',
		'Ativar Rodapé',
		'r7_checkbox_element',
		'r7_options',
		'r7_main' );
	register_setting( 
		'r7_main', 
		'active_check' );
}

function r7_checkbox_element() {
	?>
		<input type="checkbox" id="checkbox_r7-rodape" name="active_check" value="1" <?php checked(1, get_option('active_check'), true); ?>
	<?php
}

function innerFooter() {
	if( get_option('active_check') == 1 ) {
		require_once plugin_dir_path( __FILE__ ) . 'view/custom-footer.php';
	}
}

add_action( 'wp_footer', 'innerFooter', 1 );

function r7_section_text() {
    ?>
		<p>Escolha se você quer um rodapé personalizado em suas páginas!</p>
	<?php
}

?>


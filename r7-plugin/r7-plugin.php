<?php

/**
 *
 * Plugin Name:       R7 Rodape
 * Plugin URI:        https://github.com/r7com/wordpress-test
 * Description:       Plugin de rodape para o teste da o R7
 * Version:           1.0.0
 * Author:            Claudio Melo
 */

define( 'R7_PLUGIN__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'R7_PLUGIN__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function r7_plugin_styles() {
    wp_enqueue_style( 'r7-style', R7_PLUGIN__PLUGIN_URL . 'r7-style.css' );
}
add_action( 'wp_enqueue_scripts', 'r7_plugin_styles' );



//
// FOOTER HTML
//

add_action( 'wp_footer', 'my_facebook_test2', 1 );

function my_facebook_test2() {
	if(get_option('active-r7-rodape') == 1) :
	?>
		<div class="footer-rodape-r7">
			<div class="logo-r7">
				<img src="<?php echo R7_PLUGIN__PLUGIN_URL ?>images/r7com.png" alt="" />
			</div>

			<ul class="menu-rodape-r7">
				<li><a href="">Anuncie no R7</a></li>

				<li><a href="">Trabalhe conosco</a></li>

				<li><a href="">Comunicar erro</a></li>

				<li><a href="">Fale com o R7</a></li>

				<li><a href="">Mapa do site</a></li>

				<li><a href="">Termos e condições de uso</a></li>

				<li><a href="">Privacidade</a></li>
			</ul>

			<p>Claudio Melo - 19/09/2016</p>
		</div>
	<?php
	endif;
}


//
// ADMIN OPTIONS PAGE
//


function r7_plugin_settings_page()
{
    add_settings_section("section", "Section", null, "r7");
    add_settings_field("active-r7-rodape", "Ativar rodapé R7", "r7_plugin_checkbox_display", "r7", "section");  
    register_setting("section", "active-r7-rodape");
}

function r7_plugin_checkbox_display()
{
   ?>
        <input type="checkbox" name="active-r7-rodape" value="1" <?php checked(1, get_option('active-r7-rodape'), true); ?> /> 
   <?php
}

add_action("admin_init", "r7_plugin_settings_page");

function r7_plugin_page()
{
  ?>
      <div class="wrap">
         <h1>Rodapé R7</h1>
  
         <form method="post" action="options.php">
            <?php
               settings_fields("section");
  
               do_settings_sections("r7");
                 
               submit_button(); 
            ?>
         </form>
      </div>
   <?php
}

function menu_item()
{
  add_submenu_page("options-general.php", "R7 Plugin", "Rodapé R7", "manage_options", "r7", "r7_plugin_page"); 
}
 
add_action("admin_menu", "menu_item");

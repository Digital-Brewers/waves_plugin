<?php
/**
 * @package Waves

 *
 * @wordpress-plugin
 * Plugin Name: Waves by DesignStudio
 * Plugin URI: 
 * Description: A plugin that needs a description.
 * Version: 2.0.1-b
 * Author: Design Studios by Jacob Phelps
 * Author URI: https://designstudio.com
 */
namespace waves;

  new waves_plugin();

  class waves_plugin{
    
    private $include_directories = array(
      "interfaces",
      "classes",
      "page_classes",
    );

    public function __construct(){
      $this->check_if_in_admin();
      $this->define_plugin_constants();
      $this->include_scripts();
      $this->include_files();
      $this->define_admin_menu_manager();
      $this->initilize_waves_plugin();
    }
    
    private function check_if_in_admin(){
      if ( ! function_exists( 'add_action' ) ) {
        die( '-1' );
      }
    }

    public function include_scripts(){
      add_action( 'admin_enqueue_scripts', array(&$this, 'include_admin_scripts'));      
    }

    public function include_admin_scripts() {
      wp_enqueue_style( 'admin-style', WAVES_PLUGIN_ASSETS . 'style.min.css' );
      wp_enqueue_style( 'admin_enqueue_scripts', WAVES_PLUGIN_ASSETS . 'scripts.min.js' );
    }

    private function initilize_waves_plugin(){
      $in_wp_admin   = is_admin();
      $should_load   = ( ! class_exists( 'waves' ) );
      if ( $in_wp_admin && $should_load ) {
        // new waves_init();
      }
    }

    private function define_plugin_constants(){
      define( 'WAVES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
      define( 'WAVES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
      define( 'WAVES_PLUGIN_FILE', plugin_basename( __FILE__ ) );
      define( 'WAVES_PLUGIN_ASSETS', plugins_url("waves/assets/") );

      define( 'WAVES_PLUGIN_IMG', WAVES_PLUGIN_ASSETS . "images/" );
      define( 'WAVES_PLUGIN_TEMPLATES', WAVES_PLUGIN_DIR . "page_templates/" );
    }

    public function define_admin_menu_manager(){
      // global $WAVES_MENU_MANAGER;
      $GLOBALS['WAVES_MENU_MANAGER'] = new waves_admin_menu_manager();
    }

    private function include_files(){
      foreach ($this->include_directories as $dir){
        $this->import_php_in_this_directory_root($dir);
      }
    }

    private function import_php_in_this_directory_root ($plugin_directory_dirty){
      $plugin_directory_cleaned = trim($plugin_directory_dirty, "/\\");
      $php_files =  glob( WAVES_PLUGIN_DIR . "/" . $plugin_directory_cleaned . "/*.php");
      foreach ($php_files as $file){
        include_once $file;
      }
    } 

  }
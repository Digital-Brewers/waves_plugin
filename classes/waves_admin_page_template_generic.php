<?php
namespace waves;

class waves_admin_page_template_generic{

    /* These are the same across all settings pages */
    protected const DOMAIN              = "waves";
    protected const CAPABILITY          = "manage_options";
    protected const PAGE_SLUG_BASE      = "ds-waves-";
    protected const PAGE_TITLE_BASE     = "DS Waves - ";
    protected const DEFAULT_PARENT_SLUG = self::PAGE_SLUG_BASE . "page";
    protected $sub_menu = false;



    /*  These variables vary by settings page */
    
    // protected $IMG_ICON            = WAVES_PLUGIN_IMG . "icon.png"; // Select Image in waves/images
    protected $IMG_ICON            = "dashicons-tagcloud"; // https://developer.wordpress.org/resource/dashicons/
    protected $PAGE_TITLE          = "Default";
    
    protected $MENU_ENTRY_NAME  = null;
    protected $MENU_SUB_ENTRY_NAME  = null;
    protected $MENU_ENTRY_POS   = null;

    protected $PAGE_SLUG        = null;

    protected $PAGE_TEMPLATE    = null;
    protected $PARENT_SLUG      = null;

    protected $REMOVE_FROM_SUB_MENU = null;

    public function add_action_waves_admin_menu(){
        add_action( 'admin_menu', array( &$this, 'add_waves_admin_menu' ) );
    }
    
    public function add_action_waves_admin_menu_sub(){
        add_action( 'admin_menu', array( &$this, 'add_waves_sub_menu' ) );
    }

    public function add_waves_admin_menu() {
        $capability     = self::CAPABILITY;
        $icon_url       = $this->IMG_ICON;
        $function       = array( &$this, 'render_settings_options' );
        $menu_slug      = esc_html__($this->get_page_slug(), self::DOMAIN);
        $menu_title     = esc_html__($this->get_menu_entry_title(), self::DOMAIN);
        $page_title     = esc_html__($this->get_page_title(), self::DOMAIN);
        $position       = $this->get_menu_main_entry_pos();
        
        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
    }

    public function add_waves_sub_menu(){
        $capability     = self::CAPABILITY;
        $function       = array( &$this, 'render_settings_options' );
        $menu_slug      = esc_html__($this->get_page_slug(), self::DOMAIN);
        $menu_title     = esc_html__($this->get_menu_sub_entry_title(), self::DOMAIN);
        $page_title     = esc_html__($this->get_page_title(), self::DOMAIN);
        $parent_slug    = $this->get_parent_slug();
        $position       = $this->get_menu_main_sub_pos();

        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);
    }

    public function render_settings_options(){
         if ($this->PAGE_TEMPLATE == null) {
            echo "<b>ERROR</b><br>";
            echo "Page Template: " . $this->PAGE_TEMPLATE . "<br>";
            echo "Class: " . get_class() . "<br>";
            trigger_error("Default PAGE_TEMPLATE value in use. Change this value to get rid of this error.", E_USER_ERROR);
        } else {
            require(WAVES_PLUGIN_TEMPLATES . "header.php");
            require(WAVES_PLUGIN_TEMPLATES . $this->PAGE_TEMPLATE);
        }
    }

    public function get_menu_entry_title(){
        if ($this->MENU_ENTRY_NAME == null) {
            
            trigger_error("Default MENU_ENTRY_NAME value in use. Change this value to get rid of this error.", E_USER_ERROR);
            exit;
        } else {
            return $this->MENU_ENTRY_NAME;
        }
    }

    public function get_menu_sub_entry_title(){
        if ($this->MENU_SUB_ENTRY_NAME == null){
            return $this->get_menu_entry_title();
        } else {
            return $this->MENU_SUB_ENTRY_NAME;
        }
    }
    

    public function get_menu_main_entry_pos() {
        if ($this->MENU_ENTRY_POS == null){
            return 100;
        } else {
            return (int) $this->MENU_ENTRY_POS ;
        }
    }

    public function get_menu_main_sub_pos() {
        if ($this->MENU_ENTRY_POS == null){
            return 0;
        } else {
            return (int) $this->MENU_ENTRY_POS ;
        }
    }

    public function get_page_title(){
        return self::PAGE_TITLE_BASE . $this->PAGE_TITLE;
    }

    public function get_page_slug(){
        if ($this->PAGE_SLUG == null){
            return self::DEFAULT_PARENT_SLUG;
        } else {
            return self::PAGE_SLUG_BASE . $this->PAGE_SLUG;
        }
    }

    public function get_parent_slug(){
        if ($this->PARENT_SLUG != null) {
            return $this->PARENT_SLUG;
        } else {
            return self::DEFAULT_PARENT_SLUG;
        }
    }

    public function set_menu_position($i){
        if ($this->MENU_ENTRY_POS == null){
            $this->MENU_ENTRY_POS = $i;
        }
    }
    public function is_sub_menu(){
        return $this->sub_menu;
    }

    public function add_action_to_remove_from_submenu(){
        if ($this->REMOVE_FROM_SUB_MENU){
            add_action( 'admin_menu', array( &$this, 'remove_sub_menu_item' ) );
        }
    }

    public function get_page_link(){
        $slug = $this->get_page_slug();
        return "/wp-admin/admin.php?page=$slug";
        // return "/wp-admin/admin.php?page=ds-waves-about";
    }

    public function __toString(){
        return $this->get_menu_sub_entry_title();
    }
}
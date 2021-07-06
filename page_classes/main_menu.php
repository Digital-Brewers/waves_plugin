<?php
namespace waves;

class Main_Page extends waves_admin_page_template_main_menu_item {
    // protected $IMG_ICON         = WAVES_PLUGIN_IMG . "icon.png"; // Select Image in waves/images
    protected $IMG_ICON         = "dashicons-tagcloud"; // https://developer.wordpress.org/resource/dashicons/
    protected $PAGE_TITLE       = "Menu";
    protected $MENU_ENTRY_NAME  = "DS Waves";
    protected $MENU_SUB_ENTRY_NAME  = "Home";
    protected $MENU_POSITION    = 100;
    protected $PAGE_SLUG        = "page";
    protected $PAGE_TEMPLATE    = "brands_page.php";

    protected $REMOVE_FROM_SUB_MENU = true;


}
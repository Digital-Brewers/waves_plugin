<?php
namespace waves;

class Settings_Page extends waves_admin_page_template_sub_menu_item {
    protected $PAGE_TITLE       = "Settings Page Title";
    protected $MENU_ENTRY_NAME  = "Settings";
    protected $MENU_ENTRY_POS    = 500;
    protected $PAGE_SLUG        = "settings";
    protected $PAGE_TEMPLATE    = "settings_page.php";
}
<?php
namespace waves;

class About_Page extends waves_admin_page_template_sub_menu_item {
    protected $PAGE_TITLE       = "About";
    protected $MENU_ENTRY_NAME  = "About";
    protected $MENU_ENTRY_POS    = 600;
    protected $PAGE_SLUG        = "about";
    protected $PAGE_TEMPLATE    = "about_page.php";
}
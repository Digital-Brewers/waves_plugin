<?php
namespace waves;

class Brands_Page extends waves_admin_page_template_sub_menu_item {
    protected $PAGE_TITLE       = "Brands";
    protected $MENU_ENTRY_NAME  = "Brands";
    protected $MENU_ENTRY_POS    = 100;
    protected $PAGE_SLUG        = "brands";
    protected $PAGE_TEMPLATE    = "brands_page.php";
}
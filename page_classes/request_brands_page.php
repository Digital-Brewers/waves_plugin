<?php
namespace waves;

class Request_Brands_Page extends waves_admin_page_template_sub_menu_item {
    protected $PAGE_TITLE       = "Request Brands";
    protected $MENU_ENTRY_NAME  = "Request Brands";
    protected $MENU_ENTRY_POS    = 300;
    protected $PAGE_SLUG        = "requests";
    protected $PAGE_TEMPLATE    = "request_brands.php";
}
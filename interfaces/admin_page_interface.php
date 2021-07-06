<?php
namespace waves;

interface admin_settings_page{
    public function __construct();
    public function add_action_waves_admin_menu();
    public function add_waves_admin_menu_sub_entries();
    public function add_waves_admin_menu();
    public function add_waves_sub_menu();
}

?>
<?php
namespace waves;

class waves_admin_page_template_main_menu_item extends waves_admin_page_template_generic {
    public function build_page(){
        $this->add_action_waves_admin_menu();
        $this->add_action_waves_admin_menu_sub();
    }
}
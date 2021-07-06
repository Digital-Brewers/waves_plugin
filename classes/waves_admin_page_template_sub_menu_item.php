<?php
namespace waves;

class waves_admin_page_template_sub_menu_item extends waves_admin_page_template_generic{
    protected $sub_menu = true;

    public function build_page(){
        $this->add_action_waves_admin_menu_sub();
    }
}
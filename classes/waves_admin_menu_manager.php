<?php
namespace waves;

class waves_admin_menu_manager {
    private $menu_main_page_list = array();
    private $menu_sub_page_list = array();
    private $menu_sub_page_list_ordered = array();

    public function __construct(){
        $this->call_page_classes();
        $this->set_sub_menu_order();

        $this->populate_menu_pages();
        $this->populate_menu_sub_pages();
    }


    private function call_page_classes(){
        $class_list = $this->get_classes_in_this_namespace();
        foreach ($class_list as $class_name){
            $class_name_as_arr = explode("_", $class_name);
            $class_type = strtolower(end($class_name_as_arr));
            if (strcmp($class_type, "page") == 0){
                $class_name = __NAMESPACE__ . "\\" . $class_name;
                $menu_entry_obj = new $class_name;
                $menu_entry_title = $menu_entry_obj->get_menu_entry_title();

                if ($menu_entry_obj->is_sub_menu()){
                    $this->menu_sub_page_list[$menu_entry_title] = $menu_entry_obj;
                } else {
                    $this->menu_main_page_list[$menu_entry_title] = $menu_entry_obj;
                }

            } 
        }
        ksort($this->menu_main_page_list);
        ksort($this->menu_sub_page_list);
    }

    private function get_classes_in_this_namespace() {
        $namespace = __NAMESPACE__ . '\\';
        $myClasses  = array_filter(get_declared_classes(), function($item) use ($namespace) { return substr($item, 0, strlen($namespace)) === $namespace; });
        $theClasses = [];
        foreach ($myClasses AS $class):
              $theParts = explode('\\', $class);
              $theClasses[] = end($theParts);
        endforeach;
        return $theClasses;
  }

    private function set_sub_menu_order(){
        $i = 100;
        foreach ($this->menu_sub_page_list as $page){
                $page->set_menu_position($i);
                $pos = $page->get_menu_main_sub_pos();
                $this->menu_sub_page_list_ordered[$pos] = $page;
                $i += 100;
        }
        ksort($this->menu_sub_page_list_ordered);
    }

    private function populate_menu_sub_pages(){
        foreach ($this->menu_sub_page_list_ordered as $page){
            $page->build_page();
        }
    }

    private function populate_menu_pages(){
        foreach ($this->menu_main_page_list as $page){
            $page->build_page();
        }
    }

    public function get_menu(){
        foreach ($this->menu_sub_page_list_ordered as $item){
            $link_text  = $item->get_menu_sub_entry_title();
            $link_dest  = $item->get_page_link();
            echo "  <a href='$link_dest'>$link_text</a>  ";
        }
    }

}
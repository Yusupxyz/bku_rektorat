<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Output View for Admin or Front .
 *
 **/
class Layout
{
    // CI
    private $CI;
    private $privilege = true;
    


    public function __construct()
    {
        $this->CI = &get_instance();
    }



    /**
     * Auth.
     *
     * @return bool
     **/
    public function auth()
    {
        if (!$this->CI->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
    }

    public function auth_privilege($current_url){
        $query = $this->CI->db->query("select menu.id, substring_index(menu.link, '/', 1) as menulink, menu.label, groups_menu.id_groups from menu JOIN groups_menu on menu.id_menu = groups_menu.id_menu where substring_index(menu.link, '/', 1) = '$current_url'");
        $count = $query->num_rows();
        if($count != 0){
            $user_id = $this->CI->ion_auth->get_user_id();
            $q = $this->CI->db->query("select * from users_groups where user_id = '$user_id'")->result();
            $check = false;
            foreach ($q as $key => $value) {
                $x = $this->CI->db->query("select menu.id, substring_index(menu.link, '/', 1) as menulink, menu.label, groups_menu.id_groups from menu left JOIN groups_menu on menu.id_menu = groups_menu.id_menu where substring_index(menu.link, '/', 1) = '$current_url' and groups_menu.id_groups = '$value->group_id'");
                $countpriv = $x->num_rows();
                if($countpriv>0){
                    $check = true;
                }
            }
            if(!$check){
               redirect('Dashboard', 'refresh');
            }
            //echo $count;
        }
            

    }


    /**
     * Get multy level menu.
     *
     * @return HTML
     **/
     public function get_menu($type = 'side menu')
    {
        // Privilage
        $this->CI->db->where('id_groups', null);
        $this->CI->db->join('groups_menu', 'groups_menu.id_menu = menu.id_menu', 'left');
        $this->CI->db->select('menu.id_menu');
        $menu_all = $this->CI->db->get('menu');
        foreach ($menu_all->result() as $new_menu_all) {
            $id_menu[] = $new_menu_all->id_menu;
        }

        if ($this->CI->ion_auth->logged_in()) {
            $this->CI->db->where('user_id', $this->CI->ion_auth->user()->row()->id);
            $this->CI->db->join('groups_menu', 'groups_menu.id_groups = users_groups.group_id', 'right');
            $this->CI->db->group_by('id_menu');
            $this->CI->db->select('id_menu');
            $groups = $this->CI->db->get('users_groups');
            foreach ($groups->result() as $groups) {
                $id_menu[] = $groups->id_menu;
            }
        }

        $where_type = 'type = "'.$type.'"';
        if (is_array($id_menu)) {
            $where_privilage = 'id_menu in ('.implode(',', $id_menu).') and ';
        } else {
            $where_privilage = null;
        }
        $this->CI->db->where($where_privilage.$where_type);
        $this->CI->db->join('menu_type', 'menu_type.id_menu_type = menu.id_menu_type', 'left');
        $this->CI->db->order_by('sort', 'ASC');
        $this->CI->db->order_by('label', 'ASC');
        $menus = $this->CI->db->get('menu');

        return $this->menus($menus->result_array());
    }
    /**
     * Get menu in array.
     *
     * @return array
     **/
    public function menus($menus, $parent_id = 0)
    {
        $new_menus = null;
        foreach ($menus as $menu) {
            if ($parent_id == $menu['parent_id']) {
                $new_menus[$menu['id_menu']] = [
                    'label' => $menu['label'],
                    'icon' => $menu['icon'],
                    'link' => $menu['link'],
                    'attr' => $menu['id'],
                    'level' => $menu['level'],
                    'children' => $this->menus($menus, $menu['id_menu']),
                ];
            }
        }

        return $new_menus;
    }

    
    /**
     * @param string     $view
     * @param array|null $data
     * @param bool       $returnhtml
     *
     * @return mixed
     */
    public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
    {

        $this->viewdata = (empty($data)) ? $this->data : $data;
        
        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        // This will return html on 3rd argument being true
        if ($returnhtml)
        {
            return $view_html;
        }
    }

     /**
     * Return breadcrumb list $crumb = array.
     *
     * @return HTML
     **/
    public function breadcrumb($crumb, $homecrumb = null)
    {
        if ($homecrumb == null) {
            $homecrumb['icon'] = 'home';
            $homecrumb['label'] = 'Home';
            $homecrumb['link'] = 'Dashboard/index';
        }
        echo '<ol class="breadcrumb">';
        if (!isset($crumb)) {
            echo '<li class="active"><i class="fa fa-'.$homecrumb['icon'].'"></i> '.$homecrumb['label'].'</li>';
        } else {
            echo '<li><a href="'.site_url($homecrumb['link']).'"><i class="fa fa-tachometer-alt"></i> '.$homecrumb['label'].'</a></li>';
            foreach ($crumb as $label => $link) {
                if ($link == '') {
                    $add_crumb = strpos(current_url(), '/add');
                    $edit_crumb = strpos(current_url(), '/edit');
                    $read_crumb = strpos(current_url(), '/read');
                    if ($add_crumb || $edit_crumb || $read_crumb) {
                        if ($add_crumb) {
                            $part_link = str_replace('/add', '', current_url());
                            $label_new = 'Add';
                        }
                        if ($edit_crumb) {
                            $part_link = strstr(current_url(), '/edit', true);
                            $label_new = 'Edit';
                        }
                        if ($read_crumb) {
                            $part_link = strstr(current_url(), '/read', true);
                            $label_new = 'Read';
                        }
                        echo '<li><a href="'.$part_link.'">'.$label.'</a></li>';
                        echo '<li class="active">'.$label_new.'</li>';
                    } else {
                        echo '<li class="active">'.$label.'</li>';
                    }
                } else {
                    echo '<li><a href="'.site_url($link).'">'.$label.'</a></li>';
                }
            }
        }
        echo '</ol>';
    }

     /**
     * Privilage.
     *
     * @return bool
     **/
    public function set_privilege($group)
    {
        if (!$this->CI->ion_auth->in_group($group)) {
            redirect('/', 'refresh');
        }
    }

    public function set_menu_privilege($controller){
            }
    
   
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
        $c_url = $this->router->fetch_class();
        $this->layout->auth_privilege($c_url);  

	}
	
	public function index()
	{
		$this->load->view('template/header');
	}

	/**
     * Nestable drag & drop menu level & sort.
     *
     * @return HTML
     **/
    public function menu($type = 'side menu')
    {
        //last_url('set'); // save last url
        $template_data['menu_type'] = $this->db->get('menu_type')->result();
        $type = urldecode(str_replace('-', ' ', $type));
        $template_data['admin_menu'] = $this->get_menu($type);

        $this->layout->set_privilege(1);
        $this->layout->auth();

        $template_data['title'] = 'Menu';
        $template_data['subtitle'] = 'Menu';
        $template_data['crumb'] = [
            'Menu' => '',
        ];
        $template_data['code_js'] = 'menu/codejs';
        $template_data['page'] = 'menu/index';
		$this->load->view('template/backend', $template_data);
        //$this->layout->render('admin', $template_data);
    }

     /**
     * Get db menu nestable.
     *
     * @return string
     **/
    public function get_menu($type)
    {
        $this->db->where('type = "'.$type.'"');
        $this->db->join('menu_type', 'menu_type.id_menu_type = menu.id_menu_type', 'left');
        $this->db->order_by('sort', 'ASC');
        $menus = $this->db->get('menu')->result_array();

        return $this->get_nestable_menu($menus);
    }

    /**
     * Show list nestable menu.
     *
     * @return string
     **/
    public function get_nestable_menu($menus, $parent_id = 0)
    {
        $list_menu = '';
        foreach ($menus as $menu) {
            if ($parent_id == $menu['parent_id']) {
                $type = urldecode(str_replace(' ', '-', strtolower($menu['type'])));
                $list_menu .= '<li class="dd-item" data-id="'.$menu['id_menu'].'">
                <div class="dd-handle bg-purple"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i></div><p>'.$menu['label'].'
                <span class="dd-action">
                  <a href="'.site_url('menu/update/'.$menu['id_menu']).'" title="Edit" class="delete-confirm btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                  <a href="#" title="Delete" class="delete-confirm btn btn-xs btn-danger" onclick="return confirmdelete(\'cms/crud_menu/'.$type.'/delete/'.$menu['id_menu'].'\')")><i class="fa fa-trash"></i></a>
              </span></p>';
                $list_menu .= $this->get_nestable_menu($menus, $menu['id_menu']);
                $list_menu .= '</li>';
            }
        }

        if ($list_menu != '') {
            return '<ol class="dd-list">'.$list_menu.'</ol>';
        } else {
            return;
        }
    }

     /**
     * Re order SORT menu DB.
     *
     * @return array
     **/
    public function menu_re_sort($id_menu_type)
    {
        $this->db->where('id_menu_type = "'.$id_menu_type.'"');
        $this->db->order_by('sort', 'ASC');
        $menus = $this->db->get('menu')->result_array();

        return $this->get_re_sort($menus);
    }

    /**
     * Re order SORT menu.
     *
     * @return array
     **/
    public function get_re_sort($menus, $parent_id = 0)
    {
        $menu_array = null;
        foreach ($menus as $menu) {
            if ($parent_id == $menu['parent_id']) {
                $children = $this->get_re_sort($menus, $menu['id_menu']);
                if ($children) {
                    $menu_array[] = ['id' => $menu['id_menu'], 'children' => $children];
                } else {
                    $menu_array[] = ['id' => $menu['id_menu']];
                }
            }
        }

        return $menu_array;
    }

    /**
     * Update menu.
     *
     * @return redirect
     **/
    public function update_menu($menu = null, $return = true)
    {
        if ($menu == null) {
            $type = $this->input->post('type');
            $menu = $this->input->post('json_menu');
        }
        $decode = json_decode($menu);

        $this->decode_menu($decode);
        if ($return) {
            redirect('cms/menu/'.$type);
        }
    }

    /**
     * Save menu into database.
     *
     * @return array
     **/
    public function decode_menu($menu, $parent_id = null, $level = null, $sort = null)
    {
        if ($parent_id == null && $level == null) {
            $parent_id = 0;
            if ($this->uri->segment(3) == 'side_menu') {
                $level = 0;
            } else {
                $level = 1;
            }
        }

        if ($sort == null) {
            $sort = 0;
        }
        foreach ($menu as $value) {
            $update_menu = ['sort' => $sort, 'id_menu' => $value->id, 'level' => $level, 'parent_id' => $parent_id];

            $this->db->where('id_menu', $value->id);
            $this->db->update('menu', $update_menu);
            ++$sort;

            if (isset($value->children)) {
                $sort = $this->decode_menu($value->children, $value->id, $level + 1, $sort);
            }
        }

        return $sort;
    }

     /**
     * Crud multy level menu.
     *
     * @return HTML
     **/
    public function crud_menu()
    {
        if ($this->uri->segment(4) == 'delete') {
            $id_menu = $this->uri->segment(5);
            $this->db->where('id_menu', $id_menu);
            $this->db->delete('menu');

            $this->db->where('id_menu', $id_menu);
            $this->db->delete('groups_menu');

            // Delete Children
            $this->db->where('parent_id', $id_menu);
            $get_groups = $this->db->get('menu')->result();
            foreach ($get_groups as $menu) {
                $this->db->where('id_menu', $menu->id_menu);
                $this->db->delete('menu');
            }

            $this->db->where('parent_id', $id_menu);
            $this->db->delete('menu');

            $this->sort_menu_callback(0, $id_menu);
            redirect('cms/menu/'.$this->uri->segment(3));
        } else {
           
            $type = urldecode(str_replace('-', ' ', $this->uri->segment(3)));
            echo $type;
        }
    }
     /**
     * List icon picker
     * @param  string   $value
     * @param  integer  $primary_key
     * @return html
     */
    public function iconList($value = '', $primary_key = null)
    {
        $data['value'] = $value;
        return $this->load->view('icons', $data, true);
    }

    /**
     * Resort menu.
     *
     * @return bool
     **/
    public function sort_menu_callback($post_array, $primary_key)
    {
        $this->db->where('id_menu', $primary_key);
        $id_menu_type = $this->db->get('menu')->row()->id_menu_type;
        $menu_json = json_encode($this->menu_re_sort($id_menu_type));
        $this->update_menu($menu_json, false);

        return true;
    }
}

<?php

/*
@Description: User controller
@Author: Dhaval Panchal
@Input:
@Output:
@Date: 4-7-2018
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_management_control extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->viewname        = $this->router->uri->segments[2];
        $this->user_type       = 'admin';
        $this->table_name      = 'admin_management';
        $this->page_title      = $this->lang->line('user_long');
        $this->admin_session   = $this->session->userdata($this->lang->line('business_crm_admin_session'));
        $this->message_session = $this->session->flashdata('message_session');
        // pr($this->admin_session);exit;
    }

    /*
    @Description: Function for Get All User List
    @Author: Dhaval Panchal
    @Input: - Search value or null
    @Output: - all User list
    @Date: 4-7-2018
     */

    public function index()
    {

        ///Get Ajax post data
        $searchtext = $this->input->post('searchtext');
        $sortfield  = $this->input->post('sortfield');
        $sortby     = $this->input->post('sortby');
        $perpage    = $this->input->post('perpage');
        $allflag    = $this->input->post('allflag');

        if (!empty($allflag) && ($allflag == 'all' || $allflag == 'changesorting' || $allflag == 'changesearch')) {
            $this->session->unset_userdata('admin_sortsearchpage_data');
        }

        $data['sortfield']  = 'id';
        $data['sortby']     = 'desc';
        $searchsort_session = $this->session->userdata('admin_sortsearchpage_data');

        if (!empty($sortfield) && !empty($sortby)) {
            $data['sortfield'] = $sortfield;
            $data['sortby']    = $sortby;
        } else {

            if (!empty($searchsort_session['sortfield'])) {
                if (!empty($searchsort_session['sortby'])) {
                    $data['sortfield'] = $searchsort_session['sortfield'];
                    $data['sortby']    = $searchsort_session['sortby'];
                    $sortfield         = $searchsort_session['sortfield'];
                    $sortby            = $searchsort_session['sortby'];
                }
            } else {
                $sortfield = 'id';
                $sortby    = 'desc';
            }
        }

        if (!empty($searchtext)) {
            $data['searchtext'] = $searchtext;
        } else {

            if (empty($allflag)) {
                if (!empty($searchsort_session['searchtext'])) {
                    $data['searchtext'] = $searchsort_session['searchtext'];
                    $searchtext         = $data['searchtext'];
                } else {
                    $data['searchtext'] = '';
                }
            } else {
                $data['searchtext'] = '';
            }
        }

        if (!empty($perpage) && $perpage != 'null') {
            $data['perpage']    = $perpage;
            $config['per_page'] = $perpage;
        } else {

            if (!empty($searchsort_session['perpage'])) {
                $data['perpage']    = trim($searchsort_session['perpage']);
                $config['per_page'] = trim($searchsort_session['perpage']);
            } else {
                $config['per_page'] = PAGINATION_SIZE;
                $data['perpage']    = PAGINATION_SIZE;
            }
        }

        $config['base_url']        = site_url($this->user_type . '/' . $this->viewname);
        $config['is_ajax_paging']  = true; // default FALSE
        $config['paging_function'] = 'ajax_paging'; // Your jQuery paging

        if (!empty($allflag) && ($allflag == 'all' || $allflag == 'changesorting' || $allflag == 'changesearch')) {
            $config['uri_segment'] = 0;
            $uri_segment           = 0;
        } else {
            $config['uri_segment'] = 3;
            $uri_segment           = $this->uri->segment(3);
        }

        $fields = array('*', 'CONCAT_WS(" ",first_name,last_name) as name');

        $where = '';

        if (!empty($searchtext)) {
            $searchkeyword = mysqli_real_escape_string($this->db->conn_id, (trim(stripslashes($searchtext))));
            $where         = '(CONCAT_WS(" ",first_name,last_name) LIKE "%' . $searchkeyword . '%" OR email LIKE "%' . $searchkeyword . '%" OR first_name LIKE "%' . $searchkeyword . '%" OR last_name LIKE "%' . $searchkeyword . '%") OR mobile LIKE "%' . $searchkeyword . '%" ';
        }

        //Get All Users
        $sq_data_all = array
            (
            "table"       => 'admin_management',
            "fields"      => $fields,
            "num"         => $config['per_page'],
            "offset"      => $uri_segment,
            "orderby"     => $sortfield,
            "sort"        => $sortby,
            "wherestring" => $where,
        );
        $data['datalist']        = $this->Common_function_model->getmultiple_tables($sq_data_all);
        $sq_data_all['offset']   = '';
        $sq_data_all['num']      = '';
        $sq_data_all['totalrow'] = '1';
        $config['total_rows']    = $this->Common_function_model->getmultiple_tables($sq_data_all);

        ///Prepare Paginations
        $this->pagination->initialize($config);
        $data['pagination']  = $this->pagination->create_links();
        $data['uri_segment'] = $uri_segment;

        //Set Session
        $admin_sortsearchpage_data = array(
            'sortfield'   => $data['sortfield'],
            'sortby'      => $data['sortby'],
            'searchtext'  => $data['searchtext'],
            'perpage'     => trim($data['perpage']),
            'uri_segment' => $uri_segment,
            'total_rows'  => $config['total_rows']);
        $this->session->set_userdata('admin_sortsearchpage_data', $admin_sortsearchpage_data);

        if ($this->input->post('result_type') == 'ajax') {
            $this->load->view($this->user_type . '/' . $this->viewname . '/ajax_list', $data);
        } else {
            $data['main_content'] = $this->user_type . '/' . $this->viewname . "/list";
            $data['foot_part_js'] = 'admin_list';
            $this->load->view('admin/include/template', $data);
        }
    }

    /*
    @Description: Function Add New User details
    @Author: Dhaval Panchal
    @Input: -
    @Output: - Load Form for add User details
    @Date: 4-7-2018
     */

    public function add_record()
    {

        $data['main_content'] = "admin/" . $this->viewname . "/add";
        $data['foot_part_js'] = 'admin_add';
        $this->load->view('admin/include/template', $data);
    }

    /*
    @Description: Function for Insert New admin
    @Author: Dhaval Panchal
    @Input: - Details of new User which is inserted into DB
    @Output: - List of User with new inserted records
    @Date: 4-7-2018
     */

    public function insert_data()
    {
        // pr($_FILES);
        // pr($_POST);exit;

        $this->load->library('form_validation');

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('save') === 'submitForm') {
            $this->form_validation->set_rules('first_name', 'first name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('last_name', 'last name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[admin_management.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[npassword]');
            $this->form_validation->set_rules('npassword', 'Password confirmation', 'trim|required');
            $this->form_validation->set_message('check_email', 'Email already exists');

            if ($this->form_validation->run() == false) {
                $data['main_content'] = $this->user_type . '/' . $this->viewname . "/add";
                $this->load->view($this->user_type . '/include/template', $data);
            } else {
                ///Insert New User
                $data = array
                    (
                    "first_name"    => strtolower($this->input->post('first_name')),
                    "last_name"     => strtolower($this->input->post('last_name')),
                    "email"         => strtolower($this->input->post('email')),
                    "mobile"        => $this->input->post('mobile'),
                    "password"      => $this->Common_function_model->encrypt_script($this->input->post('password')),
                    "created_date"  => date('Y-m-d H:i:s'),
                    "modified_date" => date('Y-m-d H:i:s'),
                    "status"        => 1,
                );

                $bgImgPath = $this->config->item('admin_pic_big_path');

                //Upload image
                $this->load->model('Imageupload_model');

                if (!empty($_FILES['profile_pic']['name'])) {
                    $uploadFile       = 'profile_pic';
                    $thumb            = "thumb";
                    $hiddenImage      = '';
                    $small_image_size = array(
                        array
                        (
                            'imagepath' => $this->config->item('admin_pic_thumb_path'),
                            'width'     => 100,
                            'Height'    => 100,
                        ),
                    );
                    $image_name = $this->Imageupload_model->uploadBigImage($uploadFile, $bgImgPath, $thumb, $hiddenImage, $small_image_size, true);

                    if (!empty($image_name)) {
                        $data += array("profile_pic" => $image_name);
                    }
                }

                $inserted_data = $this->Common_function_model->insert($this->table_name, $data);

                if (!empty($inserted_data)) {
                    $template_data['password'] = $this->input->post('password');
                    $template_data['name']     = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
                    $template_data['email']    = $this->input->post('email');
                    $actdata                   = array(
                        'adminData'  => $template_data,
                        'login_link' => $login_link,
                    );
                    $activation_tmpl = $this->load->view('email_template/new_admin_insert', $actdata, true);

                    $sub  = $this->config->item('sitename') . " : Welcome to " . $this->config->item('sitename');
                    $from = $this->config->item('admin_email');
                    $to   = $this->input->post('email');

                    $this->Common_function_model->send_email($to, $sub, $activation_tmpl, $from);

                    ////////////
                    $response = array(
                        "status"  => $this->lang->line('message_type_success'),
                        "message" => $this->lang->line('common_add_success_msg'),
                    );
                    $this->session->set_flashdata('message_session', $response);
                    redirect($this->user_type . '/' . $this->viewname);
                } else {
                    $response = array(
                        "status"  => $this->lang->line('message_type_failed'),
                        "message" => $this->lang->line('common_error_msg'),
                    );
                    $this->session->set_flashdata('message_session', $response);
                    redirect($this->user_type . '/' . $this->viewname);
                }
            }
        } else {
            $response = array(
                "status"  => $this->lang->line('message_type_failed'),
                "message" => $this->lang->line('common_error_msg'),
            );
            $this->session->set_flashdata('message_session', $response);
            redirect($this->user_type . '/' . $this->viewname);
        }
    }

    /*
    @Description: Get Details of Edit admin
    @Author: Dhaval Panchal
    @Input: - Id of User member whose details want to change
    @Output: - Details of user which id is selected for update
    @Date: 25-11-2016
     */

    public function edit_record()
    {
        $id = $this->uri->segment(4);
        /*$data['smenu_title'] = $this->lang->line('admin_left_menu15');
        $data['submodule'] = $this->lang->line('admin_left_ssclient');*/

        $field       = array('id', 'first_name', 'last_name', 'mobile', 'email', 'profile_pic');
        $match       = array('id' => $id);
        $sq_data_all = array
            (
            "table"     => $this->table_name,
            "fields"    => $field,
            "condition" => $match,
        );
        $result = $this->Common_function_model->getmultiple_tables($sq_data_all);

        if (empty($result)) {
            redirect($this->user_type . '/' . $this->viewname);
        }

        $data['editRecord']   = $result;
        $data['foot_part_js'] = 'admin_add';
        $data['main_content'] = $this->user_type . '/' . $this->viewname . "/add";
        $this->load->view($this->user_type . '/include/template', $data);
    }

    /*
    @Description: Function for Update User Profile
    @Author: Dhaval Panchal
    @Input: - Update details of User
    @Output: - List with updated User details
    @Date: 4-7-2018
     */

    public function update_data()
    {

        $this->load->library('form_validation');

        //Check user
        $cdata['id'] = $this->input->post('id');
        $match       = array('id' => $cdata['id']);
        $sq_data_all = array
            (
            "table"     => $this->table_name,
            "condition" => $match,
        );
        $result = $this->Common_function_model->getmultiple_tables($sq_data_all);

        if (empty($result)) {
            $response = array(
                "status"  => $this->lang->line('message_type_failed'),
                "message" => $this->lang->line('common_error_msg'),
            );
            $this->session->set_flashdata('message_session', $response);
            redirect($this->user_type . '/' . $this->viewname);
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('save') === 'submitForm') {
            $password = $this->input->post('password');

            $this->form_validation->set_rules('first_name', 'first name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('last_name', 'last name', 'trim|required|min_length[2]|max_length[100]');

            if (!empty($password) && !empty($password)) {
                $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[npassword]');
                $this->form_validation->set_rules('npassword', 'Password confirmation', 'trim|required');
            }

            if ($this->form_validation->run() == false) {
                $data['editRecord']   = $result;
                $data['main_content'] = $this->user_type . '/' . $this->viewname . "/add";
                $this->load->view($this->user_type . '/include/template', $data);
            } else {
                $cdata['first_name']    = strtolower($this->input->post('first_name'));
                $cdata['last_name']     = strtolower($this->input->post('last_name'));
                $cdata['mobile']        = $this->input->post('mobile');
                $cdata['modified_date'] = date('Y-m-d H:i:s');

                $oldcontactimg = $this->input->post('oldfile');
                $oldfile1      = $this->input->post('oldfile1');
                $bgImgPath     = $this->config->item('admin_pic_big_path');

                //Upload image

                if (!empty($_FILES['profile_pic']['name'])) {
                    $uploadFile       = 'profile_pic';
                    $thumb            = "thumb";
                    $hiddenImage      = !empty($oldcontactimg) ? $oldcontactimg : '';
                    $small_image_size = array(
                        array
                        (
                            'imagepath' => $this->config->item('admin_pic_thumb_path'),
                            'width'     => 350,
                            'Height'    => 150,
                        ),
                    );
                    $this->load->model('Imageupload_model');
                    $image_name = $this->Imageupload_model->uploadBigImage($uploadFile, $bgImgPath, $thumb, $hiddenImage, $small_image_size, true);

                    if (!empty($image_name)) {
                        $cdata += array("profile_pic" => $image_name);
                    }
                } elseif ($oldfile1 == '' && !empty($oldcontactimg)) {
                    $image = $this->input->post('oldfile');

                    if (file_exists($this->config->item('admin_pic_big_path') . $image)) {
                        unlink($this->config->item('admin_pic_big_path') . $image);
                    }

                    if (file_exists($this->config->item('admin_pic_thumb_path') . $image)) {
                        unlink($this->config->item('admin_pic_thumb_path') . $image);
                    }

                    $cdata += array("profile_pic" => '');
                } elseif (!empty($oldcontactimg)) {
                    $cdata += array("profile_pic" => $oldcontactimg);
                }

                //END

                $this->Common_function_model->update($this->table_name, $cdata, array('id' => $cdata['id']));

                $response = array(
                    "status"  => $this->lang->line('message_type_success'),
                    "message" => $this->lang->line('common_edit_success_msg'),
                );
                $this->session->set_flashdata('message_session', $response);
                $searchsort_session = $this->session->userdata('admin_sortsearchpage_data');
                $pagingid           = $searchsort_session['uri_segment'];
                redirect($this->user_type . '/' . $this->viewname . '/' . $pagingid);
            }
        } else {
            $response = array(
                "status"  => $this->lang->line('message_type_failed'),
                "message" => $this->lang->line('common_error_msg'),
            );
            $this->session->set_flashdata('message_session', $response);
            redirect($this->user_type . '/' . $this->viewname);
        }
    }

    /*
    @Description: Function for Active and Inactive By Admin
    @Author: Dhaval Panchal
    @Date: 4-7-2018
     */

    public function status_update()
    {
        $id = $this->uri->segment(4);

        $cdata['id']     = $id;
        $cdata['status'] = $this->input->post('status');
        $this->Common_function_model->update($this->table_name, $cdata, array('id' => $cdata['id']));

        $searchsort_session = $this->session->userdata('admin_sortsearchpage_data');

        if (!empty($searchsort_session['uri_segment'])) {
            $pagingid = $searchsort_session['uri_segment'];
        } else {
            $pagingid = 0;
        }

        echo $pagingid;
    }

    /*
    @Description: Function for Bulk action to delete admin
    @Author: Dhaval Panchal
    @Date: 4-7-2018
     */
    public function ajax_delete_all()
    {
        $admin = $this->session->userdata($this->lang->line('business_crm_admin_session'));
        $id    = $this->input->post('single_remove_id');

        if (!empty($id) && $admin['id'] != $id) {
            $this->Common_function_model->delete($this->table_name, array('id' => $id));
            unset($id);
        }

        $array_data = $this->input->post('myarray');

        if (!empty($array_data)) {
            for ($i = 0; $i < count($array_data); $i++) {
                if (!empty($array_data[$i]) && $array_data[$i] != $admin['id']) {
                    $this->Common_function_model->delete($this->table_name, array('id' => $array_data[$i]));
                }
            }
        }

        $searchsort_session = $this->session->userdata('admin_sortsearchpage_data');

        if (!empty($searchsort_session['uri_segment'])) {
            $pagingid = $searchsort_session['uri_segment'];
        } else {
            $pagingid = 0;
        }

        echo $pagingid;
    }

    /*
    @Description: Function for checking admin already exist or not
    @Author: Dhaval Panchal
    @Input: - Email and id
    @Date: 4-7-2018
     */

    public function check_email($email = '', $user_id = '')
    {

        if (!empty($email) && $email != '' && !empty($user_id) && $user_id != '') {
            $email   = $email;
            $user_id = $user_id;
            $boolean = 'yes';
        } else {
            $email   = $this->input->post('email');
            $user_id = $this->input->post('user_id');
            $boolean = 'no';
        }

        $where_str = '';
        $message   = '';

        if (!empty($email)) {
            if (!empty($user_id) && !empty($email)) {
                $where_str = ' id != ' . $user_id . ' AND email = "' . $email . '"';
            } elseif (!empty($email)) {
                $where_str = ' email = "' . $email . '"';
            }

            $field       = array('id', 'CONCAT_WS(" ",first_name,last_name) as name', 'email', 'status');
            $sq_data_all = array
                (
                "table"       => 'admin_management',
                "fields"      => $field,
                "wherestring" => $where_str,
            );
            $check_email = $this->Common_function_model->getmultiple_tables($sq_data_all);

            if (!empty($check_email)) {
                $message = "false";
            } else {
                $message = "true";
            }
        }

        if ($boolean == 'yes') {
            if ($message == 'true') {
                return true;
            } elseif ($message == 'false') {
                return false;
            }
        } else {
            echo $message;
            exit;
        }
    }

    /*
    @Description: Function for Multiple Active and Inactive By Admin
    @Author: Dhaval Panchal
    @Date: 4-7-2018
     */
    public function ajax_status_all()
    {
        $array_data      = $this->input->post('myarray');
        $cdata['status'] = $this->input->post('status');

        for ($i = 0; $i < count($array_data); $i++) {
            if (!empty($array_data[$i])) {
                $this->Common_function_model->update($this->table_name, $cdata, array('id' => $array_data[$i]));
            }
        }

        $searchsort_session = $this->session->userdata('admin_sortsearchpage_data');
        echo $pagingid      = !empty($searchsort_session['uri_segment']) ? $searchsort_session['uri_segment'] : 0;
    }
}

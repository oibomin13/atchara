<?php
defined('BASEPATH') or exit('No direct script access allowed');
function uid()
{
    return strtoupper(uniqid());
}

function hashkey($val)
{
    return sha1(app_session() . $val);
}

function json_output($value)
{
    $CI = &get_instance();
    return $CI->output->set_content_type('application/json')->set_output(json_encode($value));
}

function app_session()
{
    return 'eqborrow';
}

function get_user_id()
{
    $CI = &get_instance();
    $sess = $CI->session->userdata(app_session());
    return $sess['id'];
}

function get_user_fullname()
{
    $CI = &get_instance();
    $sess = $CI->session->userdata(app_session());
    return $sess['fullname'];
}

function get_key()
{
    $CI = &get_instance();
    $sess = $CI->session->userdata(app_session());
    return $sess['key'];
}

function get_username()
{
    $CI = &get_instance();
    $sess = $CI->session->userdata(app_session());
    return $sess['username'];
}

function get_usertype()
{
    $CI = &get_instance();
    $sess = $CI->session->userdata(app_session());
    return $sess['usertype'];
}

function get_member_id_fromuser($uid)
{
    $CI = &get_instance();
    $CI->load->model('Member_model');
    $query = $this->db->select('*')->from('member')->where(array('user_id' => $uid))->get();
    return $query->result_array();
}

function get_running($prefix)
{
    $CI = &get_instance();
    $CI->load->model('Autorun_model');
    $row = $CI->Autorun_model->find_name($prefix);
    if (!empty($row)) {
        $running = $prefix . str_pad($row['auto_value'], 4, '0', STR_PAD_LEFT);
    } else {
        $running = $prefix . '0001';
    }
    return $running;
}

function set_sess_data($result, $key)
{
    $CI = &get_instance();
    $CI->load->model('Member_model');
    $data = array(
        'id' => $result['id'],
        'username' => $result['username'],
        'fullname' => $result['fullname'],
        'usertype' => $result['usertype'],
        'key' => $key,
    );

    // update key
    $user['id'] = $result['id'];
    $user['key'] = $key;
    $user['last_login'] = date('Y-m-d H:i:s');
    $CI->Member_model->update($user);    
    $CI->session->set_userdata(app_session(), $data);
}

function set_running($prefix)
{
    $CI = &get_instance();
    $CI->load->model('Autorun_model');
    $row = $CI->Autorun_model->find_name($prefix);
    if (empty($row)) {
        $data = $CI->Autorun_model->data();
    }

    $data['id'] = $row['id'];
    $data['auto_name'] = $prefix;
    $data['auto_value'] = empty($row) ? 2 : $row['auto_value'];

    if (empty($row)) {
        $CI->Autorun_model->save($data);
    } else {
        $CI->Autorun_model->add_number($prefix);
    }
}

function get_member($default = "เลือกสมาชิก")
{
    $CI = &get_instance();
    $CI->load->model('Member_model');
    $results = $CI->Member_model->find_all_active();
    array_unshift($results, array('id' => '', 'name' => $default));
    return array_column($results, 'name', 'id');
}

function get_categorie()
{
    $CI = &get_instance();
    $CI->load->model('Category_model');
    $results = $CI->Category_model->find_all_active();
    array_unshift($results, array('id' => '', 'name' => get_line('cat_name')));
    return array_column($results, 'name', 'id');
}

function db_date($value)
{
    if (!empty($value) or $value === '0000-00-00') {
        $arr = explode('/', $value);
        $db_date = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
    } else {
        $db_date = null;
    }
    return $db_date;
}

function str_date($value)
{
    if (!empty($value) && $value != '0000-00-00') {
        $arr = explode('-', $value);
        $str_date = $arr[2] . '/' . $arr[1] . '/' . $arr[0];
    } else {
        $str_date = '';
    }

    return $str_date;
}

function form_number($data = '', $value = '', $extra = '')
{
    $defaults = array(
        'type' => 'number',
        'name' => is_array($data) ? '' : $data,
        'value' => $value,
    );

    return '<input ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . " />\n";
}

function upload_file($file_upload = 'file_upload', $prefix = '')
{
    $ci = &get_instance();

    /* ตรวจสอบว่าภาพมีการอัพไหม? ถ้าไม่มีให้ใช้ชื่อเดิมหรือชื่อ default */
    if ($_FILES[$file_upload]['name'] != '') {
        $file_name = uniqid($prefix); /* change here ----------------------------*/
    } else {
        $file_name = ($ci->input->post('post_image') != '') ? $ci->input->post('post_image') : 'image.jpg';
    }

    /* กำหนดการอัพโหลดไฟล์ */
    $config['upload_path'] = './uploads/img/';
    $config['allowed_types'] = 'jpg|png|gif';
    $config['max_size'] = 1024 * 5;
    $config['overwrite'] = true;
    $config['file_name'] = $file_name;
    /*อัพโหลดไฟล์ */
    $ci->load->library('upload', $config);

    /*ตรวจสอบว่าอัพโหลดหรือไม่? ถ้าใช่ให้ปรับลดรูปภาพด้วย */
    if ($ci->upload->do_upload($file_upload) && $_FILES[$file_upload]['name'] != '') {
        $source_image = $ci->upload->upload_path . $ci->upload->file_name;
        list($width, $height, $type, $attr) = getimagesize($source_image);
        if ($ci->upload->file_name != 'image.jpg') {
            $ci->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = $source_image;

            /* crop before resize */
            $config['width'] = ($width >= $height) ? $height : $width;
            $config['height'] = ($width >= $height) ? $height : $width;
            $config['x_axis'] = ($width / 2) - ($config['width'] / 2);
            $config['y_axis'] = ($height / 2) - ($config['height'] / 2);
            $config['maintain_ratio'] = false;
            $config['new_image'] = fullimage($ci->upload->file_name, '_crop');
            $ci->image_lib->initialize($config);
            $ci->image_lib->crop();
            $ci->image_lib->clear();

            /*resize*/
            /*new source image by crop*/
            $config['source_image'] = $ci->upload->upload_path . fullimage($ci->upload->file_name, '_crop');

            $config['maintain_ratio'] = true;
            $config['width'] = 160;
            $config['height'] = 160;
            $config['new_image'] = fullimage($ci->upload->file_name, '_sm');
            $ci->image_lib->initialize($config);
            $ci->image_lib->resize();
            $ci->image_lib->clear();

            $config['maintain_ratio'] = true;
            $config['width'] = 400;
            $config['height'] = 400;
            $config['new_image'] = fullimage($ci->upload->file_name, '_thumb');
            $ci->image_lib->initialize($config);
            $ci->image_lib->resize();
            $ci->image_lib->clear();

            $config['width'] = 800;
            $config['height'] = 800;
            $config['maintain_ratio'] = true;
            $config['new_image'] = fullimage($ci->upload->file_name, '_extra');
            $ci->image_lib->initialize($config);
            $ci->image_lib->resize();
            $ci->image_lib->clear();

            @unlink($ci->upload->upload_path . $ci->upload->file_name);
        }
    }

    /* ชื่อไฟล์ */
    if ($_FILES[$file_upload]['name'] != '') {
        $data = $ci->upload->data();
        $datafile = $data['file_name'];
    } else {
        $datafile = $file_name;
    }

    return $datafile;
}

function delete_image($path_name, $file_name)
{
    @unlink($path_name . fullimage($file_name, '_crop'));
    @unlink($path_name . fullimage($file_name, '_sm'));
    @unlink($path_name . fullimage($file_name, '_thumb'));
    @unlink($path_name . fullimage($file_name, '_extra'));
}

function fullimage($fileimage, $prefix, $type = 'remove')
{
    if ($fileimage == '' && $type != 'remove') {
        $fullimage = 'noimage' . $prefix . '.jpg';
    } else {
        $fullimage = strstr($fileimage, '.', true) . $prefix . strrchr($fileimage, '.');
    }

    return $fullimage;
}

function update_stock($param)
{
    if (!$param['return']) {
        $id = $param['id'];
        $inout = $param['is_create'] ? -1 : 1;
        $quantity = $param['quantity'] * $inout;
        $CI = &get_instance();
        $CI->load->model('Book_model');
        $CI->db->set('quantity', 'quantity+' . $quantity, false);
        $CI->db->where('id', $id);
        $CI->db->update('book');
    }

    return true;
}

function line($val){
    $CI = &get_instance();
    echo $CI->lang->line($val);
}

function get_line($val){
    $CI = &get_instance();
    return $CI->lang->line($val);
}

function get_js(){
    $CI = &get_instance();
    $result = 'home.js';
    $url = array('home', 'category', 'product', 'department', 'membertype', 'member', 'user', 'borrow','report');
    $method = array('stock','borrow');
    if(in_array($CI->router->fetch_class(), $url)){
        $prefix_report = (in_array($CI->router->fetch_method(), $method) && $CI->router->fetch_class()=='report') ? '-'.$CI->router->fetch_method() : '';
        $result = $CI->router->fetch_class() . $prefix_report . '.js';
    }

    return $result;
}
<?php
 
require APPPATH . '/libraries/REST_Controller.php';
 
class List extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data id_user
    function index_get() {
        $id_user = $this->get('id_user');
        if ($id_user == '') {
            $id_user = $this->db->get('list')->result();
             $this->response(array( 'result' => $id_user, ), 200);
        } else {
            $this->db->where('id_user', $id_user);
            if($id_user = $this->db->get('list')->result()){
                $this->response($id_user, 200);
            }else{$this->response(array(
                    'result' =>
                        array( ['message' => '404 NOT FOUND']
        ),
        ), 404);
            }   
        }
    }
 
    // insert new data to id_user
    function index_post() {
        $data = array(
            
                    'buku_list'          => $this->post('buku_list'),
                    'link_list'          => $this->post('link_list'),
                    'gambar_list'        => $this->post('gambar_list'));
        $insert = $this->db->insert('list', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data id_user
    function index_put() {
        $id_user = $this->put('id_user');
        $data = array(
                
                    'buku_list'          => $this->put('buku_list'),
                    'link_list'          => $this->put('link_list'),
                    'gambar_list'        => $this->put('gambar_list'));
        $this->db->where('id_user', $id_user);
        $update = $this->db->update('list', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete id_user
    function index_delete() {
        $id_user = $this->delete('id_user');
        $this->db->where('id_user', $id_user);
        $delete = $this->db->delete('list');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}
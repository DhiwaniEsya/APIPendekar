<?php
 
require APPPATH . '/libraries/REST_Controller.php';
 
class Apayah extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data hiburan_id
    function index_get() {
        $hiburan_id = $this->get('hiburan_id');
        if ($hiburan_id == '') {
            $hiburan_id = $this->db->get('hiburan')->result();
        } else {
            $this->db->where('hiburan_id', $hiburan_id);
            $hiburan_id = $this->db->get('hiburan')->result();
        }
        $this->response($hiburan_id, 200);
    }
 
    // insert new data to hiburan_id
    function index_post() {
        $data = array(
            
                    'judul_hiburan'          => $this->post('judul_hiburan'),
                    'gambar_hiburan'    => $this->post('gambar_hiburan'),
                    'video_hiburan'    => $this->post('video_hiburan'),
                    'keterangan_hiburan'        => $this->post('keterangan_hiburan'));
        $insert = $this->db->insert('hiburan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data hiburan_id
    function index_put() {
        $hiburan_id = $this->put('hiburan_id');
        $data = array(
                
                    'judul_hiburan'          => $this->put('judul_hiburan'),
                    'gambar_hiburan'    => $this->put('gambar_hiburan'),
                    'video_hiburan'    => $this->put('video_hiburan'),
                    'keterangan_hiburan'        => $this->put('keterangan_hiburan'));
        $this->db->where('hiburan_id', $hiburan_id);
        $update = $this->db->update('hiburan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete hiburan_id
    function index_delete() {
        $hiburan_id = $this->delete('hiburan_id');
        $this->db->where('hiburan_id', $hiburan_id);
        $delete = $this->db->delete('hiburan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}
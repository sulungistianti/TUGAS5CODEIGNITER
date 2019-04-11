<?php

require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {
	function __construct($config = 'rest'){
		parent::__construct($config);
	}

function progdis_get(){
	$id = $this->get('id');
	if ($id){
		$progdi = $this->db->get_where('progdi',
			array('Id' => $id))->result();
	} else {
		$progdi = $this->db->get('progdi')->result();
	}
	if($progdi){
		$this->response($progdi,200);
	} else {
		$this->response(array('status'=>'not found'),404);
	}
}

function progdis_post(){
	$params = array(
		'NIP' => $this->post('NIP'),
		'nama' => $this->post('nama'),
		'telp' => $this->post('telp'),
		'email' => $this->post('email'),
		'alamat' => $this->post('alamat'));
	$process = $this->db->insert('progdi', $params);
	if($process){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}

function progdis_put(){
	$params = array(
		'NIP' => $this->put('NIP'),
		'nama' => $this->put('nama'),
		'telp' => $this->put('telp'),
		'email' => $this->put('email'),
		'alamat' => $this->put('alamat'));
	$this->db->where('id', $this->put('id'));
	$execute = $this->db->update('progdi', $params);
	if($execute){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}

function progdis_delete(){
	$this->db->where('id', $this->delete('id'));
	$execute = $this->db->delete('progdi');
	if($execute){
		$this->response(array('status'=>'success'),201);
	} else {
		return $this->response(array('status'=>'fail'), 502);
	}
}
}
?>
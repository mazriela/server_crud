<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

// Api add data user

	public function AddUser() {

	$nama_user = $this->input->post('nama_user');
	$email_user = $this->input->post('email_user');
	$no_hp_user = $this->input->post('no_hp_user');
	$alamat = $this->input->post('alamat');
	
	//check field
	$this->db->where('email_user',$email_user);
	
	//check email sudah digunakan atau belum
	$check = $this->db->get('tb_user');
	
	if($check -> num_rows() > 0 ){
		$data['message'] = "Email sudah terdaftar, gunakan email lain";
		$data['status'] = false;
		$data['response_code'] = 500;

		echo json_encode($data);

		
	} else {
		//tambah data
		$tambah['nama_user'] = $nama_user;
		$tambah['email_user']= $email_user;
		$tambah['no_hp_user'] = $no_hp_user;
		$tambah['alamat'] = $alamat;
		// action insertnya
		$masuk = $this->db->insert('tb_user', $tambah);

		if($masuk){
		$data['message'] ="Berhasil Daftar!";
		$data['status'] = true;
		$data['response_code'] = 200; 
	
	} else {
		$data['message'] ="Gagal Daftar";
		$data['status'] = false;
		$data['response_code'] = 500; 
	}
	echo json_encode($data);

  }	

}
}
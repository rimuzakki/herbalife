<?php
/**
* Webservice untuk data produk
* Webservice untuk melayani data produk
*/ 
require_once APPPATH . 'libraries/REST_Controller.php' ;
require_once APPPATH . 'libraries/Format.php' ;

use Restserver\Libraries\REST_Controller;

class API extends REST_Controller {

	function __construct($config = 'rest') {
		// header('Access-Control-Allow-Origin: *');
		// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		// header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

		header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
		}
		
		parent ::__construct($config);
  }
  
	function peserta_get() {
    $id = $this->get('id');
    
		if ($id) {
			$peserta = $this->db->get_where('peserta', array('id_peserta'=>$id))->result();
		} else {
			$peserta = $this->db->get('peserta')->result();
    }
    
	  // generate response
	  if($peserta) {
      $this->response($peserta,200);
    } else {
      $this->response(array('status'=>'not found'), 404);
    }
	}

	// function produks_post() {
	// 	$params = array(
	// 		'nama' => $this->post('nama'),
	// 		'deskripsi' => $this->post('deskripsi'),
	// 		'kategori' => $this->post('kategori'),
	// 		'harga' => $this->post('harga'));
	// 	 $process = $this->db->insert('produk', $params);
	// 	 if($process){
	// 		// 201 artinya Succesful creation of a resource.
	// 		$this->response(array('status'=>'succes'),201);
	// 	 }else{
	// 		// 502 artinya Backend service failure (data store failure).
	// 		return $this->response(array('status'=>'fail'), 502);
	// 	}
		
	// }


	function peserta_put() {
		$params = array(
			'hadir' => $this->put('hadir'),
			'id_herbalife' => $this->put('id_herbalife'),
			'nama' => $this->put('nama'),
			'level_herbalife' => $this->put('level_herbalife'),
			'no_telp' => $this->put('no_telp'),
			'tanggal_lahir' => $this->put('tanggal_lahir'),
			'email' => $this->put('email'),
			'kota_asal' => $this->put('kota_asal'),
			'propinsi' => $this->put('propinsi'),
			'tanggal_transfer' => $this->put('tanggal_transfer'),
			'nama_transfer' => $this->put('nama_transfer'),
			'bank_transfer' => $this->put('bank_transfer'),
			'nominal_transfer' => $this->put('nominal_transfer'),
			'berita_transfer' => $this->put('berita_transfer')
		);
		
		$this->db->where('id_peserta', $this->put('id_peserta'));
		
		$execute = $this->db->update('peserta', $params);
		
		if ($execute){
			$this->response(array('status'=>'succes'),201);
		} else {
			return $this->response(array('status'=>'fail'), 502);	
		}	
	}
	

	// function produks_delete() {
	// 	$this->db->where('id_produk', $this->delete('id'));
	// 	$execute =$this->db->delete('produk');
	// 	if($execute){
	// 		$this->response(array('status'=>'succes'),201);
	// 	}else{
	// 		return $this->response(array('status'=>'fail'),502);
	// 	}	
	// }
}

?>

<?php
/**
* Webservice untuk data produk
* Webservice untuk melayani data produk
*/ 
require_once APPPATH . 'libraries/REST_Controller.php' ;
use Restserver\Libraries\REST_Controller;

class API extends REST_Controller {

	function __construct($config = 'rest') {
		header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
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
			'hadir' => $this->put('hadir')
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

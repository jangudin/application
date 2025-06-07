<?php
class Template{   
 protected $_ci;        
 
 function __construct(){        
	$this->_ci = &get_instance();   
 }      
 
 function utama($content, $data = NULL){
	 /*     * $data['headernya'] , $data['contentnya'] , $data['footernya']     * variabel diatas ^ nantinya akan dikirim ke file views/template/index.php     * */       
	 $data['headernya'] = $this->_ci->load->view('template/header', $data, TRUE);       
	 $data['contentnya'] = $this->_ci->load->view($content, $data, TRUE);       
	 $data['footernya'] = $this->_ci->load->view('template/footer', $data, TRUE);                	 
	 $this->_ci->load->view('template/index', $data);   
	 }
	 
 function kedua($content, $data = NULL){
	 /*     * $data['headernya'] , $data['contentnya'] , $data['footernya']     * variabel diatas ^ nantinya akan dikirim ke file views/template/index.php     * */
	 $datas['data'] = $data;
	
	 $data['headernya'] = $this->_ci->load->view('template_kedua/header', $data, TRUE);       
	 $data['contentnya'] = $this->_ci->load->view($content, $datas, TRUE);       
	 $data['footernya'] = $this->_ci->load->view('template_kedua/footer', $data, TRUE);                
	 $this->_ci->load->view('template_kedua/index', $data);   
	 }
	 
 function ketiga($content, $data = NULL){
	 /*     * $data['headernya'] , $data['contentnya'] , $data['footernya']     * variabel diatas ^ nantinya akan dikirim ke file views/template/index.php     * */
	 $datas['data'] = $data;
	
	 $data['headernya'] = $this->_ci->load->view('template_ketiga/header', $data, TRUE);       
	 $data['contentnya'] = $this->_ci->load->view($content, $datas, TRUE);       
	 $data['footernya'] = $this->_ci->load->view('template_ketiga/footer', $data, TRUE);                
	 $this->_ci->load->view('template_ketiga/index', $data);   
	 }
	 
	  function kosong($content, $data = NULL){
	 /*     * $data['headernya'] , $data['contentnya'] , $data['footernya']     * variabel diatas ^ nantinya akan dikirim ke file views/template/index.php     * */       
	// $data['headernya'] = $this->_ci->load->view('template/header', $data, TRUE);       
	 $data['contentnya'] = $this->_ci->load->view($content, $data, TRUE);       
	// $data['footernya'] = $this->_ci->load->view('template/footer', $data, TRUE);                	 
	 $this->_ci->load->view('template_kosong/index', $data);   
	 }
	 
}

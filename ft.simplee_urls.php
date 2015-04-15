<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	require_once(PATH_THIRD."simplee_urls/config.simplee_urls.php");
	
	class Simplee_urls_ft extends EE_Fieldtype {
	
		//var $has_array_data = TRUE;
		var $info = array(
			'name' => SIMPLEE_URLS_NAME,
			'version' => SIMPLEE_URLS_VERSION
		);
		
		function _save_url($data){
			if(strpos($data, "http://") !== 0 && strpos($data, "https://") !== 0)
				$data = "http://".$data;
				
			if(!filter_var($data, FILTER_VALIDATE_URL)){
				ee()->output->show_user_error('general', $this->field_name.": The url you entered is not valid.");
			}
			return $data;
		}
		
		function install(){
			return array('key' => '');
		}
		
		function display_field($data){
			return form_input($this->field_id, $data);
		}
		
		function save($data){
			return $this->_save_url(ee()->input->post($this->field_id));
		}
		
		function replace_tag($data, $params = array(), $tagdata = FALSE){
			return $data;
		}
		
		/* ========================================================
		=========================   MATRIX   ====================== */
		
		
		function display_cell( $data ){
	    	return form_input($this->cell_name, $data);
	    }
	    
	    function save_cell($data){
			return $this->_save_url(ee()->input->post($this->field_id));
	    }
	    
	    /* ========================================================
		=========================   GRID   ======================== */
	
		public function accepts_content_type($name){
		    return ($name == 'channel' || $name == 'grid');
		}
	}
/* End of file ft.simplee_urls.php */
/* Location: ./system/expressionengine/third_party/simplee_urls/ft.simplee_urls.php */
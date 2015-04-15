<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	require_once(PATH_THIRD."simplee_urls/config.simplee_urls.php");
	
	class Simplee_urls_ft extends EE_Fieldtype {
	
		//var $has_array_data = TRUE;
		var $info = array(
			'name' => SIMPLEE_URLS_NAME,
			'version' => SIMPLEE_URLS_VERSION
		);
		
		function _save_url($data){
			if($data && $data != ''){
				if(strpos($data, "http://") !== 0 && strpos($data, "https://") !== 0)
					$data = "http://".$data;
					
				if(filter_var($data, FILTER_VALIDATE_URL) === false){
					ee()->output->show_user_error('general', $data." is not a valid url.");
				}
			}
			return $data;
		}
		
		function install(){
			return array();
		}
		
		function display_field($data){
			return form_input(array(
	            'name'  => $this->field_name,
	            'id'    => $this->field_id,
	            'value' => $data
	        ));
		}
		
		function save($data){
			return $this->_save_url($data);
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
			return $this->_save_url($data);
	    }
	    
	    /* ========================================================
		=========================   GRID   ======================== */
	
		public function accepts_content_type($name){
		    return ($name == 'channel' || $name == 'grid');
		}
		
		function grid_save($data){
			return $this->_save_url($data);
		}
	}
/* End of file ft.simplee_urls.php */
/* Location: ./system/expressionengine/third_party/simplee_urls/ft.simplee_urls.php */
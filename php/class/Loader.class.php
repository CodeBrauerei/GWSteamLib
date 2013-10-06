<?php

class Loader {
	
	function __construct() {
		
	}

	public function get_head() {
		require './php/content/head.inc.php';
	}
	
	public function get_menu() {
		require './php/content/menu.inc.php';
	}
	
	public function get_footer() {
		require './php/content/footer.inc.php';
	}
}

?>
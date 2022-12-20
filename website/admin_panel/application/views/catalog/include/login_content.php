<?php
 //Start Page Load
 if(isset($page))
 {
	  if(isset($errormessage))
	 {
		 $this->load->view($page,$errormessage); 
	 }
	 else
	 {
		 $this->load->view($page); 
	 }
 
 }
?>

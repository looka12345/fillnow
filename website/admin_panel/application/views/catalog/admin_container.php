<!--
old 
-->
<?php 
	$this->load->view($this->config->item("kritid_template_admin_inclu")."header");
?>	
   <div class="inner-wrapper">
<?php 
	$this->load->view($this->config->item("kritid_template_admin_inclu")."left_content");
?>

<?php $this->load->view($this->config->item("kritid_template_admin_cv").$page);?>

<?php 
	$this->load->view($this->config->item("kritid_template_admin_inclu")."right_content");
?>

 <?php $this->load->view($this->config->item("kritid_template_admin_inclu")."footer");?>
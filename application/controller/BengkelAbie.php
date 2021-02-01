<?php
class BengkelAbie extends EUI_Controller
{
	function BengkelAbie()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->upload('U_Testing');
		$this->U_Testing->index();
	}
	
	function TabIndex()
	{
		echo '<input type="checkbox" name="src_customer_recsource" tabindex="1" value="jambu" /> Jambu<br/>';
		echo '<input type="checkbox" name="src_customer_recsource" tabindex="2" value="apel" /> Apel<br/>';
		echo '<input type="checkbox" name="src_customer_recsource" tabindex="3" value="mangga" /> Mangga<br/>';
		echo '<input type="checkbox" name="src_customer_recsource" tabindex="4" value="melon" /> Melon<br/>';
		echo '<hr/>';
		echo '<input type="checkbox" name="xxx" tabindex="5" value="gajah" /> Gajah<br/>';
		echo '<input type="checkbox" name="xxx" tabindex="6" value="badak" /> Badak<br/>';
		echo '<input type="checkbox" name="xxx" tabindex="7" value="maung" /> Maung<br/>';
		echo '<input type="checkbox" name="xxx" tabindex="8" value="semut" /> Semut<br/>';
	}
}
?>
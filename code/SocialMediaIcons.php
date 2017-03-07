<?php 
class SocialMediaIcon extends DataObject{
	public static $db = array(
		'Title' => 'Text',
		'Url' => 'Text',
		'IconClass' => 'Enum("fa-facebook, fa-facebook-square, fa-twitter, fa-pinterest, fa-linkedin, fa-instagram, fa-email, fa-envelope, fa-phone, fa-shopping-cart, fa-youtube")',
    'ColourScheme' => 'Enum("Brand, Site","Brand")',
		'SortOrder' => 'Int',
		'ShowTitle' => 'Boolean'
	);
	
	
	
	public function getCMSFields(){
		$fields = new FieldList();
		$fields->push(new TextField('Title'));
		$fields->push(new CheckboxField('ShowTitle', 'Show title next to icon?')); 
		$fields->push(new TextField('Url', 'Complete URL (include http://) or Value'));		
		$fields->push(new DropdownField('IconClass', 'Icon Type', array('fa-facebook' => 'Facebook', 'fa-facebook-square' => 'Facebook Square', 'fa-twitter' => 'Twitter', 'fa-pinterest' => 'Pinterest', 'fa-linkedin' => 'LinkedIn', 'fa-instagram' => 'Instagram', 'fa-email' => 'Email @', 'fa-envelope' => 'Email Envelope', 'fa-phone' => 'Phone', 'fa-shopping-cart' => 'Shopping Cart', 'fa-youtube' => 'YouTube')));
    $fields->push(new DropdownField('ColourScheme', 'Colour Scheme', $this->dbObject("ColourScheme")->enumValues()));
		return $fields;
	}
	
	
	function SMIcons(){
		return $this->renderWith('SocialMediaIcons');
	}
	
	
	
}

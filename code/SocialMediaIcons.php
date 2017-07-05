<?php 
class SocialMediaIcon extends DataObject{
	public static $db = array(
		'Title' => 'Text',
		'Url' => 'Text',
		'IconClass' => 'Enum("facebook, twitter, pinterest, linkedin, instagram, google-plus, email, envelope, phone, mobile, youtube")',
    'ColourScheme' => 'Enum("Brand, Site","Brand")',
		'SortOrder' => 'Int',
		'ShowTitle' => 'Boolean',
    'Show' => 'Enum("Header, Footer, Both", "Both")'
	);
	
	
	
	public function getCMSFields(){
		$fields = new FieldList();
		$fields->push(new TextField('Title'));
		$fields->push(new CheckboxField('ShowTitle', 'Show title next to icon?')); 
		$fields->push(new TextField('Url', 'Complete URL (include http://) or Value'));		
		$fields->push(new DropdownField('IconClass', 'Icon Type', $this->dbObject('IconClass')->enumValues()));
    $fields->push(new DropdownField('ColourScheme', 'Colour Scheme', $this->dbObject("ColourScheme")->enumValues()));
    $fields->push(new DropdownField('Show', 'Show in', $this->dbObject("Show")->enumValues()));
		return $fields;
	}
	
	
	function SMIcons(){
		return $this->renderWith('SocialMediaIcons');
	}	
}

class SMPage_extension extends Extension {
  
  public function onBeforeInit() {
    Requirements::css("social-media/css/icons.css");
  }
  
  public function SocialMediaIcons(){ 
    $do = SocialMediaIcon::get()->sort('SortOrder'); 
    return $do;
  }
  
  public function FooterSocialMediaIcons(){ 
    $do = SocialMediaIcon::get()->filter(array('Show' => array('Footer', 'Both')))->sort('SortOrder'); 
    return $do;
  }
}

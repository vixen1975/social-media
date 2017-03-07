<?php 
class SocialMediaIconsAdmin extends ModelAdmin {
	private static $managed_models = array('SocialMediaIcon'); // Can manage multiple models
	
	private static $url_segment = 'social-media'; // Linked as /admin/products/
	
	private static $menu_title = 'Social Media';
	
	private static $menu_icon = 'social-media/images/twitter.png';
	
	public function getEditForm($id = null, $fields = null) { 
      $form = parent::getEditForm($id, $fields); 
      $cName = $this->sanitiseClassName($this->modelClass); 
      $gridField = $form->Fields()->fieldByName($cName); 
      $gridField->getConfig()->addComponent(new GridFieldSortableRows('SortOrder')); 
       return $form; 
   }
}
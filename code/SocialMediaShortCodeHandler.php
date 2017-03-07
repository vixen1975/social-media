<?php 
class SocialMediaShortCodeHandler {
	
	public static function parse_socialmedia($arguments, $caption = null, $parser = null, $tagName) {
		
		$customise = array();
		$class = 'brand-colours';
		$shape = ' square-icons';
		$customise['Caption'] = '';
		if(isset($arguments['style']) && $arguments['style'] == 'site'){
			$class = 'site-colours';
		}
		if(isset($arguments['shape']) && $arguments['shape'] == 'circle'){
			$shape = ' round-icons';
		}
		if(isset($caption) && $caption != NULL){
			$customise['Caption'] = $caption;
		}
		$customise['Class'] = $class.$shape; 
		$social = SocialMediaIcon::get()->filter('Url:not','')->sort('SortOrder');
		if($social){
			$icons = new ArrayList();
			foreach($social as $s){
				$icons[] = array(
					'IconClass' => $s->IconClass,
					'Url' => $s->Url
				);
			}
			if(!empty($icons)){
				$customise['Icons'] = $icons;
				$template = new SSViewer('SocialMediaList');
		        return $template->process(new ArrayData($customise));
			}
		} else {
			return;
		}

	}
}
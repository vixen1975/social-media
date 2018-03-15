<?php
/**
 * SocialShare class.
 * Provide basic sharing links for social media.
 * Based on https://github.com/jonom/silverstripe-share-care
 *
 * @extends DataExtension
 */
class SocialShare extends DataExtension {

  /**
  * Add some additional fields for social media sharing
  *
  */
  private static $db = array(
    'SMTitle' => 'Varchar(100)',
    'SMDescription' => 'Varchar(150)',
  );

  private static $has_one = array(
    'SMImage' => 'Image'
  );

  public function updateCMSFields(FieldList $fields) {
    $fields->addFieldToTab('Root.SocialMedia', new TextField('SMTitle', 'Social media title'));
    $fields->addFieldToTab('Root.SocialMedia', new TextAreaField('SMDescription', 'Social media description'));
    $fields->addFieldToTab('Root.SocialMedia', new UploadField('SMImage', 'Social media image'));
  }
  /**
   * Generate a URL to share this content on Facebook.
   *
   * @return string|false
   */
    public function FacebookShareLink(){
        if (!$this->owner->hasMethod('AbsoluteLink')) {
            return false;
        }
        $pageURL = rawurlencode($this->owner->AbsoluteLink());
        return ($pageURL) ? "https://www.facebook.com/sharer/sharer.php?u=$pageURL" : false;
    }
    /**
     * Generate a URL to share this content on Twitter
     * Specs: https://dev.twitter.com/web/tweet-button/web-intent.
     *
     * @return string|false
     */
    public function TwitterShareLink() {
        if (!$this->owner->hasMethod('AbsoluteLink')) {
            return false;
        }
        $pageURL = rawurlencode($this->owner->AbsoluteLink());
        $text = rawurlencode($this->owner->getSMTitle());
        return ($pageURL) ? "https://twitter.com/intent/tweet?text=$text&url=$pageURL" : false;
    }
    /**
     * Generate a URL to share this content on Google+
     * Specs: https://developers.google.com/+/web/snippet/article-rendering.
     *
     * @return string|false
     */
    public function GooglePlusShareLink()
    {
        if (!$this->owner->hasMethod('AbsoluteLink')) {
            return false;
        }
        $pageURL = rawurlencode($this->owner->AbsoluteLink());
        return ($pageURL) ? "https://plus.google.com/share?url=$pageURL" : false;
    }
    /**
     * Generate a URL to share this content on Pinterest
     * Specs: https://developers.pinterest.com/pin_it/.
     *
     * @return string|false
     */
    public function PinterestShareLink()
    {
        $pinImage = ($this->owner->hasMethod('getSMImage')) ? $this->owner->getSMImage() : $this->owner->getSMImage();
        if ($pinImage) {
            // OGImage may be an Image object or an absolute URL
            $imageURL = rawurlencode((is_string($pinImage)) ? $pinImage : $pinImage->getAbsoluteURL());
            $pageURL = rawurlencode($this->owner->AbsoluteLink());
            $description = rawurlencode($this->owner->getSMTitle());
            // Combine Title, link and image in to rich link
            return "http://www.pinterest.com/pin/create/button/?url=$pageURL&media=$imageURL&description=$description";
        }
        return false;
    }
    /**
     * Generate a URL to share this content on LinkedIn
     * specs: https://developer.linkedin.com/docs/share-on-linkedin
     *
     * @return string|string
     */
    public function LinkedInShareLink()
    {
        if (!$this->owner->hasMethod('AbsoluteLink')) {
            return false;
        }
        $pageURL = rawurlencode($this->owner->AbsoluteLink());
        $title = rawurlencode($this->owner->getSMTitle());
        $description = rawurlencode($this->owner->getSMDescription());
        $source = rawurlencode($this->owner->getSMSiteName());
        return "https://www.linkedin.com/shareArticle?mini=true&url=$pageURL&title=$title&summary=$description&source=$source";
    }
    /**
     * Generate a 'mailto' URL to share this content via Email.
     *
     * @return string|false
     */
    public function EmailShareLink()
    {
        if (!$this->owner->hasMethod('AbsoluteLink')) {
            return false;
        }
        $pageURL = $this->owner->AbsoluteLink();
        $subject = rawurlencode(_t('ShareCare.EmailSubject', 'Thought you might like this'));
        $body = rawurlencode(_t('ShareCare.EmailBody', 'Thought of you when I found this: {URL}', array('URL' => $pageURL)));
        return ($pageURL) ? "mailto:?subject=$subject&body=$body" : false;
    }

      /**
       * The default/fallback value to be used in the 'og:title' open graph tag.
       *
       * @return string
       */
      public function getDefaultSMTitle() {
          return $this->owner->getTitle();
      }
      /**
      * Get the social media image
      *
      * @return Image/string/false
      */
      public function getSMImage(){
        if($this->owner->SMImage()){
          $url = $this->owner->SMImage()->AbsoluteURL();
          if($url){
            return $url;
          }
        }
      }
      /**
       * The default/fallback Image object or absolute URL to be used in the 'og:image' open graph tag.
       *
       * @return Image|string|false
       */
      public function getDefaultSMImage() {
          // We don't want to use the SilverStripe logo, so let's use a favicon if available.
          return (file_exists(BASE_PATH . '/apple-touch-icon.png'))
              ? Director::absoluteURL('apple-touch-icon.png', true)
              : false;
      }
      /**
     * The title that will be used in the 'og:title' open graph tag.
     * Use a custom value if set, or fallback to a default value.
     *
     * @return string
     */
      public function getSMTitle() {
          return ($this->owner->SMTitle) ? $this->owner->SMTitle : $this->owner->getDefaultSMTitle();
      }
      /**
       * The description that will be used in the 'og:description' open graph tag.
       * Use a custom value if set, or fallback to a default value.
       *
       * @return string
       */
       public function getSMDescription() {
          // Use OG Description if set
          if ($this->owner->SMDescription) {
              $description = trim($this->owner->SMDescription);
              if (!empty($description)) {
                  return $description;
              }
          }
          return $this->owner->getDefaultSMDescription();
      }
      /**
       * The default/fallback value to be used in the 'og:description' open graph tag.
       *
       * @return string
       */
      public function getDefaultSMDescription()
      {
          // Use MetaDescription if set
          if ($this->owner->MetaDescription) {
              $description = trim($this->owner->MetaDescription);
              if (!empty($description)) {
                  return $description;
              }
          }
          // Fall back to Content
          if ($this->owner->Content) {
              $description = trim($this->owner->obj('Content')->Summary(20, 5));
              if (!empty($description)) {
                  return $description;
              }
          }
          return false;
      }

      public function getSMSiteName(){
        $config = SiteConfig::current_site_config();
        return $config->Title;
      }
}

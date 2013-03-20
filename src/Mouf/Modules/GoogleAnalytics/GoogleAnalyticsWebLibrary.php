<?php
namespace Mouf\Modules\GoogleAnalytics;
use Mouf\Html\HtmlElement\HtmlFromFile;

use Mouf\Html\HtmlElement\HtmlString;

use Mouf\Html\HtmlElement\HtmlElementInterface;
use Mouf\Html\HtmlElement\Scopable;
use Mouf\Html\Utils\WebLibraryManager\WebLibraryInterface;
use Mouf\Html\Utils\WebLibraryManager\WebLibraryRendererInterface;

/**
 * This class can be used to insert JS or CSS directly into the &lt;head&gt; tag (inline).
 * Content is loaded from PHP files passed to this object.
 *
 * @Component
 */
class GoogleAnalyticsWebLibrary implements WebLibraryInterface, WebLibraryRendererInterface {
	
	
	/**
	 * The google Analytics Key provided when you subscribed to your account (in the form UA-xxxxx-x).
	 *
	 * @var string
	 */
	private $accountKey;
	
	/**
	 * The base domain name to track (if you are tracking sub-domains). In the form: ".example.com"
	 *
	 * @var string
	 */
	private $domainName;
	
	/**
	 * 
	 * @param string $accountKey The google Analytics Key provided when you subscribed to your account (in the form UA-xxxxx-x). Keep this empty if you don't want to enable Google Analytics.
	 * @param string $domainName The base domain name to track (if you are tracking sub-domains). In the form: ".example.com". Keep this empty if you don't track subdomains.
	 */
	public function __construct($accountKey = null, $domainName = null) {
		$this->accountKey = $accountKey;
		$this->domainName = $domainName;
	}
	
    /**
     * Returns an array of Javascript files to be included for this library.
     *
     * @return array<string>
     */
    public function getJsFiles() {
    	return array();
    }
    
    /**
     * Returns an array of CSS files to be included for this library.
     *
     * @return array<string>
     */
    public function getCssFiles() {
    	return array();
    }
    
    /**
     * Returns a list of libraries that must be included before this library is included.
     *
     * @return array<WebLibraryInterface>
     */
    public function getDependencies() {
    	return array();
    }
    
    /**
     * Returns a list of features provided by this library.
     * A feature is typically a string describing what the file contains.
     *
     * For instance, an object representing the JQuery library would provide the "jquery" feature.
     *
     * @return array<string>
     */
    public function getFeatures() {
    	return array();
    }
    
    /**
     * Returns the renderer class in charge of outputing the HTML that will load CSS ans JS files.
     *
     * @return WebLibraryRendererInterface
     */
    public function getRenderer() {
    	return $this;
    }
    
    /**
     * Renders the CSS part of a web library.
     *
     * @param WebLibraryInterface $webLibrary
     */
    function toCssHtml(WebLibraryInterface $webLibrary) {
    	
    }
    
    /**
     * Renders the JS part of a web library.
     *
     * @param WebLibraryInterface $webLibrary
     */
    function toJsHtml(WebLibraryInterface $webLibrary) {
    	
    }
    
    /**
     * Renders any additional HTML that should be outputed below the JS and CSS part.
     *
     * @param WebLibraryInterface $webLibrary
     */
    function toAdditionalHtml(WebLibraryInterface $webLibrary) {
    	if($this->accountKey) {
    		?>
    	<script type="text/javascript">
    	//Google Analytics
    	  var _gaq = _gaq || [];
    	  _gaq.push(['_setAccount', '<?php echo addslashes($this->accountKey) ?>']);
    	<?php 
    		if ($this->domainName) {
    			echo "_gaq.push(['_setDomainName', '".addslashes($this->domainName)."']);";
    			echo "_gaq.push(['_setAllowLinker', true]);";	
    		}
    	?>
    	  _gaq.push(['_trackPageview']);
    	
    	  (function() {
    	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    	  })();
    	
    	</script>
    	<?php 
    	}
    }
}
?>
<?php
namespace Mouf\Modules\GoogleAnalytics;
use Mouf\Html\HtmlElement\HtmlFromFile;

use Mouf\Html\HtmlElement\HtmlString;

use Mouf\Html\HtmlElement\HtmlElementInterface;
use Mouf\Html\HtmlElement\Scopable;
use Mouf\Html\Utils\WebLibraryManager\WebLibraryInterface;
use Mouf\Html\Utils\WebLibraryManager\WebLibraryRendererInterface;

/**
 * This class can be used to insert Google Analytics tracking tag directly into your Mouf application.
 *
 */
class GoogleAnalyticsWebLibrary implements WebLibraryInterface {
	
	
	/**
	 * The google Analytics Key provided when you subscribed to your account (in the form UA-xxxxx-x).
	 *
	 * @var string
	 */
	protected $accountKey;
	
	/**
	 * The base domain name to track (if you are tracking sub-domains). In the form: ".example.com"
	 *
	 * @var string
	 */
	protected $domainName;
	
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
     * Returns the google Analytics Key provided when you subscribed to your account (in the form UA-xxxxx-x). Keep this empty if you don't want to enable Google Analytics.
     * @return string
     */
	public function getAccountKey() {
		return $this->accountKey;
	}
	
	/**
	 * Returns the base domain name to track (if you are tracking sub-domains). In the form: ".example.com"
	 * @return string
	 */
	public function getDomainName() {
		return $this->domainName;
	}
	
    
    
}
?>
<?php
use Mouf\MoufUtils;

require_once __DIR__."/../../autoload.php";

use Mouf\Actions\InstallUtils;
use Mouf\MoufManager;

// Let's init Mouf
InstallUtils::init(InstallUtils::$INIT_APP);

// Let's create the instances
$moufManager = MoufManager::getMoufManager();
if (!$moufManager->instanceExists("googleAnalyticsWebLibrary")) {
	$instanceDescriptor = $moufManager->createInstance("Mouf\\Modules\\GoogleAnalytics\\GoogleAnalyticsWebLibrary");
	$instanceDescriptor->setName("googleAnalyticsWebLibrary");
	
	$configManager = $moufManager->getConfigManager();
	$constants = $configManager->getMergedConstants();

	if (!isset($constants['GOOGLE_ANALYTICS_KEY'])) {
		$configManager->registerConstant("GOOGLE_ANALYTICS_KEY", "string", "", "Your Google Analytics key. Leave empty if you want to disable Google Analytics tracking. Don't have a key for your website? Get one here: http://www.google.com/analytics/");
	}
	
	if (!isset($constants['GOOGLE_ANALYTICS_DOMAIN_NAME'])) {
		$configManager->registerConstant("GOOGLE_ANALYTICS_DOMAIN_NAME", "string", "", "The base domain name to track (if you are tracking sub-domains). In the form: '.example.com'. Keep this empty if you don't track subdomains.");
	}
	
	$definedConstants = $configManager->getDefinedConstants();
	if (!isset($definedConstants['GOOGLE_ANALYTICS_KEY'])) {
		$definedConstants['GOOGLE_ANALYTICS_KEY'] = '';
	}
	if (!isset($definedConstants['GOOGLE_ANALYTICS_DOMAIN_NAME'])) {
		$definedConstants['GOOGLE_ANALYTICS_DOMAIN_NAME'] = '';
	}
	$configManager->setDefinedConstants($definedConstants);

	$instanceDescriptor->getProperty("accountKey")->setValue("GOOGLE_ANALYTICS_KEY")->setOrigin("config");
	$instanceDescriptor->getProperty("domainName")->setValue("GOOGLE_ANALYTICS_DOMAIN_NAME")->setOrigin("config");
				
	
	if ($moufManager->instanceExists("defaultWebLibraryManager")) {
		$defaultWebLibraryManager = $moufManager->getInstanceDescriptor("defaultWebLibraryManager");
	
		$webLibraries = $defaultWebLibraryManager->getProperty("webLibraries");
		$webLibValues = $webLibraries->getValue();
		$webLibValues[] = $instanceDescriptor;
		$webLibraries->setValue($webLibValues);
	}
}

// Let's rewrite the MoufComponents.php file to save the component
$moufManager->rewriteMouf();

// Finally, let's continue the install
InstallUtils::continueInstall();
?>
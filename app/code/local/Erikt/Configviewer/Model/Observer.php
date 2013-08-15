<?php
class Erikt_Configviewer_Model_Observer {
	const FLAG_SHOW_CONFIG = 'showConfig';
	const FLAG_SHOW_CONFIG_FORMAT = 'showConfigFormat';

	private $request;

	public function checkForConfigRequest($observer) {
		$this->request = $observer->getEvent()->getData('front')->getRequest();
		if($this->request->{self::FLAG_SHOW_CONFIG} === 'true'){
			$this->setHeader();
			$this->outputConfig();
		} elseif (in_array($this->request->{self::FLAG_SHOW_CONFIG}, array('default', 'adminhtml', 'admin', 'crontab', 'global', 'modules', 'frontend', 'menu', 'acl', 'api'))) {
			$this->setHeader();
			$this->outputConfig($this->request->{self::FLAG_SHOW_CONFIG});
		}
	}

	private function setHeader() {
		$format = isset($this->request->{self::FLAG_SHOW_CONFIG_FORMAT}) ?
			$this->request->{self::FLAG_SHOW_CONFIG_FORMAT} : 'xml';
		switch($format){
			case 'text':
				header("Content-Type: text/plain");
				break;
			default:
				header("Content-Type: text/xml");
		}
	}

	private function outputConfig($type=null) {
		die(Mage::app()->getConfig()->getNode($type)->asXML());
	}
}
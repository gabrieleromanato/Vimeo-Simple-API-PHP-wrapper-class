<?php

class VimeoSimpleAPI {
	
	const APIURL = 'http://vimeo.com/api/v2/';
		
	protected $_username;
	protected $_request;
	protected $_output;
	
	public function __construct($username, $request, $output) {
		$this->_username = $username;
		$this->_request = $request;
		$this->_output = $output;
	}
	
	/** @param None
	  * @return String $url The complete API URL
	  */
	  
	
	private function _buildURL() {
		$url = self::APIURL . $this->_username . '/' . $this->_request . '.' . $this->_output;
		return $url;
	
	}
	
	/** @param String $url
	  * @return String $data The data returned by the HTTP GET request to the APIs
	  */
	
	private function _fetch($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	
	}
	
	/** @param None
	  * @return Array $json An associative array containing the request data
	  */
	
	private function _getJSONData() {
		$url = $this->_buildURL();
		$jsonData = $this->_fetch($url);
		$json = json_decode($jsonData, true);
		return $json;
	
	}
	
	/** @param None
	  * @return Array $phpArr An associative array containing the request data
	  */
	
	private function _getPHPData() {
		$url = $this->_buildURL();
		$phpData = $this->_fetch($url);
		$phpArr = unserialize($phpData);
		return $phpArr;
	
	}
	
	/** @param None
	  * @return Array $xml An associative array containing the request data
	  */
	
	private function _getXMLData() {
		$url = $this->_buildURL();
		$xmlData = $this->_fetch($url);
		$xml = json_decode(json_encode((array) simplexml_load_string($xmlData)), 1);
		return $xml;
	}
	
	/** @param None
	  * @return Array $data An associative array containing the request data based on the output's type
	  */
	
	public function getData() {
		$output = $this->_output;
		$data = '';
		switch($output) {
			case 'json':
				$data = $this->_getJSONData();
				break;
			case 'php':
				$data = $this->_getPHPData();
				break;
			case 'xml':
				$data = $this->_getXMLData();
				break;
			default:
				break;
		}
		
		return $data;	
	
	}
}
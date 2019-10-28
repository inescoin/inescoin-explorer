<?php

// Copyright 2019 The Inescoin developers.
// - Mounir R'Quiba
// Licensed under the GNU Affero General Public License, version 3.


namespace Blockchain;

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

use GuzzleHttp\Client;

class App
{
	public $is404 = false;

	public $currentPage = 'home';

	public $components = [];

	public $body = [];

	public $client;

	public $cacheTimeout = 20;
	public $cacheFolder = '../cache/';
	public $cacheClearTimer = 180;

	public function __construct($nodeUrl = 'https://node.inescoin.org/') // http://inescoin-node:8087/
	{
		$this->_initComponents();

		$this->client = new \GuzzleHttp\Client([
			'base_uri' => $nodeUrl,
			'request.options' => [
			     'exceptions' => false,
			]
		]);
	}

	public function run() {
		// var_dump('> run');
		$this->firewall();

		$this->controller();

		return $this->render([
			'view' => __DIR__ . '/../template/pages/' . $this->currentPage . '.tpl.php',
		]);
	}

	protected function firewall() {
		// var_dump('> firewall');
		$whiteList = $this->getWhiteList();

		$home = 'home';
		$this->currentPage = $home;

		foreach ($_GET as $getKey => $value) {
			// Check bad call property
			if (!in_array($getKey, $whiteList)) {
				$this->is404 = true;
				break;
			}

			if (in_array($getKey, $whiteList) && !in_array($getKey, ['page', 'api'])) {
				// Check multiple pages call
				if ($this->currentPage !== $home) {
					$this->is404 = true;
					break;
				}

				$this->currentPage = $getKey;
			}
		}

		// var_dump($this->currentPage);
	}

	protected function controller() {
		// var_dump('> controller');
		switch ($this->currentPage) {
			case 'home':
				$page = (int) $this->_getParameterValue('page');
				$this->body['search'] = '';
				$this->body['status'] = $this->getStatus();
				$this->body['blocks'] = $this->getLastBlocks($page);
				$this->body['domains'] = $this->getLastDomains();
				$this->body['transactionsPool'] = $this->getTransactionPool();
				$this->body['pagination'] = [
					'current' => $page,
					'previous' => $page > 2 ? ($page - 1) : 1,
					'next' => $page + 1,
				];
				break;

			case 'block-height':
				$blockHeight = (int) $this->_getParameterValue('block-height');
				$this->body['search'] = '';
				$this->body['block'] = $this->getBlockByHeight($blockHeight);
				break;

			case 'block-hash':
				$blockHash = $this->_getParameterValue('block-hash');
				$this->body['search'] = '';
				$this->body['block'] = $this->getBlockByHash($blockHash);
				break;

			case 'search':
				$query = $this->_getParameterValue('search');
				$this->body['search'] = $query;
				$this->body['results'] = $this->getSearchInAll($query);
				break;

			case 'transaction':
				$this->body['search'] = '';
				$transactionHash = $this->_getParameterValue('transaction');
				$this->body['transaction'] = $this->getTransactionByHash($transactionHash);
				break;

			case 'transfer':
				$transferHash = $this->_getParameterValue('transfer');
				$this->body['search'] = '';
				$this->body['transfer'] = $this->getTransferByHash($transferHash);
				break;

			case 'wallet':
				$page = (int) $this->_getParameterValue('page');
				$walletAddress = $this->_getParameterValue('wallet');
				$this->body['search'] = '';
				$this->body['wallet'] = $this->getWalletAddressInfos($walletAddress, $page);
				$this->body['pagination'] = [
					'current' => $page,
					'previous' => $page > 2 ? ($page - 1) : 1,
					'next' => $page + 1,
				];
				break;

			case 'domain':
				$url = $this->_getParameterValue('domain');
				$this->body['search'] = '';
				$this->body['domain'] = $this->getDomainByUrl($url);
				$this->body['website'] = $this->getDomainWebsiteByUrl($url);

				break;
		}
	}

	protected function render(array $params)
	{
		if ($this->is404) {
			header("HTTP/1.0 404 Not Found");
			include(__DIR__ . '/../template/404.tpl.php');
			return;
		}

		$params['page'] = $this->currentPage;

		extract($params);
		$components = $this->components;

		extract($this->body);

		if ($this->_getParameterValue('api')) {
			header('Content-Type: application/json');
			echo json_encode($this->body, JSON_PRETTY_PRINT);

			exit();
		} else {
			include(__DIR__ . '/../template/wrapper.tpl.php');
		}
	}

	protected function getWhiteList() {
		return [
			'domain',
			'wallet',
			'search',
			'block-hash',
			'block-height',
			'transaction',
			'transfer',
			'page',
			'api'
		];
	}

	protected function getComponentList() {
		return [
			'search',
		];
	}

	public function getSearchInAll($query = '')
	{

		if (strlen($query) < 12) {
			if ($query === '0') {
				$block = $this->getBlockByHeight((int) $query);
				header('Location: /?block-height=' . $block['height']);
				exit();
			}

			$block = $this->getBlockByHeight((int) $query);
			if (!empty($block) && (int) $query > 0) {
				header('Location: /?block-height=' . $block['height']);
				exit();
			}
		}


		$blockHash = $this->getBlockByHash($query);
		if (!empty($blockHash)) {
			header('Location: /?block-hash=' . $blockHash['hash']);
			exit();
		}

		$transaction = $this->getTransactionByHash($query);
		if (!empty($transaction)) {
			header('Location: /?transaction=' . $transaction['hash']);
			exit();
		}

		$transfer = $this->getTransferByHash($query);
		if (!empty($transfer['transfer'])) {
			header('Location: /?transfer=' . $transfer['transfer']['hash']);
			exit();
		}

		$domain = $this->getDomainWebsiteByUrl($query);
		if (!isset($domain['error'])) {
			header('Location: /?domain=' . $query);
			exit();
		}

		$wallet = $this->getWalletAddressInfos($query);
		if (!isset($wallet['error'])) {
			header('Location: /?wallet=' . $query);
			exit();
		}

		if ($this->currentPage !== 'search') {
			header('Location: /?search=' . $query);
			exit();
		}

		return [];
	}

	public function getLastBlocks($page) {
		// var_dump('getLastBlocks');
		return $this->_client('POST', 'get-blocks', [
			'page' => $page,
			'limit' => 100
		]);
	}

	public function getLastDomains() {
		// var_dump('getLastBlocks');
		return $this->_client('POST', 'get-last-domains');
	}

	public function getTransactionPool() {
		// var_dump('getLastBlocks');
		return $this->_client('GET', 'mempool');
	}

	public function getStatus() {
		// var_dump('getLastBlocks');
		return $this->_client('GET', 'status');
	}

	public function getBlockByHeight($height = 1)
	{
		return $this->_client('POST', 'get-block-by-height', [
			'blockHeight' => $height
		]);
	}

	public function getBlockByHash($hash = '')
	{
		return $this->_client('POST', 'get-block-by-hash', [
			'blockHash' => $hash
		]);
	}

	public function getTransactionByHash($hash = '')
	{
		return $this->_client('POST', 'get-transaction-by-hash', [
			'transactionHash' => $hash
		]);
	}

	public function getTransferByHash($hash = '')
	{
		return $this->_client('POST', 'get-transfer-by-hash', [
			'transferHash' => $hash
		]);
	}

	public function getWalletAddressInfos($walletAddress = '', $page = 1)
	{
		return $this->_client('POST', 'get-wallet-address-infos', [
			'page' => $page,
			'walletAddress' => $walletAddress
		]);
	}

	public function getDomainByUrl($url = '')
	{
		return $this->_client('POST', 'get-website-info', [
			'url' => $url
		]);
	}

	public function getDomainWebsiteByUrl($url = '')
	{
		return $this->_client('POST', 'get-domain-url', [
			'url' => $url
		]);
	}

	private function _initComponents()
	{
		foreach ($this->getComponentList() as $componentName) {
			$this->components[$componentName] = __DIR__ . '/../template/components/' . $componentName . '.component.tpl.php';
		}

	}

	private function _client($method = 'POST', $uri = 'get-block-by-height', $params = []) {
		$response = [];

		$hash = md5($method . $uri . serialize($params));
		if (!!($cache = $this->_getCache($hash))) {
			return $cache;
		}

		try {
			$response = @json_decode($this->client->request($method, $uri, [
				'json' =>
					$params
			])->getBody()->getContents(), true);

			$this->_setCache($hash, $response);
		} catch (\Exception $e) {
		}

		return $response;
	}

	private function _getParameterValue($parameter) {
		$whiteList = $this->getWhiteList();

		$value = null;
		if (!in_array($parameter, $whiteList)) {
			return $value;
		}

		if (isset($_GET[$parameter])) {
			$value = filter_input(INPUT_GET, $parameter, FILTER_SANITIZE_STRING);
		}

		if (isset($_POST[$parameter])) {
			$value = filter_input(INPUT_POST, $parameter, FILTER_SANITIZE_STRING);
		}

		return $value;
	}

	private function _getCache($md5) {
		$this->_checkCacheForlder();
		$this->_clearTimeoutedCache();

		$filename = $this->cacheFolder . $md5 . '.json';

		if (!is_file($filename)) {
			return null;
		}

		$timeLeft = time() - filemtime($filename);
		if ($timeLeft > $this->cacheTimeout) {
			return null;
		}

		return unserialize(file_get_contents($filename));
	}

	private function _setCache($md5, $serialized) {
		$this->_checkCacheForlder();

		$filename = $this->cacheFolder . $md5 . '.json';
		file_put_contents($filename, serialize($serialized));
	}

	private function _checkCacheForlder() {
		if (!is_dir($this->cacheFolder)) {
			@mkdir($this->cacheFolder, 0777, true);
		}
	}

	private function _clearTimeoutedCache() {

		$filetime = 'time.lock';
		$folderTimeFile = $this->cacheFolder . $filetime;

		if (!file_exists($folderTimeFile)) {
			file_put_contents($folderTimeFile, '');
			return;
		}

		$time = time();
		if ($time - filemtime($folderTimeFile) > $this->cacheClearTimer) {
			$files = glob($this->cacheFolder . '*');

			foreach($files  as $file) {
				$timeLeft = $time - filemtime($file);
				if ($timeLeft > ($this->cacheTimeout) && $folderTimeFile !== $file) {
					@unlink($file);
				}
			}

			@unlink($folderTimeFile);
		}
	}
}

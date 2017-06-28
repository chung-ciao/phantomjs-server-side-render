<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class SEOController extends Controller
{
	protected $phantomConfig;
	protected $debug = false;
	protected $allowOrigin;

	public function __construct() {
		$phantomConfig = "--load-images=false ";
		$phantomConfig .= "--proxy-type=none ";
		$phantomConfig .= "--ignore-ssl-errors=true ";
		$phantomConfig .= "--load-images=false ";
		$phantomConfig .= "--local-to-remote-url-access=true";
		$this->phantomConfig = $phantomConfig;
		$this->tempFile = "/tmp/render-".timestamp_micro().".json";
        $this->allowOrigin = array_filter(explode(',', env('AllowOrigin')));
	}

	public function render(Request $request) {
		$url = $request->url;

		// 檢查domain
		$parsedUrl = parse_url($url);
		if(!$parsedUrl || !isset($parsedUrl['host']) || !isset($parsedUrl['scheme']) || !preg_match('/^https?$/i', $parsedUrl['scheme'])) {
			return response('', 404);
		}

		$hostPort = $parsedUrl['host'];
	    if(isset($parsedUrl['port'])){
	        $hostPort .= ":{$parsedUrl['port']}";
	    }

	    if(!$this->allowOrigin || !in_array($hostPort, $this->allowOrigin)) {
	    	return response('', 404);
	    }

		// 確認是否有cache
		if($this->getCache($url) != false) {
			return json_encode($this->getCache($url));
		}

		// 執行phantomjs爬頁面
		$crawler = resource_path('crawler/render.js');
		$phantomConfig = $this->phantomConfig;
		$process = new Process("phantomjs $phantomConfig $crawler $url $this->tempFile");
		$process->run();
		
		if (!$process->isSuccessful()) {
			return json_encode([
				'status' => 404
			]);
		}

		// 讀取phantomjs爬出的內容回傳, 並寫回cache
	 	$renderResult = json_decode(file_get_contents($this->tempFile));
		$this->addCache($url, $renderResult);

		if($this->debug) {
			Log::info($request);
			Log::debug($renderResult->content);
		}
		Log::debug($request->url." -> ".$renderResult->status);
		
		@unlink($this->tempFile);
		return json_encode($renderResult);
	}

	protected function getCache($key) {
		$data = Cache::get($key);
		if($data == null) return false;
		return $data;
	}

	protected function addCache($key, $data) {
		$expireAt = Carbon::now()->addHours(6);
		Cache::add($key, $data, $expireAt);
		return;
	}
}

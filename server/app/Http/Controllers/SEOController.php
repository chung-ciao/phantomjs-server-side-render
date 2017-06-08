<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SEOController extends Controller
{
  public function render(Request $request) {
  	$url = $request->url;

    // 執行phantomjs爬頁面
    $crawlerPath = resource_path('crawler/render.js');
    $process = new Process("phantomjs $crawlerPath $url");
		$process->run();

    // 讀取phantomjs爬出的內容並回傳
   	$renderResult = file_get_contents(public_path('render.json'));
    return json_encode($renderResult);
  }
}

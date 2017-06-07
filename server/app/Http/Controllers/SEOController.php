<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function render(Request $request) {
    	$url = $request->url;
        $crawlerPath = resource_path('crawler/render.js');
        $crawlerFolder = resource_path('crawler');

       	$shell_output = shell_exec("cd $crawlerFolder; phantomjs render.js $url;");
       	$renderResult = file_get_contents(resource_path('crawler/render.json'));
        return json_encode($renderResult);
    }
}

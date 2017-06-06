<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function render() {
        $crawlerPath = resource_path('crawler/render.js');
        $crawlerFolder = resource_path('crawler');
       	$shell_output = shell_exec("cd $crawlerFolder; phantomjs render.js;");
        return $crawlerFolder;
    }
}

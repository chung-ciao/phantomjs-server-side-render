var webPage = require('webpage');
var fs = require('fs');
var system = require('system');

// 最大等待時間, 超過這個時間, 無論前端是否完成回應render完成, 直接執行phantomjs
var MAX_WAIT_TIME = 15000;
var hasRender = false;
var page = webPage.create();
var url = system.args[1];
var outputPath = system.args[2];

var render = function() {
  fs.write(outputPath, JSON.stringify({
    status: 200,
    content: page.content,
  }), 'w')
  phantom.exit();
}

var error = function() {
  fs.write(outputPath, JSON.stringify({
    status: 404,
    content: 'timeout',
  }), 'w')
  phantom.exit();
}

page.open(url, function (status) {
  // 超過時間限制直接reject
  setTimeout(function() {
    if(!hasRender) {
      error();
    }
  }, MAX_WAIT_TIME);

  // 前端所有request完成, 開始render
  page.onCallback = function(status) {
    if(status == 'page.done') {
      setTimeout(function() {
        render();
        hasRender = true;
      }, 500);
    }
    else {
      error();
    } 
  }
});
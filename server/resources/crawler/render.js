var webPage = require('webpage');
var fs = require('fs');

var MAX_WAIT_TIME = 10000;
var hasRender = false;
var page = webPage.create();
var url = 'https://mei-stylist.idv.tw';
var outputPath = fs.workingDirectory+'/render.json';

var render = function() {
  page.render('capture.jpg', {format: 'jpg', quality: '100'});
  fs.write(outputPath, JSON.stringify({
    status: 200,
    created_at: new Date(),
    content: page.content,
  }), 'w')
  phantom.exit();
}

var error = function() {
  fs.write(outputPath, JSON.stringify({
    status: 400,
  }), 'w')
  phantom.exit();
}

page.viewportSize = { width: 1920, height: 1080 };
page.open(url, function (status) {
  // 超過時間限制直接reject
  setTimeout(function() {
    if(!hasRender) {
      error() 
    }
  }, MAX_WAIT_TIME);

  // 前端所有request完成, 開始render
  page.onCallback = function() {
    setTimeout(function() {
      render();
      hasRender = true;
    }, 500);
  }
});
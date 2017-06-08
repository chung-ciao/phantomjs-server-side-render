var webPage = require('webpage');
var fs = require('fs');

var page = webPage.create();
var url = 'https://mei-stylist.idv.tw';

var render = function() {
  page.render('capture.jpg', {format: 'jpg', quality: '100'});
  fs.write('./render.json', JSON.stringify({
    status: 200,
    content: page.content,
  }), 'w')
  phantom.exit();
}

page.viewportSize = { width: 1920, height: 1080 };
page.open(url, function (status) {
  page.onCallback = function() {
    setTimeout(function() {
      render();
    }, 500);
  }
});
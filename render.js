var webPage = require('webpage');
var fs = require('fs');

var page = webPage.create();
var url = 'http://localhost:8083';
var outputPath = fs.workingDirectory+'/render.json';
var render = function() {
  page.render('capture.jpg', {format: 'jpg', quality: '100'});
  console.log(page.content)
  fs.write(outputPath, JSON.stringify({
    content: page.content,
  }), 'w')
  phantom.exit();
}
page.viewportSize = { width: 1920, height: 1080 };
page.open(url, function (status) {
  page.onCallback = function() {
    setTimeout(function() {
      render()
    }, 500);
  }
});
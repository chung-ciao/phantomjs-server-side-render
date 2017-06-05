var webPage = require('webpage');
var fs = require('fs');

var page = webPage.create();
var url = 'https://mei-stylist.idv.tw';
var outputPath = fs.workingDirectory+'/render.json';

page.viewportSize = { width: 1920, height: 1080 };
page.open(url, function (status) {
  setTimeout(function() {
	page.render('capture.jpg', {format: 'jpg', quality: '100'});

	var data = JSON.stringify({
	  content: page.content,
	});
	fs.writeFile(outputPath, 'data', 'w')
	phantom.exit();
  }, 3000);
});
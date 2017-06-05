var webPage = require('webpage');
var page = webPage.create();
var url = 'https://mei-stylist.idv.tw';

page.viewportSize = { width: 1920, height: 1080 };
page.open(url, function (status) {
  setTimeout(function() {
  	page.render('capture.jpg', {format: 'jpg', quality: '100'});
  	console.log(page.content)
  	phantom.exit();
  }, 3000);
});
# Phantom JS Server Side Render


## Dependencies

* jQuery(前端計算ajax request總數使用)

## 前端

由於phantomjs不支援ES6

但前端要使用的phantom.js使用的是ES6

必須先在Web上裝babel-polyfill

phantomjs才爬的到內容

[babel-polyfill](https://babeljs.io/docs/usage/polyfill/)

接著就能在載入client資料夾內的phantom.js

當phantom.js計算到網站全部的api回來時

就會通知server side的phantomjs網站已經資料齊全

可以開始爬html
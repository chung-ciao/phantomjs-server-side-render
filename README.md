# PhantomJS Server Side Render

## How It Work?

[Vue2 with PhantomJS Server Side Render](https://blog.ciao.idv.tw/article/149797423052267#introduction)

## Client Side Deploy

### .htaccess

先將 **client folder** 內的 **.htaccess** 及 **seo.php** 放到與index.html同一層目錄

### seo.php

修改 **$ssrHost** 設定要佈署的Server Side Render主機Domain

### Javascript

可使用**client/phantom.js**

再所有api回來時會通知PhantomJS開始爬頁面

另外也有vue mixin的版本

## Server Side Deploy

Server佈署跟一般Laravel專案佈署一樣

不過還需要另外安裝PhantomJS

```bash
sudo npm install -g phantomjs
```

安裝好後要再修改PhantomJS權限
```bash
sudo chown -h [username]:[username] phantomjs
```

最後在.env中設定允許的Domain

```bash
AllowOrigin='example.com,example.com.tw'
```
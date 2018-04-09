const puppeteer = require('puppeteer')
const fs = require('fs')
const argv = require('yargs').argv

class SSR {
  constructor() {
    this.init()
    this.hasRender = false
    this.url = argv.url
    this.outputPath = argv.output

    // 最大等待時間, 超過這個時間, 無論前端是否完成回應render完成, 直接判定為404
    this.MAX_WAIT_TIME = 7000
  }

  async init() {
    const browser = await puppeteer.launch()
    const page = await browser.newPage()

    await page.goto(this.url, {
      waitUntil: ['networkidle2', 'load'],
    })
    const content = await page.content()
    const isSuccess = new RegExp(/ssr-done/g).test(content)

    setTimeout(() => {
      if(this.hasRender) return
      this.error()
    }, this.MAX_WAIT_TIME);

    if(isSuccess) {
      this.hasRender = true
      this.success(content)
    } else {
      this.error()
    }
    await browser.close()
  }

  success(content) {
    fs.writeFileSync(this.outputPath, JSON.stringify({
      status: 200,
      content: content,
    }))
  }

  error() {
    fs.writeFileSync(this.outputPath, JSON.stringify({
      status: 404,
      content: 'Not Found',
    }))
  }
}

module.exports = new SSR()
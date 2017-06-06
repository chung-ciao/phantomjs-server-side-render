class Phantom {
  constructor() {
    if(!(typeof(window.callPhantom) == 'function')) return
    $(document).ajaxComplete(() => {
      if($.active <= 1) {
        this.callPhantom()
        $(document).ajaxComplete(null)
      }
      return
  	})
  }

  callPhantom() {
    window.callPhantom('pageDone')
  }
}

export default new Phantom()
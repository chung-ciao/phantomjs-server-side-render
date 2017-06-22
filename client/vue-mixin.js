export default {
  created: function() {
    this.$root.$on('page.done', function() {
      if (typeof window.callPhantom === 'function') {
        setTimeout(function() {
          window.callPhantom('pageDone')
        }, 300)
      }
    })
  },
  beforeDestroy: function() {
    this.$root.$off('page.done')
  },
}
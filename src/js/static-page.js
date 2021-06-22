'use strict'

let policyLinks = document.querySelectorAll('[href*="policy"]')

export default () => {
  if (backend_data.static_page) {
    if (policyLinks) {
      policyLinks.forEach((item) => {
        item.removeAttribute('href')
        item.setAttribute('data-fancybox', '')
        item.setAttribute('data-type', 'iframe')
        item.setAttribute('data-src', '/policy/?content_only')
      })

      $(policyLinks).fancybox({
        iframe: {
          css: {
            width: '900px',
            height: '640px',
            maxWidth: '80%',
            maxHeight: '90%',
            margin: 0,
          }
        }
      })
    }
  }
}
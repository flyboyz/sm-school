'use strict'

const timer = document.getElementById('PromoTimer')

export default () => {
  if (timer == null) {
    return
  }

  let distance = parseInt(timer.getAttribute('data-timer'))

  let x = setInterval(function () {
    let days = Math.floor(distance / (60 * 60 * 24))
    let hours = Math.floor((distance % (60 * 60 * 24)) / (60 * 60))
    let minutes = Math.floor((distance % (60 * 60)) / 60)
    let seconds = Math.floor(distance % 60)

    let dLabel = declOfNum(days, ['день', 'дня', 'дней'])
    let hLabel = declOfNum(hours, ['час', 'часа', 'часов'])
    let mLabel = declOfNum(minutes, ['минута', 'минуты', 'минут'])
    let sLabel = declOfNum(seconds, ['секунда', 'секунды', 'секунд'])

    if (distance > 0) {
      timer.innerHTML = `${days} ${dLabel} ${hours} ${hLabel} ${minutes} ${mLabel} ${seconds} ${sLabel}`
    } else {
      clearInterval(x)
      timer.innerHTML = '-'
    }

    --distance
  }, 1000)
}

function declOfNum (number, titles) {
  const cases = [2, 0, 1, 1, 1, 2]
  return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]]
}
// #region stickyHeader

// const header = document.querySelector(".header");
// const headerNav = header.querySelector(".header__nav");
// window.addEventListener("scroll", () => {
//   if (
//     /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
//       navigator.userAgent
//     )
//   ) {
//     // код для мобильных устройств
//   } else {
//     // код для обычных устройств
//     const headerOffset = headerNav.getBoundingClientRect();
//     if (headerOffset.height < window.pageYOffset) {
//       header.classList.add("header--sticky");
//     } else {
//       header.classList.remove("header--sticky");
//     }
//   }
// });
// #endregion stickyHeader

/**
 * Липкая шапка
 */

const header = document.querySelector('.header');
const HEADER_SCROLLED_CLASS = 'header--scrolled'

function showHeader() {
  header.classList.remove('header--hidden');

  const event = new Event("header-show");
  header.dispatchEvent(event);
}
function hideHeader() {
  if (!header.classList.contains('header--dynamic')) return
  header.classList.add('header--hidden');

  const event = new Event("header-hide");
  header.dispatchEvent(event);
}

let lastScrollY = 0;
function isWindowScrolled() {
  if (window.pageYOffset < 300) {
    showHeader();
    return;
  }
  if (window.pageYOffset < 0) return;

  if (window.pageYOffset > lastScrollY) {
    hideHeader();
  } else if((window.pageYOffset < lastScrollY)){
    showHeader();
  }

  setTimeout(() => {
    lastScrollY  = window.pageYOffset;
  }, 1000)
  return lastScrollY > 15;
}



const debounce = (callback, wait) => {
  let timeoutId = null;
  return (...args) => {
    window.clearTimeout(timeoutId);
    timeoutId = window.setTimeout(() => {
      callback.apply(null, args);
    }, wait);
  };
}

header.addEventListener("header-hide", (e) => {
});
header.addEventListener("header-show", (e) => {
});

function stickyHeader() {
  if (!header.classList.contains('header--sticky')) return;
  
  if (isWindowScrolled()) {
    header.classList.add(HEADER_SCROLLED_CLASS);
  } else {
    header.classList.remove(HEADER_SCROLLED_CLASS);
  }
}

window.addEventListener('scroll', stickyHeader);
window.addEventListener('orientationchange', stickyHeader);
stickyHeader();

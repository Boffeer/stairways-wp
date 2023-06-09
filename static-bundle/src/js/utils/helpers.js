"use strict";

//#region PlatformDetect
/**
 * Получает класс названия текущей платформы и добавляет его для <body>
 * Нужно для фиксов, специфичных только для конкретной платформы
 * - [ ] tested
 */
let os = "Unknown";
if (navigator.appVersion.indexOf("Win") != -1) os = "windows";
if (navigator.appVersion.indexOf("Mac") != -1) os = "macos";
if (navigator.appVersion.indexOf("X11") != -1) os = "unix";
if (navigator.appVersion.indexOf("Linux") != -1) os = "linux";
document.body.classList.add("os-" + os);
//#endregion PlatformDetect

/**
 * @param string pass string to clipboard
 */
// eslint-disable-next-line no-unused-vars
export function copyToClipboard(text) {
  if (!text) return;

  var clipboardStorage = document.createElement("input");
  document.querySelector("body").appendChild(clipboardStorage);
  clipboardStorage.setAttribute("value", text);
  clipboardStorage.select();
  document.execCommand("copy");
  clipboardStorage.remove();
}

/**
 * Удаляет у всех элементов items класс itemClass
 *  */
function removeAll(items, itemClass) {
  if (!items && !itemClass) return;

  if (typeof items == "string") {
    items = document.querySelectorAll(items);
  }
  for (let i = 0; i < items.length; i++) {
    const item = items[i];
    item.classList.remove(itemClass);
  }
}
removeAll();

/**
 * Debounce
 * - [ ] tested
 * Разрешает только одно срабатывание fn раз в time милисекунд
 * @param {Функция для дебаунса} fn
 * @param {Тайминг} time Время перерыва между сраабатыванием функции
 * @returns void
 */
export function debounce(fn, time) {
  if (!fn && !time) return;
  let timeout;

  return function () {
    let self = this;
    const functionCall = function () {
      return fn.apply(self, arguments);
    };
    clearTimeout(timeout);
    timeout = setTimeout(functionCall, time);
  };
};

/**
 * Scroll page to top
 * - [ ] tested
 */
const scrollTopButtons = document.querySelectorAll(".js_scroll-top");
const scrollTop = (event) => {
  event.preventDefault();

  const id = scrollTop.getAttribute("href").substring(1);
  const section = document.querySelector(id);

  if (section) {
    document.scrollIntoView(section, {
      behavior: "smooth",
      block: "start",
      inline: "center",
    });
  }
};
scrollTopButtons.forEach((button) =>
  button.addEventListener("click", (event) => {
    scrollTop(event);
  })
);

/*
 * Получает дату в человеческом формате
 */
export function getShortHumanDate(date, locale = "ru") {
  var options = {
    weekday: 'short',
    day: 'numeric',
    month: 'short',
    timezone: 'UTC'
  };
   return date.toLocaleString("ru", options);
}

export function getTodayPlus(days, someDate = new Date()) {
  let numberOfDaysToAdd = days;
  let result = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
  return new Date(result)
}

/**
 * Фиксирует скрол у body
 *  */
export function bodyLock(con) {
  let scrollFix = window.innerWidth - document.body.clientWidth;
  const DEFAULT_SCROLLBAR_WIDTH = 17;
  if (con === true) {
    // scrollFix предотвращает скачки верстки в строну при блокировке скролла
    scrollFix =
      scrollFix > DEFAULT_SCROLLBAR_WIDTH ? DEFAULT_SCROLLBAR_WIDTH : scrollFix;
    document.body.style.paddingRight = `${scrollFix}px`;
    document.body.classList.add("_lock");
  } else if (con === false) {
    document.body.classList.remove("_lock");
    document.body.style.paddingRight = "0";
  } else if (con === undefined) {
    if (!document.body.classList.contains("_lock")) {
      document.body.classList.add("_lock");
    } else {
      document.body.classList.remove("_lock");
      document.body.style.paddingRight = "0";
    }
  } else {
    console.error("Неопределенный аргумент у функции bodyLock()");
  }
}

/*
  Проверяет был ли клик за пределами выбранного блока
 */
export function isClickedBeyond(e, selector) {
    let isClickBeyond = true;
    const path = e.path || (e.composedPath && e.composedPath());
    const isSelect = path.map((item, index, pathElems) => {
      if (pathElems.length - 4 < index) return;
      if (item.classList.contains(selector)) {
        isClickBeyond = false;
      }
    })
    return isClickBeyond;
}
/*
  Проверяет был ли клик за пределами выбранного блока
 */
export function getClickedNotBeyondElement(e, selector) {
    // let isElementClicked = false;
    let clickedElement;
    const path = e.path || (e.composedPath && e.composedPath());
    const isSelect = path.map((item, index, pathElems) => {
      if (pathElems.length - 4 < index) return;
      if (item.classList.contains(selector)) {
        // isElementClicked = true;
        clickedElement = item;
      }
    })
    if (clickedElement !== undefined) return clickedElement;
    return false
    // return isElementClicked;
}
import { doc } from 'prettier';
import { mediaMin } from "../utils/functions.js";
import { msnr } from './grid-masonry.js'


/*
if (document.querySelector('.reviews__container')) {

    console.log(document.querySelector('.reviews__container').querySelector('.reviews__photos').querySelectorAll('.reviews__media'))

    document.querySelector('.reviews__container').addEventListener('click', function(e) {
        if (e.target.classList.contains('reviews__photos-more')) {
            e.target.parentElement.classList.toggle('reviews__photos--active');
            // mediaMin('650') ? msnr.layout() : '';
            if (msnr) {
                msnr.layout();
            }

            if (e.target.parentElement.classList.contains('reviews__photos--active')) {
                e.target.innerText = '-'
            } else {
                let countPhoto = e.target.parentElement.querySelectorAll('.reviews__media').length - countInMedia();
                e.target.parentElement.querySelector('.reviews__photos-more').innerText = `+${countPhoto}`
            }
        }
    });


    // Подсчет скрытых фотографий
    const countInMedia = () => mediaMin('720') ? 4 : 2

    document.querySelectorAll('.reviews__photos').forEach(el => {

        // if (countPhoto <= 0) {
        //  el.querySelector('.reviews__photos-more').remove()
        //  return;
        // }

        let countPhoto = el.querySelectorAll('.reviews__media').length - countInMedia();
        el.querySelector('.reviews__photos-more').innerText = `+${countPhoto}`
    });
    setTimeout(() => {
        // msnr.layout();
    }, 500)
}
*/

/*
const casesFilterIndustriesInner = filter.querySelector(".filters-7p__track");
const filterButtons = filter.querySelectorAll(".tabs-7p-tab");
const casesFilterMore = filter.querySelector(".tabs-7p__more-button");
const casesFilterDropdown = filter.querySelector(".tabs-7p__industries-dropdown");
const filterTotal = filter.querySelector('.tabs-7p-tab--total');

filterButtons.forEach((button) => {
    button.querySelector('input').addEventListener("change", (e) => {
      if (button.classList.contains('tabs-7p-tab--total')) {
        uncheckAllFilters(filterButtons);
        return;
      }
      filterTotal.querySelector('input').checked = false;
    });
});

function moveFiltersToDropdown() {
    filterButtons.forEach((item, index) => {
      if (index === 0) return;
      casesFilterDropdown.appendChild(item);
    });
}
function moveFiltersToScrollbar() {
    filterButtons.forEach((item, index) => {
      casesFilterIndustriesInner.appendChild(item);
    });
}

function getVisibleItemsByContainerWidth(){
  // Перемещает фильтры между дропдауном и скроллбаром
  const WIDTH_MODIFIER = 230;
  function relocateFilterItems() {
    let filtersMaxWidth = filter.querySelector(".tabs-7p__industries").getBoundingClientRect().width - WIDTH_MODIFIER;
    let filtersWidth = filter.querySelector(".filters-7p__track").getBoundingClientRect().width;
    let filtersToSkip = [];


    filterButtons.forEach((item, index, arr) => {
      // Чтобы убрать все большие кнопки, которые больше половины
      const MAX_TAB_CHARACTERS = 25;
      if (item.innerText.length > MAX_TAB_CHARACTERS) {
        filtersToSkip.push(item);
        item.classList.add('js__filter-7p-tab--removed-initially')
        // console.log("Сразу убрать", item.innerText);
      }
    });
    
    filterButtons.forEach((item, index, arr) => {
      if (index === 0 || filtersToSkip.includes(item)) return;

      if (filtersWidth <= filtersMaxWidth - 180) {
        casesFilterIndustriesInner.appendChild(item);
        filtersWidth += item.getBoundingClientRect().width;
        // console.log(filterIndex ,filtersWidth, '/',filtersMaxWidth);
      }
    });

    const hiddenTabsCount = [...casesFilterDropdown.querySelectorAll('.tabs-7p-tab')].length;
    if (hiddenTabsCount == 0) {
      casesFilterMore.style.display = 'none';
    } else {
      casesFilterMore.style.display = '';
    }
  }
}


function changeFiltersPosition() {
if (window.innerWidth < 576) {
  moveFiltersToScrollbar();
} else {
  moveFiltersToDropdown();
}
relocateFilterItems();
}

window.addEventListener("resize", () => {
debounce(changeFiltersPosition(), 200);
});
changeFiltersPosition();


function handleMoreButton() {
  casesFilterMore.addEventListener("click", () => {
    casesFilterDropdown.classList.toggle(
      "tabs-7p__industries-dropdown--visible",
      "tabs-7p__industry--active"
    );
    // case.classList.toggle();
  });
  document.addEventListener("click", (e) => {
    if (
      !e.target.closest(".tabs-7p__industries-dropdown") &&
      !e.target.closest(".tabs-7p__more-button")
    ) {
      casesFilterDropdown.classList.remove(
        "tabs-7p__industries-dropdown--visible"
      );
    }
  });
}
*/

const hiderContainers = document.querySelectorAll('.reviews__photos')

function getGalleryCards(gallery) {
    if (!gallery) return [];
    const CARDS = gallery.querySelectorAll('.reviews__media')
    if (!CARDS) return [];
    return [...CARDS];
}
function getGalleryMoreButton(gallery) {
    return gallery.querySelector('.reviews__photos-more');
}
function getGalleryWidth(gallery) {
    return gallery.getBoundingClientRect().width
}
function getCardBoxWidth(card) {
    return card.getBoundingClientRect().width + +window.getComputedStyle(card).marginRight.replaceAll('px', '');
}
function getCardsToHide(cards, gallery) {
    let occupiedWidth = 0;
    const SINGLE_CARD_WIDTH = getCardBoxWidth(cards[0]);
    const MORE_BUTTON_WIDTH = getGalleryMoreButton(gallery).getBoundingClientRect().width;
    const GALLERY_WIDTH = getGalleryWidth(gallery);
    const CARDS_PER_ROW = GALLERY_WIDTH / SINGLE_CARD_WIDTH;

    const cardsToHide = cards.filter((card, index) => {
        if (occupiedWidth + SINGLE_CARD_WIDTH + MORE_BUTTON_WIDTH >= GALLERY_WIDTH) {
            return card
        };

        occupiedWidth+= getCardBoxWidth(card);
    })
    return cardsToHide;
}
function hideCards(cards) {
    cards.forEach(card => {
        card.classList.add('_hidden')
    });
}
function showCards(gallery) {
    const CARDS = [...getGalleryCards(gallery)] || false;
    if (!CARDS) return;
    CARDS.forEach(card => {
        card.classList.remove('_hidden')
    });
}
function countGalleryHiddenCards(gallery) {
    const galleryCards = getGalleryCards(gallery);
    return galleryCards.filter(card => {
        return card.classList.contains('_hidden')
    }).length
}

function initGallery(gallery) {
    const galleryCards = getGalleryCards(gallery);

    if (!galleryCards) return;

    const moreButton = getGalleryMoreButton(gallery);

    const CARDS_TO_HIDE = getCardsToHide(galleryCards, gallery)
    hideCards(CARDS_TO_HIDE);

    const HIDDEN_CARDS = countGalleryHiddenCards(gallery)
    moreButton.innerText = "+" + HIDDEN_CARDS;

    if (HIDDEN_CARDS < 2) {
        moreButton.classList.add('_hidden')
        showCards(gallery);
    } else {
        moreButton.classList.remove('_hidden')
    }

    if (moreButton.classList.contains('_inited')) return;

    moreButton.addEventListener("click", (e) => {
        moreButton.classList.add('_inited');
        if (countGalleryHiddenCards(gallery) == 0) {
            hideCards(getCardsToHide(galleryCards, gallery));
            moreButton.innerText = "+" + countGalleryHiddenCards(gallery);
        } else {
            showCards(gallery);
            moreButton.innerText = "−";
        }
    });
}
hiderContainers.forEach(gallery => {
    initGallery(gallery);
    if (window.msnr) {
        window.msnr.layout();
    }
})
window.addEventListener('resize', () => {
    hiderContainers.forEach(gallery => {
        showCards(gallery);
        initGallery(gallery);
        if (window.msnr) {
            window.msnr.layout();
        }
    })
})
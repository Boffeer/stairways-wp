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
        setTimeout(() => {
            window.msnr.layout()
        })
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
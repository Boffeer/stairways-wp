import { gsap, Timeline } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger.js";

gsap.registerPlugin(ScrollTrigger);


(() => {
    if (!document.querySelector('.product-page-seciton')) return

    function toggleVariation(elements, index) {
        elements.forEach((variation) => {
            variation.classList.remove('_active')
        })

        if (elements[index] == undefined) return
        elements[index].classList.add('_active');
    }

    const productVariationsSections = [
        '.product-page--views--element',
        '.product-page__inner-pic',
        '.product-page--views--block-text-descr',
        '.prod-info-variations__variation',
        '.section-product-difference__variation',
        '.sect-colors',
    ];

    const productVariations = [...document.querySelectorAll('.product-page--views--element')];

    productVariations.forEach((variation, index) => {
        variation.addEventListener('click', (e) => {

            productVariationsSections.forEach(section => {
                const sectionElements = [...document.querySelectorAll(section)] || [];
                toggleVariation(sectionElements, index);
            });

            if (window.boltsBlock) {
                window.boltsBlock.scrollTrigger.refresh();
            }

            window.scroll({
                top: 0,
                left: 0,
                behavior: 'smooth'
            })
        });
    });
})();

import {isClickedBeyond} from "../utils/helpers.js";
const hotspotCircles = document.querySelectorAll('.product-page--circle');

// function getHotspotBounds(hotspot) {
//     return {
//         hotspot: hotspot.getBoundingClientRect(),
//         parent: hotspot.parentElement.getBoundingClientRect(),
//         popup: hotspot.querySelector('.product-page--circle--popup').getBoundingClientRect()
//     }
// }
// function isPopOverlaysHotspot(button) {
//     const {parent, hotspot, popup} = getHotspotBounds(button);


//     if (hotspot.x - popup.width < hotspot.width) {
//         return true;
//     } else {
//         return false;
//     }
// }
// function isPopBeyondHorizontal(button) {
//     const {parent, hotspot, popup} = getHotspotBounds(button);
//     return parent.width - (popup.width + hotspot.x);
// }
// function isPopBeyondVertical(button) {
//     const {parent, hotspot, popup} = getHotspotBounds(button);
// }

function openHotspot(hotspot) {
    hotspot.classList.add('_active');
    // isPopBeyondVertical(hotspot)
}
function closeHotspot(hotspot) {
    hotspot.classList.remove('_active');
}

hotspotCircles.forEach((hotspot, index) => {
    const hotspotClass = `hotspot-${index}`
    hotspot.classList.add(hotspotClass);
    window.addEventListener("click", (e) => {
        if (hotspot.classList.contains('_active')) {
            closeHotspot(hotspot)
            return;
        }

        if (isClickedBeyond(e, hotspotClass)) {
            closeHotspot(hotspot)
        } else {
            openHotspot(hotspot)
        }
    })
});


if (document.querySelector('.section-product-difference-pin') &&
    document.querySelector('.product-details-shifter__container') &&
    document.querySelector('.sect-carcas--background--img') &&
    window.innerWidth > 1000) 
{

    const boltsBlock =  gsap.timeline({
        scrollTrigger: {
            trigger: ".section-product-difference-pin",
            start: "7.5%",
            scrub: 1,
            pinSpacing: true, 
            pin: true,
        }
    });
    boltsBlock.to(".product-details-shifter__container", {
        width: "100%",
        maxWidth: "100%",
    })
    boltsBlock.to(".sect-carcas--background--img", {
        yPercent: -40
    }, "<")
    window.boltsBlock = boltsBlock;
}

import { gsap, Timeline } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger.js";

gsap.registerPlugin(ScrollTrigger);


(() => {
    if (!document.querySelector('.product-page-seciton')) return

    const productVariations = [...document.querySelectorAll('.product-page--views--element')];
    const productVariationsPic = [...document.querySelectorAll('.product-page__inner-pic')];
    const productVariationsDesc = [...document.querySelectorAll('.product-page--views--block-text-descr')];
    productVariations.forEach((variation, index) => {
        variation.addEventListener('click', (e) => {
            productVariations.forEach((variation) => {
                variation.classList.remove('_active');
            })
            productVariationsPic.forEach((pic) => {
                pic.classList.remove('_active')
            })
            productVariationsDesc.forEach((desc) => {
                desc.classList.remove('_active')
            })
            variation.classList.add('_active')
            productVariationsPic[index].classList.add('_active');
            productVariationsDesc[index].classList.add('_active');
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



if (document.querySelector('.section-product-difference') &&
    document.querySelector('.product-details-shifter__container') &&
    document.querySelector('.sect-carcas--background--img') &&
    window.innerWidth > 1000) 
{

    const boltsBlock =  gsap.timeline({
        scrollTrigger: {
            // trigger: ".product-details-shifter",
            trigger: ".section-product-difference",
            start: "7.5%",
            // start: "-60%",
            scrub: 1,
            pinSpacing: true, 
            pin: true,
            // markers: true,
        }
    });
    boltsBlock.to(".product-details-shifter__container", {
        width: "100%",
        maxWidth: "100%",
        // yPercent: -20,
        // height: "-=20%",
    })
    // boltsBlock.to(".sect-carcas__inner", {
    boltsBlock.to(".sect-carcas--background--img", {
        yPercent: -40
    }, "<")
}

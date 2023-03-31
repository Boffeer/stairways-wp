import { gsap, Timeline } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger.js";

gsap.registerPlugin(ScrollTrigger);

window.boltsBlocks = [];


if (document.querySelector('.section-product-difference-pin') &&
    document.querySelector('.product-details-shifter__container') &&
    document.querySelector('.sect-carcas--background--img') &&
    window.innerWidth > 1000) 
{


    // Init multiple bolts sections
    const bolts = document.querySelectorAll('.section-product-difference-pin');
    bolts.forEach((bolt, index) => {
        const boltsPinClass = `section-product-difference-pin-${index}`
        bolt.classList.add(boltsPinClass);

        const boltsContainerClass = `product-details-shifter__container-${index}`;
        bolt.querySelector('.product-details-shifter__container').classList.add(boltsContainerClass)

        const boltsImgClass = `sect-carcas--background--img-${index}`;
        bolt.querySelector('.sect-carcas--background--img').classList.add(boltsImgClass);


            const boltsBlock =  gsap.timeline({
                scrollTrigger: {
                    trigger: `.${boltsPinClass}`,
                    start: "7.5%",
                    end: "bottom",
                    scrub: 1,
                    pinSpacing: true, 
                    pin: true,
                }
            });
            boltsBlock.to(`.${boltsContainerClass}`, {
                width: "100%",
                maxWidth: "100%",
            })
            boltsBlock.to(`.${boltsImgClass}`, {
                yPercent: -40
            }, "<");

            window.boltsBlocks[index] = boltsBlock;
    })
        

    setTimeout(() => {
        const boltsVariations = document.querySelectorAll('.section-product-difference__variation');
        boltsVariations.forEach((section) => {
            section.classList.add('_loaded');
        })
            
    }, 1000)
    


}

function updateBoltsGSAP() {
    if (window.boltsBlocks.length < 1) return;
    
    window.boltsBlocks.forEach(bolt => {
        bolt.scrollTrigger.refresh()
    })
}
window.updateBoltsGSAP = updateBoltsGSAP;

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

            window.updateBoltsGSAP();

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


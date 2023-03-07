import { mediaMin } from "../utils/functions.js";

"use strict"
const headerMenuMobile = document.querySelector('.header_mobile_menu');
const menu = document.querySelector('.gamburger');


const blockCity = document.querySelector('.menu-city');
const blockCityMenu = document.querySelector('.menu-city__popup-list');
// document.querySelector('.gamburger').addEventListener('click', function(){
//   headerMenuMobile.classList.add('_active');
// })

const dropdownsVariable = document.querySelectorAll('.dropdown--variable');
dropdownsVariable.forEach((dropdown) => {
    const elementsCount = [...dropdown.querySelectorAll('.dropdown__body--list-element')].length;
    const dropdownBody = dropdown.querySelector('.dropdown__body');

    if (elementsCount < 9) {
        dropdownBody.classList.add('dropdown__body--less-9');
    } else  {
        dropdownBody.classList.add('dropdown__body--more-8');
    }
})


const dropdownElements = [...document.querySelectorAll('.dropdown__body--list-element')];
dropdownElements.forEach(dropdownElement => {
    dropdownElement.addEventListener('click', (e) => {

        const cityPickers = document.querySelectorAll('.city-picker');
        cityPickers.forEach(picker => {
            picker.querySelector('.city-picker__current').innerText = `г. ${dropdownElement.innerText}`;
        })
        
        const currentListElements = dropdownElement.parentElement.querySelectorAll('.dropdown__body--list-element');
        currentListElements.forEach(currentListElement => {
            currentListElement.classList.remove('_active');
        })
        dropdownElement.classList.add('_active');
    })
    // currentListElements.forEach(dropdownElement => {
    //     dropdownElement.addEventListener('click', (e) => {
    //         currentListElements.forEach((dropdownElem) => {
    //             dropdownElem.classList.remove('_active');
    //         })

    //         dropdownElement.classList.add('_active')
    //     })
    // })
})




window.addEventListener('click', function(e) {
    if (e.target.classList.value === menu.className ||
        e.target.closest(`.${menu.className}`)) {
        headerMenuMobile.classList.add('_active');
    }


    if (e.target.classList.value === blockCity.className ||
        e.target.closest(`.${blockCity.className}`)) {
        blockCityMenu.classList.add('_active');
    }

    if (e.target.getAttribute('data-esc') ||
        e.target.closest('[data-esc]')) {
        e.target.closest('[data-parent-block]').classList.remove('_active');
    }

    if (e.target.closest('.button-more') || e.target.classList.contains('button-more')) {
        e.target.closest('.header__nav').querySelector('.header__nav-list__dropdown-block').classList.toggle('_active')
    }

    if (!e.target.closest('.dropdown')) {
        if (document.querySelector('.dropdown._active')) {
            document.querySelectorAll('.dropdown._active').forEach(
                el => el.classList.remove('_active'));
        }
    }
});

const dropdowns = document.querySelectorAll('.dropdown');
dropdowns.forEach(dropdown => {
    dropdown.addEventListener('click', (e) => {
        if (!dropdown.classList.contains('_active')) {
            dropdown.classList.add('_active')
            coordBlockCity();
        } else {
            dropdown.classList.remove('_active')
        }
    })
})


const headerElem = document.querySelector('.header__top');
const elemInStyle = headerElem.querySelector('.dropdown');
const PADDINGBORDER = 2;

function coordBlockCity() {
    if (mediaMin('768')) {
        if (!elemInStyle.classList.contains('_active')) return false;
        let styleELem = window.getComputedStyle(headerElem, null);
        let sumNotPadding = (headerElem.offsetHeight - (parseFloat(styleELem.paddingBottom) + parseFloat(styleELem.paddingTop)))
        let resultStlye = (sumNotPadding + parseFloat(styleELem.paddingBottom)) - PADDINGBORDER;
        elemInStyle.querySelector('.dropdown__body').style.transform = `translateY(${resultStlye}px)`;
    }
}

window.addEventListener('resize', () => { coordBlockCity() });

// const appendList = document.querySelector('.menu-city__popup-list--bottom');
// const cloneListCity = document.querySelector('.city_block__list').cloneNode(true);

// appendList.innerHTML = cloneListCity.outerHTML;
import "../unstable/sticky-header.js";
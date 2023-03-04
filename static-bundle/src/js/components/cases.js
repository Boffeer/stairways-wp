'use strict';

try {
	let AJAX_ADMIN_URL= stairways.ajaxUrl;;

function updateCaseText(title = '', stats = '', desc = '') {
	const casePop = document.querySelector('.poppa-abouts');
	const caseTitle = casePop.querySelector('.modal__title');
	const caseStats = casePop.querySelector('.modal-abouts__stats');
	const caseDesc = casePop.querySelector('.modal__group--desc');
	const caseCta = casePop.querySelector('.modal-abouts__button')

	caseTitle.innerText = title;
	caseDesc.innerText = desc;
	caseCta.dataset.formName = `${caseCta.dataset.formNamePrefix} «${title}»`

	if (!stats) return
	caseStats.innerHTML = stats;
}

function updateCaseSlides(gallery = '') {
	const casePop = document.querySelector('.poppa-abouts');
	const caseCarousel = casePop.querySelector('.poppa-slider--swiper')

	caseCarousel.querySelectorAll('.swiper-slide.poppa-slider--slide').forEach(slide => {
		slide.remove()
	});

	caseCarousel.querySelector('.swiper-wrapper').innerHTML = gallery;
	caseCarousel.swiper.updateSlides();
	caseCarousel.swiper.updateProgress();
	caseCarousel.swiper.slideTo(0);
}

initCaseButtons();
function initCaseButtons() {
	const casesButtons = document.querySelectorAll('.js-button__get-content');
	casesButtons.forEach((button) => {
		if (button.classList.contains('js-button__get-content--init')) return;


		button.addEventListener("click", async (e) => {
			let caseId = button.dataset.caseId;
			if (!caseId) return;
			const buttonText = button.innerText
			button.classList.add('button--wait')

	    const formData = new FormData();
	    formData.append('action', 'get_case');
	    formData.append('id', caseId);

	    if (!AJAX_ADMIN_URL) {
	    	console.error('no AJAX_ADMIN_URL in cases.js')
	    	return;
	    }

			const caseObject = await fetch(AJAX_ADMIN_URL, {
	      method: "POST",
	      body: formData,
			});

	    let result = await caseObject.text();
	    const {title, stats, desc, gallery} = JSON.parse(result);
	    await updateCaseText(title, stats, desc);
	    await updateCaseSlides(gallery);

	    window.poppa.openPop('abouts')
			button.classList.remove('button--wait')
		});

		button.classList.add('js-button__get-content--init');
	})
}
window.initCaseButtons = initCaseButtons;

function updateFormName(formElement, name) {
	if (!formElement || !name) return;

	const formNameInput = formElement.querySelector('input[name="form_name"]');
	if (!formNameInput) return;

	formNameInput.value = name;
}

initFormNameButtons();
function initFormNameButtons() {
	const formNameButtons = document.querySelectorAll('.js-button__formname');

	formNameButtons.forEach((button) => {
		if (button.classList.contains('js-button__formname--init')) return

		button.addEventListener('click', (e) => {
			const formSelector = e.target.dataset.form;
			if (!formSelector) return;
			const form = document.querySelector(formSelector);

			const formName = e.target.dataset.formName;
			if (!formName) return;

			updateFormName(form, formName);
		})

	button.classList.add('js-button__formname--init')
	})
}
window.initFormNameButtons = initFormNameButtons
} catch {
	console.warn('There is no AJAX_ADMIN_URL in cases.js')
}

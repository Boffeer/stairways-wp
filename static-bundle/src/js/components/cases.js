'use strict';

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
	setTimeout(() => {
		caseCarousel.swiper.updateSlides();
		caseCarousel.swiper.updateProgress();
		caseCarousel.swiper.slideTo(0);
		caseCarousel.swiper.slideReset();
		console.log(caseCarousel.swiper)
	}, 100)
	// caseCarousel.swiper.slidePrev();
}
function updateFormName(formElement, name) {
	if (!formElement || !name) return;

	const formNameInput = formElement.querySelector('input[name="form_name"]');
	if (!formNameInput) return;

	formNameInput.value = name;
}
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


try {
	let AJAX_ADMIN_URL= stairways.ajaxUrl;;

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
	initCaseButtons();
	window.initCaseButtons = initCaseButtons;

	initFormNameButtons();
} catch {
	console.warn('There is no AJAX_ADMIN_URL in cases.js')
}

try {
	let AJAX_ADMIN_URL= stairways.ajaxUrl;;
	const productCasesMore = document.querySelector('.prod-items__show');
	if (productCasesMore) {
		productCasesMore.dataset.fetchIteration = "1";
		const INITIAL_CASES_COUNT = [...productCasesMore.parentElement.querySelectorAll('.projects-gallery-carousel__slide')].length;

		productCasesMore.addEventListener('click', async (e) => {
			const includeCasesIds = [];
			const currentCases = [...productCasesMore.parentElement.querySelectorAll('.projects-gallery-carousel__slide')];
			// const currentCasesCount = [...currentCases].length;

			// console.log(currentCases)
			currentCases.forEach((caseItem) => {
				includeCasesIds.push(caseItem.querySelector('.projects-gallery-slide').dataset.id);
			})

			productCasesMore.classList.add('button--wait')
	    productCasesMore.dataset.fetchIteration = +productCasesMore.dataset.fetchIteration + 1;

	    const formData = new FormData();
	    formData.append('action', 'get_more_cases');
	    formData.append('initial', INITIAL_CASES_COUNT);
	    formData.append('include', includeCasesIds);
	    formData.append('offset', INITIAL_CASES_COUNT * +productCasesMore.dataset.fetchIteration);


	    if (!AJAX_ADMIN_URL) {
	    	console.error('no AJAX_ADMIN_URL in cases.js')
	    	return;
	    }

			const caseObject = await fetch(AJAX_ADMIN_URL, {
	      method: "POST",
	      body: formData,
			});

	    let result = await caseObject.text();
	    const gallery = productCasesMore.parentElement.querySelector('.projects-gallery-carousel');
	    gallery.innerHTML = result;
	    // gallery.innerHTML = gallery.innerHTML + result;
	    // const {title, stats, desc, gallery} = JSON.parse(result);
	    // await updateCaseText(title, stats, desc);
	    setTimeout(() => {
		    window.initCaseButtons();
		    window.poppa.initButtons()
		    updateCaseSlides(gallery);
	    },10);

			productCasesMore.classList.remove('button--wait')
		})
	}
} catch {
	console.warn('There is no AJAX_ADMIN_URL in get_more.js')
}

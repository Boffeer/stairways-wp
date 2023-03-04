import {debounce} from "../utils/helpers.js";

const filterContainer = document.querySelectorAll('.tabs-7p');

const casesFilterIndustriesInner = document.querySelector(".filters-7p__track");
const filterButtons = document.querySelectorAll(".tabs-7p-tab");
const casesFilterMore = document.querySelector(".tabs-7p__more-button");
const casesFilterDropdown = document.querySelector(
  ".tabs-7p__industries-dropdown"
);
const filterTotal = document.querySelector('.tabs-7p-tab--total');


function uncheckAllFilters(filters) {
	filters.forEach(filter => {
		if (filter.classList.contains('tabs-7p-tab--total')) return;

		const checkInput = filter.querySelector('input[type="radio"]') || filter.querySelector('input[type="checkbox"]');
		checkInput.checked = false;
	})
}

if ([...filterButtons].length > 0) {

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
      if (index === 0) return;
      casesFilterIndustriesInner.appendChild(item);
    });
  }

  // Перемещает фильтры между дропдауном и скроллбаром
  function relocateFilterItems() {
    let filtersMaxWidth = document.querySelector(".tabs-7p__industries").getBoundingClientRect().width - 360;
    let filtersWidth = document.querySelector(".filters-7p__track").getBoundingClientRect().width;
    let filtersToSkip = [];

    filterButtons.forEach((item, index, arr) => {
      // Чтобы убрать все большие кнопки, которые больше половины
      if (item.innerText.length > 16) {
        filtersToSkip.push(item);
        // console.log("Сразу убрать", item.innerText);
      }
    });
    
    filterButtons.forEach((item, index, arr) => {
      if (index === 0 || filtersToSkip.includes(item)) return;

      if (filtersWidth <= filtersMaxWidth - 100) {
        casesFilterIndustriesInner.appendChild(item);
        filtersWidth += item.getBoundingClientRect().width;
      }
    });
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

try {
const AJAX_ADMIN_URL = stairways.ajaxUrl
const casesFilters = document.querySelectorAll('.tabs-7p');
casesFilters.forEach(filter => {
  const filterForm = filter.querySelector('form');
  const gallery = filter.parentElement.querySelector('.projects-gallery').querySelector('.swiper-wrapper');
  const checkboxes = filterForm.querySelectorAll('input[type="checkbox"]');

  if (!filterForm || !gallery) return;

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', async (e) => {
      e.preventDefault();
      gallery.classList.add('gallery--wait')
      const checked = filterForm.querySelectorAll('input:checked');
      let categoriesIds = [];
      checked.forEach(checkbox => {
        categoriesIds.push(checkbox.value);
      })
      categoriesIds = JSON.stringify(categoriesIds);

      const formData = new FormData();
      formData.append('action', 'get_filtered_cases');
      formData.append('categories', categoriesIds);
      const caseObject = await fetch(AJAX_ADMIN_URL, {
        method: "POST",
        body: formData,
      });
      let result = await caseObject.text();


      const cases = gallery.querySelectorAll('.projects-gallery-slide')
      cases.forEach((caseItem) => {
        caseItem.remove();
      })
      gallery.innerHTML = result;
      window.initFormNameButtons();
      window.initCaseButtons();
      window.poppa.initButtons();
      const carousel = filter.parentElement.querySelector('.projects-gallery-carousel');
      if (carousel) {
        if (carousel.swiper) {
          carousel.swiper.update();
          carousel.swiper.updateProgress();
        }
      }
      gallery.classList.remove('gallery--wait');
    })
  })
})
  
} catch {
  console.warn('There is no AJAX_ADMIN_URL in filter-7p.js')
}

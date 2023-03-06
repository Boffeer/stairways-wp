import {debounce} from "../utils/helpers.js";

const filterContainer = document.querySelectorAll('.tabs-7p');



function uncheckAllFilters(filters) {
	filters.forEach(filter => {
		if (filter.classList.contains('tabs-7p-tab--total')) return;

		const checkInput = filter.querySelector('input[type="radio"]') || filter.querySelector('input[type="checkbox"]');
		checkInput.checked = false;
	})
}

filterContainer.forEach((filter, filterIndex) => {

const casesFilterIndustriesInner = filter.querySelector(".filters-7p__track");
const filterButtons = filter.querySelectorAll(".tabs-7p-tab");
const casesFilterMore = filter.querySelector(".tabs-7p__more-button");
const casesFilterDropdown = filter.querySelector(
  ".tabs-7p__industries-dropdown"
);
const filterTotal = filter.querySelector('.tabs-7p-tab--total');

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
    let filtersMaxWidth = filter.querySelector(".tabs-7p__industries").getBoundingClientRect().width - 360;
    let filtersWidth = filter.querySelector(".filters-7p__track").getBoundingClientRect().width;
    let filtersToSkip = [];


    filterButtons.forEach((item, index, arr) => {
      // Чтобы убрать все большие кнопки, которые больше половины
      if (item.innerText.length > 25) {
        filtersToSkip.push(item);
        item.classList.add('js__filter-7p-tab--removed-initially')
        // console.log("Сразу убрать", item.innerText);
      }
    });
    
    filterButtons.forEach((item, index, arr) => {
      if (index === 0 || filtersToSkip.includes(item)) return;

      if (filtersWidth <= filtersMaxWidth - 100) {
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
})


try {
const AJAX_ADMIN_URL = stairways.ajaxUrl
const casesFilters = document.querySelectorAll('.tabs-7p');
casesFilters.forEach(filter => {
  const filterForm = filter.querySelector('form');
  // let gallery = filter.parentElement.querySelector('.projects-gallery')
  const gallery = filter.parentElement.querySelector('.swiper-wrapper');

  if (!gallery) {
    console.log('no gallery for',  filterForm.dataset.action)
    return;
  }
  const checkboxes = filterForm.querySelectorAll('input[type="checkbox"]');

  if (!filterForm || !gallery) return;

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', async (e) => {
      e.preventDefault();
      gallery.classList.add('gallery--wait')
      let checked = [...filterForm.querySelectorAll('input:checked')];

      if (checked.length == 0) {
        const totalButton = filterForm.querySelector('.tabs-7p-tab--total').querySelector('input')
        totalButton.checked = true;
        checked.push(totalButton);
      }

      let categoriesIds = [];
      checked.forEach(checkbox => {
        categoriesIds.push(checkbox.value);
      })

      categoriesIds = JSON.stringify(categoriesIds);

      const formData = new FormData();
      // console.log(filter.dataset)
      formData.append('action', filterForm.dataset.action);
      formData.append('categories', categoriesIds);
      // console.log(categoriesIds)
      const caseObject = await fetch(AJAX_ADMIN_URL, {
        method: "POST",
        body: formData,
      });
      let result = await caseObject.text();


      const cases = gallery.querySelectorAll('.swiper-slide')
      cases.forEach((caseItem) => {
        caseItem.remove();
      })
      gallery.innerHTML = result;
      window.initFormNameButtons();
      window.initCaseButtons();
      window.poppa.initButtons();
      const carousel = gallery.parentElement
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

"use strict"

import Swiper, { Navigation, Autoplay, Pagination, Thumbs, EffectFade } from "swiper";
// import {debounce} from "../utils/helpers.js";


const quizes = document.querySelectorAll('.quiz-carousel');
function togglePrevVisibility(context) {
  if (context.activeIndex == 0) {
    // context.el.querySelector('.quiz-button-prev').style.display = 'none';
    context.el.querySelector('.quiz-buttons').classList.remove('quiz-buttons--not-first-slide')
  } else {
    // context.el.querySelector('.quiz-button-prev').style.display = '';
    context.el.querySelector('.quiz-buttons').classList.add('quiz-buttons--not-first-slide')
  }
}

function changeStepIndex(context) {
  const quiz = context.el;
  const sliderStatusStepEl = quiz.parentElement.querySelector('.quiz-status__step');

  if (sliderStatusStepEl) {
    const TOTAL_STEPS = context.slides.length;
    const CURRENT_STEP = context.activeIndex + 1;
    const STEP_INDEX = ` ${CURRENT_STEP} / ${TOTAL_STEPS}`;

    sliderStatusStepEl.innerText = STEP_INDEX;
  }
}

function changeStepName(context) {
  const quiz = context.el;
  const stepNameEl = quiz.parentElement.querySelector('.quiz-status__name')

  if (stepNameEl) {
    const CURRENT_SLIDE = context.slides[context.activeIndex];
    stepNameEl.innerText = CURRENT_SLIDE.dataset.stepName;
  }
}

function isQuestionFinal(context) {
  return context.activeIndex == context.slides.length - 1;
}

function hideButtonsOnFinalQuestion(context) {
    context.el.querySelector('.quiz-buttons').style.display = 'none';
}

function processQuestionCondition(context, condition) {
  if (condition.includes('!=')) {
    condition = condition.split('!=');
    condition[0] = getQuestionAppearCondition(context, condition[0]);
    return condition[0] != condition[1]
  } else if (condition.includes('==')) {
    condition = condition.split('==');
    condition[0] = getQuestionAppearCondition(context, condition[0]);
    return condition[0] == condition[1]
  }
}

function prepareQuestionCondition(context, condition) {
  if (condition == undefined) return true;
  let mappedConditions;

  if (condition.includes('&&')) {
    let conditions = condition.split('&&'); 
    mappedConditions = conditions.map(condition => {
      return processQuestionCondition(context, condition);
    });
    mappedConditions = Boolean( mappedConditions.reduce((totalAnswer, currentAnswer) => {
      return totalAnswer * currentAnswer;
    }) )
  } else {
    mappedConditions = processQuestionCondition(context, condition);
  }

  return mappedConditions;
}

function getQuestionAppearCondition(context, question) {
  const userCheckedAnswer = context.el.querySelector(`[name="${question}"]:checked`).dataset.value
  return  userCheckedAnswer;
}

quizes.forEach((quiz, index) => {
  const SWIPER_NAME = 'quiz';
  const CURRENT_SWIPER_NAME = `${SWIPER_NAME}-${index}`;

  if (quiz.id == '') {
    quiz.id+= `${CURRENT_SWIPER_NAME}`;
  } else {
    quiz.id+= ` ${CURRENT_SWIPER_NAME}`;
  }

  let carousel = new Swiper(`#${CURRENT_SWIPER_NAME}`, {
    modules: [Navigation, Pagination, EffectFade],
    autoHeight: true,
    allowTouchMove: false,
    spaceBetween: 10,
    slidesPerView: 1,
    slidesPerGroup: 1,
    pagination: {
      el: `#${CURRENT_SWIPER_NAME} .${SWIPER_NAME}-pagination`,
      type: "progressbar",
    },
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    on: {
      init: function() {
        togglePrevVisibility(this);
        this.slides.forEach((slide, index) => {
          slide.dataset.index = index;
          slide.querySelectorAll('.quiz-answer__radio').forEach((answer, index) => {
            answer.dataset.value = index + 1;
          })
        })
      },
      slideChange: function() {

        togglePrevVisibility(this);
        if (!isQuestionFinal(this)) return

        hideButtonsOnFinalQuestion(this);
        this.params.autoHeight = false;
        this.update();
        const wrapper = this.el.querySelector('.swiper-wrapper');
        wrapper.style.height = '';
      },
      slideNextTransitionEnd: function () {
      },
      slidePrevTransitionEnd: function () {
      },
      slideChangeTransitionEnd: function () {
        // changeStepIndex(this);
        changeStepName(this);
      }
    }
  });


  const nextButton = quiz.querySelector(`.${SWIPER_NAME}-button-next`);

  nextButton.addEventListener('click', () => {
    let currentIndex = carousel.activeIndex
    currentIndex++
    let nextSlideCondition = prepareQuestionCondition(carousel, carousel.slides[currentIndex].dataset.condition)

    while(nextSlideCondition == false) {
      carousel.slides[currentIndex].querySelectorAll('.quiz-answer__radio').forEach(input => {
        input.disabled = true
      })
      currentIndex++;
      nextSlideCondition = prepareQuestionCondition(carousel, carousel.slides[currentIndex].dataset.condition)
    }
    carousel.slideTo(currentIndex)
  });

  const prevButton = quiz.querySelector(`.${SWIPER_NAME}-button-prev`);
  prevButton.addEventListener('click', () => {
    let currentIndex = carousel.activeIndex;
    currentIndex--;
    let nextSlideCondition = prepareQuestionCondition(carousel, carousel.slides[currentIndex].dataset.condition)

    while(nextSlideCondition == false) {
      carousel.slides[currentIndex].querySelectorAll('.quiz-answer__radio').forEach(input => {
        input.disabled = false
      })
      currentIndex--;
      nextSlideCondition = prepareQuestionCondition(carousel, carousel.slides[currentIndex].dataset.condition);
    }
    carousel.slideTo(currentIndex)
  });
})





// -----
if (document.querySelector('.product-hero-gallery') && document.querySelector('.product-hero-thumbs')) {
  let swiper = new Swiper(".product-hero-thumbs", {
    direction: 'vertical',
    centeredSlides: true,
    centeredSlidesBounds: true,
    centerInsufficientSlides: true,
    spaceBetween: 10,
    slidesPerView: 'auto',
  });
  let heroGallery = new Swiper(".product-hero-gallery", {
    modules: [Navigation, Pagination, EffectFade],
    spaceBetween: 10,
    pagination: {
      el: ".product-hero-gallery-pagination",
      clickable: true,
    },
    effect: 'fade',
      fadeEffect: {
      crossFade: true
    },
    navigation: {
      nextEl: ".product-hero-gallery-next",
      prevEl: ".product-hero-gallery-prev",
    },
    thumbs: {
      swiper: swiper,
    },
    on: {
      slideChange: function() {
        swiper.slideTo(this.activeIndex);
      },
    }
  });
  swiper.on('slideChange', () => {
    heroGallery.slideTo(swiper.activeIndex);
  })
  swiper.slides.forEach((slide, index) => {
    slide.addEventListener('click', () => {
      heroGallery.slideTo(index);
    })
  })
}


if (document.querySelector('.promo-carousel')) {
  function normalizePaginationOffset(swiper) {
    // if (window.innerWidth > 769) return

    const currentSlideCard = swiper.slides[swiper.activeIndex].querySelector('.promo-carousel-card')
    setTimeout(() => {
      const paginationBottomOffset = +currentSlideCard.getBoundingClientRect().height;
      let initialPaginationBottomOffset = 38;
      if (window.innerWidth > 601 && window.innerWidth <= 768) {
        initialPaginationBottomOffset = 98;
      }
      if (window.innerWidth < 769){
        const singularCard = document.querySelector('.promo-carousel-card--singular');
        const singularCardHeight = singularCard.getBoundingClientRect().height
        initialPaginationBottomOffset += singularCardHeight;
      }

      const newPaginationOffset = Math.round(initialPaginationBottomOffset) + Math.round(paginationBottomOffset);
      swiper.pagination.el.style.bottom =  newPaginationOffset + 'px';
    }, 200)
  }
  let promoSlider = new Swiper(".promo-carousel", {
    modules: [Navigation, Autoplay, Pagination, EffectFade],
    effect: 'fade',
      fadeEffect: {
      crossFade: true
    },
    spaceBetween: 10,
    autoHeight: true,
    autoplay: {
      delay: 3000,
    },
    breakpoints: {
      769: {
        spaceBetween: 100,
      }
    },
    pagination: {
      el: ".promo-carousel__pagination",
      clickable: true,
    },
    on: {
      init: function () {
        normalizePaginationOffset(this)
      },
      slideChange: function () {
        normalizePaginationOffset(this)
      },
    }
  });
  window.addEventListener("resize", (e) => {
    debounce(normalizePaginationOffset(promoSlider), 200);
  });
}


const CHANGES_CASE_CARD_CAROUSEL = 'changes-case-card-carousel'
if (document.querySelector(`.${CHANGES_CASE_CARD_CAROUSEL}`)) {
  const carousels = document.querySelectorAll(`.${CHANGES_CASE_CARD_CAROUSEL}`);

  carousels.forEach((carousel, index) => {
    carousel.setAttribute('id', `${CHANGES_CASE_CARD_CAROUSEL}-${index}`);
  })
  carousels.forEach((carousel, index) => {
    new Swiper(`#${CHANGES_CASE_CARD_CAROUSEL}-${index}`, {
      modules: [Navigation, Autoplay, Pagination],
      autoplay: {
        delay: 3000,
      },
      navigation: {
        nextEl: `#${CHANGES_CASE_CARD_CAROUSEL}-${index} .swiper-button-next`,
        prevEl: `#${CHANGES_CASE_CARD_CAROUSEL}-${index} .swiper-button-prev`,
      },
    });
  })
}

if (document.querySelector('.grabber-carousel')) {
let promoSlider = new Swiper(".grabber-carousel", {
  grabCursor: true,
  slidesPerView: 1.25,
  spaceBetween: 8,
  breakpoints: {
    769: {
      slidesPerView: 2.5,
    }
  }
  // cssMode: true,
  // freeMode: true,
  // centeredSlides: true,
  // effect: 'creative',
  // creativeEffect: {
  // prev: {
  //   shadow: false,
  //   translate: [0, 0, -400],
  // },
  // next: {
  //   translate: ['100%', 0, 0],
  // },
  // },
});
}

if (document.querySelector('.product-cases-carousel')) {
  const carousels = document.querySelectorAll('.product-cases-carousel');
  const CAROUSEL_ID = 'product-cases-carousel';
  setTimeout(() => {
    carousels.forEach((carousel, index) => {
      carousel.id = `${CAROUSEL_ID}-${index}`

      let productCaseSlider = new Swiper(`#${carousel.id}`, {
        grabCursor: true,
        autoHeight: true,
        slidesPerView: 1,
        spaceBetween: 150,
        modules: [Navigation, Autoplay, Pagination],
        navigation: {
          nextEl: `#${carousel.id} .swiper-button-next`,
          prevEl: `#${carousel.id} .swiper-button-prev`,
        },
      });
      carousel.querySelectorAll('.product-cases-carousel-slide').forEach(slide => {
        slide.querySelector('.gallery-accordion__button-more').addEventListener('click', () => {
          console.log(productCaseSlider)
          setTimeout(() => {
            productCaseSlider.update();
          }, 200)
        })
      })
    })
  }, 1000)
}



const articleCarousels = document.querySelectorAll('.wp-block-cb-carousel');
articleCarousels.forEach((carousel, carouselIndex) => {
  carousel.classList.add('swiper');

  const carouselClass = `article-slider-${carouselIndex}`
  carousel.classList.add(carouselClass);


  const carouselContent = carousel.innerHTML;
  carousel.innerHTML = '';

  const swiperWrapper = document.createElement('div');
  swiperWrapper.classList.add('swiper-wrapper')

  carousel.append(swiperWrapper);

  swiperWrapper.innerHTML = carouselContent;

  carousel.querySelectorAll('.wp-block-cb-slide').forEach(slide => {
    slide.classList.add('swiper-slide');
  })

  const bullets = document.createElement('div');
  const bulletsClass = `swiper-pagination-${carouselIndex}`
  bullets.classList.add('swiper-pagination')
  bullets.classList.add(bulletsClass)
  carousel.append(bullets);

  const prevButton = document.createElement('div')
  const prevButtonClass = `swiper-button-prev-${carouselIndex}`
  prevButton.classList.add('swiper-button-prev')
  prevButton.classList.add(prevButtonClass)
  carousel.append(prevButton);

  const nextButton = document.createElement('div')
  const nextButtonClass = `swiper-button-next-${carouselIndex}`
  nextButton.classList.add('swiper-button-next')
  nextButton.classList.add(nextButtonClass)
  carousel.append(nextButton);

  new Swiper(`.${carouselClass}`, {
    modules: [Navigation, Pagination],
    // autoHeight: true,
    spaceBetween: 10,
    pagination: {
      el: `.${bulletsClass}`,
      clickable: true,
    },
    effect: 'fade',
      fadeEffect: {
      crossFade: true
    },
    navigation: {
      nextEl: `.${nextButtonClass}`,
      prevEl: `.${prevButtonClass}`,
    },
  });

})

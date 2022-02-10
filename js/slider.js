// Slider
const initSlider = function () {
  document.querySelectorAll('.gallery').forEach(function (galerie) {
    const slideSelectorsArray = [];
    const container = galerie.querySelector('.gdymc_gallery_container');
    var items = galerie.querySelectorAll('.gdymc_gallery_item');

    let showcaseObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && ['init', 'next', 'prev'].some(className => entry.target.classList.contains(className))) {
          
          // Remove active classes
          galerie.querySelectorAll('.gdymc_gallery_item_selector').forEach(function (item) {
            item.classList.remove('toRight');
            item.classList.remove('toLeft');

            if (['fromRight', 'fromLeft'].some(className => item.classList.contains(className))) {
              if (entry.target.classList.contains('next')) { 
                item.classList.add('toRight');
              }

              if (entry.target.classList.contains('prev')) { 
                item.classList.add('toLeft');
              }

              item.classList.remove('fromRight');
              item.classList.remove('fromLeft');
            }
          });

          if (entry.target.classList.contains('next')) {
            galerie.querySelector(`.gdymc_gallery_item_selector[data-item="${entry.target.dataset.slide}"]`).classList.add('fromRight');
          } else if (entry.target.classList.contains('prev')) {
            galerie.querySelector(`.gdymc_gallery_item_selector[data-item="${entry.target.dataset.slide}"]`).classList.add('fromLeft');
          } else {
            galerie.querySelector(`.gdymc_gallery_item_selector[data-item="${entry.target.dataset.slide}"]`).classList.add('fromRight');
          }

          entry.target.classList.remove('next');
          entry.target.classList.remove('prev');

          // Declare next gallery item
          if (entry.target.nextElementSibling) {
            entry.target.nextElementSibling.classList.add('next');

            // Remove unused declaration of old next gallery item
            if (entry.target.nextElementSibling.nextElementSibling) {
              entry.target.nextElementSibling.nextElementSibling.classList.remove('next');
            }
          }

          // Declare previous gallery item
          if (entry.target.previousElementSibling) {
            entry.target.previousElementSibling.classList.add('prev');

            // Remove unused declaration of old previous gallery item
            if (entry.target.previousElementSibling.previousElementSibling) {
              entry.target.previousElementSibling.previousElementSibling.classList.remove('prev');
            }
          }
        }
      });
    }, {
      root: galerie,
      threshold: .8
    });

    if (items.length > 1) {
      items.forEach(function (item) {
        // Decalare initial gallery item
        items[0].classList.add('init');
        showcaseObserver.observe(item);

        const slideSelector = `
          <span class="gdymc_gallery_item_selector" data-item="${item.dataset.slide}"></span>
        `;

        slideSelectorsArray.push(slideSelector);

        item.addEventListener('click', function (event) {
          if (event.target.classList.contains('gdymc_gallery_item')) {
            container.scroll(event.target.offsetLeft, 0);
          }
        });
      });

      const slideSelectors = document.createElement('div');
      slideSelectors.classList.add('gdymc_gallery_selectors');
      slideSelectors.innerHTML = slideSelectorsArray.join('');
      galerie.appendChild(slideSelectors);

      slideSelectors.addEventListener('click', function (event) {
        if (event.target.classList.contains('gdymc_gallery_item_selector')) {
          const sliderItem = event.target.dataset.item;
          container.scroll(galerie.querySelector(`.gdymc_gallery_item[data-slide="${sliderItem}"]`).offsetLeft, 0);
        }
      });
    }
  });
}

export default initSlider;
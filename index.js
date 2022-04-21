import './index.scss';

import store from './js/store/store';
import events from './js/events/events';
import initSlider from './js/slider';

function ready (callback) {
  document.addEventListener('DOMContentLoaded', () => callback());
}

ready(function () {
  store.state.domReady = true;

  events.add('click');
  events.add('focusout');
  events.add('change');

  initSlider();
});
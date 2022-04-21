import store from '../store/store';
import formHandler from '../form/handler';


export const helpers = {
  blockScrolling: function () {
    document.querySelector('body').classList.toggle('block-scrolling');
  },
}

export const handler = {


  /**
   * Toggle mobile navigation and update the linked state.
  **/

  mobileNavigation: function() {
    store.state.mobileNavigation = !store.state.mobileNavigation;
    helpers.blockScrolling();
    document.querySelector('.navigation__mobile').classList.toggle('navigation__mobile--active');
    document.querySelector('.navigation__mobile-trigger').classList.toggle('navigation__mobile-trigger--close');
  },
  ...formHandler
}

export default handler;
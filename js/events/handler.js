import store from '../store/store';

const mailRegEx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

const check = (input)  => {
  return {
    email: input.value.match(mailRegEx),
    tel: input.value !== '',
    text: input.value !== '',
    date: input.value !== '',
    select: input.value !== '',
    textarea: input.value !== '',
    hidden: input.value !== '',
    checkbox: input.checked
  } [input.type];
}

export const helpers = {
  blockScrolling: function () {
    document.querySelector('body').classList.toggle('block-scrolling');
  },
}

export const handler = {
  mobileNavigation: function() {
    store.state.mobileNavigation = !store.state.mobileNavigation;
    helpers.blockScrolling();
    document.querySelector('.navigation__mobile').classList.toggle('navigation__mobile--active');
    document.querySelector('.navigation__mobile-trigger').classList.toggle('navigation__mobile-trigger--close');
  },
  checkValidity: function(input) {
    if (!check(input)) {
      input.classList.add('invalid');
      return false;
    } else {
      input.classList.remove('invalid');
      return true;
    }
  },
  sendContactForm: function (event) {
    event.preventDefault();

    console.log(event);

    const errors = [];
    const formData = new FormData();
    const formElement = event.target.closest('form');

    Array.from(event.target.form).forEach(input => {
      if (input.required) {
        errors.push(handler.checkValidity(input));
      }

      formData.append(input.name, input.value);
    });

    if (!errors.includes(false)) {
      formElement.classList.add('loading', 'disabled');

      fetch(window.location.origin + '/wp-json/custom/v1/send', {
        'method': 'POST', 
        'body': formData,
        'redirect': 'follow'
      }).then(res => {
        if (res.status === 200) {
          formElement.classList.remove('loading');
          formElement.classList.add('success');

          setTimeout(() => {
            Array.from(event.target.form).forEach(input => {
              if (input.type !== 'submit') {
                input.value = '';
              }
            });
            formElement.classList.remove('success', 'disabled');
          } , 3000);
        } 
      }).catch(err => {
        formElement.classList.remove('loading');
        formElement.classList.add('failure');
      });
    } else {
      Array.from(document.querySelectorAll('.invalid')).forEach(input => {
        input.classList.add('invalid--strong');
      });
    }
  },
  checkFormInput: function (event) {
    handler.checkValidity(event.target);
  },
  checkCheckbox: function (event) {
    if (event.target.type === 'checkbox') {
      return;
    }
    
    const clickedElement = event.target.parentNode.querySelector('input') 
      ? event.target.parentNode.querySelector('input')
      : event.target.querySelector('input');

    clickedElement.checked = !clickedElement.checked;
  }
}

export default handler;
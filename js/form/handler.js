import post from '../utils/post';

// Utility methods
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

const markInvalidInputs = (input) => {
  if (!check(input)) {
    input.classList.add('invalid');
    return false;
  } else {
    input.classList.remove('invalid');
    return true;
  }
};

// Methods
const handler = {
  checkFormInput: function (event) {
    markInvalidInputs(event.target);
  },
  checkAllFormInputs: function (event) {
    const errors = [];
    const data = new FormData();

    Array.from(event.target.form).forEach(input => {
      if (input.required) {
        errors.push(markInvalidInputs(input));
      }

      data.append(input.name, input.value);
    });

    if (errors.includes(false)) {
      return false;
    } else {
      return data;
    }
  },
  checkChildCheckbox: function (event) {
    if (event.target.type === 'checkbox') {
      return;
    }
    
    const targetCheckbox = event.target.parentNode.querySelector('input') 
      ? event.target.parentNode.querySelector('input')
      : event.target.querySelector('input');

      targetCheckbox.checked = !targetCheckbox.checked;
  },
  sendForm: async function (event) {
    event.preventDefault();

    // Get valid form data
    const formData = handler.checkAllFormInputs(event);

    // Send if form is valid
    if (formData) {
        handler.updateFormState(event, 'loading');

        const response = await post('/wp-json/custom/v1/send', formData);

        if (response.status === 200) {
          handler.updateFormState(event, 'success');

          setTimeout(() => {
            handler.clearForm(event);
            handler.clearFormState(event);
          }, 3000);
        } else {
          handler.updateFormState(event, 'failure');
        }
    } else {
      Array.from(event.target.form.querySelectorAll('.invalid')).forEach(input => {
        input.classList.add('invalid--strong');
      });
    }
  },
  clearForm: function (event) {
    Array.from(event.target.form).forEach(input => {
      if (input.type !== 'submit') {
        input.value = '';
      }
    });
  },
  updateFormState: function (event, state) {
    const stateClasses = {
      loading: ['disabled', 'loading'],
      success: ['disabled', 'success'],
      failure: ['disabled', 'failure']
    }[state];

    event.target.form.classList.remove('disabled', 'loading', 'success', 'failure');

    event.target.form.classList.add(...stateClasses);
  },
  clearFormState: function (event) {
    event.target.form.classList.remove('disabled', 'loading', 'success', 'failure');
  }
}

export default handler; 
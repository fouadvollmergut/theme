import post from '../utils/post';

// Utility methods
const mailRegEx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

const check = (input)  => {
  return {
    'text': input.value !== '',
    'email': input.value.match(mailRegEx),
    'tel': input.value !== '',
    'date': input.value !== '',
    'select-one': input.value !== '',
    'textarea': input.value !== '',
    'hidden': input.value !== '',
    'file': input.value !== '',
    'checkbox': input.checked,
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

const createEmbeddedFile = (file) => {

  const embedElement = document.createElement('embed');
  embedElement.src = URL.createObjectURL(file);
  embedElement.src += '#toolbar=0&navpanes=0&scrollbar=0';

  const fileName = document.createElement('caption');
  fileName.innerText = file.name;

  const filePreview = `
    <div class="filePreviewItem">
      ${embedElement.outerHTML}
      <span>${fileName.outerHTML}</span>
    </div>
  `;

  return filePreview;
}

const clearFilePreview = (input) => {
  const filePreviewContainer = input.parentElement.querySelector('.filePreview');
  filePreviewContainer.innerHTML = '';
  filePreviewContainer.classList.remove('populated');
}

// Methods
const handler = {


  /**
   * Validate event target and mark it as invalid if it is not valid.
   *
   * @param {Object} event The event triggered the function.
  **/

  validateFormInput: function (event) {
    markInvalidInputs(event.target);
  },


  /**
   * Valiadate all input elements inside the event target form.
   *
   * @param {Object} event The event triggered the function.
   * @return {Object} If validation succeeds: A data object containing all the inserted form data.
  **/

  validateAllFormInputs: function (event) {
    const errors = [];
    const data = new FormData();

    Array.from(event.target.form).forEach(input => {
      if (input.required) {
        errors.push(markInvalidInputs(input));
      }

      if (input.type === 'file') {
        Array.from(input.files).forEach((file, i) => {
          data.append(input.name + ' ' + i, file);
        });
      } else {
        data.append(input.name, input.value);
      }
    });

    if (errors.includes(false)) {
      return false;
    } else {
      return data;
    }
  },


  /**
   * Check the checkbox that is a child of the event target.
   *
   * @param {Object} event The event triggered the function.
  **/

  checkChildCheckbox: function (event) {
    if (event.target.type === 'checkbox') {
      return;
    }
    
    const targetCheckbox = event.target.parentNode.querySelector('input') || event.target.querySelector('input');

    targetCheckbox.checked = !targetCheckbox.checked;
    targetCheckbox.value = targetCheckbox.checked;
  },


  /**
   * Update file preview.
   *
   * @param {Object} event The event triggered the function.
  **/

  handleFilePreview: function (event) {
    clearFilePreview(event.target);
    const filePreviewContainer = event.target.parentElement.querySelector('.filePreview');

    Array.from(event.target.files).forEach(file => {
      filePreviewContainer.insertAdjacentHTML("beforeend", createEmbeddedFile(file));
    });

    if (filePreviewContainer.childElementCount) {
      filePreviewContainer.classList.add('populated')
    } else {
      filePreviewContainer.classList.remove('populated');
    }
  },


  /**
   * Sends the form data to the server. Updates form state according to the sending process.
   *
   * @param {Object} event The event triggered the function.
  **/

  sendForm: async function (event) {
    event.preventDefault();

    // Get valid form data
    const formData = handler.validateAllFormInputs(event);

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


  /**
   * Reset form input values.
   *
   * @param {Object} event The event triggered the function.
  **/

  clearForm: function (event) {
    Array.from(event.target.form).forEach(input => {
      if (input.type !== 'submit') {
        input.value = '';
      }

      if (input.type === 'checkbox') {
        input.checked = false;
      }

      if (input.type === 'file') {
        clearFilePreview(input);
      }
    });
  },


  /**
   * Handle form state changes by chaning classes of the concerned form.
   *
   * @param {Object} event The event triggered the function.
   * @param {string} state The state to change to.
  **/

  updateFormState: function (event, state) {
    const stateClasses = {
      loading: ['disabled', 'loading'],
      success: ['disabled', 'success'],
      failure: ['disabled', 'failure']
    }[state];

    event.target.form.classList.remove('disabled', 'loading', 'success', 'failure');

    event.target.form.classList.add(...stateClasses);
  },


  /**
   * Clear form state by removing all state classes from the concerned form.
   *
   * @param {Object} event The event triggered the function.
  **/

  clearFormState: function (event) {
    event.target.form.classList.remove('disabled', 'loading', 'success', 'failure');
  }
}

export default handler; 
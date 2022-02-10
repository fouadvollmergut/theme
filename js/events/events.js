import handler from "./handler";

const listener = {
  add: function (event) {
    const elementsWithEvent = document.querySelectorAll('[e-' + event + ']');

    Array.from(elementsWithEvent).forEach(element => {
      element.addEventListener(event, handler[element.attributes['e-' + event].value]);
    });
  },
  addAll: function () {
    const allEvents = [
      'click',
      'focus',
      'focusout',
      'change',
      'mouseover',
      'mouseout',
      'mousemove',
      'mousedown',
      'mouseup'
    ];
    
    allEvents.forEach(function (event) {
      const elementsWithEvent = document.querySelectorAll('[e-' + event + ']');

      Array.from(elementsWithEvent).forEach(element => {
        element.addEventListener(event, handler[element.attributes['e-' + event].value]);
      });
    });
  }
}

export const events = {
  add: listener.add,
  addAll: listener.addAll
}

export default events;
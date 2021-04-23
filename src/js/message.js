'use strict';

export default (title = '', text = '') => {
    return `<div class="modal modal_fixed-width modal_lighting" style="display: none;">
        <div class="modal__title">${title}</div>
        <div class="modal__text">${text}</div>
    </div>`
}

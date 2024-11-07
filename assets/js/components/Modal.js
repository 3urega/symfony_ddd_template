import * as bootstrap from 'bootstrap';

export class Modal {
    /**
     * @param {string} modalId - The id of the modal element.
     * @param {string} size - The size of the modal element. Values: sm (300px), lg (800px), xl (1150px). Default 500px.
     * @param {boolean} backdropStatic - If set to true the modal will not close when clicking outside it. By default false.
     */
    constructor(modalId, backdropStatic = false, size = null) {
        this.modal = document.getElementById(modalId);
        this.closeButton = this.modal.querySelector('.btn-close');
        this.modalTitle = this.modal.querySelector('.modal-title');
        this.modalBody = this.modal.querySelector('.modal-body');
        this.modalFooter = this.modal.querySelector('.modal-footer');

        this.backdrop = backdropStatic ? {backdrop: 'static'} : null;

        if (size) {
            this._setModalSize(size);
        }
    }

    init() {
        this.bootstrapModal = new bootstrap.Modal(this.modal, this.backdrop ?? {});
    }

    /**
     * @param {string} title - The title of the modal element.
     */
    addTitle(title) {
        this.modalTitle.textContent = title;
    }

    /**
     * @param {string} content - The content inside the modal body.
     */
    addContent(content) {
        this.modalBody.innerHTML = content;
    }

    /**
     * @param {Element} button - Button element.
     * @param {callback} callback - Button's action.
     */
    addFooterButton(button, callback) {
        this.modalFooter.appendChild(button);
        this.modalFooter.addEventListener('click', (e) => {
            if (e.target === button) {
                callback(e);
            }
        });
    }

    open() {
        this.bootstrapModal.show();
    }

    close() {
        this.bootstrapModal.hide();
    }

    /**
     * @param {callback} callback - Action done when modal is shown.
     */
    onOpen(callback) {
        $(this.modal).on('show.bs.modal', callback);
    }

    /**
     * @param {callback} callback - Action done when modal has been closed.
     */
    onClose(callback) {
        $(this.modal).on('hidden.bs.modal', callback);
    }

    clearModal() {
        this.modalTitle.textContent = '';
        this.modalBody.innerHTML = '';
        this.modalFooter.innerHTML = '';

        //Clonem el footer per eliminar els eventListeners enllaçats als botons que ja no existeixen
        const newModalFooter = this.modalFooter.cloneNode(true);
        this.modalFooter.replaceWith(newModalFooter);
        this.modalFooter = newModalFooter;
    }

    /**
     * @param {string} size - The size of the modal element. Values: sm (300px), lg (800px), xl (1150px). Default 500px.
     */
    _setModalSize(size) {
        const modalDialog = this.modal.querySelector('.modal-dialog');
        const validValues = ['sm', 'lg', 'xl'];

        if (!validValues.includes(size)) {
            return;
        }

        modalDialog.classList.add(`modal-${size}`);
    }
}

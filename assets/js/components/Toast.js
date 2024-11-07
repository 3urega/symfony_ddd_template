import {htmlToElem} from "../util/util";

export class Toast {
    /**
     * @param {Element} elementId - Toast element.
     */
    constructor(elementId) {
        document.body.appendChild(htmlToElem(`
            <div id="${elementId}" class="toast" style="position: absolute; top: 20px; right: 20px; z-index: 200000">
                <div class="toast-header text-white">
                    <div class="icon mr-2"></div>
                    <strong class="mr-auto title"></strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body text-white">
                </div>
            </div>
        `));
        this.element = document.getElementById(elementId);
    }

    init() {
        $(this.element).toast({
            delay: 3500
        });
        $(this.element).on('hidden.bs.toast', () => {
            this.element.querySelector('.icon').innerHTML = '';
            this.element.querySelector('.title').textContent = '';
            this.element.querySelector('.toast-body').innerHTML = '';
        })
    }

    open() {
        $(this.element).toast('show');
    }

    /**
     * @param {callback} className - Bootstrap bg class
     */
    setColorClass(className) {
        this.element.classList.add(className);
    }

    /**
     * @param {callback} icon - Fontawesome icon class
     */
    setIconClass(icon) {
        this.element.querySelector('.icon').innerHTML = `<i class="${icon}"></i>`;
    }

    /**
     * @param {callback} title - Title text.
     */
    setTitle(title) {
        this.element.querySelector('.title').innerText = title;
    }

    /**
     * @param {callback} content - Html and text inside body modal.
     */
    setContent(content) {
        this.element.querySelector('.toast-body').innerHTML = content;
    }

    /**
     * @param {callback} callback - Action done when toast has been closed.
     */
    onClose(callback) {
        $(this.element).on('hidden.bs.toast', callback);
    }

    remove() {
        $(this.element).toast('dispose');
        document.body.removeChild(document.querySelector('.toast'));
    }
}

import $ from 'jquery';
import 'select2/dist/js/select2';
import 'select2/dist/js/i18n/es';

export class Select2Select {
    /**
     * @param {string} selectId - The id of the select element.
     * @param {string} dropdownParentId - The id of the dropdown element parent (fix for modals).
     * @param {string} ajaxUrl - Select2 generates a dynamic dropdown list from an ajax search.
     */
    constructor(selectId, dropdownParentId = null, ajaxUrl = null) {
        this.selector = document.getElementById(selectId);
        this.options = {
            width: '100%',
            language: 'es',
            placeholder: 'Selecciona una opción'
        };

        if (dropdownParentId) {
            this.options.dropdownParent = $(`#${dropdownParentId}`);
        }

        if (ajaxUrl) {
            this.options.minimumInputLength = 3;
            this.options.ajax = {
                url: ajaxUrl,
                dataType: 'json',
                delay: 250,
                cache: true,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
            }
        }
    }

    init() {
        $(this.selector).select2(this.options);
    }

    getValue() {
        return $(this.selector).val();
    }

    onChange(callback) {
        $(this.selector).on('select2:select', callback);
        $(this.selector).on('select2:clear', callback);
    }

    destroy() {
        $(this.selector).select2('destroy');
    }

    clear() {
        $(this.selector).val('All').trigger('change.select2');
    }
}

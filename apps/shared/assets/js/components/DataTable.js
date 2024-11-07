import 'datatables.net/js/dataTables';
import 'datatables.net-bs4/js/dataTables.bootstrap4';

export class DataTable {
    /**
     * @param {string} tableId - The id of the table element.
     */
    constructor(tableId) {
        this.table = document.getElementById(tableId);
        this.columns = [];
        this.filters = [];

        this.options = {
            drawCallback: (settings) => {
                //$('[data-toggle="tooltip"]').tooltip({ trigger: 'hover' });
            },
            language: {
                'url': config.datatables.lang,
            },
            dom: config.datatables.dom
        };
    }

    init() {
        this._validateAsyncOptions();

        this._setColumns();

        this._setFilters();

        this.dataTable = $(this.table).DataTable(this.options);
    }

    /**
     * @param {string} url - Ajax url.
     */
    setAjaxUrl(url) {
        if (!url) {
            throw new Error('Ajax url cannot be empty.');
        }

        this.options.ajax =  {
            url: url
        };
        this.options.serverSide = true;
    }

    /**
     * @param {string} name - Column name.
     * @param {boolean} orderable - Set column as orderable. False by default.
     * @param {callback} renderCallback - Render callback. It will be called with this four parameters: (columnData, type, row, meta)
     */
    setColumn(name, orderable = false, renderCallback = null) {
        let column = {
            data: name,
            orderable
        }

        if (renderCallback) {
            column.render = renderCallback;
        }

        this.columns.push(column);
    }

    /**
     * @param {string} filterName - Name that must match the searching key of the backend's query.
     * @param {callback} getFilterValue - Callback that must return the value of the filter element.
     */
    setFilter(filterName, getFilterValue) {
        this.filters.push({
            filterName,
            getFilterValue
        });
    }

    reload() {
        if (!this.dataTable) {
            return;
        }
       // $('[data-toggle="tooltip"]').tooltip('dispose');
        this.dataTable.ajax.reload();
    }

    /**
     * @param {callback} callback - Row render callback.
     */
    setRowCallback(callback) {
        this.options = { ...this.options, rowCallback: callback };
    }

    getTableElement() {
        return this.table;
    }

    _validateAsyncOptions() {
        if ((this.columns.length && !this.options.ajax)
            ||
            (!this.columns.length && this.options.ajax)
        ) {
            throw new Error('Both columns and ajaxUrl options need to be specified if one of them is.');
        }

        if (this.filters.length && !this.options.ajax) {
            throw new Error('Filters can only work if an ajax url has been specified.')
        }
    }

    _setColumns() {
        if (this.columns.length && this.options.ajax.url) {
            this.options.columns = this.columns;
        }
    }

    _setFilters() {
        if (this.filters.length) {
            this.options.ajax.data = (data) => {
                data.filters = {};
                this.filters.forEach((filter) => {
                    data['filters'][filter.filterName] = filter.getFilterValue();
                })
            }
        }
    }
}

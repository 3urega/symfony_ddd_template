import {DataTable} from '../../../../../../shared/assets/js/components/DataTable';
import {debounce} from "../../../../../../shared/assets/js/util";

export class ListadoProductosBackoffice {
    constructor() {
        this.table = new DataTable('productos_table');
        this.buscarFilter = document.getElementById('buscar_nombre');
        this.pendentsFilter = document.getElementById('pendents');

        this.table.setAjaxUrl(config.listado.url);
        this._setTableColumns();
        this._setTableFilters();
    }

    render() {
        this.table.init();
        this._setFilterListeners();
    }

    _setTableColumns() {
        const impersonarEmail = '';

        
        this.table.setColumn('id', false, (id) => {

            const url = 'hallo'; //config.editar_producto.url.replace('id_producto', id);
            
            return `
                 <a
                    data-toggle="tooltip"
                    href="${url}" class="btn btn-link p-1"
                    data-original-title="Ver"
                    data-placement="right"
                 >
                    <i class="fas fa-eye"></i>
                </a> 
            `;
        });

        this.table.setColumn('nombre', true);
    }

    _setTableFilters() {
        this.table.setFilter('nombre', () => {
            //console.log('buscando ... ', this.buscarFilter.value)
            return this.buscarFilter.value
        });
        //this.table.setFilter('pendents', () => this.pendentsFilter.checked);
    }

    _setFilterListeners() {
        this.buscarFilter.addEventListener('keyup', debounce(
            () => {
                this.table.reload();
            },
            300
        ));
        /*
        this.pendentsFilter.addEventListener('change', (value) => {
            this.table.reload();
        });
        */
    }
    
}



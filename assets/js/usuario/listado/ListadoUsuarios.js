import {DataTable} from '../../components/DataTable';
import {debounce} from "../../util/util";

export class ListadoUsuarios {
    constructor() {
        this.table = new DataTable('usuarios_table');
        this.buscarFilter = document.getElementById('buscar');

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

        this.table.setColumn('nombre', true);
        this.table.setColumn('direccionEmail', true);
        this.table.setColumn('id', false, (id, type, row) => {

            const url = config.editar_usuario.url.replace('id_usuario', id);
            const url_impersonar = config.impersonar_usuario 
                ? config.impersonar_usuario.url.replace('direccion_email', row.direccionEmail)
                : null;
            
            let response = `
                 <a
                    data-toggle="tooltip"
                    href="${url}" class="btn btn-link p-1"
                    data-original-title="Ver"
                    data-placement="right"
                 >
                    <i class="fas fa-eye"></i>
                </a> 
                `;
            if(url_impersonar){
                response += `<a 
                data-toggle="tooltip"
                href="${url_impersonar}" class="btn btn-link p-1"
                data-original-title="Impersonar"
                data-placement="right"
            >
                <i class="fas fa-arrow-circle-right"></i>
            </a>
            `;
            }
                

            return response;
        });
    }

    _setTableFilters() {
        this.table.setFilter('email or name', () => this.buscarFilter.value);
    }

    _setFilterListeners() {
        this.buscarFilter.addEventListener('keyup', debounce(
            () => this.table.reload(),
            300
        ));
    }
}



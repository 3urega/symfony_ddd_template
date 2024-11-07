import {Select2Select} from "../../../../../../../assets/js/components/Select2Select";
import {SweetAlert} from "../../../../../../../assets/js/components/SweetAlert";

export class Formulario {
    constructor() {
        this.rolSelect = new Select2Select('rol');
        this.sellosSelect = new Select2Select('sellos');
        this.altaEventosCheckbox = document.getElementById('alta_eventos_container');
        this.deleteUserBtn = document.getElementById('delete_user_btn');
        this.deleteUserAlert = new SweetAlert(
            'Eliminar producto',
            '¿Seguro que quieres <b>eliminar este usuario</b>? Esta acción será permantente.',
            'warning'
        );
    }

    render() {
        this.rolSelect.init();
        this.sellosSelect.init();
        this._toggleAltaEventos();

        if(this.deleteUserBtn) {
            this.deleteUserBtn.addEventListener('click', (e) => {

                e.preventDefault();
    
                this.deleteUserAlert.init().then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = this.deleteUserBtn.href;
                    }
                });
            });
        }
        
    }

    _toggleAltaEventos() {
        this.rolSelect.onChange((e) => {
             if (this.rolSelect.getValue() === config.usuario.altaEventosRol) {
                 this.altaEventosCheckbox.classList.remove('d-none');
             } else {
                 this.altaEventosCheckbox.classList.add('d-none');
             }
        });
    }
}

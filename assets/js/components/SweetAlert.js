import Swal from "sweetalert2";

export class SweetAlert {
    constructor(title, content, icon = null, extraOptions = {}) {
        this.options = {
            title,
            html: content,
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-default ml-2',
            },
            buttonsStyling: false
        }

        if (icon) {
            this.options.icon = icon;
        }

        this.options = { ...this.options, ...extraOptions };
    }

    init() {
        return Swal.fire(this.options);
    }

    close() {
        Swal.close();
    }
}

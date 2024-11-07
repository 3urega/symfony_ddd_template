import {Dropzone} from 'dropzone/dist/dropzone';

export class DropzoneInsideForm {
    /**
     * @param {string} elementId - The id of the div element.
     * @param {string} accept - File types accepted. By default 'image/*'.
     */
    constructor(elementId, accept = 'image/*') {
        this.elementId = elementId;
        this.files = [];

        this.options = {
            url: '/', //will not be used as we only want dropzone to get the files base64
            paramName: 'dropzone',
            uploadMultiple: true,
            autoProcessQueue: false,
            acceptedFiles: accept,
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar'
        }
    }

    init() {
        Dropzone.autoDiscover = false;
        this.dropzone = new Dropzone(`#${this.elementId}`, this.options);

        this.dropzone.on('addedfile', (file) => {
            const reader = new FileReader();
            reader.onload = (event) => {
                // event.target.result contains base64 encoded image
                this.files.push(event.target.result);
            };
            reader.readAsDataURL(file);
        });

        this.dropzone.on('removedfile', (file) => {
            const reader = new FileReader();
            reader.onload = (event) => {
                this.files = this.files.filter((file) => file !== event.target.result);
            };
            reader.readAsDataURL(file);
        });
    }

    getFiles() {
        return this.files;
    }
}

import 'summernote/dist/summernote-bs4';
import 'summernote/dist/lang/summernote-es-ES';

export class Summernote {
    /**
     * @param {string} textareaId - Id of the textarea to become summernote.
     * @param {boolean} images - Lets upload images with base64. Default false.
     * @param {boolean} videos - Lets add video links. Default false.
     * @param {int} height - Initial height of the element. Default 300.
     */
    constructor(textareaId, images = false, videos = false, height = 200) {
        this.textarea = document.getElementById(textareaId);

        const insert = ['link'];

        if (images) {
            insert.push('picture');
        }

        if (videos) {
            insert.push('video');
        }

        this.options = {
            height: height,
            placeholder: this.textarea.placeholder,
            lang: 'es-ES',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul','ol']],
                ['insert', insert]
            ],
            disableDragAndDrop: true,
            codeviewIframeFilter: true,
            dialogsInBody: true, //solves css bug between bootstrap, animate.css and summernote
            callbacks: {
                //evita que s'enganxi text amb format perque els estils no trenquin la web
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        }
    }

    init() {
        $(this.textarea).summernote(this.options);
    }

    disable() {
        $(this.textarea).summernote('disable');
    }

    destroy() {
        $(this.textarea).summernote('destroy');
    }
}

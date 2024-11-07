import 'daterangepicker/daterangepicker';

export class DateTimePicker {
    /**
     * @param {string} inputId - Id of the input to become daterangepicker.
     * @param {boolean} time - If set to true shows time selector. Default false.
     * @param {boolean} range - If set to true shows two related datepickers. Default false.
     */
    constructor(inputId, time = false, range = false) {
        this.inputId = inputId;
        this.input = document.getElementById(inputId);
        this.range = range;
        this.time = time;
        this.startDate = null;
        this.endDate = null;

        this.options = {
            opens: 'right',
            singleDatePicker: !range,
            autoUpdateInput: false,
            timePicker: time,
            timePicker24Hour: time,
            locale: {
                startDate : moment().format(time ? 'DD/MM/YYYY HH:mm' : 'DD/MM/YYYY'),
                format: time ? 'DD/MM/YYYY HH:mm' : 'DD/MM/YYYY',
                applyLabel: 'Guardar',
                cancelLabel: 'Limpiar',
                daysOfWeek: [
                    'Do',
                    'Lu',
                    'Ma',
                    'Mi',
                    'Ju',
                    'Vi',
                    'Sa'
                ],
                monthNames: [
                    'Enero',
                    'Febrero',
                    'Marzo',
                    'Abril',
                    'Mayo',
                    'Junio',
                    'Julio',
                    'Agosto',
                    'Septiembre',
                    'Octubre',
                    'Noviembre',
                    'Diciembre'
                ],
                firstDay: 1
            },
        }
    }

    init() {
        $(this.input).daterangepicker(this.options);
        $(this.input).on('cancel.daterangepicker', (ev, picker) => {
            $(this.input).val('');
        });
        $(this.input).on('apply.daterangepicker', (ev, picker) => {
            if (this.time) {
                this._setDateAndTime(ev, picker);
            } else {
                this._setDate(ev, picker);
            }
        });
    }

    _setDateAndTime(ev, picker) {
        let value = picker.startDate.format('DD/MM/YYYY HH:mm');
        this.startDate = picker.startDate.format('DD/MM/YYYY HH:mm');

        if (this.range) {
            value += ' - ' + picker.endDate.format('DD/MM/YYYY HH:mm');
            this.endDate = picker.endDate.format('DD/MM/YYYY HH:mm');
        }
        document.getElementById(this.inputId).setAttribute('value',value);
        this.input.value = value;
    }

    _setDate(ev, picker) {
        let value = picker.startDate.format('DD/MM/YYYY');
        this.startDate = picker.startDate.format('DD/MM/YYYY');

        if (this.range) {
            value += ' - ' + picker.endDate.format('DD/MM/YYYY');
            this.endDate = picker.endDate.format('DD/MM/YYYY');
        }
        document.getElementById(this.inputId).setAttribute('value',value);
        this.input.value = value;
    }

    /**
     * @param {callback} callback - Action done after apply daterangepicker.
     */
    onApply(callback) {
        $(this.input).on('apply.daterangepicker', callback);
    }

    /**
     * @param {callback} callback - Action done after cancel daterangepicker.
     */
    onCancel(callback) {
        $(this.input).on('cancel.daterangepicker', (ev, picker) => {
            $(this.input).val('');
            this.startDate = null;
            this.endDate = null;
            callback();
        });
    }

    clear() {
        $(this.input).daterangepicker(this.options).val('');
    }

    getStartDate() {
        return this.startDate;
    }

    getEndDate() {
        return this.endDate;
    }
}

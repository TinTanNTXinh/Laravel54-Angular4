interface IDatePicker {
    range_date: any[];

    datepickerSettings: any;
    timepickerSettings: any;
    datepicker_from: Date;
    datepicker_to: Date;
    datepickerToOpts: any;
    handleDateFromChange(dateFrom: Date): void;
    clearDate(event: any, field: string): void;
}

import {Injectable} from '@angular/core';

declare let util: any;
declare let moment: any;

@Injectable()
export class DateHelperService {

    constructor() {

    }

    public locale: string = "vi-VN";
    public locale_options: any = { day: "2-digit", month: "2-digit", year: "numeric" };
    public icon_calendar: string = "fa fa-calendar";

    public date_placeholder: string = "Chọn ngày";
    public datepickerSettings: any = {
        autoclose: true,
        todayBtn: 'linked',
        todayHighlight: true,
        icon: this.icon_calendar,
        placeholder: this.date_placeholder,
        format: 'dd/mm/yyyy'
    };

    public range_date: any[] = [
        {name: 'Không chọn', value: 'none'},
        {name: 'Hôm qua', value: 'yesterday'},
        {name: 'Hôm nay', value: 'today'},
        {name: 'Tuần này', value: 'week'},
        {name: 'Tháng này', value: 'month'},
        {name: 'Năm nay', value: 'year'}
    ];

    /** Date */
    public getDate(dt: Date): string {
        return dt.toLocaleDateString(this.locale, this.locale_options);
    }

    public createDate(str: string): Date {
        // Mask: dd/mm/YYYY;
        let day: number = Number(str.substr(0, 2));
        let month = Number(str.substr(3, 2));
        let year = Number(str.substr(6, 4));
        return new Date(year, month - 1, day);
    }

    public renderDateTimePicker(ids: string[], format_code: string = 'DD/MM/YYYY'): void {
        util.renderDateTimePicker(ids, format_code);
    }

    /** MomentJS */
    public parseMoment(d: string, f: string) {
        let m = moment(d, f);
        if (m.isValid()) return m;
        return null;
    }

    public isBefore(d1: string, fd1: string, d2: string, fd2: string): boolean {
        let m1 = moment(d1, fd1);
        let m2 = moment(d2, fd2);
        if (m1.isValid() && m2.isValid())
            return m1.isBefore(m2);
        return null;
    }

    public isSame(d1: string, fd1: string, d2: string, fd2: string): void {
        let m1 = moment(d1, fd1);
        let m2 = moment(d2, fd2);
        if (m1.isValid() && m2.isValid())
            return m1.isSame(m2);
        return null;
    }

    public isAfter(d1: string, fd1: string, d2: string, fd2: string): void {
        let m1 = moment(d1, fd1);
        let m2 = moment(d2, fd2);
        if (m1.isValid() && m2.isValid())
            return m1.isAfter(m2);
        return null;
    }

    public isSameOrBefore(d1: string, fd1: string, d2: string, fd2: string): void {
        let m1 = moment(d1, fd1);
        let m2 = moment(d2, fd2);
        if (m1.isValid() && m2.isValid())
            return m1.isSameOrBefore(m2);
        return null;
    }

    public isSameOrAfter(d1: string, fd1: string, d2: string, fd2: string): void {
        let m1 = moment(d1, fd1);
        let m2 = moment(d2, fd2);
        if (m1.isValid() && m2.isValid())
            return m1.isSameOrAfter(m2);
        return null;
    }

    public isBetween(d1: string, fd1: string, d2: string, fd2: string, d3: string, fd3: string): void {
        let m1 = moment(d1, fd1);
        let m2 = moment(d2, fd2);
        let m3 = moment(d3, fd3);
        if (m1.isValid() && m2.isValid() && m3.isValid())
            return m1.isBetween(m2, m3, null, []);
        return null;
    }
}

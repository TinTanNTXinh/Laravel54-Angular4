import {Component, OnInit} from '@angular/core';

@Component({
    selector: 'month-picker',
    templateUrl: './month-picker.component.html'
})

export class MonthPicker implements OnInit {

    private mm: any;

    public months: any[] = [
        {val: '01', name: 'Tháng 1'},
        {val: '02', name: 'Tháng 2'},
        {val: '03', name: 'Tháng 3'},
        {val: '04', name: 'Tháng 4'},
        {val: '05', name: 'Tháng 5'},
        {val: '06', name: 'Tháng 6'},
        {val: '07', name: 'Tháng 7'},
        {val: '08', name: 'Tháng 8'},
        {val: '09', name: 'Tháng 9'},
        {val: '10', name: 'Tháng 10'},
        {val: '11', name: 'Tháng 11'},
        {val: '12', name: 'Tháng 12'}
    ];

    ngOnInit() {
        this.getMonth();
    }

    private getMonth(): void {
        let today = new Date();
        this.mm = today.getMonth() + 1;
        if (this.mm < 10) {
            this.mm = '0' + this.mm
        }
    }
}
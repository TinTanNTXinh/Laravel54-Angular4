import { Component, OnInit } from '@angular/core';

@Component({
    selector: 'year-picker',
    templateUrl: './year-picker.component.html'
})

export class YearPicker implements OnInit {

    public years: number[] =[];
    private yy : number;

    ngOnInit() {
        this.getYear();
    }

    getYear(){
        let today = new Date();
        this.yy = today.getFullYear();
        for(let i = (this.yy-10); i <= this.yy; i++){
            this.years.push(i);}
    }


}
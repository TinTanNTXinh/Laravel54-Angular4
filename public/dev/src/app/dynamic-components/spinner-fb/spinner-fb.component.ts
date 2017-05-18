import {Component, OnInit, Input} from '@angular/core';

@Component({
    selector: 'spinner-fb',
    templateUrl: 'spinner-fb.component.html',
    styleUrls: ['spinner-fb.component.css']
})
export class SpinnerFbComponent implements OnInit {
    public spinnerIsLoading: boolean;

    constructor() {

    }

    ngOnInit() {

    }

    @Input() get isLoading(): boolean {
        return this.spinnerIsLoading;
    }

    set isLoading(obj: boolean) {
        this.spinnerIsLoading = obj;
    }

}
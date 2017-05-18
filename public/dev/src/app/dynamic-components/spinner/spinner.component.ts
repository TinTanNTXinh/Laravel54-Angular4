import {Component, OnInit, Input} from '@angular/core';

@Component({
    selector: 'spinner',
    templateUrl: 'spinner.component.html',
    styleUrls: ['spinner.component.css']
})
export class SpinnerComponent implements OnInit {
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
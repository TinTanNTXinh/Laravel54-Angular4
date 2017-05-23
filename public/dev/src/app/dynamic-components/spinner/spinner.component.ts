import {Component, OnInit, Input} from '@angular/core';

@Component({
    selector: 'spinner',
    templateUrl: 'spinner.component.html',
    styleUrls: ['spinner.component.css']
})
export class SpinnerComponent implements OnInit {

    constructor() {

    }

    ngOnInit() {

    }

    @Input() isLoading: boolean = false;

}
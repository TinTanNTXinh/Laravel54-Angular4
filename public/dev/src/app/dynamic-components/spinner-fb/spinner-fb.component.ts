import {Component, OnInit, Input} from '@angular/core';

@Component({
    selector: 'spinner-fb',
    templateUrl: 'spinner-fb.component.html',
    styleUrls: ['spinner-fb.component.css']
})
export class SpinnerFbComponent implements OnInit {

    constructor() {

    }

    ngOnInit() {

    }

    @Input() isLoading: boolean = false;

}
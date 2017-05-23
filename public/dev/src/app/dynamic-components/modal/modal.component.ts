import {Component, OnInit, Input, Output, EventEmitter} from '@angular/core';

@Component({
    selector: 'modal',
    templateUrl: 'modal.component.html'
})
export class ModalComponent implements OnInit {

    constructor() {

    }

    ngOnInit() {

    }

    @Input() objectData: any = {};

    @Output() onClicked: EventEmitter<number> = new EventEmitter();

    public clicked(id: number): void {
        this.onClicked.emit(id);
    }
}
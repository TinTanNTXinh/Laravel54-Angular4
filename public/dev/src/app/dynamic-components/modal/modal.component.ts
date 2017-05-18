import {Component, OnInit, Input, Output, EventEmitter} from '@angular/core';

@Component({
    selector: 'modal',
    templateUrl: 'modal.component.html'
})
export class ModalComponent implements OnInit {
    public modalObjectData: any;

    constructor() {

    }

    ngOnInit() {

    }

    @Input() get objectData(): any {
        return this.modalObjectData;
    }

    set objectData(obj: any) {
        this.modalObjectData = obj;
    }

    @Output() onClicked: EventEmitter<number> = new EventEmitter();

    clicked(id: number, event?: Event) {
        if (event) {
            event.preventDefault();
        }
        this.onClicked.emit(id);
    }


}
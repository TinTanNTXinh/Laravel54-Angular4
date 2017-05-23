import {Component, OnInit, Input, Output, EventEmitter} from '@angular/core';

@Component({
    selector: 'counter',
    templateUrl: 'counter.component.html'
})
export class CounterComponent implements OnInit {

    /** Variables */
    private counterValue = 0;

    constructor() {
    }

    ngOnInit() {
    }

    @Input()
    get counter() {
        return this.counterValue;
    }

    @Output() counterChange = new EventEmitter();

    set counter(val) {
        this.counterValue = val;
        this.counterChange.emit(this.counterValue);
    }

    @Input() readonly: boolean = false;

    @Output() onInputed: EventEmitter<number> = new EventEmitter();

    public inputed(event: any) {
        this.onInputed.emit(this.counter);
    }

    public increase(): void {
        this.counter++;
    }

    public decrement(): void {
        this.counter--;
    }
}
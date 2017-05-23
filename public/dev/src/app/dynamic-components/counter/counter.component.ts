import {Component, OnInit, Input, Output, EventEmitter, forwardRef} from '@angular/core';
import {ControlValueAccessor, NG_VALUE_ACCESSOR} from '@angular/forms';

@Component({
    selector: 'counter',
    templateUrl: 'counter.component.html',
    providers: [
        {
            provide: NG_VALUE_ACCESSOR,
            useExisting: forwardRef(() => CounterComponent),
            multi: true
        }
    ]
})
export class CounterComponent implements OnInit, ControlValueAccessor {

    /** NgModel */
    @Input('value') _value: any = null;
    onChange: any = () => {
    };
    onTouched: any = () => {
    };

    get value() {
        return this._value;
    }

    set value(val) {
        this._value = val;
        this.onChange(val);
        this.onTouched();
    }

    registerOnChange(fn) {
        this.onChange = fn;
    }

    registerOnTouched(fn) {
        this.onTouched = fn;
    }

    writeValue(value) {
        if (value) {
            this._value = value;
        }
    }

    /** Variables */

    constructor() {
    }

    ngOnInit() {
    }

    @Input() readonly: boolean = false;

    @Output() onInputed: EventEmitter<number> = new EventEmitter();

    public inputed(event: any) {
        this.onInputed.emit(this.value);
    }

    public increase(): void {
        this.value++;
    }

    public decrement(): void {
        this.value--;
    }
}
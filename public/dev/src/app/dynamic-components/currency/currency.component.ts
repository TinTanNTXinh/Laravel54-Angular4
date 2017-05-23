import {Component, OnInit, Input, Output, EventEmitter, forwardRef} from '@angular/core';
import {ControlValueAccessor, NG_VALUE_ACCESSOR} from '@angular/forms';

import {CurrencyHelperService} from '../../services/helpers/currency.helper';
import {NumberHelperService} from '../../services/helpers/number.helper';

@Component({
    selector: 'currency',
    templateUrl: 'currency.component.html',
    providers: [
        {
            provide: NG_VALUE_ACCESSOR,
            useExisting: forwardRef(() => CurrencyComponent),
            multi: true
        }
    ]
})
export class CurrencyComponent implements OnInit, ControlValueAccessor {

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
    public currencyStringData: string;
    private currencyNumberData: number;

    constructor(private currencyHelperService: CurrencyHelperService
        , private numberHelperService: NumberHelperService) {
    }

    ngOnInit() {
    }

    @Input() readonly: boolean = false;
    @Input() suffix: string = this.currencyHelperService.currency_signal;

    @Input() get numberData(): number {
        this.currencyStringData = this.numberHelperService.formatThousandsSeparator(this.currencyNumberData.toString());
        return this.currencyNumberData;
    }

    set numberData(money: number) {
        this.currencyNumberData = money;
        this.currencyStringData = this.numberHelperService.formatThousandsSeparator(this.currencyNumberData.toString());
    }

    @Output() onInputed: EventEmitter<number> = new EventEmitter();

    inputed(event: any) {
        this.currencyStringData = this.numberHelperService.formatThousandsSeparator(event);
        this.currencyNumberData = this.numberHelperService.convertToNumber(this.currencyStringData);
        this.value = this.currencyNumberData;
        this.onInputed.emit(this.currencyNumberData);
    }
}
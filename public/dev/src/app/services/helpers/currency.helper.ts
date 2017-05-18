import {Injectable} from '@angular/core';

@Injectable()
export class CurrencyHelperService {
    public currency_signal: string;

    constructor() {
        this.currency_signal = 'đ';
    }
}

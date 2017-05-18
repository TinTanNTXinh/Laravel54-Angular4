import {Injectable} from '@angular/core';

@Injectable()
export class NumberHelperService {
    constructor() {

    }

    public formatThousandsSeparator(str: string): string {
        str = str.replace(/[A-Za-z]/g, '');
        return Number(str.replace(new RegExp(',', "g"), "")).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    public convertToNumber(str: string): number {
        str = str.replace(/[A-Za-z]/g, '');
        return Number(str.replace(new RegExp(',', "g"), ""));
    }
}

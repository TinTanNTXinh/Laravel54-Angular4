import {Injectable} from '@angular/core';

import {StringHelperService} from './string.helper';
import {CommonHelperService} from './common.helper';

declare let $: any;

@Injectable()
export class ArrayHelperService {
    constructor(private stringHelperService: StringHelperService
        , private commonHelperService: CommonHelperService) {

    }

    /** Array */
    public sortByNumber(arr, attr) {
        arr.sort(function (a, b) {
            return a[attr] - b[attr];
        });
        return arr;
    }

    public sortByString(arr, attr) {
        arr.sort(function(a, b) {
            let nameA = a[attr].toUpperCase(); // ignore upper and lowercase
            let nameB = b[attr].toUpperCase(); // ignore upper and lowercase
            if (nameA < nameB) {
                return -1;
            }
            if (nameA > nameB) {
                return 1;
            }
            // names must be equal
            return 0;
        });
        return arr;
    }

    public searchArray(arr, query, field_name = 'name') {
        let _this = this;
        return $.grep(arr, function(value) {
            let item: string = _this.stringHelperService.removeDiacritics(value[field_name]).toLowerCase().trim();
            let find: string = _this.stringHelperService.removeDiacritics(query).toLowerCase().trim();
            return item.indexOf(find) >= 0;
        });
    }

    public chunkArray(myArray, chunk_size){
        let clone = this.commonHelperService.cloneObject(myArray);

        let results = [];

        while (clone.length) {
            results.push(clone.splice(0, chunk_size));
        }

        return results;
    }
}

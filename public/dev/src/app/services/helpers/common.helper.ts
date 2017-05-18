import {Injectable} from '@angular/core';

@Injectable()
export class CommonHelperService {
    constructor() {

    }

    /** Common */
    public cloneObject(obj): any {
        return JSON.parse(JSON.stringify(obj));
    }
}

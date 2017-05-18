import {Injectable} from '@angular/core';

import * as FileSaver from "file-saver";

@Injectable()
export class FileHelperService {
    constructor() {

    }

    /** File */
    public downloadFile(content, file_name, media_type): void {
        let blob = new Blob([content], { type: media_type });
        FileSaver.saveAs(blob, file_name);
    }
}

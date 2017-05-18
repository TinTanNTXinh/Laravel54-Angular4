import {Injectable} from '@angular/core';

@Injectable()
export class DeviceCaptionService {

    public cabinet: string;
    public tray: string;
    public rfid: string;
    public card: string;
    public cdm: string;

    constructor() {
        this.cabinet = 'Tủ';
        this.tray = 'Box';
        this.rfid = 'Máy đọc thẻ';
        this.card = 'Thẻ';
        this.cdm = 'Máy nạp tiền';
    }
}

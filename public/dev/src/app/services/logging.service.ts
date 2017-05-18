import { Injectable } from '@angular/core';

@Injectable()
export class LoggingService {
    private env: string;

    constructor() {
        let config: any = this.getConfig();
        this.env = config.env;
    }

    public consoleLog(data: any, color?: string): void {
        if(this.env === 'dev')
            console.log(data, color);
    }

    public consoleTable(data: any[]): void {
        if(this.env === 'dev')
            console.table(data);
    }

    public consoleInfo(data: any): void {
        if(this.env === 'dev')
            console.info(data);
    }

    public consoleError(data: any): void {
        if(this.env === 'dev')
            console.error(data);
    }

    private getConfig(): any {
        // Pure Ajax
        let config;
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                config = JSON.parse(this.responseText);
            }
        };
        xhttp.open("GET", "./assets/config/app.config.json", false);
        xhttp.send();
        return config;
    }
}
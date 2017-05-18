import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';

@Component({
    selector: 'app-footer',
    templateUrl: './footer.component.html'
})
export class FooterComponent implements OnInit {

    public version: string;

    constructor(private httpClientService: HttpClientService) {
    }

    ngOnInit() {
        this.getConfig();
    }

    private getConfig(): void {
        this.httpClientService.pureGet('./assets/config/app.config.json').subscribe(
            (success: any) => {
                let config = success;
                this.version = config.version;
            },
            (error: any) => {

            }
        );
    }
}

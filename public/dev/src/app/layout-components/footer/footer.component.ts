import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';

@Component({
    selector: 'app-footer',
    templateUrl: './footer.component.html'
})
export class FooterComponent implements OnInit {

    public version: string;

    constructor(private httpClientService: HttpClientService) {
        this.version = this.httpClientService.getConfig().version;
    }

    ngOnInit() {
    }
}

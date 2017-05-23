import {Injectable} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';

@Injectable()
export class TransportService {

    public prefix_url: string;

    constructor(private httpClientService: HttpClientService
        , private toastrHelperService: ToastrHelperService) {
    }

    public loadAll(): any {
        this.httpClientService.get(this.prefix_url).subscribe(
            (success: any) => {
                return success;
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
                return error;
            }
        );
    }
}
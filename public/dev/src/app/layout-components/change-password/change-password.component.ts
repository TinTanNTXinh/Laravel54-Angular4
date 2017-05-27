import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';
import {AuthenticationService} from '../../services/authentication.service';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';

@Component({
    selector: 'app-change-password',
    templateUrl: './change-password.component.html'
})
export class ChangePasswordComponent implements OnInit {

    public data: any;

    constructor(private httpClientService: HttpClientService
        , private authenticationService: AuthenticationService
        , private toastrHelperService: ToastrHelperService) {
    }

    ngOnInit() {
        this.clear();
    }

    public changePassword() {
        this.httpClientService.post('users/change-password', {"data": this.data}).subscribe(
            (success: any) => {
                this.clear();
                this.toastrHelperService.showToastr('success', 'Thay đổi mật khẩu thành công. Vui lòng đăng nhập lại.');
                this.authenticationService.clearAuthLocalStorage();
                this.authenticationService.notifyAuthenticate(false);
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error', error['error']);
            }
        );
    }

    public clear() {
        this.data = {
            password: '',
            new_password: ''
        };
    }

}

import {Component, OnInit} from '@angular/core';
import {Router} from "@angular/router";
import {Subscription} from 'rxjs';

import {AuthenticationService} from '../../services/authentication.service';
import {HttpClientService} from '../../services/httpClient.service';
import {LoggingService} from '../../services/logging.service';

@Component({
    selector: 'app-aside',
    templateUrl: './aside.component.html'
})
export class AsideComponent implements OnInit {

    private roles: any = [];
    public fullname: string = '';
    public position_name: string = '';
    private _httpClientSubscription: Subscription;
    public user_image: string = '';

    public nav_lv0: string = 'Danh mục';
    public nav_lv1: string = 'Dữ liệu ban đầu';
    public nav_lv2: string = 'Cài đặt thiết bị';
    public nav_lv3: string = 'Báo cáo';

    constructor(private httpClientService: HttpClientService, private authenticationService: AuthenticationService, private router: Router, private loggingService: LoggingService) {
        this._httpClientSubscription = this.httpClientService.httpClient$.subscribe(
            status => {
                this.loggingService.consoleLog("%c Navigation", "background: green; color: white");
                this.loggingService.consoleLog(status);

                if (status) {
                    this.roles = this.authenticationService.authenticateRole;
                    this.fullname = this.authenticationService.authenticateUser.fullname;
                    this.position_name = this.authenticationService.authenticateUser.position_name;
                    this.user_image = this.authenticationService.authenticateUser.file_path;
                } else {
                    this.roles = [];
                    this.fullname = '';
                    this.position_name = '';
                    this.user_image = '';
                }

                this.loggingService.consoleTable(this.roles);
                this.loggingService.consoleLog("%c ----------", "background: green; color: white");
            }
        )
    }

    ngOnInit() {
    }

    public logOut(): void {
        this.authenticationService.clearAuthLocalStorage();
        this.authenticationService.notifyAuthenticate(false);
        this.router.navigate(['/login']);
    }

    /**
     * slice roles with group_role_id
     */
    public sliceRoles(group_role_id: number) {
        return this.roles.filter(function (o) {
            return o['group_role_id'] == group_role_id;
        });
    }

}

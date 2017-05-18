import {Component, OnInit} from '@angular/core';
import {Router} from "@angular/router";

import {AuthenticationService} from '../../services/authentication.service';
import {HttpClientService} from '../../services/httpClient.service';
import {LoggingService} from '../../services/logging.service';
import {Subscription} from 'rxjs';

@Component({
    selector: 'app-header',
    templateUrl: './header.component.html'
})
export class HeaderComponent implements OnInit {

    public fullname: string = '';
    public position_name: string = '';
    public supplier_name: string = '';
    public distributor_name: string = '';
    public user_image: string = '';
    private nav_is_full: boolean = true;
    private nav_have_not_user: boolean = true;
    private _httpClientSubscription: Subscription;

    constructor(private httpClientService: HttpClientService, private authenticationService: AuthenticationService, private router: Router, private loggingService: LoggingService) {
        this._httpClientSubscription = this.httpClientService.httpClient$.subscribe(
            status => {
                this.loggingService.consoleLog("%c Header", "background: yellow; color: lime");
                this.loggingService.consoleLog(status);

                if (status) {
                    this.fullname = this.authenticationService.authenticateUser.fullname;
                    this.position_name = this.authenticationService.authenticateUser.position_name;
                    this.supplier_name = this.authenticationService.authenticateUser.supplier_name;
                    this.distributor_name = this.authenticationService.authenticateUser.distributor_name;
                    this.user_image = this.authenticationService.authenticateUser.file_path;
                } else {
                    this.fullname = '';
                    this.position_name = '';
                    this.supplier_name = '';
                    this.distributor_name = '';
                    this.user_image = '';
                }

                this.loggingService.consoleLog(this.fullname);
                this.loggingService.consoleLog("%c ----------", "background: yellow; color: lime");
            }
        );
    }

    ngOnInit() {
        this.displayItemOnNav();
    }

    public logOut(): void {
        this.authenticationService.clearAuthLocalStorage();
        this.authenticationService.notifyAuthenticate(false);
        this.router.navigate(['/login']);
    }

    public changeDisplayNav(): void {
        this.nav_is_full = !this.nav_is_full;
        localStorage.setItem('nav_is_full', this.nav_is_full.toString());
    }

    public displayItemOnNav(): void {
        if (this.router.url == '/login') return;

        let statusNavFull: string = localStorage.getItem('nav_is_full');
        if (statusNavFull != null)
            if (statusNavFull == 'false') {
                if (!document.getElementById('display-nav')) return;
                document.getElementById('display-nav').click();
            }

        let statusNavUser: string = localStorage.getItem('nav_have_not_user');
        if (statusNavUser != null)
            if (statusNavUser == 'false') {
                if (!document.getElementById('display-user')) return;
                document.getElementById('display-user').click();
            }
    }

    public changeDisplayUser(): void {
        this.nav_have_not_user = !this.nav_have_not_user;
        localStorage.setItem('nav_have_not_user', this.nav_have_not_user.toString());
    }

}

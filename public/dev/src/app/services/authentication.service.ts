import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';
import {LoggingService} from './logging.service';
import {Router} from "@angular/router";

@Injectable()
export class AuthenticationService {

    public authenticate = new BehaviorSubject<Boolean>(false);
    public authenticate$ = this.authenticate.asObservable();
    public authenticateRole: any[] = [];
    public authenticateGroupRole: any[] = [];
    public authenticateUser: any = null;
    public authenticateToken: string;

    constructor(private loggingService: LoggingService
        , private router: Router) {
        this.checkAuthLocalStorage();
    }

    checkAuthLocalStorage(): void {
        try {
            this.loggingService.consoleLog("%c AuthenticationService", "color: red");
            if (localStorage.getItem('_token')) {
                this.loggingService.consoleLog("%c Đã có token trong localStorage", "color:red");
                /* GET AUTH FROM LOCAL STORAGE */
                this.getAuthLocalStorage();
                /* NOTIFY */
                this.notifyAuthenticate(true);
            } else {
                this.loggingService.consoleLog("%c Không có token trong localStorage", "color:red");
                this.clearAuthLocalStorage();
                /* NOTIFY */
                this.notifyAuthenticate(false);
            }
            this.loggingService.consoleLog("%c ------------------------------", "color:red");
        } catch (exception) {
            /* CLEAR AUTH IN LOCAL STORAGE */
            this.clearAuthLocalStorage();
            /* NOTIFY */
            this.notifyAuthenticate(false);
        }
    }

    getAuthLocalStorage(): void {
        /* GET TOKEN */
        this.authenticateToken = localStorage.getItem('_token');
    }

    createAuthLocalStorage(): void {
        /* CLEAR LOCAL STORAGE */
        this.clearAuthLocalStorage();
        /* CREATE TOKEN */
        localStorage.setItem('_token', this.authenticateToken);
    }

    clearAuthLocalStorage(): void {
        /* REMOVE TOKEN */
        localStorage.removeItem('_token');
    }

    notifyAuthenticate(status: Boolean): void {
        this.authenticate.next(status);
    }

    public logOut(): void {
        this.clearAuthLocalStorage();
        this.notifyAuthenticate(false);
        this.router.navigate(['/login']);
    }

}
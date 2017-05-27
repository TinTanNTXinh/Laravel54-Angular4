import {Component, OnInit} from '@angular/core';
import {Router, NavigationStart} from '@angular/router';
import {Subscription} from 'rxjs';

import {AuthenticationService} from './services/authentication.service';
import {LoggingService} from './services/logging.service';

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html'
})
export class AppComponent implements OnInit {

    private authenticate: boolean = false;
    private _authSubscription: Subscription;

    constructor(private router: Router
        , private authenticationService: AuthenticationService
        , private loggingService: LoggingService) {
        this._authSubscription = this.authenticationService.authenticate$.subscribe(
            status => {
                this.loggingService.consoleLog("%c AppComponent", "color: blue");
                this.loggingService.consoleLog(status);
                this.loggingService.consoleLog("%c ------------", "color: blue");
                this.authenticate = Boolean(status);
                if (!status) {
                    router.navigate(['/login']);
                }
            }
        );

        router.events.subscribe(
            event => {
                if (event instanceof NavigationStart) {
                    if (event.url == '/login') {
                        if (this.authenticate) {
                            this.router.navigate(['/dashboards']);
                        }
                    } else {
                        if (!this.authenticate) {
                            this.router.navigate(['/login']);
                        }
                    }
                }
                // NavigationEnd
                // NavigationCancel
                // NavigationError
                // RoutesRecognized
            }
        )
    }

    ngOnInit() {
    }

    public displayLayout(): boolean {
        return !(this.router.url == '/login');
    }

}

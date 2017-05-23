import {Injectable} from "@angular/core";
import {Http, Headers, Response} from "@angular/http";
import {Subscription, Observable} from "rxjs";
import {BehaviorSubject} from 'rxjs/BehaviorSubject';

import {AuthenticationService} from "./authentication.service";
import {LoggingService} from "./logging.service";
import {Router} from "@angular/router";
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class HttpClientService {
    private _headers: Headers = new Headers();
    private _authSubscription: Subscription;

    public httpClient = new BehaviorSubject<Boolean>(false);
    public httpClient$ = this.httpClient.asObservable();

    private apiHost: string = '';
    private apiUrl: string = '';
    private apiVersion: string = '';

    constructor(private http: Http, private authenticationService: AuthenticationService, private router: Router, private loggingService: LoggingService) {
        let config: any = this.getConfig();
        this.apiHost = config.apiHost;
        this.apiUrl = config.apiUrl;
        this.apiVersion = config.apiVersion;

        this._authSubscription = authenticationService.authenticate$.subscribe(
            status => {
                this.loggingService.consoleLog("%c HttpClientService", "color: green");
                this.loggingService.consoleLog(status);
                if (status) {
                    this.createHeader();
                    this.loggingService.consoleLog("%c Tạo header", "color: green");
                    this.loggingService.consoleLog("%c Role", "color: green");
                    this.loggingService.consoleTable(authenticationService.authenticateRole);
                    this.loggingService.consoleLog("%c User", "color: green");
                    this.loggingService.consoleLog(authenticationService.authenticateUser);
                    this.get('authorization').subscribe(
                        (success: any) => {
                            /* SAVE USER */
                            authenticationService.authenticateUser = success['user'];

                            /* SAVE ROLE */
                            let array_role = success['roles'];
                            authenticationService.authenticateRole = [];
                            for (let i = 0; i < array_role.length; i++) {
                                authenticationService.authenticateRole.push(array_role[i]);
                            }

                            /* SAVE GROUP ROLE */
                            let array_group_role = success['group_roles'];
                            authenticationService.authenticateGroupRole = [];
                            for (let i = 0; i < array_group_role.length; i++) {
                                authenticationService.authenticateGroupRole.push(array_group_role[i]);
                            }

                            /* SAVE AUTH */
                            authenticationService.createAuthLocalStorage();
                            // this.authenticationService.notifyAuthenticate(true);

                            this.notifyHttpClient(true);

                            this.loggingService.consoleLog("%c Role", "color: green");
                            this.loggingService.consoleTable(authenticationService.authenticateRole);
                            this.loggingService.consoleLog("%c User", "color: green");
                            this.loggingService.consoleLog(authenticationService.authenticateUser);

                            this.loggingService.consoleLog("%c Current URL: " + router.url, "color: yellow; background: black");
                            this.loggingService.consoleLog("%c -----------------", "color: green");
                            router.navigate([router.url]);
                        },
                        (error: any) => {
                            authenticationService.clearAuthLocalStorage();
                            authenticationService.notifyAuthenticate(false);
                            this.notifyHttpClient(false);
                        }
                    );
                } else {
                    this.removeHeader();
                    this.notifyHttpClient(false);
                }
            }
        );
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

        // Promise
        // return this.http.get('./assets/config/app.config.json')
        //     .toPromise()
        //     .then(res => {return res.json();})
        //     .then(data => {return data;})
        //     .then(config => {
        //         this.apiHost = config.apiHost;
        //         this.apiUrl = config.apiUrl;
        //         this.apiVersion = config.apiVersion;
        //     });

        // let config = this.getConfig();
        // config.then(() => {
        //
        // });

        // Rxjs
        // this.http.get('./assets/config/app.config.json')
        //     .subscribe(
        //         (success: Response) => {
        //             let config = success.json();
        //             this.apiHost = config.apiHost;
        //             this.apiUrl = config.apiUrl;
        //             this.apiVersion = config.apiVersion;
        //         },
        //         (error: Response) => {
        //
        //         }
        //     );
    }

    createHeader(): void {
        this._headers.delete('Authorization');
        this._headers.append('Authorization', 'Bearer ' + localStorage.getItem('_token'));
    }

    createHeaderFromToken(token: string): void {
        this._headers.delete('Authorization');
        this._headers.append('Authorization', 'Bearer ' + token);
    }

    removeHeader(): void {
        this._headers.delete('Authorization');
    }

    get(url: string, mode: string = 'json'): Observable<Response> {
        // toPromise().then(if status code = 401 redirect to login)
        return this.http.get(`${this.apiHost}/${this.apiUrl}/${this.apiVersion}/${url}`, {
            headers: this._headers
        })
            .map((res: Response) => {
                if(mode == 'json')
                    return res.json();
                else if(mode == 'text')
                    return res.text();
                else
                    return res;
            });
    }

    post(url: string, data: any): Observable<Response> {
        return this.http.post(`${this.apiHost}/${this.apiUrl}/${this.apiVersion}/${url}`, data, {
            headers: this._headers
        })
            .map((res: Response) => res.json());
    }

    put(url: string, data: any): Observable<Response> {
        return this.http.put(`${this.apiHost}/${this.apiUrl}/${this.apiVersion}/${url}`, data, {
            headers: this._headers
        })
            .map((res: Response) => res.json());
    }

    patch(url: string, data: any): Observable<Response> {
        return this.http.patch(`${this.apiHost}/${this.apiUrl}/${this.apiVersion}/${url}`, data, {
            headers: this._headers
        })
            .map((res: Response) => res.json());
    }

    delete(url: string): Observable<Response> {
        return this.http.delete(`${this.apiHost}/${this.apiUrl}/${this.apiVersion}/${url}`, {
            headers: this._headers
        })
            .map((res: Response) => res.json());
    }

    /** Pure HTTP Method */
    pureGet(url: string, mode: string = 'json'): Observable<Response> {
        return this.http.get(`${url}`, {
            headers: this._headers
        })
            .map((res: Response) => {
                if(mode == 'json')
                    return res.json();
                else if(mode == 'text')
                    return res.text();
                else
                    return res;
            });
    }

    purePost(url: string, data: any): Observable<Response> {
        return this.http.post(`${url}`, data, {
            headers: this._headers
        })
            .map((res: Response) => res.json());
    }

    purePut(url: string, data: any): Observable<Response> {
        return this.http.put(`${url}`, data, {
            headers: this._headers
        })
            .map((res: Response) => res.json());
    }

    purePatch(url: string, data: any): Observable<Response> {
        return this.http.patch(`${url}`, data, {
            headers: this._headers
        })
            .map((res: Response) => res.json());
    }

    pureDelete(url: string): Observable<Response> {
        return this.http.delete(`${url}`, {
            headers: this._headers
        })
            .map((res: Response) => res.json());
    }

    notifyHttpClient(status: Boolean): void {
        this.httpClient.next(status);
    }

    getDatasPage(url: string, page: number, pageSize: number): Observable<Response> {
        return this.http.get(`${this.apiHost}/${this.apiUrl}/${this.apiVersion}/${url}/page/${page}/${pageSize}`, {
            headers: this._headers
        });
    }

}
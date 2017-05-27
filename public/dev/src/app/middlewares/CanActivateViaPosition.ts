import {Injectable} from '@angular/core';
import {ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot} from "@angular/router";
import {Observable} from "rxjs";
import 'rxjs/add/operator/map';

import {AuthenticationService} from "../services/authentication.service";

@Injectable()
export class CanActivateViaPosition implements CanActivate {

    constructor(private authenticationService: AuthenticationService) {
    }

    canActivate(route: ActivatedRouteSnapshot,
                state: RouterStateSnapshot): Observable<boolean> | Promise<boolean> | boolean {
        return true;
    }
}
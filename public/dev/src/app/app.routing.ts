import {Routes, RouterModule} from '@angular/router';

// My share components
import {DashboardComponent} from './layout-components/dashboard/dashboard.component';
import {LoginComponent} from './layout-components/login/login.component';
import {ChangePasswordComponent} from './layout-components/change-password/change-password.component';

// My components
import {UserComponent} from './components/user/user.component';
import {PositionComponent} from './components/position/position.component';
import {PostageComponent} from './components/postage/postage.component';
import {TransportComponent} from './components/transport/transport.component';
import {LubeComponent} from './components/lube/lube.component';
import {OilComponent} from './components/oil/oil.component';
import {CustomerComponent} from './components/customer/customer.component';
import {DriverComponent} from './components/driver/driver.component';

// My middleware

const APP_ROUTES: Routes = [
    {path: '', redirectTo: 'dashboards', pathMatch: 'full'},
    {path: 'dashboards', component: DashboardComponent},
    {path: 'login', component: LoginComponent},
    {path: 'change-password', component: ChangePasswordComponent},
    {path: 'users', component: UserComponent},
    {path: 'positions', component: PositionComponent},
    {path: 'postages', component: PostageComponent},
    {path: 'transports', component: TransportComponent},
    {path: 'lubes', component: LubeComponent},
    {path: 'oils', component: OilComponent},
    {path: 'customers', component: CustomerComponent},
    {path: 'drivers', component: DriverComponent},
];

export const routing = RouterModule.forRoot(APP_ROUTES);

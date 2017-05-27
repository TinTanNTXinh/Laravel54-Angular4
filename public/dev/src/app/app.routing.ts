import {Routes, RouterModule} from '@angular/router';

// My share components
import {DashboardComponent} from './layout-components/dashboard/dashboard.component';
import {LoginComponent} from './layout-components/login/login.component';
import {ChangePasswordComponent} from './layout-components/change-password/change-password.component';

// My components
import {PositionComponent} from './components/position/position.component';
import {UserComponent} from './components/user/user.component';
import {CustomerComponent} from './components/customer/customer.component';
import {StaffCustomerComponent} from './components/staff-customer/staff-customer.component';
import {PostageComponent} from './components/postage/postage.component';
import {TransportComponent} from './components/transport/transport.component';
import {GarageComponent} from './components/garage/garage.component';
import {TruckComponent} from './components/truck/truck.component';
import {DriverComponent} from './components/driver/driver.component';
import {LubeComponent} from './components/lube/lube.component';
import {OilComponent} from './components/oil/oil.component';
import {CostOilComponent} from './components/cost-oil/cost-oil.component';
import {CostLubeComponent} from './components/cost-lube/cost-lube.component';
import {CostParkComponent} from './components/cost-park/cost-park.component';
import {CostOtherComponent} from './components/cost-other/cost-other.component';
import {InvoiceCustomerComponent} from './components/invoice-customer/invoice-customer.component';
import {InvoiceGarageComponent} from './components/invoice-garage/invoice-garage.component';

// My middleware

const APP_ROUTES: Routes = [
    {path: '', redirectTo: 'dashboards', pathMatch: 'full'},
    {path: 'dashboards', component: DashboardComponent},
    {path: 'login', component: LoginComponent},
    {path: 'change-password', component: ChangePasswordComponent},

    {path: 'positions', component: PositionComponent},
    {path: 'users', component: UserComponent},

    {path: 'customers', component: CustomerComponent},
    {path: 'staff-customers', component: StaffCustomerComponent},
    {path: 'postages', component: PostageComponent},
    {path: 'transports', component: TransportComponent},

    {path: 'garages', component: GarageComponent},
    {path: 'trucks', component: TruckComponent},
    {path: 'drivers', component: DriverComponent},

    {path: 'oils', component: OilComponent},
    {path: 'lubes', component: LubeComponent},

    {path: 'cost-oils', component: CostOilComponent},
    {path: 'cost-lubes', component: CostLubeComponent},
    {path: 'cost-parks', component: CostParkComponent},
    {path: 'cost-others', component: CostOtherComponent},
    //
    {path: 'invoice-customers', component: InvoiceCustomerComponent},
    {path: 'invoice-garages', component: InvoiceGarageComponent},
    //
    // {path: 'report-revenues', component: null},
    // {path: 'report-transports', component: null},
];

export const routing = RouterModule.forRoot(APP_ROUTES);

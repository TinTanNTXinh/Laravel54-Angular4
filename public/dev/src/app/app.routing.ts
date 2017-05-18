import {Routes, RouterModule} from '@angular/router';

// My share components
import {DashboardComponent} from './layout-components/dashboard/dashboard.component';
import {LoginComponent} from './layout-components/login/login.component';
import {ChangePasswordComponent} from './layout-components/change-password/change-password.component';

// My components
import {IOCenterComponent} from './components/io-center/io-center.component';
import {CollectionComponent} from './components/collection/collection.component';
import {DeviceComponent} from './components/device/device.component';
import {ProducerComponent} from './components/producer/producer.component';
import {SupplierComponent} from './components/supplier/supplier.component';
import {DistributorComponent} from './components/distributor/distributor.component';
import {UserComponent} from './components/user/user.component';
import {ProductComponent} from './components/product/product.component';
import {ProductTypeComponent} from './components/product-type/product-type.component';
import {UnitComponent} from './components/unit/unit.component';
import {PositionComponent} from './components/position/position.component';
import {ButtonProductComponent} from './components/button-product/button-product.component';
import {UserCardComponent} from './components/user-card/user-card.component';
import {ReportSupplierComponent} from './components/report-supplier/report-supplier.component';
import {ReportDistributorComponent} from './components/report-distributor/report-distributor.component';
import {ReportStaffInputComponent} from './components/report-staff-input/report-staff-input.component';
import {ReportStaffOutputComponent} from './components/report-staff-output/report-staff-output.component';
import {ReportVsysComponent} from './components/report-vsys/report-vsys.component';
import {ReportLoggingComponent} from './components/report-logging/report-logging.component';

// My middleware

const APP_ROUTES: Routes = [
    {path: '', redirectTo: 'dashboards', pathMatch: 'full'},
    {path: 'dashboards', component: DashboardComponent},
    {path: 'login', component: LoginComponent},
    {path: 'change-password', component: ChangePasswordComponent},
    {path: 'io-centers', component: IOCenterComponent},
    {path: 'collections', component: CollectionComponent},
    {path: 'devices', component: DeviceComponent},
    {path: 'producers', component: ProducerComponent},
    {path: 'suppliers', component: SupplierComponent},
    {path: 'distributors', component: DistributorComponent},
    {path: 'users', component: UserComponent},
    {path: 'products', component: ProductComponent},
    {path: 'product-types', component: ProductTypeComponent},
    {path: 'units', component: UnitComponent},
    {path: 'positions', component: PositionComponent},
    {path: 'button-products', component: ButtonProductComponent},
    {path: 'user-cards', component: UserCardComponent},
    {path: 'report-suppliers', component: ReportSupplierComponent},
    {path: 'report-distributors', component: ReportDistributorComponent},
    {path: 'report-staff-inputs', component: ReportStaffInputComponent},
    {path: 'report-staff-outputs', component: ReportStaffOutputComponent},
    {path: 'report-vsyss', component: ReportVsysComponent},
    {path: 'report-loggings', component: ReportLoggingComponent}
];

export const routing = RouterModule.forRoot(APP_ROUTES);

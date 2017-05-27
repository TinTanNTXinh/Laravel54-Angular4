import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

// 3rd libraries
import {NKDatetimeModule} from 'ng2-datetime/ng2-datetime';

// My libraries
import {ModalComponent} from './dynamic-components/modal/modal.component';
import {CurrencyComponent} from './dynamic-components/currency/currency.component';
import {SpinnerComponent} from './dynamic-components/spinner/spinner.component';
import {SpinnerFbComponent} from './dynamic-components/spinner-fb/spinner-fb.component';
import {AutoCompleteComponent} from './dynamic-components/autocomplete/autocomplete.component';
import {XAutoCompleteComponent} from './dynamic-components/xautocomplete/xautocomplete.component';
import {XDatatableComponent} from './dynamic-components/xdatatable/xdatatable.component';
import {ObjNgFor} from './pipes/objngfor.pipe';
import {SafeHtmlPipe} from './pipes/safe-html.pipe';
import {SafeDomPipe} from './pipes/safe-dom.pipe';
import {MonthPicker} from './dynamic-components/month-picker/month-picker.component';
import {YearPicker} from './dynamic-components/year-picker/year-picker.component';
import {XPaginationComponent} from './dynamic-components/xpagination/xpagination.component';
import {MasterDetailComponent} from './dynamic-components/master-detail/master-detail.component';
import {CounterComponent} from './dynamic-components/counter/counter.component';

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

import {FormulaComponent} from './components/postage/formula.component';
import {FormulaTransportComponent} from './components/transport/formula-transport.component';
import {VoucherComponent} from './components/voucher/voucher.component';

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        ReactiveFormsModule,

        NKDatetimeModule,
    ],
    declarations: [
        ModalComponent,
        CurrencyComponent,
        SpinnerComponent,
        SpinnerFbComponent,
        AutoCompleteComponent,
        XAutoCompleteComponent,
        XDatatableComponent,
        ObjNgFor,
        SafeHtmlPipe,
        SafeDomPipe,
        MonthPicker,
        YearPicker,
        XPaginationComponent,
        MasterDetailComponent,
        CounterComponent,

        PositionComponent,
        UserComponent,
        CustomerComponent,
        StaffCustomerComponent,
        PostageComponent,
        TransportComponent,
        GarageComponent,
        TruckComponent,
        DriverComponent,
        LubeComponent,
        OilComponent,
        CostOilComponent,
        CostLubeComponent,
        CostParkComponent,
        CostOtherComponent,
        InvoiceCustomerComponent,
        InvoiceGarageComponent,
        FormulaComponent,
        FormulaTransportComponent,
        VoucherComponent,
    ],
    exports: [
        CommonModule,
        FormsModule,
        ReactiveFormsModule,

        NKDatetimeModule,

        ModalComponent,
        CurrencyComponent,
        SpinnerComponent,
        SpinnerFbComponent,
        AutoCompleteComponent,
        XAutoCompleteComponent,
        XDatatableComponent,
        ObjNgFor,
        SafeHtmlPipe,
        SafeDomPipe,
        MonthPicker,
        YearPicker,
        XPaginationComponent,
        MasterDetailComponent,
        CounterComponent,

        PositionComponent,
        UserComponent,
        CustomerComponent,
        StaffCustomerComponent,
        PostageComponent,
        TransportComponent,
        GarageComponent,
        TruckComponent,
        DriverComponent,
        LubeComponent,
        OilComponent,
        CostOilComponent,
        CostLubeComponent,
        CostParkComponent,
        CostOtherComponent,
        InvoiceCustomerComponent,
        InvoiceGarageComponent,
        FormulaComponent,
        FormulaTransportComponent,
        VoucherComponent,
    ]
})
export class SharedModule {
}

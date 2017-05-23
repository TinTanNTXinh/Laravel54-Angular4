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
import {XDatatableComponent} from './dynamic-components/xdatatable/xdatatable.component';
import {ObjNgFor} from './pipes/objngfor.pipe';
import {SafeHtmlPipe} from './pipes/safe-html.pipe';
import {MonthPicker} from './dynamic-components/month-picker/month-picker.component';
import {YearPicker} from './dynamic-components/year-picker/year-picker.component';
import {XPaginationComponent} from './dynamic-components/xpagination/xpagination.component';
import {MasterDetailComponent} from './dynamic-components/master-detail/master-detail.component';
import {CounterComponent} from './dynamic-components/counter/counter.component';

// My components
import {PositionComponent} from './components/position/position.component';
import {UserComponent} from './components/user/user.component';
import {PostageComponent} from './components/postage/postage.component';
import {TransportComponent} from './components/transport/transport.component';
import {FormulaComponent} from './components/postage/formula.component';
import {FormulaTransportComponent} from './components/transport/formula-transport.component';
import {LubeComponent} from './components/lube/lube.component';
import {OilComponent} from './components/oil/oil.component';
import {CustomerComponent} from './components/customer/customer.component';
import {DriverComponent} from './components/driver/driver.component';

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
        XDatatableComponent,
        ObjNgFor,
        SafeHtmlPipe,
        MonthPicker,
        YearPicker,
        XPaginationComponent,
        MasterDetailComponent,
        CounterComponent,

        PositionComponent,
        UserComponent,
        PostageComponent,
        TransportComponent,
        FormulaComponent,
        FormulaTransportComponent,
        LubeComponent,
        OilComponent,
        CustomerComponent,
        DriverComponent
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
        XDatatableComponent,
        ObjNgFor,
        SafeHtmlPipe,
        MonthPicker,
        YearPicker,
        XPaginationComponent,
        MasterDetailComponent,
        CounterComponent,

        PositionComponent,
        UserComponent,
        PostageComponent,
        TransportComponent,
        FormulaComponent,
        FormulaTransportComponent,
        LubeComponent,
        OilComponent,
        CustomerComponent,
        DriverComponent
    ]
})
export class SharedModule {
}

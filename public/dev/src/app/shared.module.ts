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

// My components
import {PositionComponent} from './components/position/position.component';
import {UserComponent} from './components/user/user.component';
import {PostageComponent} from './components/postage/postage.component';
import {TransportComponent} from './components/transport/transport.component';

// My dynamic form
import { DynamicFormComponent }         from './dynamic-form/dynamic-form.component';
import { DynamicFormQuestionComponent } from './dynamic-form/dynamic-form-question.component';

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

        PositionComponent,
        UserComponent,
        PostageComponent,
        TransportComponent,
        DynamicFormComponent,
        DynamicFormQuestionComponent
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

        PositionComponent,
        UserComponent,
        PostageComponent,
        TransportComponent,
        DynamicFormComponent,
        DynamicFormQuestionComponent
    ]
})
export class SharedModule {
}

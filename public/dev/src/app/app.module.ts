// Default
import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {HttpModule, JsonpModule} from '@angular/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

// My libraries
import {routing} from './app.routing';
import {AuthenticationService} from './services/authentication.service';
import {HttpClientService} from './services/httpClient.service';
import {LoggingService} from './services/logging.service';
import {ArrayHelperService} from './services/helpers/array.helper';
import {CommonHelperService} from './services/helpers/common.helper';
import {CurrencyHelperService} from './services/helpers/currency.helper';
import {DateHelperService} from './services/helpers/date.helper';
import {DomHelperService} from './services/helpers/dom.helper';
import {FileHelperService} from './services/helpers/file.helper';
import {NumberHelperService} from './services/helpers/number.helper';
import {PaginationHelperService} from './services/helpers/pagination.helper';
import {StringHelperService} from './services/helpers/string.helper';
import {ToastrHelperService} from './services/helpers/toastr.helper';
import {DeviceCaptionService} from './services/captions/device.caption';

// My share components
import {HeaderComponent} from './layout-components/header/header.component';
import {AsideComponent} from './layout-components/aside/aside.component';
import {FooterComponent} from './layout-components/footer/footer.component';
import {LoginComponent} from './layout-components/login/login.component';
import {DashboardComponent} from './layout-components/dashboard/dashboard.component';
import {ChangePasswordComponent} from './layout-components/change-password/change-password.component';

// Root component
import {AppComponent} from './app.component';

// My middlewares

// My share modules
import { SharedModule } from './shared.module';



@NgModule({
  declarations: [
    AppComponent,

    HeaderComponent,
    AsideComponent,
    FooterComponent,
    LoginComponent,
    DashboardComponent,
    ChangePasswordComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpModule,
    JsonpModule,
    BrowserAnimationsModule,
    routing,
    SharedModule
  ],
  providers: [
    AuthenticationService,
    HttpClientService,
    LoggingService,
    ArrayHelperService,
    CommonHelperService,
    CurrencyHelperService,
    DateHelperService,
    DomHelperService,
    FileHelperService,
    NumberHelperService,
    PaginationHelperService,
    StringHelperService,
    ToastrHelperService,
    DeviceCaptionService
  ],
  bootstrap: [AppComponent]
})
export class AppModule {
}

import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';
import {DateHelperService} from '../../services/helpers/date.helper';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';
import {FileHelperService} from '../../services/helpers/file.helper';
import {DeviceCaptionService} from '../../services/captions/device.caption';

@Component({
    selector: 'app-report-vsys',
    templateUrl: './report-vsys.component.html'
})
export class ReportVsysComponent implements OnInit
    , ICommon, ICrud, IDatePicker, ISearch {

    /** My Variables **/
    public header_master: any;
    public header_detail: any;
    public setup: any;
    public header_dps: any;

    public report_balances: any[] = [];
    public report_balance_details: any[] = [];
    public report_dpss: any[] = [];
    public first_day: string = '';
    public last_day: string = '';
    public today: string = '';
    public cards: any[] = [];
    public cdms: any[] = [];
    public distributors: any[] = [];
    public visitors: any[] = [];
    public filter_ReportBalance: any;
    public filter_ReportDps: any;
    public isLoading_Dps: boolean = true;
    public isLoading_Balance: boolean = true;

    public _deviceCaptionService;

    /** ICommon **/
    title: string;
    placeholder_code: string;
    prefix_url: string;
    isLoading: boolean;
    header: any;
    action_data: any;

    /** ICrud **/
    modal: any;
    isEdit: boolean;

    /** IDatePicker **/
    range_date: any[];
    datepickerSettings: any;
    datepicker_from: Date;
    datepicker_to: Date;
    datepickerToOpts: any = {};

    /** ISearch **/
    filtering: any;

    constructor(private httpClientService: HttpClientService
        , private dateHelperService: DateHelperService
        , private toastrHelperService: ToastrHelperService
        , private domHelperService: DomHelperService
        , private fileHelperService: FileHelperService
        , private deviceCaptionService: DeviceCaptionService) {
        this._deviceCaptionService = this.deviceCaptionService;
    }

    ngOnInit(): void {
        this.title = 'Báo cáo tiền';
        this.prefix_url = 'report-vsyss';
        this.range_date = this.dateHelperService.range_date;
        this.refreshData();
        this.datepickerSettings = this.dateHelperService.datepickerSettings;
        this.action_data = {
            ADD: false,
            EDIT: false,
            DELETE: false
        };
        this.header_master = {
            visitor_phone: {
                title: "SĐT"
            },
            distributor_name: {
                title: "Đại lý"
            },
            card_code: {
                title: `Mã ${this._deviceCaptionService.card}`
            },
            fc_sum_dps: {
                title: "Tổng nạp"
            },
            fc_sum_buy: {
                title: "Tổng chi"
            },
            fc_total_money: {
                title: "Số dư TK"
            },
            last_updated: {
                title: "Hđ gần đây"
            },
        };
        this.header_detail = {
            status_vi: {
                title: "Trạng thái"
            },
            fc_money: {
                title: "Tiền"
            },
            cdm_code: {
                title: "Mã thiết bị"
            },
            cdm_name: {
                title: "Tên thiết bị"
            },
            created_date: {
                title: "Ngày"
            },
            created_time: {
                title: "Giờ"
            }
        };
        this.setup = {
            link: 'report-vsyss/balance-detail',
            json_name: 'report_balance_details'
        };
        this.header_dps = {
            distributor_name: {
                title: 'Đại lý'
            },
            visitor_phone: {
                title: 'SĐT'
            },
            card_code: {
                title: `Mã ${this._deviceCaptionService.card}`
            },
            cdm_name: {
                title: this._deviceCaptionService.cdm
            },
            date_dps: {
                title: 'Ngày'
            },
            time_dps: {
                title: 'Giờ'
            },
            fc_money: {
                title: 'Số tiền'
            }
        };
    }

    /** ICommon **/
    loadData(): void {
        this.httpClientService.get(this.prefix_url).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.changeLoading(true);
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    reloadData(arr_data: any[]): void {
        this.first_day = arr_data['first_day'];
        this.last_day = arr_data['last_day'];
        this.today = arr_data['today'];

        this.report_dpss = [];
        this.report_balances = [];

        this.cards = arr_data['cards'];
        this.cdms = arr_data['cdms'];
        this.distributors = arr_data['distributors'];
        this.visitors = arr_data['visitors'];
    }

    refreshData(): void {
        this.changeLoading(false);
        this.clearOne();
        this.clearSearch();
        this.clearSearchDps();
        this.clearSearchBalance();
        this.loadData();
    }

    changeLoading(status: boolean): void {
        this.isLoading = status;
    }

    /** ICrud **/
    loadOne(id: number): void {
    }

    clearOne(): void {
    }

    addOne(): void {
    }

    updateOne(): void {
    }

    deactivateOne(id: number): void {
        this.httpClientService.patch(this.prefix_url, {"id": id}).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.toastrHelperService.showToastr('success', 'Hủy thành công.');
                this.domHelperService.toggleModal('modal-confirm');
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    deleteOne(id: number): void {
        this.httpClientService.delete(`${this.prefix_url}/${id}`).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.toastrHelperService.showToastr('success', 'Xóa thành công!');
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    confirmDeactivateOne(id: number): void {
        this.deactivateOne(id);
    }

    validateOne(): boolean {
        return null;
    }

    displayEditBtn(status: boolean): void {
        this.isEdit = status;
    }

    fillDataModal(id: number): void {
        this.modal.id = id;
        this.modal.header = 'Xác nhận';
        this.modal.body = `Có chắc muốn xóa ${this.title} này?`;
        this.modal.footer = 'OK';
    }

    actionCrud(obj: any): void {
        switch (obj.mode) {
            case 'add':
                this.displayEditBtn(false);
                this.clearOne();
                this.domHelperService.showTab('menu2');
                break;
            case 'edit':
                this.loadOne(obj.data.id);
                break;
            case 'delete':
                this.fillDataModal(obj.data.id);
                break;
            default:
                break;
        }
    }

    /** IDatePicker **/
    handleDateFromChange(dateFrom: Date): void {
        this.datepicker_from = dateFrom;
        this.datepickerToOpts = {
            startDate: dateFrom,
            autoclose: true,
            todayBtn: 'linked',
            todayHighlight: true,
            icon: this.dateHelperService.icon_calendar,
            placeholder: this.dateHelperService.date_placeholder,
            format: 'dd/mm/yyyy'
        };
    }

    clearDate(event: any, field: string): void {
        if (event == null) {
            switch (field) {
                case 'from':
                    this.filtering.from_date = '';
                    break;
                case 'to':
                    this.filtering.from_date = '';
                    break;
                default:
                    break;
            }
        }
    }

    /** ISearch **/
    search(): void {
        if (this.datepicker_from != null && this.datepicker_to != null) {
            let from_date = this.dateHelperService.getDate(this.datepicker_from);
            let to_date = this.dateHelperService.getDate(this.datepicker_to);
            this.filtering.from_date = from_date;
            this.filtering.to_date = to_date;
        }
        this.changeLoading(false);

        this.httpClientService.get(`${this.prefix_url}/search?query=${JSON.stringify(this.filtering)}`).subscribe(
            (success: any) => {
                this.reloadDataSearch(success);
                this.displayColumn();
                this.changeLoading(true);
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    reloadDataSearch(arr_data: any[]): void {
    }

    clearSearch(): void {
    }

    displayColumn(): void {
    }

    /** My Function **/
    public searchReportBalance(): void {
        this.myChangeLoading('balance', false);
        this.httpClientService.get(`${this.prefix_url}/report-balances/search?query=${JSON.stringify(this.filter_ReportBalance)}`).subscribe(
            (success: any) => {
                this.reloadDataSearchReportBalance(success);
                this.myDisplayColumn('balance');
                this.myChangeLoading('balance', true);
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    public searchReportDps(): void {
        if (this.datepicker_from != null && this.datepicker_to != null) {
            let from_date = this.dateHelperService.getDate(this.datepicker_from);
            let to_date = this.dateHelperService.getDate(this.datepicker_to);
            this.filter_ReportDps.from_date = from_date;
            this.filter_ReportDps.to_date = to_date;
        }

        this.myChangeLoading('dps', false);

        this.filter_ReportDps.show_type = 'web';

        this.httpClientService.get(`${this.prefix_url}/report-dpss/search?query=${JSON.stringify(this.filter_ReportDps)}`).subscribe(
            (success: any) => {
                this.reloadDataSearchReportDps(success);
                this.myDisplayColumn('dps');
                this.myChangeLoading('dps', true);
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    public reloadDataSearchReportBalance(arr_data) {
        this.report_balances = arr_data['report_balances'];
    }

    public reloadDataSearchReportDps(arr_data) {
        this.report_dpss = arr_data['report_dpss'];
    }

    public clearSearchDps(): void {
        this.datepicker_from = null;
        this.datepicker_to = null;

        this.filter_ReportDps = {
            from_date: '',
            to_date: '',
            range: '',
            card_id: 0,
            cdm_id: 0,
            distributor_id: 0,
            visitor_id: 0,
            show_type: ''
        };
    }

    public clearSearchBalance(): void {
        this.filter_ReportBalance = {
            distributor_id: 0,
            visitor_id: 0,
            card_id: 0
        };
    }

    public myChangeLoading(type: string, status: boolean): void {
        switch (type) {
            case 'dps':
                this.isLoading_Dps = status;
                break;
            case 'balance':
                this.isLoading_Balance = status;
                break;
            default:
                break;
        }
    }

    public myDisplayColumn(mode: string) {
        let setting = {
            visitor_id: ['visitor_phone'],
            distributor_id: ['distributor_name'],
            card_id: ['card_code'],
            cdm_id: ['cdm_name']
        };
        switch (mode) {
            case 'dps':
                for (let parent in setting) {
                    for (let child of setting[parent]) {
                        if (!!this.header_dps[child])
                            this.header_dps[child].visible = !(!!this.filter_ReportDps[parent]);
                    }
                }
                break;
            case 'balance':
                for (let parent in setting) {
                    for (let child of setting[parent]) {
                        if (!!this.header_master[child])
                            this.header_master[child].visible = !(!!this.filter_ReportBalance[parent]);
                    }
                }
                break;
            default:
                break;
        }
    }

    public downloadFile(mode: string) {
        let subfix_filename: string = '';
        let url: string = '';
        switch (mode) {
            case 'dps':
                subfix_filename = 'Nap';
                if (this.datepicker_from != null && this.datepicker_to != null) {
                    let from_date = this.dateHelperService.getDate(this.datepicker_from);
                    let to_date = this.dateHelperService.getDate(this.datepicker_to);
                    this.filter_ReportDps.from_date = from_date;
                    this.filter_ReportDps.to_date = to_date;
                }
                this.filter_ReportDps.show_type = 'csv';
                url = `report-dpss/search?query=${JSON.stringify(this.filter_ReportDps)}`;
                break;
            case 'balance':
                subfix_filename = 'SoDuTK';
                url = `report-balances/search?query=${JSON.stringify(this.filter_ReportBalance)}`;
                break;
            default: break;
        }
        this.httpClientService.get(`${this.prefix_url}/${url}`, 'text')
            .subscribe(
                (success: any) => {
                    this.fileHelperService.downloadFile(success, `BaoCaoTien_Nap_${subfix_filename}.csv`, 'text/csv');
                },
                (error: any) => {
                    this.toastrHelperService.showToastr('error');
                }
            );
    }
}

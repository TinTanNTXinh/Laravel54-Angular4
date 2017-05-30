import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';
import {DateHelperService} from '../../services/helpers/date.helper';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';

@Component({
    selector: 'app-driver',
    templateUrl: './driver.component.html',
    styles: []
})
export class DriverComponent implements OnInit
    , ICommon, ICrud, IDatePicker, ISearch {

    /** My Variables **/
    public drivers: any[] = [];
    public drivers_search: any[] = [];
    public driver: any;

    public birthday: Date = new Date();
    public ngay_cap_chung_minh: Date = new Date();
    public start_date: Date = new Date();
    public finish_date: Date = new Date();
    public ngay_cap_bang_lai: Date = new Date();
    public ngay_het_han_bang_lai: Date = new Date();

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
    timepickerSettings: any;
    datepicker_from: Date;
    datepicker_to: Date;
    datepickerToOpts: any = {};

    /** ISearch **/
    filtering: any;

    constructor(private httpClientService: HttpClientService
        , private dateHelperService: DateHelperService
        , private toastrHelperService: ToastrHelperService
        , private domHelperService: DomHelperService) {
    }

    ngOnInit(): void {
        this.title = 'Tài xế';
        this.prefix_url = 'drivers';
        this.range_date = this.dateHelperService.range_date;
        this.refreshData();
        this.datepickerSettings = this.dateHelperService.datepickerSettings;
        this.timepickerSettings = this.dateHelperService.timepickerSettings;
        this.header = {
            fullname: {
                title: 'Tên',
                data_type: 'TEXT'
            },
            phone: {
                title: 'Điện thoại',
                data_type: 'TEXT'
            },
            fd_birthday: {
                title: 'Ngày sinh',
                data_type: 'TEXT',
                prop_name: 'birthday'
            },
            dia_chi_thuong_tru: {
                title: 'Địa chỉ thường trú',
                data_type: 'TEXT'
            },
            dia_chi_tam_tru: {
                title: 'Địa chỉ tạm trú',
                data_type: 'TEXT'
            },
            so_chung_minh: {
                title: 'Số chứng minh',
                data_type: 'TEXT'
            },
            fd_ngay_cap_chung_minh: {
                title: 'Ngày cấp chứng minh',
                data_type: 'DATETIME',
                prop_name: 'ngay_cap_chung_minh'
            },
            loai_bang_lai: {
                title: 'Loại bằng lái',
                data_type: 'TEXT'
            },
            fd_ngay_cap_bang_lai: {
                title: 'Ngày cấp bằng lái',
                data_type: 'DATETIME',
                prop_name: 'ngay_cap_bang_lai'
            },
            fd_ngay_het_han_bang_lai: {
                title: 'Ngày hết hạn bằng lái',
                data_type: 'DATETIME',
                prop_name: 'ngay_het_han_bang_lai'
            },
            fd_start_date: {
                title: 'Ngày vào làm',
                data_type: 'DATETIME',
                prop_name: 'start_date'
            },
            fd_finish_date: {
                title: 'Ngày thôi việc',
                data_type: 'DATETIME',
                prop_name: 'finish_date'
            }
        };

        this.modal = {
            id: 0,
            header: '',
            body: '',
            footer: ''
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
        this.drivers = [];
    }

    refreshData(): void {
        this.changeLoading(false);
        this.clearOne();
        this.clearSearch();
        this.loadData();
    }

    changeLoading(status: boolean): void {
        this.isLoading = status;
    }

    /** ICrud **/
    loadOne(id: number): void {
        this.driver = this.drivers.find(o => o.id == id);

        this.setDateTimeDriverToGlobal();
    }

    clearOne(): void {
        this.driver = {
            fullname: '',
            phone: '',
            birthday: '',
            sex: 'Nam',
            email: '',
            dia_chi_thuong_tru: '',
            dia_chi_tam_tru: '',
            so_chung_minh: '',
            ngay_cap_chung_minh: '',
            loai_bang_lai: '',
            so_bang_lai: '',
            ngay_cap_bang_lai: '',
            ngay_het_han_bang_lai: '',
            start_date: '',
            finish_date: '',
            note: ''
        };
    }

    addOne(): void {
        if (!this.validateOne()) return;

        this.setDateTimeGlobalToDriver();

        this.httpClientService.post(this.prefix_url, {"driver": this.driver}).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.clearOne();
                this.toastrHelperService.showToastr('success', 'Thêm thành công!');
            },
            (error: any) => {
                for (let err of error.json()['msg']) {
                    this.toastrHelperService.showToastr('error', err);
                }
            }
        );
    }

    updateOne(): void {
        if (!this.validateOne()) return;

        this.setDateTimeGlobalToDriver();

        this.httpClientService.put(this.prefix_url, {"driver": this.driver}).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.clearOne();
                this.displayEditBtn(false);
                this.toastrHelperService.showToastr('success', 'Cập nhật thành công!');
            },
            (error: any) => {
                for (let err of error.json()['msg']) {
                    this.toastrHelperService.showToastr('error', err);
                }
            }
        );
    }

    deactivateOne(id: number): void {
        this.httpClientService.patch(this.prefix_url, {"id": id}).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.search();
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
        let flag: boolean = true;
        if (this.driver.fullname == '') {
            flag = false;
            this.toastrHelperService.showToastr('warning', `Tên  ${this.title} không được để trống!`);
        }
        return flag;
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
            case 'ADD':
                this.clearOne();
                this.displayEditBtn(false);
                this.domHelperService.showTab('menu2');
                break;
            case 'EDIT':
                this.loadOne(obj.data.id);
                this.displayEditBtn(true);
                this.domHelperService.showTab('menu2');
                break;
            case 'DELETE':
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
        this.drivers = arr_data['drivers'];
        this.drivers_search = arr_data['drivers'];
    }

    clearSearch(): void {
        this.datepicker_from = null;
        this.datepicker_to = null;
        this.filtering = {
            from_date: '',
            to_date: '',
            range: ''
        };
    }

    displayColumn(): void {
        let setting = {};
        for (let parent in setting) {
            for (let child of setting[parent]) {
                if (!!this.header[child])
                    this.header[child].visible = !(!!this.filtering[parent]);
            }
        }
    }

    /** My Function **/
    private setDateTimeGlobalToDriver(): void {
        this.driver.birthday = this.dateHelperService.getDate(this.birthday);
        this.driver.ngay_cap_chung_minh = this.dateHelperService.getDate(this.ngay_cap_chung_minh);
        this.driver.start_date = this.dateHelperService.getDate(this.start_date);
        this.driver.finish_date = this.dateHelperService.getDate(this.finish_date);
        this.driver.ngay_cap_bang_lai = this.dateHelperService.getDate(this.ngay_cap_bang_lai);
        this.driver.ngay_het_han_bang_lai = this.dateHelperService.getDate(this.ngay_het_han_bang_lai);
    }

    private setDateTimeDriverToGlobal(): void {
        this.birthday = new Date(this.driver.birthday);
        this.ngay_cap_chung_minh = new Date(this.driver.ngay_cap_chung_minh);
        this.start_date = new Date(this.driver.start_date);
        this.finish_date = new Date(this.driver.finish_date);
        this.ngay_cap_bang_lai = new Date(this.driver.ngay_cap_bang_lai);
        this.ngay_het_han_bang_lai = new Date(this.driver.ngay_het_han_bang_lai);
    }

}
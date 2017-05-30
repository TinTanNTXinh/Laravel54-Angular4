import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';
import {DateHelperService} from '../../services/helpers/date.helper';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';

@Component({
    selector: 'app-cost-oil',
    templateUrl: './cost-oil.component.html',
    styles: []
})
export class CostOilComponent implements OnInit
    , ICommon, ICrud, IDatePicker, ISearch {

    /** ===== MY VARIABLES ===== **/
    public cost_oils: any[] = [];
    public cost_oil: any;
    public trucks: any[] = [];
    public oil: any;

    public refuel_date: Date = new Date();
    public refuel_time: Date = new Date();

    /** ===== ICOMMON ===== **/
    title: string;
    placeholder_code: string;
    prefix_url: string;
    isLoading: boolean;
    header: any;
    action_data: any;

    /** ===== ICRUD ===== **/
    modal: any;
    isEdit: boolean;

    /** ===== IDATEPICKER ===== **/
    range_date: any[];
    datepickerSettings: any;
    timepickerSettings: any;
    datepicker_from: Date;
    datepicker_to: Date;
    datepickerToOpts: any = {};

    /** ===== ISEARCH ===== **/
    filtering: any;

    constructor(private httpClientService: HttpClientService
        , private dateHelperService: DateHelperService
        , private toastrHelperService: ToastrHelperService
        , private domHelperService: DomHelperService) {
    }

    ngOnInit(): void {
        this.title = 'Chi phí dầu';
        this.prefix_url = 'cost-oils';
        this.range_date = this.dateHelperService.range_date;
        this.datepickerSettings = this.dateHelperService.datepickerSettings;
        this.timepickerSettings = this.dateHelperService.timepickerSettings;
        this.header = {
            truck_area_code_number_plate: {
                title: 'Xe',
                data_type: 'TEXT',
            },
            fd_refuel_date: {
                title: 'Ngày đổ',
                data_type: 'DATETIME',
                prop_name: 'refuel_date'
            },
            fc_fuel_price: {
                title: 'Giá dầu',
                data_type: 'NUMBER',
                prop_name: 'fuel_price'
            },
            quantum_liter: {
                title: 'Số lít',
                data_type: 'NUMBER'
            },
            vat: {
                title: 'VAT',
                data_type: 'NUMBER'
            },
            fc_after_vat: {
                title: 'Tổng chi phí',
                data_type: 'NUMBER',
                prop_name: 'after_vat'
            },
            note: {
                title: 'Ghi chú',
                data_type: 'TEXT'
            }
        };

        this.modal = {
            id: 0,
            header: '',
            body: '',
            footer: ''
        };

        this.refreshData();
    }

    /** ===== ICOMMON ===== **/
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
        this.cost_oils = [];
        this.trucks = arr_data['trucks'];
        this.oil = arr_data['oil'];

        this.setOilForOne();
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

    /** ===== ICRUD ===== **/
    loadOne(id: number): void {
        this.cost_oil = this.cost_oils.find(o => o.id == id);

        this.setDataOneToGlobal();
    }

    clearOne(): void {
        this.cost_oil = {
            vat: 0,
            after_vat: 0,
            fuel_id: 0,
            fuel_price: 0,
            quantum_liter: 0,
            refuel_date: '',
            note: '',
            truck_id: 0
        };
        if (this.oil) {
            this.setOilForOne();
        }
    }

    addOne(): void {
        if (!this.validateOne()) return;

        this.setDataGlobalToOne();

        this.httpClientService.post(this.prefix_url, {"cost_oil": this.cost_oil}).subscribe(
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

        this.setDataGlobalToOne();

        this.httpClientService.put(this.prefix_url, {"cost_oil": this.cost_oil}).subscribe(
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

    /** ===== IDATEPICKER ===== **/
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

    /** ===== ISEARCH ===== **/
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
        this.cost_oils = arr_data['cost_oils'];
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

    /** ===== FUNCTION ACTION ===== **/
    public computeAfterVat(): void {
        this.cost_oil.after_vat = (this.cost_oil.quantum_liter * this.cost_oil.fuel_price)
            + ((this.cost_oil.quantum_liter * this.cost_oil.fuel_price) * this.cost_oil.vat / 100);
    }

    /** ===== FUNCTION ===== **/
    private setDataGlobalToOne(): void {
        this.cost_oil.refuel_date = this.dateHelperService.joinDateTimeToString(this.refuel_date, this.refuel_time);
    }

    private setDataOneToGlobal(): void {
        this.refuel_date = new Date(this.cost_oil.refuel_date);
        this.refuel_time = new Date(this.cost_oil.refuel_date);
    }

    private setOilForOne(): void {
        this.cost_oil.fuel_id = this.oil.id;
        this.cost_oil.fuel_price = this.oil.price;
    }
}
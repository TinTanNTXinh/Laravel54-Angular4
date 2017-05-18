import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';
import {DateHelperService} from '../../services/helpers/date.helper';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';
import {DeviceCaptionService} from '../../services/captions/device.caption';

@Component({
    selector: 'app-button-product',
    templateUrl: './button-product.component.html',
    styles: []
})
export class ButtonProductComponent implements OnInit
    , ICommon, ICrud, IDatePicker, ISearch {

    /** My Variables **/
    public tray_products: any[] = [];
    public tray_products_search: any[] = [];
    public products: any[] = [];
    public trays: any[] = [];
    public tray_product: any;
    public tray_product_update: any;
    public modal_update: any;
    public io_centers: any[] = [];
    public cabinets: any[] = [];
    public distributors: any[] = [];
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
        , private deviceCaptionService: DeviceCaptionService) {
        this._deviceCaptionService = this.deviceCaptionService;
    }

    ngOnInit(): void {
        this.title = `${this._deviceCaptionService.tray} - Sản phẩm`;
        this.prefix_url = 'button-products';
        this.range_date = this.dateHelperService.range_date;
        this.refreshData();
        this.datepickerSettings = this.dateHelperService.datepickerSettings;
        this.header = {
            io_center_code: {
                title: 'Mã bộ trung tâm'
            },
            io_center_name: {
                title: 'Bộ trung tâm'
            },
            distributor_name: {
                title: 'Đại lý'
            },
            cabinet_name: {
                title: this._deviceCaptionService.cabinet
            },
            tray_name: {
                title: this._deviceCaptionService.tray
            },
            tray_code: {
                title: `Mã ${this._deviceCaptionService.tray}`
            },
            tray_quantum_product: {
                title: 'Tối đa'
            },
            total_quantum: {
                title: 'Hiện tại'
            },
            tray_description: {
                title: `Mô tả ${this._deviceCaptionService.tray}`
            },
            product_name: {
                title: 'Sản phẩm'
            }
        };

        this.modal = {
            id: 0,
            header: '',
            body: '',
            footer: ''
        };

        this.tray_product_update = {
            id: 0,
            total_quantum: 0,
            active: true
        };

        this.modal_update = {
            distributor_name: '',
            cabinet_name: '',
            tray_name: ''
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
        this.tray_products = [];

        this.tray_products_search = arr_data['tray_products'];

        this.products = arr_data['products'];

        this.trays = arr_data['trays'];

        this.io_centers = arr_data['io_centers'];
        this.cabinets = arr_data['cabinets'];
        this.distributors = arr_data['distributors'];
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
        let tray_product = this.tray_products.find(function (o) {
            return o['id'] == id;
        });

        this.modal_update.distributor_name = tray_product.distributor_name;
        this.modal_update.cabinet_name = tray_product.cabinet_name;
        this.modal_update.tray_name = tray_product.tray_name;

        this.tray_product_update.id = tray_product.id;
        this.tray_product_update.total_quantum = tray_product.total_quantum;
    }

    clearOne(): void {
        this.tray_product = {
            arr_tray_id: [],
            product_id: 0,
            active: true
        };
    }

    addOne(): void {
    }

    updateOne(): void {
        this.httpClientService.put(this.prefix_url, {"tray_product": this.tray_product_update}).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.toastrHelperService.showToastr('success', 'Tác vụ thành công.');
                this.domHelperService.toggleModal('modal-update');
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
                this.toastrHelperService.showToastr('success', 'Hủy thành công.');
                this.domHelperService.toggleModal('modal-confirm');
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    deleteOne(id: number): void {
    }

    confirmDeactivateOne(id: number): void {
        this.deactivateOne(id);
    }

    validateOne(): boolean {
        let flag: boolean = true;
        if (this.tray_product.arr_tray_id.length == 0) {
            this.toastrHelperService.showToastr('warning', `Vui lòng chọn ít nhất 1 ${this._deviceCaptionService.tray}.`);
            flag = false;
        }
        if (this.tray_product.product_id == 0) {
            this.toastrHelperService.showToastr('warning', 'Vui lòng chọn 1 sản phẩm.');
            flag = false;
        }
        return flag;
    }

    displayEditBtn(status: boolean): void {
        this.isEdit = status;
    }

    fillDataModal(id: number): void {
        this.modal.id = id;
        this.modal.header = 'Xác nhận';
        this.modal.body = `Có chắc muốn xóa sản phẩm này ra khỏi ${this._deviceCaptionService.tray}?`;
        this.modal.footer = 'OK';
    }

    actionCrud(obj: any): void {
        switch (obj.mode) {
            case 'add':
                this.clearOne();
                this.domHelperService.showTab('menu2');
                break;
            case 'edit':
                this.domHelperService.getElementById('btn-show-modal1').click();
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
        this.tray_products = arr_data['tray_products'];
        this.tray_products_search = arr_data['tray_products'];
    }

    clearSearch(): void {
        this.datepicker_from = null;
        this.datepicker_to = null;
        this.filtering = {
            from_date: '',
            to_date: '',
            range: '',
            io_center_id: 0,
            distributor_id: 0,
            cabinet_id: 0,
            product_id: 0
        };
    }

    displayColumn(): void {
        let setting = {
            io_center_id: ['io_center_code', 'io_center_name'],
            cabinet_id: ['cabinet_name'],
            distributor_id: ['distributor_name'],
            product_id: ['product_name']
        };
        for (let parent in setting) {
            for (let child of setting[parent]) {
                if (!!this.header[child])
                    this.header[child].visible = !(!!this.filtering[parent]);
            }
        }
    }

    /** My Function */
    public checkTray(value: boolean, tray_id: number): void {
        if (value) {
            this.tray_product.arr_tray_id.push(tray_id);
        }
        else {
            let index = this.tray_product.arr_tray_id.indexOf(tray_id);
            this.tray_product.arr_tray_id.splice(index, 1);
        }
    }

    public saveTrayProduct(): void {
        if (!this.validateOne())
            return;

        this.httpClientService.post(this.prefix_url, {"tray_product": this.tray_product}).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.toastrHelperService.showToastr('success', 'Tác vụ thành công.');
            },
            (error: any) => {
                for (let err of error.json()['msg']) {
                    this.toastrHelperService.showToastr('error', err);
                }
            }
        );
    }


}

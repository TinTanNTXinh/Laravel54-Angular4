import {Component, OnInit} from '@angular/core';
import {FormGroup, FormBuilder, FormArray} from '@angular/forms';

import {HttpClientService} from '../../services/httpClient.service';
import {DateHelperService} from '../../services/helpers/date.helper';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';

@Component({
    selector: 'app-transport',
    templateUrl: './transport.component.html',
    styles: []
})
export class TransportComponent implements OnInit
    , ICommon, ICrud, IDatePicker, ISearch {

    /** ===== MY VARIABLES ===== **/
    public transports: any[] = [];
    public transport: any;
    public customers: any[] = [];
    public trucks: any[] = [];
    public products: any[] = [];
    public vouchers: any[] = [];
    public header_voucher: any;
    public action_voucher: any = {
        ADD: {
            visible: true,
            caption: 'Tăng',
            icon: 'fa fa-plus'
        },
        EDIT: {
            visible: true,
            caption: 'Giảm',
            icon: 'fa fa-minus'
        },
        DELETE: {
            visible: false,
            caption: '',
            icon: ''
        }
    };
    public transport_date: Date = new Date();
    public transport_time: Date = new Date();

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

    constructor(private fb: FormBuilder
        , private httpClientService: HttpClientService
        , private dateHelperService: DateHelperService
        , private toastrHelperService: ToastrHelperService
        , private domHelperService: DomHelperService) {
    }

    ngOnInit(): void {
        this.initFormulaFormGroup();

        this.title = 'Đơn hàng';
        this.prefix_url = 'transports';
        this.range_date = this.dateHelperService.range_date;
        this.datepickerSettings = this.dateHelperService.datepickerSettings;
        this.timepickerSettings = this.dateHelperService.timepickerSettings;
        this.header = {
            fd_transport_date: {
                title: 'Ngày vận chuyển',
                data_type: 'DATETIME',
                prop_name: 'transport_date'
            },
            customer_fullname: {
                title: 'Khách hàng',
                data_type: 'TEXT'
            },
            truck_area_code_number_plate: {
                title: 'Xe',
                data_type: 'TEXT'
            },
            quantum_product: {
                title: 'Lượng hàng',
                data_type: 'NUMBER'
            },
            fc_receive: {
                title: 'Nhận',
                data_type: 'NUMBER',
                prop_name: 'receive'
            },
            fc_carrying: {
                title: 'Bốc xếp',
                data_type: 'NUMBER',
                prop_name: 'carrying'
            },
            fc_parking: {
                title: 'Neo đêm',
                data_type: 'NUMBER',
                prop_name: 'parking'
            },
            fc_fine: {
                title: 'Công an',
                data_type: 'NUMBER',
                prop_name: 'fine'
            },
            fc_phi_tang_bo: {
                title: 'Phí tăng bo',
                data_type: 'NUMBER',
                prop_name: 'phi_tang_bo'
            },
            fc_add_score: {
                title: 'Thêm điểm',
                data_type: 'NUMBER',
                prop_name: 'add_score'
            },
            receiver: {
                title: 'Người nhận',
                data_type: 'TEXT'
            }
        };

        this.modal = {
            id: 0,
            header: '',
            body: '',
            footer: ''
        };

        this.header_voucher = {
            name: {
                title: 'Tên'
            },
            quantum: {
                title: 'Số lượng'
            }
        };

        this.transport_time.setHours(0, 0, 0, 0);

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
        this.transports = [];
        this.customers = arr_data['customers'];
        this.trucks = arr_data['trucks'];
        this.products = arr_data['products'];
        this.vouchers = arr_data['vouchers'];

        this.setAreaCodeNumberPlate('TRUCK');
        this.clearQuantumVoucher();
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
        this.httpClientService.get(`${this.prefix_url}/${id}`).subscribe(
            (success: any) => {
                // set transport
                this.transport = success['transport'];

                // set transport_date
                this.transport_date = new Date(this.transport.transport_date);
                this.transport_time = new Date(this.transport.transport_date);

                // set transport_vouchers
                this.clearQuantumVoucher();
                success['transport_vouchers'].forEach(function (transport_voucher) {
                    let voucher = this.vouchers.find(o => o.id == transport_voucher.voucher_id);
                    if (voucher)
                        voucher.quantum = transport_voucher.quantum;
                }, this);

                // set transport_formulas
                this.clearFormula();
                success['transport_formulas'].forEach(function (transport_formula) {
                    this.addFormula(transport_formula.rule, transport_formula.name, transport_formula.value1, transport_formula.value2);
                }, this);
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    clearOne(): void {
        this.transport = {
            code: '',
            transport_date: '',
            type1: 'NORMAL',
            quantum_product: 0,
            revenue: 0,
            receive: 0,
            delivery: 0,
            carrying: 0,
            parking: 0,
            fine: 0,
            phi_tang_bo: 0,
            add_score: 0,
            voucher_number: '',
            quantum_product_on_voucher: '',
            receiver: '',
            note: '',
            truck_id: 0,
            product_id: 0,
            customer_id: 0,
            postage_id: 0,
            fuel_id: 0,
            postage_unit_price: 0,
            unit_name: 'đ/?'
        };

        this.clearQuantumVoucher();

        this.clearFormula();
    }

    addOne(): void {
        if (!this.validateOne()) return;

        this.setDateTimeToTransport();

        let transport_vouchers = this.vouchers.filter(function (obj) {
            return obj.quantum > 0;
        }).map(function (obj) {
            let transport_voucher = {voucher_id: 0, quantum: 0};
            transport_voucher.voucher_id = obj.id;
            transport_voucher.quantum = obj.quantum;
            return transport_voucher;
        });

        let data = {
            "transport": this.transport,
            "formulas": this.formulaFormArray.value,
            "transport_vouchers": transport_vouchers
        };

        this.httpClientService.post(this.prefix_url, {"transport": data}).subscribe(
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

        this.setDateTimeToTransport();

        let transport_vouchers = this.vouchers.filter(function (obj) {
            return obj.quantum > 0;
        }).map(function (obj) {
            let transport_voucher = {voucher_id: 0, quantum: 0};
            transport_voucher.voucher_id = obj.id;
            transport_voucher.quantum = obj.quantum;
            return transport_voucher;
        });

        let data = {
            "transport": this.transport,
            "formulas": this.formulaFormArray.value,
            "transport_vouchers": transport_vouchers
        };

        this.httpClientService.put(this.prefix_url, {"transport": data}).subscribe(
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
        if (this.transport.truck_id == 0) {
            flag = false;
            this.toastrHelperService.showToastr('warning', `Xe ${this.title} không được để trống!`);
        }
        if (this.transport.product_id == 0) {
            flag = false;
            this.toastrHelperService.showToastr('warning', `Hàng ${this.title} không được để trống!`);
        }
        if (this.transport.customer_id == 0) {
            flag = false;
            this.toastrHelperService.showToastr('warning', `Khách hàng ${this.title} không được để trống!`);
        }
        if (this.transport.truck_id == 0) {
            flag = false;
            this.toastrHelperService.showToastr('warning', `Xe ${this.title} không được để trống!`);
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
        this.transports = arr_data['transports'];

        this.setAreaCodeNumberPlate('TRANSPORT');
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

    /** ===== FORM FORMULA ===== **/
    public formulaFormGroup: FormGroup;

    private initFormulaFormGroup(): void {
        this.formulaFormGroup = this.fb.group({
            formulas: this.fb.array([])
        });
    }

    get formulaFormArray(): FormArray {
        return <FormArray>this.formulaFormGroup.controls['formulas'];
    }

    private buildFormula(rule: string, name: string, value1: any, value2: any): FormGroup {
        let formula: FormGroup;
        switch (rule) {
            case 'SINGLE':
                formula = this.fb.group({
                    rule: rule,
                    name: name,
                    value1: value1,
                    value2: ''
                });
                break;
            case 'RANGE':
            case 'OIL':
                formula = this.fb.group({
                    rule: rule,
                    name: name,
                    value1: value1,
                    value2: 0
                });
                break;
            case 'PAIR':
                formula = this.fb.group({
                    rule: rule,
                    name: name,
                    value1: value1,
                    value2: value2
                });
                break;
            default:
                break;
        }
        return formula;
    }

    private addFormula(rule: string, name: string, value1: any, value2: any): void {
        const new_control = this.buildFormula(rule, name, value1, value2);
        this.formulaFormArray.push(new_control);
    }

    private removeFormula(index: number): void {
        this.formulaFormArray.removeAt(index);
    }

    private clearFormula(): void {
        let length: number = this.formulaFormArray.length;
        for (let i = length; i--;) {
            this.removeFormula(i);
        }
    }

    /** ===== FUNCTION ACTION ===== **/
    public selectedCustomer(event: any): void {

        // Xóa các công thức hiện có
        this.clearFormula();

        // Set lại đơn giá
        this.transport.postage_unit_price = 0;

        // Set lại doanh thu
        this.computeRevenue();

        if (!!event.id) {
            let find_formulas = {
                customer_id: event.id,
                transport_date: this.dateHelperService.joinDateTimeToString(this.transport_date, this.transport_time)
            };
            this.findFormulas(find_formulas);
        }
    }

    public findPostage(): void {
        let formulas = {
            customer_id: this.transport.customer_id,
            transport_date: this.dateHelperService.joinDateTimeToString(this.transport_date, this.transport_time),
            formulas: this.formulaFormGroup.value.formulas
        };

        this.httpClientService.get(`${this.prefix_url}/find-postage?query=${JSON.stringify(formulas)}`).subscribe(
            (success: any) => {
                this.transport.postage_unit_price = success.postage.unit_price;
                this.transport.unit_name = success.postage.unit_name;

                this.computeRevenue();
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );

    }

    public computeRevenue(): void {
        this.transport.revenue = (this.transport.quantum_product * this.transport.postage_unit_price) + (this.transport.carrying + this.transport.parking + this.transport.fine + this.transport.phi_tang_bo + this.transport.add_score);
    }

    public actionVoucher(obj: any): void {
        switch (obj.mode) {
            case 'ADD':
                this.vouchers[obj.index].quantum += 1;
                break;
            case 'EDIT':
                this.vouchers[obj.index].quantum -= 1;
                if (this.vouchers[obj.index].quantum < 0)
                    this.vouchers[obj.index].quantum = 0;
                break;
            case 'DELETE':
                break;
            default:
                break;
        }
    }

    /** ===== FUNCTION ===== **/
    private findFormulas(find_formulas: {}): void {
        this.httpClientService.get(`${this.prefix_url}/find-formulas?query=${JSON.stringify(find_formulas)}`).subscribe(
            (success: any) => {
                let formulas = success['formulas'];
                for (let formula of formulas) {
                    switch (formula.rule) {
                        case 'SINGLE':
                            this.addFormula(formula.rule, formula.name, '', '');
                            break;
                        case 'RANGE':
                        case 'OIL':
                            this.addFormula(formula.rule, formula.name, 0, 0);
                            break;
                        case 'PAIR':
                            this.addFormula(formula.rule, formula.name, '', '');
                            break;
                        default:
                            break;
                    }
                }
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    private setDateTimeToTransport(): void {
        this.transport.transport_date = this.dateHelperService.joinDateTimeToString(this.transport_date, this.transport_time);
    }

    private clearQuantumVoucher(): void {
        this.vouchers.map(function (voucher) {
            voucher.quantum = 0;
            return voucher;
        });
    }

    private setAreaCodeNumberPlate(type: string): void {
        switch (type) {
            case 'TRUCK':
                this.trucks.map(function (item) {
                    item.area_code_number_plate = `${item.area_code}-${item.number_plate}`;
                    return item;
                });
                break;
            case 'TRANSPORT':
                this.transports.map(function (item) {
                    item.truck_area_code_number_plate = `${item.truck_area_code}-${item.truck_number_plate}`;
                    return item;
                });
                break;
            default: break;
        }
    }
}
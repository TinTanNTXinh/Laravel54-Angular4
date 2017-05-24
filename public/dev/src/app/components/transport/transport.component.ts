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

    /** My Variables **/
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

    constructor(private fb: FormBuilder
        , private httpClientService: HttpClientService
        , private dateHelperService: DateHelperService
        , private toastrHelperService: ToastrHelperService
        , private domHelperService: DomHelperService) {
    }

    ngOnInit(): void {
        this.title = 'Đơn hàng';
        this.prefix_url = 'transports';
        this.range_date = this.dateHelperService.range_date;
        this.refreshData();
        this.datepickerSettings = this.dateHelperService.datepickerSettings;
        this.timepickerSettings = this.dateHelperService.timepickerSettings;
        this.header = {
            fd_transport_date: {
                title: 'Ngày vận chuyển'
            },
            customer_fullname: {
                title: 'Khách hàng'
            },
            truck_area_code_number_plate: {
                title: 'Xe'
            },
            quantum_product: {
                title: 'Lượng hàng'
            },
            fc_receive: {
                title: 'Nhận'
            },
            fc_carrying: {
                title: 'Bốc xếp'
            },
            fc_parking: {
                title: 'Neo đêm'
            },
            fc_fine: {
                title: 'Công an'
            },
            fc_phi_tang_bo: {
                title: 'Phí tăng bo'
            },
            fc_add_score: {
                title: 'Thêm điểm'
            },
            receiver: {
                title: 'Người nhận'
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

        this.formulaFormGroup = this.fb.group({
            formulas: this.fb.array([])
        });

        this.transport_time.setHours(0, 0, 0, 0);
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
        this.transports = [];
        this.customers = arr_data['customers'];
        this.trucks = arr_data['trucks'];
        this.products = arr_data['products'];
        this.vouchers = arr_data['vouchers'];

        this.setAreaCodeNumberPlateTruck();
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

    /** ICrud **/
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
            type1: '',
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

        let data = {
            "transport": this.transport,
            "formulas": this.formulaFormArray.value,
            "transport_vouchers": {}
        };

        this.httpClientService.put(this.prefix_url, data).subscribe(
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
            case 'add':
                this.clearOne();
                this.displayEditBtn(false);
                this.domHelperService.showTab('menu2');
                break;
            case 'edit':
                this.loadOne(obj.data.id);
                this.displayEditBtn(true);
                this.domHelperService.showTab('menu2');
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
        this.transports = arr_data['transports'];

        this.setAreaCodeNumberPlateTruck();
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

    /** Formulas Form **/
    formulaFormGroup: FormGroup;

    get formulaFormArray(): FormArray {
        return <FormArray>this.formulaFormGroup.controls['formulas'];
    }

    private initFormula(rule: string, name: string, value1: any, value2: any): FormGroup {
        let formula: FormGroup;
        switch (rule) {
            case 'Single':
                formula = this.fb.group({
                    rule: rule,
                    name: name,
                    value1: value1,
                    value2: ''
                });
                break;
            case 'Range':
            case 'Oil':
                formula = this.fb.group({
                    rule: rule,
                    name: name,
                    value1: value1,
                    value2: 0
                });
                break;
            case 'Pair':
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
        const new_control = this.initFormula(rule, name, value1, value2);
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

    /** My Function **/
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

    private findFormulas(find_formulas: {}): void {
        this.httpClientService.get(`${this.prefix_url}/find-formulas?query=${JSON.stringify(find_formulas)}`).subscribe(
            (success: any) => {
                let formulas = success['formulas'];
                for (let formula of formulas) {
                    switch (formula.rule) {
                        case 'Single':
                            this.addFormula(formula.rule, formula.name, '', '');
                            break;
                        case 'Range':
                        case 'Oil':
                            this.addFormula(formula.rule, formula.name, 0, 0);
                            break;
                        case 'Pair':
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

    private setDateTimeToTransport(): void {
        this.transport.transport_date = this.dateHelperService.joinDateTimeToString(this.transport_date, this.transport_time);
    }

    public actionVoucher(obj: any): void {
        switch (obj.mode) {
            case 'add':
                this.vouchers[obj.index].quantum += 1;
                break;
            case 'edit':
                this.vouchers[obj.index].quantum -= 1;
                if (this.vouchers[obj.index].quantum < 0)
                    this.vouchers[obj.index].quantum = 0;
                break;
            case 'delete':
                break;
            default:
                break;
        }
    }

    private clearQuantumVoucher(): void {
        this.vouchers.map(function (voucher) {
            voucher.quantum = 0;
            return voucher;
        });
    }

    private setAreaCodeNumberPlateTruck(): void {
        this.trucks.map(function (truck) {
            truck.area_code_number_plate = `${truck.area_code}-${truck.number_plate}`;
            return truck;
        });
    }
}
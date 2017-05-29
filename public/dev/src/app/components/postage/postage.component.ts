import {Component, OnInit} from '@angular/core';
import {FormGroup, FormBuilder, FormArray, Validators} from '@angular/forms';

import {HttpClientService} from '../../services/httpClient.service';
import {DateHelperService} from '../../services/helpers/date.helper';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';

@Component({
    selector: 'app-postage',
    templateUrl: './postage.component.html',
    styles: []
})
export class PostageComponent implements OnInit
    , ICommon, ICrud, IDatePicker, ISearch {

    /** ===== MY VARIABLES ===== **/
    public postages: any[] = [];
    public postage: any;
    public customers: any[] = [];
    public units: any[] = [];
    public formula_samples: any[] = [];

    public apply_date: Date = new Date();
    public apply_time: Date = new Date();

    public setup_master_detail = {
        link: 'postages/search/customer',
        json_name: 'postages'
    };
    public header_master = {
        fullname: {
            title: 'Khách hàng',
            data_type: 'TEXT'
        },
        // quantum_postage: {
        //     title: 'Số cước phí',
        //     data_type: 'TEXT'
        // },
    };
    public header_detail = {
        unit_name: {
            title: 'ĐVT',
            data_type: 'TEXT'
        },
        fc_unit_price: {
            title: 'Đơn giá',
            data_type: 'NUMBER',
            prop_name: 'unit_price'
        },
        fd_apply_date: {
            title: 'Ngày áp dụng',
            data_type: 'DATETIME',
            prop_name: 'apply_date'
        },
        delivery_percent: {
            title: 'Giao xe',
            data_type: 'NUMBER'
        },
        note: {
            title: 'Ghi chú',
            data_type: 'TEXT'
        }
    };

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

        this.title = 'Cước phí';
        this.prefix_url = 'postages';
        this.range_date = this.dateHelperService.range_date;

        this.datepickerSettings = this.dateHelperService.datepickerSettings;
        this.timepickerSettings = this.dateHelperService.timepickerSettings;

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
        this.postages = [];
        this.customers = arr_data['customers'];
        this.units = arr_data['units'];
        this.formula_samples = arr_data['formula_samples'];
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
        this.postage = this.postages.find(o => o.id == id);

        // set transport_date
        this.apply_date = new Date(this.postage.apply_date);
        this.apply_time = new Date(this.postage.apply_date);
    }

    clearOne(): void {
        this.postage = {
            customer_id: 0,
            unit_id: 0,
            fuel_id: 0,
            delivery_percent: 0,
            unit_price: 0,
            apply_date: '',
            note: ''
        };
    }

    addOne(): void {
        if (!this.validateOne()) return;

        this.setDateTimeToPostage();

        let data = {
            postage: this.postage,
            formulas: this.formulaFormArray.value
        };

        this.httpClientService.post(this.prefix_url, {"postage": data}).subscribe(
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

        this.setDateTimeToPostage();

        let data = {
            postage: this.postage,
            formulas: this.formulaFormArray.value
        };

        this.httpClientService.put(this.prefix_url, {"postage": data}).subscribe(
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
        if (this.postage.code == '') {
            flag = false;
            this.toastrHelperService.showToastr('warning', `Mã ${this.title} không được để trống!`);
        }
        if (this.postage.name == '') {
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
        this.postages = arr_data['postages'];
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

    /** ===== FORM FORMULA ===== **/
    public formulaFormGroup: FormGroup;

    private initFormulaFormGroup(): void {
        this.formulaFormGroup = this.fb.group({
            formulas: this.fb.array([])
        });
    }

    get formulaFormArray(): FormArray {
        return <FormArray>this.formulaFormGroup.get('formulas');
        // return <FormArray>this.formulaFormGroup.controls['formulas'];
    }

    private buildFormula(rule: string, name: string = ''): FormGroup {
        let formula;
        switch (rule) {
            case 'SINGLE':
                formula = this.fb.group({
                    rule: rule,
                    name: [name, [Validators.required]],
                    value1: ['', [Validators.required]],
                    value2: ''
                });
                break;
            case 'RANGE':
            case 'OIL':
                formula = this.fb.group({
                    rule: rule,
                    name: [name, [Validators.required]],
                    value1: [0, [Validators.pattern('[0-9].*'), Validators.required]],
                    value2: [0, [Validators.pattern('[0-9].*'), Validators.required]]
                });
                break;
            case 'PAIR':
                formula = this.fb.group({
                    rule: rule,
                    name: [name, [Validators.required]],
                    value1: ['', [Validators.pattern('[a-zA-Z].*'), Validators.required]],
                    value2: ['', [Validators.pattern('[a-zA-Z].*'), Validators.required]]
                });
                break;
            default:
                break;
        }
        return formula;
    }

    public addFormula(rule: string, name: string = ''): void {
        this.formulaFormArray.push(this.buildFormula(rule, name));
    }

    private removeFormula(index: number) {
        this.formulaFormArray.removeAt(index);
    }

    private clearFormula(): void {
        let length: number = this.formulaFormArray.length;
        for (let i = length; i--;) {
            this.removeFormula(i);
        }
    }

    /** ===== FUNCTION ===== **/
    public selectFormulaSample(formula_sample_id: number): void {
        let formula_sample = this.formula_samples.find(o => o.id == formula_sample_id);
        this.addFormula(formula_sample.rule, formula_sample.name);
    }

    private setDateTimeToPostage(): void {
        this.postage.apply_date = this.dateHelperService.joinDateTimeToString(this.apply_date, this.apply_time);
    }
}

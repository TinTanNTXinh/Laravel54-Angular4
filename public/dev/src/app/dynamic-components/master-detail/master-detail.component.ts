import {Component, OnInit, Input, Output, EventEmitter} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {PaginationHelperService} from '../../services/helpers/pagination.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';
import {DateHelperService} from '../../services/helpers/date.helper';

@Component({
    selector: 'master-detail',
    templateUrl: './master-detail.component.html',
    styleUrls: ['./master-detail.component.css']
})
export class MasterDetailComponent implements OnInit {

    /** ===== VARIABLES ===== **/
    public activeRow: number = 0;
    public selectedRow: number = 0;
    public setClickedRow: Function;
    public selectedRowDetail: number = 0;
    public setClickedRowDetail: Function;
    public isAsc: boolean = true;
    public master_data: any[] = [];

    /** ===== VARIABLES PAGINATION ===== **/
    public pager: any = {};
    public pagedItems: any[];
    private pageSize: number = 10;

    constructor(private httpClientService: HttpClientService
        , private toastrHelperService: ToastrHelperService
        , private paginationHelperService: PaginationHelperService
        , private domHelperService: DomHelperService
        , private dateHelperService: DateHelperService) {

        this.setClickedRow = function (index) {
            this.selectedRow = index;
        };
        this.setClickedRowDetail = function (index) {
            this.selectedRowDetail = index;
        };
    }

    ngOnInit() {
        this.setSortProp();
    }

    /** ===== INPUT ===== **/
    @Input() setup: any = {};
    @Input() header_master: any = {};
    @Input() header_detail: any = {};
    @Input() detail: any[] = [];
    @Input() action_detail: any = {
        ADD: {
            visible: true,
            caption: 'Thêm',
            icon: 'fa fa-plus',
        },
        EDIT: {
            visible: true,
            caption: 'Cập nhật',
            icon: 'fa fa-pencil',
        },
        DELETE: {
            visible: true,
            caption: 'Xóa',
            icon: 'fa fa-trash-o',
        }
    };
    @Input() action_master: any = {
        ADD: {
            visible: true,
            caption: 'Thêm',
            icon: 'fa fa-plus',
        },
        EDIT: {
            visible: true,
            caption: 'Cập nhật',
            icon: 'fa fa-pencil',
        },
        DELETE: {
            visible: true,
            caption: 'Xóa',
            icon: 'fa fa-trash-o',
        }
    };

    @Input() get master(): any[] {
        return this.master_data;
    }

    set master(obj: any[]) {
        this.master_data = obj;
        if (this.master_data.length > 0)
            this.setPage(1);
    }

    /** ===== OUTPUT ===== **/
    @Output() onClickedMaster: EventEmitter<any> = new EventEmitter();
    public clickedMaster(mode: string): void {
        let index = this.selectedRow + (this.pager.currentPage * this.pageSize) - this.pageSize;
        let data = this.master[index];
        if (typeof data !== 'undefined') {
            this.onClickedMaster.emit({index: index, mode: mode, data: data});
            switch (mode) {
                case 'ADD':
                case 'EDIT':
                    break;
                case 'DELETE':
                    this.domHelperService.getElementById('btn-show-modal').click();
                    break;
                default:
                    break;
            }
        }
        else {
            switch (mode) {
                case 'ADD':
                    this.onClickedMaster.emit({index: 0, mode: mode, data: {}});
                    break;
                case 'EDIT':
                case 'DELETE':
                    this.toastrHelperService.showToastr('warning', 'Vui lòng chọn một dòng dữ liệu!');
                    break;
                default:
                    break;
            }
        }
    }

    @Output() onClickedDetail: EventEmitter<any> = new EventEmitter();
    public clickedDetail(mode: string): void {
        let index = this.selectedRowDetail;
        let data = this.detail[index];
        if (typeof data !== 'undefined') {
            this.onClickedDetail.emit({index: index, mode: mode, data: data});
            switch (mode) {
                case 'ADD':
                case 'EDIT':
                    break;
                case 'DELETE':
                    this.domHelperService.getElementById('btn-show-modal').click();
                    break;
                default:
                    break;
            }
        }
        else {
            switch (mode) {
                case 'ADD':
                    this.onClickedDetail.emit({index: 0, mode: mode, data: {}});
                    break;
                case 'EDIT':
                case 'DELETE':
                    this.toastrHelperService.showToastr('warning', 'Vui lòng chọn một dòng dữ liệu!');
                    break;
                default:
                    break;
            }
        }
    }

    /** ===== FUNCTION ACTION ===== **/
    public showDetail(id: number): void {
        if (this.activeRow == id) {
            this.activeRow = 0;
            return;
        }
        this.httpClientService.get(`${this.setup.link}/${id}`).subscribe(
            (success: any) => {
                this.detail = success[this.setup.json_name];
                this.activeRow = id;

                this.selectedRowDetail = 0;
                this.setSortPropDetail();
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    public visible(key): boolean {
        return 'visible' in this.header_master[key] ? this.header_master[key]['visible'] : true;
    }

    /** ===== SORT ===== **/
    public sortIndex(mode: string): void {
        this.isAsc = !this.isAsc;
        this.pagedItems.reverse();
        this.master_data.reverse();
    }

    public sortPropName(data_type: string, sort: string, key: string): void {
        let prop_name = ('prop_name' in this.header_master[key]) ? this.header_master[key].prop_name : key;
        let isDesc: number = 0;
        let isAsc: number = 0;
        switch (sort) {
            case 'DESC':
                isDesc = -1;
                isAsc = 1;
                this.header_master[key].isDesc = false;
                this.header_master[key].isAsc = true;
                break;
            case 'ASC':
                isDesc = 1;
                isAsc = -1;
                this.header_master[key].isDesc = true;
                this.header_master[key].isAsc = false;
                break;
            default:
                break;
        }

        switch (data_type) {
            case 'TEXT':
                this.pagedItems.sort(function (left_side, right_side): number {
                    let prop_left_side: string = left_side[prop_name].toUpperCase();
                    let prop_right_side: string = right_side[prop_name].toUpperCase();
                    return (prop_left_side < prop_right_side) ? isDesc : (prop_left_side > prop_right_side) ? isAsc : 0;
                });
                this.master.sort(function (left_side, right_side): number {
                    let prop_left_side: string = left_side[prop_name].toUpperCase();
                    let prop_right_side: string = right_side[prop_name].toUpperCase();
                    return (prop_left_side < prop_right_side) ? isDesc : (prop_left_side > prop_right_side) ? isAsc : 0;
                });
                break;
            case 'NUMBER':
                this.pagedItems.sort(function (left_side, right_side): number {
                    let prop_left_side: number = Number(left_side[prop_name]);
                    let prop_right_side: number = Number(right_side[prop_name]);
                    return (prop_left_side < prop_right_side) ? isDesc : (prop_left_side > prop_right_side) ? isAsc : 0;
                });
                this.master.sort(function (left_side, right_side): number {
                    let prop_left_side: number = Number(left_side[prop_name]);
                    let prop_right_side: number = Number(right_side[prop_name]);
                    return (prop_left_side < prop_right_side) ? isDesc : (prop_left_side > prop_right_side) ? isAsc : 0;
                });
                break;
            case 'DATETIME':
                this.pagedItems.sort(function (left_side, right_side): number {
                    let sort_o1_before_o2: any = this.dateHelperService.isBefore(left_side[prop_name], 'YYYY-MM-DD HH:mm:ss', right_side[prop_name], 'YYYY-MM-DD HH:mm:ss');
                    let sort_o1_after_o2: any = this.dateHelperService.isAfter(left_side[prop_name], 'YYYY-MM-DD HH:mm:ss', right_side[prop_name], 'YYYY-MM-DD HH:mm:ss');
                    return sort_o1_before_o2 ? isDesc : sort_o1_after_o2 ? isAsc : 0;
                }.bind(this));
                this.master.sort(function (left_side, right_side): number {
                    let sort_o1_before_o2: any = this.dateHelperService.isBefore(left_side[prop_name], 'YYYY-MM-DD HH:mm:ss', right_side[prop_name], 'YYYY-MM-DD HH:mm:ss');
                    let sort_o1_after_o2: any = this.dateHelperService.isAfter(left_side[prop_name], 'YYYY-MM-DD HH:mm:ss', right_side[prop_name], 'YYYY-MM-DD HH:mm:ss');
                    return sort_o1_before_o2 ? isDesc : sort_o1_after_o2 ? isAsc : 0;
                }.bind(this));
                break;
            default:
                break;
        }
    }

    public sortPropNameDetail(data_type: string, sort: string, key: string): void {
        let prop_name = ('prop_name' in this.header_detail[key]) ? this.header_detail[key].prop_name : key;
        let isDesc: number = 0;
        let isAsc: number = 0;
        switch (sort) {
            case 'DESC':
                isDesc = -1;
                isAsc = 1;
                this.header_detail[key].isDesc = false;
                this.header_detail[key].isAsc = true;
                break;
            case 'ASC':
                isDesc = 1;
                isAsc = -1;
                this.header_detail[key].isDesc = true;
                this.header_detail[key].isAsc = false;
                break;
            default:
                break;
        }

        switch (data_type) {
            case 'TEXT':
                this.detail.sort(function (left_side, right_side): number {
                    let prop_left_side: string = left_side[prop_name].toUpperCase();
                    let prop_right_side: string = right_side[prop_name].toUpperCase();
                    return (prop_left_side < prop_right_side) ? isDesc : (prop_left_side > prop_right_side) ? isAsc : 0;
                });
                break;
            case 'NUMBER':
                this.detail.sort(function (left_side, right_side): number {
                    let prop_left_side: number = Number(left_side[prop_name]);
                    let prop_right_side: number = Number(right_side[prop_name]);
                    return (prop_left_side < prop_right_side) ? isDesc : (prop_left_side > prop_right_side) ? isAsc : 0;
                });
                break;
            case 'DATETIME':
                this.detail.sort(function (left_side, right_side): number {
                    let sort_o1_before_o2: any = this.dateHelperService.isBefore(left_side[prop_name], 'YYYY-MM-DD HH:mm:ss', right_side[prop_name], 'YYYY-MM-DD HH:mm:ss');
                    let sort_o1_after_o2: any = this.dateHelperService.isAfter(left_side[prop_name], 'YYYY-MM-DD HH:mm:ss', right_side[prop_name], 'YYYY-MM-DD HH:mm:ss');
                    return sort_o1_before_o2 ? isDesc : sort_o1_after_o2 ? isAsc : 0;
                }.bind(this));
                break;
            default:
                break;
        }
    }

    private setSortProp(): void {
        for (let key in this.header_master) {
            if (this.header_master.hasOwnProperty(key)) {
                this.header_master[key].isAsc = false;
                this.header_master[key].isDesc = true;
            }
        }
    }

    private setSortPropDetail(): void {
        for (let key in this.header_detail) {
            if (this.header_detail.hasOwnProperty(key)) {
                this.header_detail[key].isAsc = false;
                this.header_detail[key].isDesc = true;
            }
        }
    }

    /** ===== PAGINATION ===== **/
    public setPage(page: number): void {
        if (page < 1 || page > this.pager.totalPages) {
            return;
        }

        // get pager object from service
        this.pager = this.paginationHelperService.getPager(this.master_data.length, page, this.pageSize);

        // get current page of items
        this.pagedItems = this.master_data.slice(this.pager.startIndex, this.pager.endIndex + 1);
    }
}
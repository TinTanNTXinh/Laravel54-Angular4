import {Component, OnInit, Input, Output, EventEmitter} from '@angular/core';

import {PaginationHelperService} from '../../services/helpers/pagination.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {DateHelperService} from '../../services/helpers/date.helper';

@Component({
    selector: 'xdatatable',
    templateUrl: './xdatatable.component.html',
    styleUrls: ['./xdatatable.component.css']
})
export class XDatatableComponent implements OnInit {

    /** ===== VARIABLES ===== **/
    public highlightRows: number[] = [];
    public selectedRow: number;
    public setClickedRow: Function;
    public isAsc: boolean = true;
    private body_data: any[];

    /** ===== VARIABLES PAGINATION ===== **/
    public pager: any = {};
    public pagedItems: any[];
    private pageSize: number = 10;

    constructor(private paginationHelperService: PaginationHelperService
        , private domHelperService: DomHelperService
        , private toastrHelperService: ToastrHelperService
        , private dateHelperService: DateHelperService) {

        this.clearSelectedAndHighlightRows();
        this.setClickedRow = function (index) {
            switch (this.settingClass) {
                case 'active':
                    this.selectedRow = index;
                    break;
                case 'highlight':
                    let index_in_body_data: number = index + (this.pager.currentPage * this.pageSize) - this.pageSize;
                    let found = this.highlightRows.find(o => o == index_in_body_data);
                    if (typeof found === "undefined")
                        this.highlightRows.push(index_in_body_data);
                    else {
                        let index_in_page = this.highlightRows.indexOf(index_in_body_data);
                        this.highlightRows.splice(index_in_page, 1);
                    }
                    break;
                default:
                    break;
            }
        };
    }

    ngOnInit() {
        this.setSortProp();
    }

    /** ===== INPUT ===== **/
    @Input() header: any;
    @Input() action: any = {
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
    @Input() settingClass: string = 'active';

    @Input() get body(): any[] {
        return this.body_data;
    }

    set body(obj: any[]) {
        this.pagedItems = [];
        this.body_data = obj;
        if (this.body_data.length > 0)
            this.setPage(1);
    }

    /** ===== OUTPUT ===== **/
    @Output() onClicked: EventEmitter<any> = new EventEmitter();

    public clicked(mode: string): void {

        switch (this.settingClass) {
            case 'highlight':
                this.onClicked.emit({highlight_rows: this.highlightRows, mode: mode});
                break;
            case 'active':
                let index = this.selectedRow + (this.pager.currentPage * this.pageSize) - this.pageSize;
                let data = this.body_data[index];
                if (typeof data !== 'undefined') {
                    this.onClicked.emit({index: index, mode: mode, data: data});
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
                            this.onClicked.emit({index: 0, mode: mode, data: {}});
                            break;
                        case 'EDIT':
                        case 'DELETE':
                            this.toastrHelperService.showToastr('warning', 'Vui lòng chọn một dòng dữ liệu!');
                            break;
                        default:
                            break;
                    }
                }
                break;
            default:
                break;
        }
    }

    /** ===== FUNCTION ACTION ===== **/
    public visible(key): boolean {
        return 'visible' in this.header[key] ? this.header[key]['visible'] : true;
    }

    /** ===== SELECTED & HIGHLIGHT ROW ===== **/
    public activeRow(index: number): boolean {
        if (this.settingClass == 'highlight') return false;
        return index == this.selectedRow;
    }

    public highlightRow(index: number): boolean {
        if (this.settingClass == 'active') return false;
        let index_in_body_data: number = index + (this.pager.currentPage * this.pageSize) - this.pageSize;
        let found = this.highlightRows.find(o => o == index_in_body_data);
        return (typeof found !== "undefined");
    }

    public changeSettingClass() {
        this.settingClass = (this.settingClass == 'active') ? 'highlight' : 'active';

        this.clearSelectedAndHighlightRows();
    }

    private clearSelectedAndHighlightRows(): void {
        this.selectedRow = 0;
        this.highlightRows = [];
    }

    /** ===== SORT ===== **/
    public sortIndex(mode: string): void {
        this.isAsc = !this.isAsc;
        this.pagedItems.reverse();
        this.body_data.reverse();
    }

    public sortPropName(data_type: string, sort: string, key: string): void {
        let prop_name = ('prop_name' in this.header[key]) ? this.header[key].prop_name : key;
        let isDesc: number = 0;
        let isAsc: number = 0;
        switch (sort) {
            case 'DESC':
                isDesc = -1;
                isAsc = 1;
                this.header[key].isDesc = false;
                this.header[key].isAsc = true;
                break;
            case 'ASC':
                isDesc = 1;
                isAsc = -1;
                this.header[key].isDesc = true;
                this.header[key].isAsc = false;
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
                this.body_data.sort(function (left_side, right_side): number {
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
                this.body_data.sort(function (left_side, right_side): number {
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
                this.body_data.sort(function (left_side, right_side): number {
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
        for (let key in this.header) {
            if (this.header.hasOwnProperty(key)) {
                this.header[key].isAsc = false;
                this.header[key].isDesc = true;
            }
        }
    }

    /** ===== PAGINATION ===== **/
    public setPage(page: number): void {
        if (page < 1 || page > this.pager.totalPages) {
            return;
        }

        // get pager object from service
        this.pager = this.paginationHelperService.getPager(this.body_data.length, page, this.pageSize);

        // get current page of items
        this.pagedItems = this.body_data.slice(this.pager.startIndex, this.pager.endIndex + 1);
    }
}

import {Component, OnInit, Input, Output, EventEmitter} from '@angular/core';

import {HttpClientService} from '../../services/httpClient.service';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';
import {PaginationHelperService} from '../../services/helpers/pagination.helper';

@Component({
    selector: 'master-detail',
    templateUrl: './master-detail.component.html',
    styles: []
})
export class MasterDetailComponent implements OnInit {

    /** Variables Master-Detail */
    public master_data: any[] = [];
    public activeRow: number = 0;

    /** Variable selected row */
    selectedRow: number;
    setClickedRow: Function;

    /** Variable sort index */
    public isAsc: boolean = true;

    /**
     * VARIABLE PAGINATION
     */
    pager: any = {};
    pagedItems: any[];
    pageSize: number = 10;

    constructor(private httpClientService: HttpClientService
        , private toastrHelperService: ToastrHelperService,
                private paginationHelperService: PaginationHelperService) {
        this.selectedRow = 0;
        this.setClickedRow = function (index) {
            this.selectedRow = index;
        };
    }

    ngOnInit() {

    }

    /** Input */
    @Input() setup: any = {};
    @Input() header_master: any = {};
    @Input() header_detail: any = {};
    @Input() detail: any[] = [];

    @Input() get master(): any[] {
        return this.master_data;
    }

    set master(obj: any[]) {
        this.master_data = obj;
        if (this.master_data.length > 0)
            this.setPage(1);
    }

    /** Output */
    public showDetail(id: number) {
        if (this.activeRow == id) {
            this.activeRow = 0;
            return;
        }
        this.httpClientService.get(`${this.setup.link}/${id}`).subscribe(
            (success: any) => {
                this.detail = success[this.setup.json_name];
                this.activeRow = id;
            },
            (error: any) => {
                this.toastrHelperService.showToastr('error');
            }
        );
    }

    /** Sort */
    public sortIndex(mode: string) {
        this.isAsc = !this.isAsc;
        this.pagedItems.reverse();
        this.master_data.reverse();
    }

    /**
     *  PAGINATION
     */
    /** Function */
    public setPage(page: number) {
        if (page < 1 || page > this.pager.totalPages) {
            return;
        }

        // get pager object from service
        this.pager = this.paginationHelperService.getPager(this.master_data.length, page, this.pageSize);

        // get current page of items
        this.pagedItems = this.master_data.slice(this.pager.startIndex, this.pager.endIndex + 1);
    }

    /** Visible column */
    public visible(value): boolean {
        if (typeof value === "undefined")
            return true;
        return value;
    }
}
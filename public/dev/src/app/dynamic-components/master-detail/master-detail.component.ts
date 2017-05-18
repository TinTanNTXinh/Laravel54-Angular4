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
    public detail_data: any[] = [];
    private header_master_data: any[] = [];
    private header_detail_data: any[] = [];
    private setup_data: any = {
        link: '',
        json_name: ''
    };
    public activeRow: number = 0;

    /** Variable selected row */
    selectedRow : number;
    setClickedRow : Function;

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
        this.setClickedRow = function(index){
            this.selectedRow = index;
        };
    }

    ngOnInit() {

    }
    /** Input */
    @Input() get setup(): string {
        return this.setup_data;
    }

    set setup(obj: string) {
        this.setup_data = obj;
    }

    @Input() get header_master(): any {
        return this.header_master_data;
    }
    set header_master(obj: any) {
        this.header_master_data = obj;
    }

    @Input() get header_detail(): any {
        return this.header_detail_data;
    }
    set header_detail(obj: any) {
        this.header_detail_data = obj;
    }

    @Input() get master(): any[] {
        return this.master_data;
    }
    set master(obj: any[]) {
        this.master_data = obj;
        if(this.master_data.length > 0)
            this.setPage(1);
    }

    @Input() get detail(): any[] {
        return this.detail_data;
    }
    set detail(obj: any[]) {
        this.detail_data = obj;
    }

    /** Output */
    public showDetail(id: number) {
        if (this.activeRow == id) {
            this.activeRow = 0;
            return;
        }
        this.httpClientService.get(`${this.setup_data.link}/${id}`).subscribe(
            (success: any) => {
                this.detail_data = success[this.setup_data.json_name];
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
        if(typeof value === "undefined")
            return true;
        return value;
    }
}
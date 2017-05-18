import {Component, Input, Output, EventEmitter} from '@angular/core';

import {PaginationHelperService} from '../../services/helpers/pagination.helper';
import {StringHelperService} from '../../services/helpers/string.helper';
import {DomHelperService} from '../../services/helpers/dom.helper';
import {ToastrHelperService} from '../../services/helpers/toastr.helper';

@Component({
    selector: 'xdatatable',
    templateUrl: './xdatatable.component.html',
    styles: []
})
export class XDatatableComponent {

    /** Variables */
    selectedRow : number;
    setClickedRow : Function;
    public isAsc: boolean = true;
    public id_pagination: string;
    public header_data: any[];
    private body_data: any[];
    public action_data: any = {
        ADD: true,
        EDIT: true,
        DELETE: true
    };

    /**
     * VARIABLE PAGINATION
     */
    // pager object
    pager: any = {};
    // paged items
    pagedItems: any[];
    pageSize: number = 10;


    constructor(private paginationHelperService: PaginationHelperService,
            private stringHelperService: StringHelperService,
            private domHelperService: DomHelperService,
            private toastrHelperService: ToastrHelperService) {
        this.id_pagination = this.stringHelperService.randomString();
        this.selectedRow = 0;
        this.setClickedRow = function(index){
            this.selectedRow = index;
        };
    }

    /** Input */
    @Input() get header(): any {
        return this.header_data;
    }

    set header(obj: any) {
        this.header_data = obj;
    }

    @Input() get body(): any[] {
        return this.body_data;
    }

    set body(obj: any[]) {
        this.pagedItems = [];
        this.body_data = obj;
        if(this.body_data.length > 0)
            this.setPage(1);
    }

    @Input() get action(): any {
        return this.action_data;
    }

    set action(obj: any) {
        this.action_data = obj;
    }

    /** Output */
    @Output() onClicked: EventEmitter<any> = new EventEmitter();
    clicked(mode: string) {
        switch (mode) {
            case 'add':
                this.onClicked.emit({index: 0, mode: mode, data: {}});
                break;
            case 'edit':
            case 'delete':
                let index = this.selectedRow + (this.pager.currentPage * this.pageSize) - this.pageSize;
                let data = this.body_data[index];
                if(typeof data !== 'undefined') {
                    this.onClicked.emit({index: index, mode: mode, data: data});
                    if(mode == 'delete')
                        this.domHelperService.getElementById('btn-show-modal').click();
                }
                else
                    this.toastrHelperService.showToastr('warning', 'Vui lòng chọn một dòng dữ liệu!');
                break;
            default: break;
        }

    }

    /** Visible column */
    public visible(value): boolean {
        if(typeof value === "undefined")
            return true;
        return value;
    }

    /** Sort */
    public sortIndex(mode: string) {
        this.isAsc = !this.isAsc;
        this.pagedItems.reverse();
        this.body_data.reverse();
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
        this.pager = this.paginationHelperService.getPager(this.body_data.length, page, this.pageSize);

        // get current page of items
        this.pagedItems = this.body_data.slice(this.pager.startIndex, this.pager.endIndex + 1);
    }
}

/*
public header = {
    code: {
        title: "Mã"
    },
    name: {
        title: "Tên"
    },
    edit: {
        title: "Sua"
    }
};

public body = [
    {
        name: 'your name 1',
        code: '111',
        edit: "<button class=\"btn btn-primary\">Sua</button>"
    },
    {
        name: 'your name 2',
        code: '222',
        edit: "<button class=\"btn btn-primary\">Sua</button>"
    },
    {
        name: 'your name 3',
        code: '333',
        edit: "<button class=\"btn btn-primary\">Sua</button>"
    },
];
<xdatatable [body]="body" [header]="header"></xdatatable>
*/

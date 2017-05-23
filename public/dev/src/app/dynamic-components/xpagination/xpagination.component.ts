import { Component, Input } from '@angular/core';

import {PaginationHelperService} from '../../services/helpers/pagination.helper';

@Component({
    selector: 'xpagination',
    templateUrl: './xpagination.component.html'
})

export class XPaginationComponent {

    /** Variables */
    // array of all items to be paged
    private allItems: any[];

    // pager object
    public pager: any = {};

    // paged items
    public pagedItems: any[];

    constructor(private paginationHelperService: PaginationHelperService) {

    }

    /** Input */
    @Input() get data(): any[] {
        return this.allItems;
    }

    set data(obj: any[]) {
        this.allItems = obj;
        this.setPage(1);
    }

    /** Function */
    public setPage(page: number): void {
        if (page < 1 || page > this.pager.totalPages) {
            return;
        }

        // get pager object from service
        this.pager = this.paginationHelperService.getPager(this.allItems.length, page);

        // get current page of items
        this.pagedItems = this.allItems.slice(this.pager.startIndex, this.pager.endIndex + 1);
    }
}
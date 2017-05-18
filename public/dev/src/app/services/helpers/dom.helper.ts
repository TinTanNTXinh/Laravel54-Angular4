import {Injectable} from '@angular/core';

declare let $: any;

@Injectable()
export class DomHelperService {
    constructor() {

    }

    /** DOM */
    public showTab(id: string): void {
        $('a[href="#' + id + '"]').tab('show');
    }

    public toggleModal(id: string): void {
        $('#' + id).modal('toggle');
    }

    public getElementById(id: string) {
        return document.getElementById(id);
    }

    /** Table */
    public addColorSelectedRowTable(id) {
        $(`#${id}`).on('click', 'tbody tr', function(event) {
            $(this).addClass('highlight').siblings().removeClass('highlight');
        });
    }
}

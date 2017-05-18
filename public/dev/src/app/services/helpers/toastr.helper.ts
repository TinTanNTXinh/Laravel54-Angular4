import {Injectable} from '@angular/core';

declare let toastr: any;

@Injectable()
export class ToastrHelperService {
    constructor() {
        this.configJQToastr();
    }

    /** jQuery toastr */
    public showToastr(mode: string, message?: string, title?: string): void {
        switch (mode) {
            case 'success':
            case 'info':
                title = (typeof title === 'undefined') ? 'Thông báo!' : title;
                break;
            case 'warning':
                title = (typeof title === 'undefined') ? 'Cảnh báo!' : title;
                break;
            case 'error':
                message = (typeof message === 'undefined') ? 'Kết nối với máy chủ thất bại! Vui lòng thử lại sau.' : message;
                title = (typeof title === 'undefined') ? 'Cảnh báo!' : title;
                break;
            default: break;
        }
        toastr[mode](message, title);
    }

    private configJQToastr() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
}

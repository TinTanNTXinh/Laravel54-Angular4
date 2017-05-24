import {Pipe, SecurityContext} from '@angular/core';
import {DomSanitizer} from '@angular/platform-browser';

@Pipe({name: 'safeHtml'})
export class SafeHtmlPipe {
    constructor(private sanitizer:DomSanitizer){}

    transform(style) {
        // return this.sanitizer.bypassSecurityTrustStyle(style);
        // return this.sanitizer.sanitize(SecurityContext.HTML, style);
        return this.sanitizer.bypassSecurityTrustHtml(style);
        // return this.sanitizer.bypassSecurityTrustXxx(style); - see docs
    }
}
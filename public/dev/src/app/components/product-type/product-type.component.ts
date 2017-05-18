import { Component, OnInit } from '@angular/core';

@Component({
    selector: 'app-product-type',
    templateUrl: './product-type.component.html'
})
export class ProductTypeComponent implements OnInit {
    
    /**
     *
     */
    constructor() {
        //called first time before the ngOnInit()

    }

    ngOnInit() {
        //called after the constructor and called  after the first ngOnChanges() 
    }
}

import { Component, Input, OnInit } from '@angular/core';
import { FormGroup } from '@angular/forms';

@Component({
    selector: 'formula-transport',
    templateUrl: 'formula-transport.component.html',
})
export class FormulaTransportComponent implements OnInit{
    @Input('group')
    public formulaForm: FormGroup;

    public type: string;
    public name: string;
    public value1: any;
    public value2: any;

    constructor() {
    }

    ngOnInit() {
        this.type = this.formulaForm.get('type').value;
        this.name = this.formulaForm.get('name').value;
        this.value1 = this.formulaForm.get('value1').value;
        this.value2 = this.formulaForm.get('value2').value;
    }

}
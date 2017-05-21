import { Component, Input, OnInit } from '@angular/core';
import { FormGroup } from '@angular/forms';

@Component({
    selector: 'formula',
    templateUrl: 'formula.component.html',
})
export class FormulaComponent implements OnInit{
    @Input('group')
    public formulaForm: FormGroup;

    public type: string;

    constructor() {
    }

    ngOnInit() {
        this.type = this.formulaForm.get('type').value;
    }

}
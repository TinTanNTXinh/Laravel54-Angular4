import { Component, Input, OnInit } from '@angular/core';
import { FormGroup } from '@angular/forms';

@Component({
    selector: 'formula',
    templateUrl: 'formula.component.html',
})
export class FormulaComponent implements OnInit{
    @Input('group')
    public formulaForm: FormGroup;

    public rule: string;

    constructor() {
    }

    ngOnInit() {
        this.rule = this.formulaForm.get('rule').value
    }

}
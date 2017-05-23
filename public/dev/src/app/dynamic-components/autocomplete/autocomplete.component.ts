import {Component, ElementRef, Input, Output, EventEmitter, forwardRef} from '@angular/core';

import {ControlValueAccessor, NG_VALUE_ACCESSOR} from '@angular/forms';
@Component({
    selector: 'autocomplete',
    templateUrl: './autocomplete.component.html',
    styleUrls: ['./autocomplete.component.css'],
    host: {
        '(document:click)': 'handleClick($event)',
        '(keydown)': 'handleKeyDown($event)'
    },
    providers: [
        {
            provide: NG_VALUE_ACCESSOR,
            useExisting: forwardRef(() => AutoCompleteComponent),
            multi: true
        }
    ]
})
export class AutoCompleteComponent implements ControlValueAccessor {

    /** NgModel */
    @Input() model_name: string = 'id';
    @Input('value') _value: any = null;
    onChange: any = () => {
    };
    onTouched: any = () => {
    };

    get value() {
        return this._value;
    }

    set value(val) {
        this._value = val;
        this.onChange(val);
        this.onTouched();
    }

    registerOnChange(fn) {
        this.onChange = fn;
    }

    registerOnTouched(fn) {
        this.onTouched = fn;
    }

    writeValue(value) {
        if (value) {
            this._value = value;
        }
    }

    /** Variables */
    query: string = '';
    filteredList: any[] = [];
    elementRef: ElementRef;
    pos: number = -1;
    opened: boolean = false;
    selectedItem: any;
    item: any;

    constructor(private el: ElementRef) {
        this.elementRef = el;
    }

    /** Input */
    @Input() placeholder: string = '';
    @Input() name: string = 'name';
    @Input() data: any[] = [];

    /** Output */
    @Output() onClicked: EventEmitter<any> = new EventEmitter();

    /** Function */
    private filterQuery() {
        this.filteredList = this.data.filter((el: any) => {
            return el[this.name].toLowerCase().indexOf(this.query.toLowerCase()) > -1;
        });
    }

    public filter(event: any) {
        if (this.query !== '') {
            if (this.opened) {

                /*
                 48 -> 57 : 0 -> 9
                 65 -> 90 : a -> z
                 8        : backspace
                 38       : Up Arrow
                 40       : Down Arrow
                 13       : Enter
                 */
                if ((event.keyCode >= 48 && event.keyCode <= 57) ||
                    (event.keyCode >= 65 && event.keyCode <= 90) ||
                    (event.keyCode == 8)) {

                    this.pos = 0;
                    this.filterQuery();

                } else if (event.keyCode != 38 && event.keyCode != 40 && event.keyCode != 13) {
                    this.filteredList = this.data;
                }
            } else {
                this.filterQuery();
            }
        } else {
            if (this.opened) {
                this.filteredList = this.data;
            } else {
                this.filteredList = [];
            }
        }

        for (let i = 0; i < this.filteredList.length; i++) {
            this.filteredList[i].selected = false;
        }

        if (this.selectedItem) {
            this.filteredList.map((i) => {
                if (i.id == this.selectedItem.id) {
                    this.pos = this.filteredList.indexOf(i);
                }
            });
            this.selectedItem = null;
            this.value = null;
        }

        // Arrow-key Down
        if (event.keyCode == 40) {
            if (this.pos + 1 != this.filteredList.length)
                this.pos++;
        }

        // Arrow-key Up
        if (event.keyCode == 38) {
            if (this.pos > 0)
                this.pos--;
        }

        if (this.filteredList[this.pos] !== undefined)
            this.filteredList[this.pos].selected = true;

        // Enter
        if (event.keyCode == 13) {
            if (this.filteredList[this.pos] !== undefined) {
                this.select(this.filteredList[this.pos]);
            }
        }

        // Handle scroll position of item
        let listGroup = document.getElementById('list-group');
        let listItem = document.getElementById('true');
        if (listItem) {
            listGroup.scrollTop = (listItem.offsetTop - 200);
        }
    }

    public select(item: any): void {
        this.selectedItem = item;
        this.selectedItem.selected = true;
        this.query = item[this.name];
        this.filteredList = [];
        this.onClicked.emit(this.selectedItem);
        this.value = this.selectedItem[this.model_name];
    }

    public showAll(input: any): void {
        input.select();

        if (this.filteredList.length > 0) {
            this.opened = false;
            this.filteredList = [];
        } else {
            this.opened = true;
            this.filteredList = this.data;
        }
        if (this.query === '') {
            this.clearAll();
        }

        this.clearSelects();
    }

    handleKeyDown(event: any): void {
        // Prevent default actions of arrows
        if (event.keyCode == 40 || event.keyCode == 38) {
            event.preventDefault();
        }
    }

    private clearAll(): void {
        if (this.filteredList) {
            for (let i = 0; i < this.filteredList.length; i++)
                this.filteredList[i].selected = false;
        }
    }

    /** Remove selected from all items of the list **/
    private clearSelects(): void {
        if (this.selectedItem) {
            for (let i = 0; i < this.filteredList.length; i++) {
                if (this.filteredList[i].id != this.selectedItem.id)
                    this.filteredList[i].selected = false;
            }
        }
    }

    /** Handle outside click to close suggestions**/
    handleClick(event: any): void {
        let clickedComponent = event.target;
        let inside = false;
        do {
            if (clickedComponent === this.elementRef.nativeElement) {
                inside = true;
            }
            clickedComponent = clickedComponent.parentNode;
        } while (clickedComponent);
        if (!inside) {
            this.filteredList = [];
            this.opened = false;
        }
    }

    public clear(): void {
        this.clearSelects();
        this.selectedItem = null;
        this.query = '';
        this.clearAll();
        this.onClicked.emit({id: 0});
        this.value = null;
    }
}
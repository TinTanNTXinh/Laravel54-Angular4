import {Component, ElementRef, Input, Output, EventEmitter, OnChanges} from '@angular/core';

@Component({
    selector: 'xautocomplete',
    templateUrl: './xautocomplete.component.html',
    styleUrls: ['./xautocomplete.component.css'],
    host: {
        '(document:click)': 'handleClick($event)',
        '(keydown)': 'handleKeyDown($event)'
    }
})
export class XAutoCompleteComponent implements OnChanges {

    /** ===== BINDING DATA ===== **/
    private _value: number = 0;

    @Input()
    get value() {
        return this._value;
    }

    @Output() valueChange = new EventEmitter();

    set value(val) {
        this._value = val;
        this.valueChange.emit(this._value);
    }

    /** ===== VARIABLES ===== **/
    public query: string = '';
    public filteredList: any[] = [];
    private elementRef: ElementRef;
    private pos: number = -1;
    private opened: boolean = false;
    private selectedItem: any;

    // http://keycode.info/
    private key_codes_deny: any[] = [17, 16, 20, 9, 192, 27
        , 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123
        , 18, 91, 92, 93, 42, 19, 45, 36, 33, 35, 34, 37, 39, 144];

    constructor(private el: ElementRef) {
        this.elementRef = el;
    }

    ngOnChanges() {
        this.selectByValue();
    }

    /** ===== INPUT ===== **/
    @Input() model_name: string = 'id';
    @Input() placeholder: string = '';
    @Input() name: string = 'name';
    @Input() data: any[] = [];

    /** ===== OUTPUT ===== **/
    @Output() onClicked: EventEmitter<any> = new EventEmitter();

    /** ===== FUCTION HANDLE ===== **/

    // Handle outside click to close suggestions
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

    // Prevent default actions of Up & Down arrows
    handleKeyDown(event: any): void {
        if (event.keyCode == 40 || event.keyCode == 38) {
            event.preventDefault();
        }
    }

    /** ===== FUNCTION ACTION ===== **/
    /**
     * Filter item
     * @event {KeyboardEvent} event
     */
    public filter(event: KeyboardEvent): void {
        // Validate key code
        if (this.key_codes_deny.includes(event.keyCode)) {
            return;
        }
        if (event.ctrlKey && !this.key_codes_deny.includes(event.keyCode)) {
            return;
        }
        if (event.altKey && !this.key_codes_deny.includes(event.keyCode)) {
            return;
        }

        if (this.query !== '') {
            if (this.opened) {
                /*
                 48 -> 57 : 0 -> 9
                 65 -> 90 : a -> z
                 8        : backspace
                 38       : Up Arrow
                 40       : Down Arrow
                 13       : Enter
                 32       : Space
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

        this.clearAll();

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

    /**
     * Select one item
     * @item {any} item
     */
    public select(item: any): void {
        this.selectedItem = item;
        this.selectedItem.selected = true;
        this.query = item[this.name];
        this.filteredList = [];
        this.onClicked.emit(this.selectedItem);
        this.value = this.selectedItem[this.model_name];
    }

    /**
     * Show all items
     * @input {any} input
     */
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

    /**
     * Clear selected item
     */
    public clear(): void {
        this.clearSelects();
        this.selectedItem = null;
        this.query = '';
        this.clearAll();
        this.onClicked.emit({id: 0});
        this.value = null;
    }

    /** ===== FUNCTION ===== **/

    /**
     * Find filtered list
     */
    private filterQuery() {
        this.filteredList = this.data.filter((el: any) => {
            return el[this.name].toLowerCase().indexOf(this.query.toLowerCase()) > -1;
        });
    }

    /**
     * Remove selected from all items
     */
    private clearAll(): void {
        if (this.filteredList) {
            this.filteredList.forEach(function (item) {
                item.selected = false;
                return item;
            });
        }
    }

    /**
     * Remove selected from all items except item selected
     */
    private clearSelects(): void {
        if (this.selectedItem) {
            this.filteredList.forEach(function (item) {
                if (item.id !== this.selectedItem.id)
                    item.selected = false;
                return item;
            }, this);
        }
    }

    /**
     * Set selected item by value
     */
    private selectByValue(): void {
        if (this.data.length > 0) {
            if (this.value == 0) {
                this.clearSelects();
                this.selectedItem = null;
                this.query = '';
                this.clearAll();
            } else if (!!this.value) {
                let item = this.data.find(o => o.id == this.value);
                this.selectedItem = item;
                this.selectedItem.selected = true;
                this.query = item[this.name];
                this.filteredList = [];
            }
        }
    }
}
interface ISearch {
    filtering: any;
    search(): void;
    reloadDataSearch(arr_data: any[]): void;
    clearSearch(): void;
    displayColumn(): void;
}

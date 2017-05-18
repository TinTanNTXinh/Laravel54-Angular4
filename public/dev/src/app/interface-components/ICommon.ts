interface ICommon {

    title: string;
    placeholder_code: string;
    prefix_url: string;
    isLoading: boolean;
    header: any;
    action_data: any;

    /** Data */
    loadData(): void;
    reloadData(arr_data: any[]): void;
    refreshData(): void;

    /** Action */
    changeLoading(status: boolean): void;
}

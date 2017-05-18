<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Device;
use App\ButtonProduct;
use App\Distributor;
use App\Supplier;
use App\IOCenter;
use DB;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    private $tray_id;
    public $supplier, $distributor, $cabinet, $tray, $tray_products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tray_id)
    {
        $this->tray_id = $tray_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->tray    = Device::find($this->tray_id);
        $this->cabinet = Device::find($this->tray->parent_id);
        $io_center     = IOCenter::find($this->cabinet->io_center_id);

        $this->distributor = Distributor::find($io_center->dis_id);
        $this->supplier    = Supplier::find($this->distributor->sup_id);

        $tray_ids            = Device::whereActive(true)->where('parent_id', $this->cabinet->id)->pluck('id')->toArray();
        $this->tray_products = ButtonProduct::where('button_products.active', true)
            ->whereIn('button_id', $tray_ids)
            ->leftJoin('devices', 'devices.id', '=', 'button_products.button_id')
            ->leftJoin('products', 'products.id', '=', 'button_products.product_id')
            ->leftJoin('units', 'units.id', '=', 'products.unit_id')
            ->leftJoin('product_prices', 'product_prices.product_id', '=', 'products.id')
            ->select('button_products.total_quantum', 'devices.name as tray_name', 'products.name as product_name', 'products.barcode as product_barcode', 'units.name as unit_name', DB::raw('CONCAT(FORMAT(product_prices.price_input, 0), \' đ\') as fc_price_input'))
            ->get();
        if($this->supplier->email)
            return $this->to($this->supplier->email)->view('mails.reminder');
        return $this->to('ntxinh@tintansoft.com')->view('mails.reminder');
    }
}

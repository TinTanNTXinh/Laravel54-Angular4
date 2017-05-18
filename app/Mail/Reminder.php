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
        return $this->to('ntxinh@tintansoft.com')->view('mails.reminder');
    }
}

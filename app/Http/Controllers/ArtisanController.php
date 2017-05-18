<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Artisan;

class ArtisanController extends Controller
{

    public function __construct()
    {
    }

    public function getCommandReset(Request $request)
    {
        // Roll back all migrations and migrate them again
//        Artisan::call('migrate:refresh');
        // Fill tables with seeds
//        Artisan::call('db:seed');

        $exitCode = Artisan::call('migrate:refresh', [
            '--seed' => true,
        ]);
        $msg = 'Reset data is ';
        $msg .= ($exitCode == 0) ? 'successful.' : 'failure.';
        return response()->json(['msg' => $msg, 'exit_code' => $exitCode], 200);
    }
}

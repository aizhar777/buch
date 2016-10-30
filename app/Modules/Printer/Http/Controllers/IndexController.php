<?php

namespace App\Modules\Printer\Http\Controllers;

use App\Trade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function printTrade($id, $type, $format = 'L', $output = 'html')
    {
        $trade = Trade::whereId($id)->with('statuses','ppCode','client','supervisor','completer','products')->firstOrFail();

        switch ($type){
            case 'check':
                $result = $this->printCheck($trade, $format, $output);
                break;
            case 'invoice':
                $result = $this->printCheck($trade, $format, $output);
                break;
            case 'certificate':
                $result = $this->printCheck($trade, $format, $output);
                break;
            case 'order':
                $result = $this->printCheck($trade, $format, $output);
                break;
            default:
                $result = abort(404);
        }
        return $result;
    }

    public function printCheck(Trade $trade, $format, $output){
        return view('printer::check', ['trade' => $trade]);
    }

    public function printInvoice(Trade $trade, $format, $output){}
    public function printCertificate(Trade $trade, $format, $output){}
    public function printOrder(Trade $trade, $format, $output){}
}

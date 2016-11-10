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
        $trade = Trade::findByIdWithAllRelations($id);

        switch ($type){
            case 'check':
                $result = $this->printCheck($trade, $format, $output);
                break;
            case 'invoice':
                $result = $this->printInvoice($trade, $format, $output);
                break;
            case 'certificate':
                $result = $this->printCertificate($trade, $format, $output);
                break;
            case 'order':
                $result = $this->printOrder($trade, $format, $output);
                break;
            default:
                $result = abort(404);
        }

        return $result;
    }

    public function printCheck(Trade $trade, $format, $output)
    {
        return view('printer::check', ['trade' => $trade]);
    }

    public function printInvoice(Trade $trade, $format, $output)
    {
        return view('printer::invoices', ['trade' => $trade->toArray()]);
    }

    public function printCertificate(Trade $trade, $format, $output)
    {
        return view('printer::certificate_of_completion', ['trade' => $trade]);
    }

    public function printOrder(Trade $trade, $format, $output)
    {
        return view('printer::cash_order', ['trade' => $trade]);
    }
}

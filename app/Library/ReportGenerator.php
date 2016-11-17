<?php

namespace App\Library;


use App\Client;
use App\Library\Interfaces\ReportGeneratorInterface;
use App\Product;
use App\Report;
use App\Stock;
use App\Subdivision;
use App\Trade;
use App\User;

class ReportGenerator implements ReportGeneratorInterface
{
    /**
     * Generate report
     *
     * @return void
     */
    public function generate()
    {
        Report::create([
            'users' => $this->reportUsers(),
            'subdivisions' => $this->reportSubdivisions(),
            'stocks' => $this->reportStocks(),
            'trades' => $this->reportTrades(),
            'products' => $this->reportProducts(),
            'clients' => $this->reportClients(),
            'money' => $this->reportMoney(),
        ]);
    }

    protected function reportUsers(){
        return User::count();
    }
    protected function reportClients(){
        return Client::count();
    }
    protected function reportProducts(){
        return Product::count();
    }
    protected function reportTrades(){
        return Trade::count();
    }
    protected function reportSubdivisions(){
        return Subdivision::count();
    }
    protected function reportStocks(){
        return Stock::count();
    }
    protected function reportMoney(){
        $trades = Trade::wherePaymentIsCompleted(1);
        if($trades->count() > 0){
            $total = (double)0;
            foreach ($trades as $trade){
                $summ = (double)0;
                foreach ($trade->products as $product){
                    $summ +=  (double)$product->pivot->quantity * (double)$product->price;
                }
                $total += (double)$summ;
            }
            return $total;
        }else{
            return 0.0;
        }
    }
}
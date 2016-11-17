<?php

namespace App\Library\Interfaces;


interface ReportGeneratorInterface
{
    /**
     * Generate report
     *
     * @return void
     */
    public function generate();
}
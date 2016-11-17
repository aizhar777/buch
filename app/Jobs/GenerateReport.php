<?php

namespace App\Jobs;

use App\Library\Interfaces\ReportGeneratorInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateReport implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ReportGeneratorInterface $report
     */
    public $report;


    /**
     * Create a new job instance.
     *
     * @param ReportGeneratorInterface $generator
     */
    public function __construct(ReportGeneratorInterface $generator)
    {
        $this->report = $generator;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->report->generate();
    }
}

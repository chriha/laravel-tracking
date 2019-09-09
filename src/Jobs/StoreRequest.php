<?php

namespace Chriha\LaravelTracking\Jobs;

use Chriha\LaravelTracking\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoreRequest implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var array */
    private $request;


    /**
     * Create a new job instance.
     * @param array $request
     */
    public function __construct( array $request )
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        return Request::create( $this->request );
    }
}

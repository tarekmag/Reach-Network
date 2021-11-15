<?php

namespace App\Console\Commands;

use App\Models\Ad;
use App\Enums\Define;
use App\Models\Advertiser;
use App\Mail\AdRemainderEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AdCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ad:next-remainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule a daily email at 08:00 PM that will be sent to advertisers who have ads the next day as a remainder.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Ad Command Next Remainder is Start');
        
        $result = Ad::whereDate('start_date', now()->addDays(1)->format(Define::DATE_FORMAT))->with(['advertiser', 'category', 'tags'])->has('advertiser')->get();

        $this->output->progressStart($result->count());

        $collection = collect($result->toArray());

        $grouped = $collection->groupBy('advertiser_id');

        foreach($grouped->all() as $key => $row)
        {
            $advertiser = Advertiser::find($key);
            Mail::to($advertiser->email)->send(new AdRemainderEmail($advertiser, $row));
        }
        $this->output->progressFinish();
        
        $this->info('Ad Command Next Remainder is Ended');
    }
}

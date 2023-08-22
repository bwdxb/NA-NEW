<?php

namespace App\Console\Commands;

use App\MarketPlace;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AdvertsScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:advert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The Adverts in the MarketPlace has to be deleted off the system if not removed/ updated within 2 months by the employee & alert user(employees) when prior to submitted their advert - 3 days in advance reminder prior to deletion';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $todayDate;
    private $deleteAdventDate;
    private $notifyAdventDate;

    public function __construct()
    {
        parent::__construct();
        $this->todayDate = Carbon::today();
        $this->deleteAdventDate = $this->todayDate->subMonths(2);
        $this->notifyAdventDate = $this->deleteAdventDate->subDays(3);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Log::error('timestamp->' . date("Y-m-d H:i:s"));
            Log::error('---------------------start--------------------------------');

            $deleteAdvents = MarketPlace::where('updated_at', '<=',$this->deleteAdventDate)
            ->delete();
            // dd([
            //     'deleteAdvents'=>$deleteAdvents,
            //     'deleteAdventDate'=>$this->deleteAdventDate,
            // ]);

            $notifyAdvents = MarketPlace::where('updated_at', '<=',$this->deleteAdventDate)
            ->get();

            Log::error('----------------------end--------------------------------');
        } catch (\Exception $e) {
            Log::error(date("Y-m-d H:i:s") . auth()->user());
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return 0;
        }
    }

}

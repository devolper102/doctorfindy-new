<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Appointment;
use Carbon\Carbon;
class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
              $allAppointment = Appointment::with('order')->orderBy("id","desc")->get(); 
             foreach ($allAppointment as $app){
               // dd($app);
                $app_created = $app->created_at->addMinutes(30)->format('M d, Y H:i');
                $date = new Carbon();
            $today_date = $date->now()->format('M d, Y H:i');
           // dd($app_created,$today_date);
            if ($app_created === $today_date) {
                if ($app->order != null) {
                    // if ($app->order->status === 'pending') {
                    //      $status = Appointment::where('id',$app->id)->update(array('status'=>'cancel'));
                    // }
                }
                else{
                     $status = Appointment::where('id',$app->id)->update(array('status'=>'cancel'));
                }
            }
        }

            // $id = 42;
            // DB::table('appointments')
            //   ->where('id', $id)
            //   ->update(array('status'=>'cancel'));

    }
}

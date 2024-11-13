<?php

namespace App\Console\Commands;

use App\Models\Enrollment;
use App\Notifications\StudentNotFinishedCourseNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $enrollments = Enrollment::all();
        foreach($enrollments as $enrollment){
            $user = $enrollment->user;
            $timezone = $user->timezone;
            $time = Carbon::now($timezone)->format('H:i');
            if($time == '15:22' && $enrollment->progress!= 100){
                $user->notify(new StudentNotFinishedCourseNotification($enrollment));
            }
        }
    }
}

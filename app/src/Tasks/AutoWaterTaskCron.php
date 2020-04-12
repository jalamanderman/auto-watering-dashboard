<?php

use SilverStripe\CronTask\Interfaces\CronTask;

class AutoWaterTaskCron implements CronTask {

    protected $title = 'Cron to run notices task which compiles the JSON data for the notices map';
    protected $enabled = true;

    public function getSchedule() {
//            return "0 22 */2 * * "; //run every 2 days at 10pm
        return "*/2 * * * *"; //run every minute

    }

    public function process() {
        $AutoWaterTask = new AutoWaterTask();
        $AutoWaterTask->run($request = null);

        $dashboard = Dashboard::get()->first();

        if ($dashboard->AutoWatering == 'ON') {
            $AutoWaterTask->run($request = null);
        }
    }
}



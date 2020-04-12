<?php

namespace {
    use SilverStripe\CronTask\Interfaces\CronTask;

    class AutoWaterTaskCron implements CronTask {

        protected $title = 'Cron to run notices task which compiles the JSON data for the notices map';
        protected $enabled = true;

        public function getSchedule() {
            return "0 22 */2 * * "; //run every 2 days at 10pm
        }

        public function process(){

            $AutoWaterTask = new AutoWaterTask();
            $dashboard = Dashboard::get()->first();

            if ($dashboard->AutoWatering == 'ON') {
                $AutoWaterTask->run($request=null);
            }
        }
    }
}


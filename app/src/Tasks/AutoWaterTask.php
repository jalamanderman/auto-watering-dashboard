<?php


    use SilverStripe\Core\Injector\Injector;
    use SilverStripe\Control\HTTPRequest;
    use SilverStripe\Dev\BuildTask;

    class AutoWaterTask extends BuildTask {

        protected $title = 'Auto water task';
        protected $description = 'Sets auto watering on/off';
        protected $enabled = true;
        protected $Config;

        /**
         * Run the task
         **/

        function run($request) {
            if (!empty($request)) {
                $params = $request->requestVars();
            }

            // Run it twice
            $this->doAutoWater();

            echo '<br/>' . ' <br/>' . 'Cron task completed successfully.';


            return array();
        }

        public function doAutoWater() {
            $submission = FormSubmission::create();

            exec("echo '1-1' |sudo tee /sys/bus/usb/drivers/usb/bind");
            sleep(3);
            exec("echo '1-1' |sudo tee /sys/bus/usb/drivers/usb/unbind");

            $submission->write();

            //set submission session and redirect submitter
            $request = Injector::inst()->get(HTTPRequest::class);
        }

}

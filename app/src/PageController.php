<?php

use SilverStripe\Control\Director;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\DatetimeField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\Requirements;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\HTTPRequest;

class PageController extends ContentController {
    private static $allowed_actions = [
        'WaterOnce',
        'submitted',
        'ToggleAuto',
        'ToggleAutoBool'
    ];

    public function LastWatered() {
        $last_watered = FormSubmission::get()->First()->Created;

        function time_elapsed_string($datetime, $full = false) {
            $now = new DateTime;
            $ago = new DateTime($datetime);
            $diff = $now->diff($ago);

            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;

            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }

            if (!$full) {
                $string = array_slice($string, 0, 1);
            }
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        }

        return  time_elapsed_string($last_watered);
    }



    public function doToggleAutoBool(){

        $dashboard = Dashboard::get()->First();
//            $dashboard->AutoWaterting = 0;
        $dashboard->AutoWaterting = false;
        echo $dashboard->AutoWaterting;


//            die;

//            echo $dashboard->AutoWaterting;
//            die;
        $dashboard->Write();
        $dashboard->doRestoreToStage();

        $this->redirect($this->Link());
    }

    public function ToggleAutoBool() {
        $fields = FieldList::create();
        $actions = FieldList::create(FormAction::create('doToggleAutoBool', 'Toggle'));
        return Form::create($this, 'ToggleAutoBool', $fields, $actions);
    }

    public function WaterOnce() {
        $fields = FieldList::create();
        $actions = FieldList::create(FormAction::create('doWaterOnce', 'Water'));
        return Form::create($this, 'WaterOnce', $fields, $actions);
    }

    public function doWaterOnce($data) {
        $submission = FormSubmission::create();
        $submission->Payload = json_encode($data);
        $submission->OriginID = $this->ID;
        $submission->OriginClass = $this->ClassName;

        exec("echo '1-1' |sudo tee /sys/bus/usb/drivers/usb/bind");
        sleep(1);
        exec("echo '1-1' |sudo tee /sys/bus/usb/drivers/usb/unbind");

        $submission->write();

        //set submission session and redirect submitter
        $request = Injector::inst()->get(HTTPRequest::class);
        $session = $request->getSession();
        $session->set($this->ClassName . '_Form_Sent', true);
        $this->redirect($this->Link());
    }

    public function FormSubmissions() {
        return FormSubmission::get();
    }

//       Create the list of water data (days which have had a watering event occur)
    public function WaterData() {
        $water = FormSubmission::get()->toArray();

//            foreach ($water as $key => $val) {
//                echo $val->Created . '<br/>';
//            }

        $waterArray = [];

        foreach ($water as $key => $val) {
            array_push($waterArray, explode(" ", $val->Created)[0]);
        }

        return $this->RefineData($waterArray);
    }


//      Create the list of refined data. This includes days which have had no watering events
    public function RefineData($data) {
        // First count the occurances of watering events on the days which have had water
        $refined = array_count_values($data);

        $waterArray = [];
        // We give the values a associative title
        foreach ($refined as $key => $val) {
            array_push($waterArray, ['date' => $key, 'qty' => $val]);
        }

        // We set the dates for the chart
        $begin = new DateTime(date("y-m-d", strtotime("-7 day"))); //or given date
        $end = new DateTime(date("y-m-d"));
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);

        $chartData = [];

        foreach ($daterange as $date) {
            $dataKey = array_search($date->format("Y-m-d"), array_column($waterArray, 'date'));
            if ($dataKey !== false) { // if we have the data in given date
                $chartData[$date->format("Y-m-d")] = $waterArray[$dataKey]['qty'];
            } else {
                //if there is no record, create default values
                $chartData[$date->format("Y-m-d")] = 0;
            }
        }

        $finalData = [];
        // Finally get the data into a format for the chart (adding array containers)
        foreach ($chartData as $key => $val) {
            array_push($finalData, [$key, $val]);
        }

        return json_encode($finalData);
    }

    /**
     * checks if session has a form submission
     * @return  bool
     */
    public function Submitted() {
        $request = Injector::inst()->get(HTTPRequest::class);
        $session = $request->getSession();

        if ($session->get($this->ClassName . '_Form_Sent')) {
            $session->clear($this->ClassName . '_Form_Sent');
            return true;
        }

        return false;
    }

	public function init() {
		parent::init();

        exec("echo '1-1' |sudo tee /sys/bus/usb/drivers/usb/unbind");

        Requirements::css('https://fonts.googleapis.com/css?family=Roboto:400,600,700,800');
		
		if (Director::isLive()){
//			Requirements::javascript('app/production/index.min.js');
//			Requirements::css('app/production/index.min.css');
            Requirements::css('app/production/index.css');
            Requirements::javascript('app/production/index.js');
		} else {
			Requirements::css('app/production/index.css');
			Requirements::javascript('app/production/index.js');
		}
	}
}
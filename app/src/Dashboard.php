<?php


use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\CMS\Model\SiteTree;

class Dashboard extends Page {

    private static $db = [
        'LastWatered' => 'Text',
        'AutoWatering' => 'Text'
//        'AutoWatering' => 'Boolean'
    ];

    private static $defaults = [
//        'AutoWatering' => 'OFF'
    ];

//    private static $has_one = [
//        'AutoWatering' => 'Auto Watering'
//    ];

}


<?php

namespace {

    use DNADesign\Elemental\Models\ElementContent;
    use SilverStripe\CMS\Model\SiteTree;

    class Dashboard extends Page
    {
        private static $db = [
            'LastWatered' => 'Text',
            'AutoWatering' => 'Boolean'
        ];

        private static $defaults = [

        ];


    }
}

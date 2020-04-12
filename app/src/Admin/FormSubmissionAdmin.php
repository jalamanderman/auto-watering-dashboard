<?php

use SilverStripe\Admin\ModelAdmin;

class FormSubmissionAdmin extends ModelAdmin {

    private static $url_segment = 'form-submissions';
    private static $menu_title = 'Submissions';
    private static $menu_icon_class = 'font-icon-edit-list';

    private static $managed_models = [
		FormSubmission::class
    ];
}



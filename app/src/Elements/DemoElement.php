<?php

namespace Skeletor\Elemental;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\TextareaField;

class DemoElement extends BaseElement {

	private static $title = 'Demo Element';
	private static $singular_name = 'Demo Element';
	private static $description = 'Demo element to showcase namespaceing and core class methods.';
	private static $icon = 'font-icon-p-a';

	/*
	 * For elements that are more complex (e.g. have a Gridfield) disable the
	 * in-line edit form by setting private static $inline_editable = false
	*/

	private static $db = [
		'DemoText' => 'Text',
	];

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', TextareaField::create('DemoText', 'Demo text'));

		return $fields;
	}

	public function getType() {
		return 'Demo Element';
	}
}
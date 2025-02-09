<?php

namespace TheSceneman\SilverStripeGlossary\Model;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

/**
 * @property string Title
 * @property string Definition
 */
class GlossaryTerm extends DataObject
{
    private static string $table_name = 'Terminology';

    private static array $db = [
        'Title' => 'Varchar',
        'Definition' => 'HTMLText',
    ];

    private static array $extensions = [
        Versioned::class,
    ];

    private static string $default_sort = 'Title';

    private static array $summary_fields = [
        'Title' => 'Title',
        'Definition' => 'Definition',
    ];

    public function getCMSFields(): FieldList
    {
        $self = $this;

        $this->beforeUpdateCMSFields(static function ($fields) use ($self): void {
            $fields->removeByName('Definition');

            $fields->addFieldsToTab('Root.Main', [HTMLEditorField::create('Definition')]);
        });

        $fields = parent::getCMSFields();

        return $fields;
    }
}

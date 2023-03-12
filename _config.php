<?php

use TheSceneman\SilverStripeGlossary\View\GlossaryShortcodeProvider;
use SilverStripe\View\Parsers\ShortcodeParser;
use SilverStripe\Core\Manifest\ModuleResourceLoader;
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\Core\Environment;

// Register our glossary shortcode handler
ShortcodeParser::get('default')
    ->register('glossary_term', [GlossaryShortcodeProvider::class, 'handle_shortcode']);

// Add glossary button to WYSIWYG
$editorConfig = HTMLEditorConfig::get(Environment::getEnv('HTML_EDITOR') ?? 'cms');
$editorConfig->enablePlugins([
    'glossary' => ModuleResourceLoader::resourceURL('vendor/thesceneman/silverstripe-glossary/client/dist/js/glossary.js'),
])->addButtonsToLine(3, 'ssglossary');

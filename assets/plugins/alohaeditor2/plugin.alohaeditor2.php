<?php
//<?php
/**
 * Aloha-Editor 2
 *
 * Javascript rich text editor
 *
 * @category    plugin
 * @version     2.0.0 Alpha 188
 * @license     http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @properties &editableIds=Editable<br/>Modx-Phs->CSS-IDs (Example: longtitle->#modx_longtitle,
content->#modx_content);textarea;longtitle->#modx_longtitle,
content->#modx_content
 * @internal    @events OnParseDocument
 * @internal    @modx_category Manager and Admin
 * @internal    @legacy_names Aloha-Editor 2
 * @internal    @installset base
 *
 * @author Deesen / updated: 27.02.2016
 * Latest Updates / Issues on Github : https://github.com/Deesen/alohaeditor2-for-modx-evo
 */
if (!defined('MODX_BASE_PATH')) { die('What are you doing? Get out of here!'); }

// Init
include_once(MODX_BASE_PATH."assets/plugins/alohaeditor2/class.modxRTEbridge.inc.php");
$rte = new modxRTEbridge('alohaeditor2');

// Internal Stuff - Don´t touch!
$showSettingsInterface = false;  // Show/Hide interface in Modx- / user-configuration (false for "Mini")
$editorLabel = $rte->pluginParams['editorLabel'];

$e = &$modx->event;
switch ($e->name) {

    // inject JS-init into <body> before tvs, chunks, snippets, etc. are parsed
    case "OnParseDocument":
        $rte->addEditorScriptToBody();
        break;

    // render Modx- / User-configuration settings-list
    case "OnInterfaceSettingsRender":
        if( $showSettingsInterface === true ) {
            $html = $rte->getModxSettings();
            $e->output($html);
        };
        break;

    default :
        return; // important! stop here!
        break;
}
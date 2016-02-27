<?php
// Editor-Settings
$editorLabel    = 'Aloha-Editor 2';      // Name displayed in Modx-Dropdowns - No HTML!
$skinsDirectory = 'aloha/skins'; // Relative to plugin-dir
$editorVersion  = '2.0.0 Alpha Build 188';          // Version of CKEditor-Library
// $editorLogo     = ''; // Optional Image displayed in Modx-settings

// Dynamic translation of Modx-settings to editor-settings
$bridgeParams = array(

    // editor-param => translate-function (return NULL = no translation, still allows $this->set(), $this->appendInitOnce() etc )

    'elements' => function () {

        global $modx;

        // &editableIds=Editable Modx-Phs==CSS-IDs / TVs;textarea;longtitle==#modx_longtitle,content==#modx_content
        // $this->force('elements', array('#modx_longtitle','#modx_content') );

        $editableIds = isset($this->pluginParams['editableIds']) ? $this->pluginParams['editableIds'] : '';
        $editableIds = explode(',', $editableIds);

        $dataEls = array();
        foreach( $editableIds as $idStr  ) {
            $editable = explode('->',$idStr);
            $modxPh = trim($editable[0]);
            $cssId = trim($editable[1]);

            $dataEls[] = "'{$modxPh}': $('{$cssId}').html()";
        }

        $dataEls = join(",\n                ", $dataEls);

        $this->set('data', "
            var data = {
                'rid':{$modx->documentIdentifier},
                {$dataEls}
            };", 'raw');

        return NULL;
    },
);

// Custom settings to show below Modx- / user-configuration
$customSettings = array( );

// For Modx- and user-configuration
$defaultValues = array( );

// Add translation for monolingual custom-messages with $this->setLang( key, string, overwriteExisting=false )
/*
$this->setLang('editor_custom_buttons1_msg', '<div style="width:70vw;word-wrap:break-word;overflow-wrap:break-word;">[+default+]<i>'.$defaultValues['custom_buttons1'].'</i></div>' );
$this->setLang('editor_custom_buttons2_msg', '<div style="width:70vw;word-wrap:break-word;overflow-wrap:break-word;">[+default+]<i>'.$defaultValues['custom_buttons2'].'</i></div>' );
$this->setLang('editor_css_selectors_schema', 'Title==Tag==CSS-Class');
$this->setLang('editor_css_selectors_example', 'Mono==pre==mono||Small Text==span==small');
$this->setLang('editor_css_selectors_separator', '||');
*/

?>


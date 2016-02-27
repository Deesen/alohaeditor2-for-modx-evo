<?php

$rid = isset($_POST['rid']) ? (int)$_POST['rid'] : NULL;
$out = '';

if( $rid ) {

    include_once(dirname(__FILE__)."/../../cache/siteManager.php");
    define('MODX_API_MODE', true);
    define("IN_MANAGER_MODE", "true");
    $mtime = microtime();
    $manage_path = '../../../'.MGR_DIR.'/';
    include($manage_path . 'includes/config.inc.php');
    include(MODX_MANAGER_PATH . 'includes/document.parser.class.inc.php');
    $modx = new DocumentParser;
    $mtime = explode(" ",$mtime);
    $modx->tstart = $mtime[1] + $mtime[0];;
    $modx->mstart = memory_get_usage();
    startCMSSession();
    $modx->db->connect();
    $modx->getSettings();

    if ($modx->getLoginUserType() === 'manager')
    {
        include_once(MODX_BASE_PATH."assets/plugins/alohaeditor2/class.modxRTEbridge.inc.php");
        $rte = new modxRTEbridge('alohaeditor2');

        $editableIds = $modx->pluginCache[$rte->pluginParams['editorLabel'].'Props'];
        $editableIds = $modx->parseProperties($editableIds);
        $editableIds = explode(',', $editableIds['editableIds']);

        include_once(MODX_BASE_PATH . "assets/lib/MODxAPI/modResource.php");

        $modx->doc = new modResource($modx);
        $modx->doc->edit($rid);

        foreach( $editableIds as $idStr  ) {

            $editable = explode('->',$idStr);
            $modxPh = trim($editable[0]);

            if(isset( $_POST[$modxPh] ))
                $modx->doc->set($modxPh, $rte->unprotectModxPlaceholders($_POST[$modxPh]));
        };

        $out = $modx->doc->save(true, true);    // Returns ressource-ID

    } else {

        $out = 'Alohaeditor: Not logged into manager!';

    };

};

echo (string)$out;
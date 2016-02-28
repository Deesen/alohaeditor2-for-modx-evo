## Aloha Editor 2.0.0 Alpha for Modx Evo
Aloha v2 is still in alpha development stage so this plugin has not more to offer than the official demo http://www.alohaeditor.org/demo/aloha-ui/    

Features:
  - All Modx-placeholders like `[[snippet]] {{chunk}}` etc get preserved in editing areas to avoid breaking content
  - Saving ressources works only when logged into manager
  
Todo:
  - Frontpage-toolbar display only when logged into, avoid caching on OnParseDocument-event

------------------------------------------------------------------------------

**Setup:** In plugin-configuration there is only 1 option called "Editable Modx-Phs->CSS-IDs", expecting a scheme like `MODX-Placeholder->#CSS-Id`. Enter comma-separated as follow (breaking lines allowed):

    longtitle->#modx_longtitle,
    content->#modx_content

In your template prepare the editable areas by adding `class="editable"` and the unique CSS-Id `id="modx_longtitle"`. Example: 

    <h1 class="editable" id="modx_longtitle">[*longtitle*]</h1>
    <div class="editable" id="modx_content">[*content*]</div>


------------------------------------------------------------------------------

Manual installation of plugin `assets/plugins/ckeditor4/plugin.ckeditor4.php`:

  - Copy files of `assets/plugins/alohaeditor2/` to your Modx-installation 
  - In Modx Manager go to Elements -> Plugins and create new plugin
  - Name it "Aloha Editor 2"
  - Paste content of file `assets/plugins/alohaeditor2/plugin.alohaeditor2.php` into Modx Plugin-Code (remove `//<?php` in first line)
  - Set system-events `OnParseDocument`
  - Setup as described above
  - Save new plugin
<?php
function liquid_load_extensions() {
	$extensions_dir = LD_ADDONS_PATH . 'extensions/';
    $dir = new DirectoryIterator($extensions_dir);

    foreach ($dir as $dirinfo) {  
        if($dirinfo->isDir() && !$dirinfo->isDot()) {
            $extension_name = $dirinfo->getFilename();
            if(file_exists($extensions_dir.$extension_name.DIRECTORY_SEPARATOR.$extension_name.'.php')) {
            	require_once $extensions_dir.$extension_name.DIRECTORY_SEPARATOR.$extension_name.'.php';
            }
        }                
    }
}
add_action( 'plugins_loaded', 'liquid_load_extensions', 20, 8 );
?>
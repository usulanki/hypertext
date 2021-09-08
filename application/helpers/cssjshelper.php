<?php 

class cssjshelper{

    /** @var $_cssFiles     : Array. To store the added css files. */
    private static $_cssFiles       = array() ;

    /** @var $_jsFiles  : Array. To store the added js files. */
    private static $_jsFiles        = array() ;

    public function addCSS( $cssFile ) {

        if ( file_exists(  $cssFile ) ) {
            // If it is exist then check it in array, if it is not in array then add
                cssjshelper::$_cssFiles[] = $cssFile ;

        }

        return cssjshelper::$_cssFiles;

    }

    public function addJS( $jsFile ) {

        if ( file_exists(  $jsFile ) ) {
            // If it is exist then check it in array, if it is not in array then add
                cssjshelper::$_jsFiles[] = $jsFile ;

        }
        return cssjshelper::$_jsFiles;
    }


}



?>
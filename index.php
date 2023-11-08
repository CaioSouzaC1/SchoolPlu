<?php

/**
 * SchoolPlu
 *
 * @package       SCHP
 * @author        Caio César de Souza
 *
 * @wordpress-plugin
 * Plugin Name:   SchoolPlu
 * Plugin URI:    https://caiosouza.dev
 * Description:   Transforming wordpress into a school management system.
 * Version:       0.1.0
 * Author:        Caio César de Souza
 * Author URI:    https://caiosouza.dev
 * Update URI:    https://caiosouza.dev
 * Text Domain:   SCHP
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('SCHP_VERSION')) {
    define('SCHP_VERSION', '0.1.0');
}

if (!class_exists('SCHP')) {


    define('SCHP_PLUGIN_FILE', __FILE__);
    define('SCHP_PATH', plugin_dir_path(__FILE__));
    define('SCHP_PLUGIN_URL', plugin_dir_url(__FILE__));
    define('SCHP_PLUGIN_BASENAME', plugin_basename(SCHP_PLUGIN_FILE));
    define('SCHP_PLUGIN_NAME', trim(dirname(SCHP_PLUGIN_BASENAME), '/'));

    class SCHP
    {

        public function init()
        {
            if (!class_exists('ACF')) {
                trigger_error("SchoolPlu requires Advanced Custom Fields to be installed and activated.", E_USER_WARNING);
                return;
            }
            $this->include("inc/removing.php");
            $this->include("inc/enqueue.php");
            $this->include("inc/roles.php");
        }

        private function include($filename)
        {
            $file_path = SCHP_PATH . ltrim($filename, '/');
            if (file_exists($file_path)) {
                include_once $file_path;
            }
        }
    };


    function schp()
    {
        global $schp;
        if (!isset($schp)) {
            $schp = new SCHP();
            $schp->init();
        }
        return $schp;
    }
    add_action('plugins_loaded', 'schp');
}

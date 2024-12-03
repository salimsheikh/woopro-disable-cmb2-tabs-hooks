<?php
/**
 * @wordpress-plugin
 * Plugin Name: Disable CMB2 Tabs Hooks
 * Plugin URI: http://woochamps.com
 * Description: This plugin disables specific hooks added by the CMB2_Tabs class, such as `before_form`, `opening_div`, and `render_nav`, to prevent unwanted functionality in the gamipress tools. The hooks are added by Netbase Framework plugin.
 * Version: 1.0.0
 * Author: WooPro
 * Author URI: http://woochamps.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: disable-cmb2-tabs-hooks
 * Domain Path: /languages

 * Copyright: (c) 2024 WooPro (info@woochamps.com)
 * Tested up to: 6.x.x
 * Created Date December 03, 2024
*/

 if (!function_exists('disable_cmb2_tabs_hooks')) {
    function disable_cmb2_tabs_hooks() {

        if(!isset($_GET['page'])){
            return false;
        }

        if($_GET['page'] != 'gamipress_tools'){
            return false;
        }

        if(!class_exists('CMB2_Tabs')){
            return false;
        }

        global $wp_filter;

        // Check and remove 'before_form' hook for CMB2_Tabs object
        if (isset($wp_filter['cmb2_before_form'])) {
            foreach ($wp_filter['cmb2_before_form']->callbacks[10] as $key => $callback) {
                if (is_object($callback['function'][0]) && get_class($callback['function'][0]) === 'CMB2_Tabs') {
                    // Remove 'before_form' hook
                    remove_action('cmb2_before_form', array($callback['function'][0], 'before_form'), 10);
                    break;
                }
            }
        }

        // Check and remove 'opening_div' hook for CMB2_Tabs object
        if (isset($wp_filter['cmb2_before_form'])) {
            foreach ($wp_filter['cmb2_before_form']->callbacks[10] as $key => $callback) {
                if (is_object($callback['function'][0]) && get_class($callback['function'][0]) === 'CMB2_Tabs') {
                    // Remove 'opening_div' hook
                    remove_action('cmb2_before_form', array($callback['function'][0], 'opening_div'), 10);
                    break;
                }
            }
        }

        // Check and remove 'render_nav' hook for CMB2_Tabs object
        if (isset($wp_filter['cmb2_before_form'])) {
            foreach ($wp_filter['cmb2_before_form']->callbacks[20] as $key => $callback) {
                if (is_object($callback['function'][0]) && get_class($callback['function'][0]) === 'CMB2_Tabs') {
                    // Remove 'render_nav' hook
                    remove_action('cmb2_before_form', array($callback['function'][0], 'render_nav'), 20);
                    break;
                }
            }
        }

        remove_action('init', 'disable_cmb2_tabs_hooks', 20);
    }
    add_action('init', 'disable_cmb2_tabs_hooks', 20);
 }


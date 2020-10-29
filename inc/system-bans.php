<?php
define('CHANGED_PLUGINS', array('custom-twitter-feeds'));

/**
 * Disable update changed plugins
 */
function disable_plugins_update($update)
{
    if (!is_array(CHANGED_PLUGINS) || count(CHANGED_PLUGINS) == 0) {
        return $update;
    }

    if ($update) {
        foreach ($update->response as $name => $val) {
            foreach (CHANGED_PLUGINS as $plugin) {
                if (stripos($name, $plugin) !== false) {
                    unset($update->response[$name]);
                }
            }
        }
    }

    return $update;
}

add_filter('site_transient_update_plugins', 'disable_plugins_update');


/**
 * Replace standard WP logo
 */
function change_login_logo()
{
    ?>
    <style type="text/css">
        body.login div#login h1 a {
            padding: 20px 0;
            width: 320px;
            background: linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgb(66, 66, 66) 100%),
            url('<?= get_template_directory_uri() ?>/images/logo.png') no-repeat center;
            background-size: contain;
            background-blend-mode: screen;
            border-radius: 7px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .35);
        }

        #loginform .button-primary {
            background: #353535;
            border-color: black;
            box-shadow: 0 1px 0 grey;
            text-shadow: 0 -1px 1px black,
            1px 0 1px black,
            0 1px 1px black,
            -1px 0 1px black;
        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'change_login_logo');
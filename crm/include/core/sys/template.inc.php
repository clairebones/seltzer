<?php

/*
    Copyright 2009-2012 Edward L. Platt <elplatt@alum.mit.edu>
    
    This file is part of the Seltzer CRM Project
    theme.inc.php - Provides theming for core elements

    Seltzer is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.

    Seltzer is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Seltzer.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Render a template.
 * @param $name The template name.
 * @param $path The template path.
 */
function template_render ($name, $path) {
    // Load variables into local scope
    $variables = template_preprocess($path, $path);
    extract($variables);
    
    // Construct the template filename
    $filename = path_to_theme() . '/' . $name . '.tpl.php';
    
    // Render template
    ob_start();
    include($filename);
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}

/**
 * Assign variables to be set for a template.
 * @param $path The path to the current page
 */
function template_preprocess ($path) {
    global $config_org_name;
    global $config_base_path;
    
    $variables = array();
    $variables['scripts'] = theme('scripts');
    $variables['stylesheets'] = theme('stylesheets');
    $variables['title'] = title();
    $variables['org_name'] = $config_org_name;
    $variables['base_path'] = $config_base_path;
    $variables['hostname'] = $_SERVER['SERVER_NAME'];
    $variables['header'] = theme('header');
    $variables['errors'] = theme('errors');
    $variables['messages'] = theme('messages');
    $variables['content'] = theme('page', $path, $_GET);
    $variables['footer'] = theme('footer');
    return $variables;
}

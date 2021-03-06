<?php

/*
    Copyright 2009-2012 Edward L. Platt <elplatt@alum.mit.edu>
    
    This file is part of the Seltzer CRM Project
    index.php - Application main page

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

require_once('include/crm.inc.php');

// Check for GET/POST command
$post_command = $_POST['command'];
$get_command = $_GET['command'];
$command = !empty($post_command) ? $post_command : $get_command;

if (!empty($command)) {
    // Check if handler exists
    $handler = 'command_' . $command;
    if (function_exists($handler)) {
        // Execute handler
        $next = $handler();
    } else {   
        // Redirect to homepage
        error_register('No such command: ' . $command);
        $next = 'index.php';
    }    
    // Redirect
    header('Location: ' . $next);
    die();
}

print template_render('page', path());

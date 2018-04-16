<?php 

use Deline\Component\Security;

//export to global variables.
$GLOBALS["parameters"] = $parameters;
$GLOBALS["attributes"] = $attributes;
$GLOBALS["session"] = $session;
$GLOBALS["stylesheets"] = array();
$GLOBALS["scripts"] = array();
$GLOBALS["scripts_sync"] = array();

function deline_parameter_get($name) {
    return $GLOBALS["parameters"][$name];
}

function deline_attribute_get($name) {
    return $GLOBALS["attributes"][$name];
}

function deline_session_get($name) {
    return $GLOBALS["session"][$name];
}

function deline_load_stylesheet($filename) {
    array_push($GLOBALS["stylesheets"], $filename);
}

function deline_load_script($filename, $sync = false) {
    if ($sync) {
        array_push($GLOBALS["scripts_sync"], $filename);
    } else {
        array_push($GLOBALS["scripts"], $filename);
    }
}
function deline_show_file($filename) {
    $parameters = $GLOBALS["parameters"];
    $attributes = $GLOBALS["attributes"];
    $session    = $GLOBALS["session"];
    require_once $filename;
}
function deline_show_template($template_name) {
    deline_show_file(getcwd()."/templates/tpl.".$template_name.".php");
}
function deline_show_html_head() {
    deline_show_template("html.head");
}
function deline_show_html_foot() {
    deline_show_template("html.foot");
}
function deline_show_header() {
    deline_show_template("header");
}

function deline_show_footer() {
    deline_show_template("footer");
}

function deline_show_text($text) {
    echo Security::escapeHTML($text);
}

function deline_show_html($html) {
    echo $html;
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'session', 'form_validation', 'user_agent','Auth','upload');

$autoload['drivers'] = array();

// $autoload['helper'] = array('url', 'form', 'cookie', 'file');
$autoload['helper'] = array('url','form','security','file','multi_language');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array();

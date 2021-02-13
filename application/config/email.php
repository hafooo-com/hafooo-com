<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['emailConfig']['protocol'] = 'smtp';
$config['emailConfig']['smtp_timeout'] = '30';
$config['emailConfig']['mailtype'] = 'html';
$config['emailConfig']['charset'] = 'utf-8';
$config['emailConfig']['newline'] = "\r\n";
$config['emailConfig']['wordwrap'] = FALSE;
//$config['emailConfig']['smtp_crypto'] = 'ssl',
//$config['emailConfig']['crlf'] = '\r\n',
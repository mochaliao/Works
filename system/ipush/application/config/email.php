<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'sendmail';
$config['charset']  = 'utf-8';
$config['wordwrap'] = TRUE;

$config['smtp_crypto']  = 'ssl';
$config['smtp_host']    = 'mail.phc-web.net';
$config['smtp_user']    = 'jeff';
$config['smtp_pass']    = 'no0818';
$config['smtp_port']    = 465;
$config['mailtype']     = 'html';
$config['validate']     = TRUE;
$config['smtp_timeout'] = 30;

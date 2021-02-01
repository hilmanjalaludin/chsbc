<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @ def    : include transaction page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 *
 */
 
 echo form() -> combo('InsuredPlanType','select',$Plan,null,array('change'=>"getCallPremi(this);"));


<?php 

namespace SGE\App;

class Route{
    function hook(){
        $sendgridMail= new Controllers\SendgridMail();
        add_action('admin_menu',[$sendgridMail,'showEmailMenu']);
        add_action('admin_init',[$sendgridMail,'checkSendgridmail']);
     }
  }
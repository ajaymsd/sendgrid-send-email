<?php 

namespace SGE\App\Controllers;

class SendgridMail
{
   function showEmailMenu(){
		add_menu_page(
         "Send Email", //Page Title
         "Send Email",  //Menu Title
         "manage_options", //Capability
         "send_email",    //slug
         array($this,"loadEmailPage"),  //Callback
         '',  //icon
         6   //priority
       );
	}

   function loadEmailPage(){
      if(file_exists(SGE_PLUGIN_PATH.'/app/Views/Form.php')){
         include (SGE_PLUGIN_PATH . '/app/Views/Form.php');
       }else{
         wp_die('Page Not Found');
       }
   }


   //Function to do validation and pass
   function checkSendgridmail(){
      if(isset($_POST) && !empty($_POST) && check_admin_referer('sge_email_form')){
        $to_address=sanitize_email($_POST['sge_email']);
        $subject=sanitize_text_field($_POST['sge_subject']);
        $message=sanitize_textarea_field($_POST['sge_message']);

        if(!filter_var($to_address,FILTER_VALIDATE_EMAIL)){
          add_action('admin_notices',[$this,'errorNoticeForEmail']);
          return;
        }

        if(empty($subject)){
         add_action('admin_notices',[$this,'errorNoticeForSubject']);
         return;
        }

        if(empty($message)){
         add_action('admin_notices',[$this,'errorNoticeForMessage']);
         return;
        }

        $this->send($to_address,$subject,$message);

      }
   }
  

   //Functions to show notices
   function errorNoticeForEmail(){
      ?>
      <div class="notice notice-error is-dismissible">
        <h4>Enter A Valid Email</h4>
      </div>
      <?php
   }

   function errorNoticeForSubject(){
      ?>
       <div class="notice notice-error is-dismissible">
          <h4>Error occured in subject</h4>
       </div>
       <?php
   }

   function errorNoticeForMessage(){
      ?>
       <div class="notice notice-error is-dismissible">
          <h4>Error Occured in Message</h4>
       </div>
      <?php 
   }

   function successMessageForEmail(){
      ?>
       <div class="notice notice-success is-dismissible">
          <h4>Mail Sent Successfully</h4>
       </div>
      <?php
   }

   function unsuccessMessageForEmail(){
      ?>
       <div class="notice notice-error is-dismissible">
          <h4>Mail not Sent</h4>
       </div>
      <?php
   }

   //Main Function to send Email
   function send($to_address,$subject,$message){
      $api_url='https://api.sendgrid.com/v3/mail/send';

      $headers=array(
         'Content-Type'=>'application/json',
         'Authorization'=>'Bearer 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'
      );

      $data=array(
         'personalizations'=>array(
            array(
            'to'=>array(
               array(
                  'email'=>$to_address)
            )
         )
      ),
         'from'=>array('email'=>'ajbalasubramanian2002@gmail.com'),
         'subject'=>$subject,
         'content'=>array(
               array(
               'type'=>'text/plain',
               'value'=>"hello"
               )
            )
        );

         $args=array(
            'body'=>wp_json_encode($data),
            'headers'=>$headers
         );

       $response=wp_remote_post($api_url,$args);
       
       if($response['response']['code']==202){
         add_action('admin_notices',[$this,'successMessageForEmail']);
         return;
       }else{
         add_action('admin_notices',[$this,'unsuccessMessageForEmail']);
         return;
       }
       
   }
}

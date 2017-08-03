<?php
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
 require 'vendor/autoload.php';
 $sendgrid = new SendGrid("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");
 $email    = new SendGrid\Email();
  
 $email->addTo("harish@sksofttechnologies.com")
       ->setFrom("kr@sehionusa.org")
       ->setSubject("Sending with SendGrid is Fun")
       ->setHtml("and easy to do anywhere, even with PHP");
  
 $sendgrid->send($email);
?>
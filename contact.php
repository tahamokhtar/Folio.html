<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'contact@example.com';

  $php_email_form = __DIR__ . '/vendor/php-email-form/php-email-form.php';
  if (file_exists($php_email_form)) {
    require_once($php_email_form);
  }

  // Fallback: Define a minimal PHP_Email_Form class if not found (for development/testing only)
  if (!class_exists('PHP_Email_Form')) {
    class PHP_Email_Form {
      public $ajax = false;
      public $to;
      public $from_name;
      public $from_email;
      public $subject;
      public $smtp = array();
      private $messages = array();

      public function add_message($content, $label, $min_length = 0) {
        $this->messages[] = array('label' => $label, 'content' => $content, 'min_length' => $min_length);
      }

      public function send() {
        // This is a dummy send function for fallback; replace with real implementation
        return "Email sent (fallback class).";
      }
    }
  }
  // مصفوفة تحتوي على صفات البريد الإلكتروني
  $email_attributes = array(
    'to' => $receiving_email_address,
    'from_name' => isset($_POST['name']) ? $_POST['name'] : '',
    'from_email' => isset($_POST['email']) ? $_POST['email'] : '',
    'subject' => isset($_POST['subject']) ? $_POST['subject'] : '',
    'message' => isset($_POST['message']) ? $_POST['message'] : ''
  );

  $contact = new PHP_Email_Form();
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>

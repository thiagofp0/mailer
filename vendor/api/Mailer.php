<?php

    namespace Api;

    use Rain\Tpl;
    use Api\Controller\Sender;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    class Mailer{

        private $username;
        private $password;
        private $mail;

        public function __construct(Sender $sender, $data=[]){

            $toAddress = $sender->getToAddress();
            $toName = $sender->getToName();
            $nameFrom = $sender->getNameFrom();
            $emailReply = $sender->getEmailReply();
            $template = $sender->getTemplate();
            $subject = $sender->getSubject();

            $this->username = getenv("USERNAME");
            $this->password = getenv("PASSWORD");

            $config = array(
                "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/res/templates/",
                "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
                "debug"         => false // set to false to improve the speed
            );
            Tpl::configure( $config );

            $tpl = new Tpl;

            foreach ($data as $key => $value) {
                $tpl->assign($key, $value);
            }

            $html = $tpl->draw($template, true);

            $this->mail = new PHPMailer();
            $this->mail->isSMTP();
            $this->mail->SMTPDebug = 0;
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->Port = 587;
            
            $this->mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $this->mail->SMTPSecure = 'tls';
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $this->username;
            $this->mail->Password = $this->password;
            $this->mail->setFrom($this->username, $nameFrom);
            $this->mail->addReplyTo('comunicacao@nobugs.com.br', 'Marketing No Bugs');
            $this->mail->addAddress($toAddress, $toName);
            $this->mail->Subject = $subject;
            $this->mail->msgHTML($html);
            $this->mail->AltBody = 'Mensagem alternativa';
            //$this->mail->addAttachment('images/phpmailer_mini.png');
        }
        
        public function send(){
            return $this->mail->send();
        }
    }

?>
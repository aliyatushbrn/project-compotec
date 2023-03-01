<?php defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
{

    public function index()
    {
        // echo gethostbyname("host.name.tld");
        //     $email_config = array(
        //         'protocol'  => 'smtp',
        //         'smtp_host' => 'ssl://smtp.googlemail.com',
        //         'smtp_port' => '465',
        //         'smtp_user' => 'compotecsmk4pkl@gmail.com',
        //         'smtp_pass' => 'compoteck4!',
        //         'mailtype'  => 'text',
        //         'starttls'  => true,
        //         'newline'   => "\r\n"
        //     );

        //     $this->load->library('email', $email_config);

        //     $this->email->from('compotecsmk4pkl@gmail.com', 'Compotec');
        //     $this->email->to('aliyatushbrn@gmail.com');
        //     $this->email->subject('Email Test');
        //     $this->email->message('Testing the email class.');

        //     $this->email->send();
        // $this->load->library('email');
        // $this->load->helper('url');
        // $this->load->helper('form');

        // $config = array(
        //     'protocol'  => 'localhost',
        //     'smtp_host' => 'localhost',
        //     'smtp_port' => 'localhost',
        //     'smtp_user' =>  'root',
        //     'smtp_pass' => ''
        // );

        $this->load->library("email");
        $config = array(
            'protocol' => 'sendmail', // 'mail', 'sendmail', or 'smtp'
            'mailpath' => '/usr/sbin/sendmail',
            // 'smtp_host' => '',
            // 'smtp_port' => 465,
            'smtp_user' => 'compotecsmk4pkl@gmail.com',
            'smtp_pass' => 'compoteck4!',
            // 'smtp_crypto' => '', //can be 'ssl' or 'tls' for example
            'mailtype' => 'html', //plaintext 'text' mails or 'html'
            'smtp_timeout' => '5', //in seconds
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('compotecsmk4pkl@gmail.com', 'Compotec');
        $this->email->to('aliyatushbrn@gmail.com');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if ($this->email->send()) {
            echo "Email berhasil dikirim";
        } else {
            show_error($this->email->print_debugger());
        };
    }

    public function kirimemail()
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => '2021rpl.aliyatu@smkn4bogor.sch.id', // change it to yours
            'smtp_pass' => 'GantiPassword1!', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = '';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('2021rpl.aliyatu@smkn4bogor.sch.id'); // change it to yours
        $this->email->to('aliyatushbrn@gmail.com'); // change it to yours
        $this->email->subject('Resume from JobsBuddy for your Job posting');
        $this->email->message($message);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}
// $config['protocol'] = 'sendmail';
// $config['mailpath'] = '/usr/sbin/sendmail';
// $config['charset'] = 'UTF-8';
// $config['wordwrap'] = TRUE;
// $this->email->initialize($config);
// $this->email->clear();

<?php
/**
 * Created by PhpStorm.
 * User: oussema
 * Date: 11/30/2019
 * Time: 19:13
 */
class Users extends CI_Controller{

    function index()
    {
        $data['users']=$this->UserModel->getUsers();
        $data['title']='Users List';
        $this->load->view('templates/header',$data);
        $this->load->view('users/index',$data );
        $this->load->view('templates/footer');
    }
    function create(){
        $data['emailError'] = '';
        $data['recaptchaError'] = '';
        $data['title']='Add User';
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('email','Email','required');
        if($this->form_validation->run()=== FALSE ) {
            $this->load->view('templates/header',$data);
            $this->load->view('users/create',$data);
            $this->load->view('templates/footer');
        }else{
            $googleRecaptcha=$this->input->post('g-recaptcha-response');
            $email=$this->input->post('email');
            $emailVerification=verifyEmail($email);
            if(!$emailVerification){
                $data['emailError']= 'this email is not valid';
            }
            if($googleRecaptcha === ''){
                $data['recaptchaError'] = 'please fill the recaptcha';
            }
            if($googleRecaptcha !== '' && $emailVerification ){
                $this->UserModel->addUser();
                sendMail($email);
                redirect('users');
            }else{
                $this->load->view('templates/header',$data);
                $this->load->view('users/create',$data);
                $this->load->view('templates/footer');
            }


        }
    }
}
    function verifyEmail($email){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.debounce.io/v1/?api=5de400df64a1a&email=".$email,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $result =json_decode($response)->debounce->result;
        if($result === 'Safe to Send'){
            return true;
        }else{
            return false;
        }
    }
    function sendMail($email){
        //oneTool
        $ci =& get_instance();
        $ci->load->library('email');
        $ci->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => 'apikey',
            'smtp_pass' => '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',
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ));
        $ci->email->from('neoxam9@gmail.com', 'OneTool');
        $ci->email->to($email);
        $ci->email->subject('Confirmation Email');
        $ci->email->message('By getting this you are approuving your account.');
        $ci->email->send();
        print_r($ci->email->print_debugger());

    }
?>
<?php
/**
 * Created by PhpStorm.
 * User: oussema
 * Date: 11/30/2019
 * Time: 19:13
 */
class Pages extends CI_Controller{

    function view($page = 'home')
    {
        if( !file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('templates/footer');

    }

}


?>
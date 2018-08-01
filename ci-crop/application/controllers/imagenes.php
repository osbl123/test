<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagenes extends CI_Controller {

	
	public function index()
	{
		$this->load->view('cargar_img');
    }

    public function procesar_imagen() {

        //Cargar imagen
        //print_r($_FILES);
        //exit();
        //echo $nombre_imagen;

        /*
        if(isset($_FILES['profile_pic']['name']) && !empty($_FILES['profile_pic']['name'])) {

        } else {
            echo 'No hay imagen cargada';
        }
        */
        $nombre_imagen = $_FILES['userfile']['name'];
        $config['max_size'] = 0;
        //$config['max_width'] = '1024';
        //$config['max_height'] = '768';
        $config['quality']  = '90%';
        $config['overwrite'] = TRUE;
        $config['upload_path']  = './plantilla/uploads/gallery/';
        //$config['allowed_type'] = 'gif|jpg|jpeg|png';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['allowed_types'] = "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp";


        $config['file_name'] = $nombre_imagen;

        $this->load->library('upload');
        $this->upload->initialize($config);  
        //$this->load->library('upload',$config);

        
        
        /*
        echo $image=$_POST['userfile'];
        if($image==null){
            echo "<br/>no image<br/>";  
            exit();
        }
*/
        /*
        $image = isset($_POST['userfile'])?$_POST['userfile']:null;s
        if($image==null){
            echo "<br/>no image<br/>";  
            exit();
        }
        */

        if(!is_dir($config['upload_path']))
        {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error); //display errors
        } else {
            
            echo "<br/> reached <br/>";
            /*
                session_start();
                $this->membership_model->insert_images($this->upload->data(),$email);
                $data = array('upload_data' => $this->upload->data());

                echo "<br/ problem<br/>";


                $data = array('upload_data' => $this->upload->data());
                            $fullpath= $data['upload_data']['full_path'];
                            $file_name = $data['upload_data']['file_name'];
                */
        }

        //$this->upload->do_upload();
        //echo 'se subio la imagen';
    }
    





}
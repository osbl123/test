<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Croper extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('image_lib');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('croper_up');
    }
    

    function do_upload()
    {
        $config['upload_path'] = './plantilla/uploads/gallery/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        
        $this->load->library('upload', $config);
        
        if(!is_dir($config['upload_path']))
        {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        
        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error); //display errors
        }
        else
        {
            $upload_data = $this->upload->data();
            $data['upload_data'] = $upload_data;
        
            $source_img = $upload_data['full_path']; //Defining the Source Image
            $new_img = $upload_data['file_path'] . $upload_data['raw_name'].'_thumb'.$upload_data['file_ext']; //Defining the Destination/New Image
        
            $data['source_image'] = $new_img;
        
            $this->create_thumb_gallery($upload_data, $source_img, $new_img, 250, 200); //Creating Thumbnail for Gallery which keeps the original
            ///modificado por mi 
            //$this->load->view('crop-gallery', $data);
            $this->load->view('view_crop', $data);
        }
    }

    /*--------------------------------------------------------
    Create Thumbnail for Gallery which Keeps Original Image too
    $upload_data variable keeps the data of the uploaded file
    ---------------------------------------------------------*/
    function create_thumb_gallery($upload_data, $source_img, $new_img, $width, $height)
    {
        //Copy Image Configuration
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_img;
        $config['create_thumb'] = FALSE;
        $config['new_image'] = $new_img;
        $config['quality'] = '100%';
        
        
        $this->image_lib->initialize($config);
        
        if ( ! $this->image_lib->resize() )
        {
            echo $this->image_lib->display_errors();
        }
        else
        {
            //Images Copied
            //Image Resizing Starts
            $config['image_library'] = 'gd2';
            $config['source_image'] = $source_img;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['quality'] = '100%';
            $config['new_image'] = $source_img;
            $config['overwrite'] = TRUE;
            $config['width'] = $width;
            $config['height'] = $height;
            $dim = (intval($upload_data['image_width']) / intval($upload_data['image_height'])) - ($config['width'] / $config['height']);
            $config['master_dim'] = ($dim > 0)? 'height' : 'width';
            
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            
            if ( ! $this->image_lib->resize())
            {
                echo $this->image_lib->display_errors();
            }
            else
            {
                //echo 'Thumnail Created';
                return true;
            }
        }
    }

    function crop()
    {
        if($this->input->post('x',TRUE))
        {
            $X = $this->input->post('x');
            $Y = $this->input->post('y');
            $W = $this->input->post('w');
            $H = $this->input->post('h');
            $source_img = $this->input->post('source_image');
            echo $source_img;

            $config['image_library'] = 'gd2';
            $config['source_image'] = $source_img;
            $config['new_image'] = $source_img;
            $config['quality'] = '100%';
            $config['maintain_ratio'] = FALSE;
            $config['width'] = $W;
            $config['height'] = $H;
            $config['x_axis'] = $X;
            $config['y_axis'] = $Y;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);

            if (!$this->image_lib->crop())
            {
                echo $this->image_lib->display_errors();
            }
            else
            {
                echo 'Cropped Perfectly';
            }
        }
    }

}
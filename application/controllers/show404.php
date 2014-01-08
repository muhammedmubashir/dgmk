<?php
class show404 extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
    }

    public function index()
    {
        
        $this->load->model("front_model");
        $data['packages'] = $this->front_model->get_packages_list();
        $data['hotels'] = $this->front_model->get_hotel_list();
        $data['tours'] = $this->front_model->get_tours_list();
        foreach($data['packages'] as $package)
        {
            $data['package_to_tour'][$package['package_id']] = $this->front_model->get_package_tours_detail($package['package_id']);
        }
        

        $data['title'] = "Emirates Holidays Online - Travels and Tours";
        $data['keyword'] = "Travel, Dubai City Tour, Desert Tours, Safari Desert, Desert Safari, Desert Safari Tour, Burj Khalifa, Sharjah and Ajman City Tour, Abu Dhabi Tour, Al Ain Tour, Dubai Shopping Tour, Sea Plane Tour Dubai, Dubai Helicopter Tour by Emirates Holidays Online - Travels and Tours";
        $data['keyword_description'] = "Desert Safari Luxury 4 Wheel drive vehicle tour by Emirates Holidays Online - Travels and Tours";
        $this->output->set_status_header('404');
        $data['content'] = 'error_404'; // View name
        $this->load->view("layouts/header",$data);
        $this->load->view('custom404',$data);//loading in my template
        $this->load->view("layouts/footer",$data);

        
    }
}
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
        $this->load->model('post_model');
        $this->load->model('homepage_model');
        $this->load->model('service_model');
        $this->load->model('category_model');
        $this->load->model('product_model');
    }
    public function index()
    {
        $meta                   = $this->meta_model->get_meta();
        $post                   = $this->post_model->post_home();
        $homepage               = $this->homepage_model->get_homepage();
        $service                = $this->service_model->get_service();
        $product                   = $this->product_model->product_home();
        $popular_product           = $this->product_model->get_popular();


        // Desktop View
        $data = array(
            'title'                 => $meta->title . ' - ' . $meta->tagline,
            'keywords'              => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
            'deskripsi'             => $meta->description,
            'post'                  => $post,
            'homepage'              => $homepage,
            'service'               => $service,
            'product'                  => $product,
            'popular_product'          => $popular_product,
            'content'               => 'front/home/index'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function translate($language)
    {
        $newData = [
            'language' => $language
        ];
        $this->session->set_userdata($newData);
        if ($this->session->userdata('language')) {
            redirect($_SERVER['HTTP_REFERER']);
        };
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('meta_model');
        $this->load->model('images_model');
        $this->load->library('pagination');
    }
    public function index()
    {
        $meta                           = $this->meta_model->get_meta();
        $category                       = $this->category_model->get_category();

        $this->load->library('pagination');
        $config['base_url']             = base_url('product/index/');
        $config['total_rows']           = count($this->product_model->total_row());
        $config['per_page']             = 6;
        $config['uri_segment']          = 3;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $limit                          = $config['per_page'];
        $start                          = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        $this->pagination->initialize($config);
        $product = $this->product_model->get_product($limit, $start);


        $data = array(
            'title'                       => 'Product',
            'deskripsi'                   => 'Product - ' . $meta->description,
            'keywords'                    => 'Product - ' . $meta->keywords,
            'paginasi'                    => $this->pagination->create_links(),
            'product'                      => $product,
            'category'                    => $category,
            'content'                     => 'front/product/index'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function detail($product_slug = NULL)
    {
        if (!empty($product_slug)) {
            $product_slug;
        } else {
            redirect(base_url('product'));
        }
        $category                       = $this->category_model->get_category();
        $product                         = $this->product_model->read($product_slug);
        $id = $product->id;
        $images = $this->images_model->image_product($id);

        $data                           = array(
            'title'                       => 'Product',
            'deskripsi'                   => 'Product',
            'keywords'                    => $product->meta_keywords,
            'product'                      => $product,
            'images'                => $images,
            'category'                    => $category,

        );
        $this->add_count($product_slug);
        $this->load->view('front/product/detail', $data, FALSE);
    }
    function add_count($product_slug)
    {
        $this->load->helper('cookie');
        $check_visitor = $this->input->cookie(urldecode($product_slug), FALSE);
        $ip = $this->input->ip_address();
        if ($check_visitor == false) {
            $cookie = array(
                "name"                      => urldecode($product_slug),
                "value"                     => "$ip",
                "expire"                    =>  time() + 7200,
                "secure"                    => false
            );
            $this->input->set_cookie($cookie);
            $this->product_model->update_counter(urldecode($product_slug));
        }
    }
}

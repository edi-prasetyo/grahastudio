<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
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
    $this->load->library('pagination');
    $this->load->model('post_model');
    $this->load->model('category_model');
    $this->load->model('meta_model');
  }
  public function index()
  {
    $category           = $this->category_model->get_category();
    $post_popular     = $this->post_model->post_popular();
    if (!$this->agent->is_mobile()) {
      // Desktop View
      $data = [
        'title'                 => 'Category',
        'deskripsi'             => 'Category',
        'keywords'              => 'Category',
        'category'              => $category,
        'post_popular'        => $post_popular,
        'content'               => 'front/category/index_category'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      // Mobile View
      $data = [
        'title'                 => 'Category',
        'deskripsi'             => 'Category',
        'keywords'              => 'Category',
        'category'              => $category,
        'post_popular'        => $post_popular,
        'content'               => 'mobile/category/index'
      ];
      $this->load->view('mobile/layout/wrapp', $data, FALSE);
    }
  }
  public function item($category_slug = NULL)
  {
    $category_detail          = $this->category_model->read($category_slug);
    $category_id              = $category_detail->id;

    $post_featured                 = $this->post_model->post_popular_category($category_id);
    $post_popular                 = $this->post_model->post_popular_category($category_id);
    

    if (!empty($category_slug)) {
      $meta                     = $this->meta_model->get_meta();

      $category          = $this->category_model->get_category();
      $config['base_url']         = base_url('category/item/' . $category_slug . '/index/');
      $config['total_rows']       = count($this->post_model->total_row_category($category_id));
      $config['per_page']         = 2;
      $config['uri_segment']      = 5;

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
      $limit                      = $config['per_page'];
      $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
      $this->pagination->initialize($config);
      $post = $this->post_model->category($category_id, $limit, $start);


      $data = array(
        'title'                 => 'Category - ' . $category_detail->category_name,
        'deskripsi'             => 'Berita - ' . $meta->description,
        'keywords'              => 'Berita - ' . $meta->keywords,
        'post'                => $post,
        'category'              => $category,
        'post_featured'     => $post_featured,
        'post_popular'        => $post_popular,
        'pagination'            => $this->pagination->create_links(),
        'content'               => 'front/category/item_category'
      );
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      redirect(base_url('post'));
    }
  }
}

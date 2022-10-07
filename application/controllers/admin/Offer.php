<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Offer extends CI_Controller
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
        $this->load->model('meta_model');
        $this->load->model('transaction_model');
    }

    public function index()
    {
        $config['base_url']         = base_url('admin/offer/index/');
        $config['total_rows']       = count($this->transaction_model->total_row_offer());
        $config['per_page']         = 5;
        $config['uri_segment']      = 4;

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
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

        $this->pagination->initialize($config);
        $offer = $this->transaction_model->get_offer($limit, $start);
        $data = [
            'title'                 => 'Offer',
            'offer'                  => $offer,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/offer/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function detail($id)
    {
        $offer = $this->transaction_model->detail_offer($id);
        $data = [
            'title'                   => "Detail Offer",
            'offer'             => $offer,
            'content'                 => 'admin/offer/detail'
        ];
        $this->status_read($id);
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function status_read($id)
    {
        $data = [
            'id'               => $id,
            'status_read'      => 1,
        ];
        $this->transaction_model->update_offer($data);
    }
}

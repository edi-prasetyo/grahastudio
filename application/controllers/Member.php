<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
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
        $this->load->model('user_model');
        $this->load->model('transaction_model');
        $this->load->model('images_model');
        $this->load->library('pagination');
    }
    public function index()
    {
        $id                         = $this->session->userdata('id');
        $user_id                         = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $transaction                  = $this->transaction_model->get_alltransaction();
        $total_transaction            = $this->transaction_model->total_transaction_user($user_id);

        if ($user) {
            $data = [
                'title'                       => 'Member',
                'deskripsi'                   => 'Member',
                'keywords'                    => 'Member',
                'user'                      => $user,
                'transaction'               => $transaction,
                'total_transaction'         => $total_transaction,
                'content'                   => 'front/member/index'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('auth'));
        }
    }
    public function transaction()
    {
        $user_id  = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);

        $config['base_url']         = base_url('member/transaction/index/');
        $config['total_rows']       = count($this->transaction_model->total_transaction_user($user_id));
        $config['per_page']         = 10;
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

        $transaction                    = $this->transaction_model->transaction_user($limit, $start, $user_id);

        if ($user) {
            $data = [
                'title'                     => 'Transaction',
                'deskripsi'                 => 'Transaction',
                'keywords'                  => 'Transaction',
                'user'                      => $user,
                'transaction'               => $transaction,
                'pagination'                    => $this->pagination->create_links(),
                'content'                   => 'front/member/transaction'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('auth'));
        }
    }
    public function detail_transaction($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $transaction    = $this->transaction_model->transaction_detail($id, $user_id);

        if ($user) {
            $data = [
                'title'                     => 'Transaction',
                'deskripsi'                 => 'Transaction',
                'keywords'                  => 'Transaction',
                'user'                      => $user,
                'transaction'               => $transaction,
                'pagination'                => $this->pagination->create_links(),
                'content'                   => 'front/member/detail_transaction'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('auth'));
        }
    }
    public function download($id = null)
    {
        if (!empty($id)) {
            $id;
        } else {
            redirect(base_url('member'));
        }
        $this->load->helper('download');
        $this->load->helper('file');
        $transaction = $this->transaction_model->transaction_detail($id);
        $product_id = $transaction->product_id;

        $files = $this->images_model->file_download($product_id);
        $file = $files->file;

        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $data = file_get_contents(base_url('assets/ey7jfdglui4763-956yyeb7u537583tjfgfs74586045hhdjsoudkshdva/' . $file),  false, stream_context_create($arrContextOptions));
        $name = $file;
        force_download($name, $data);
    }
}

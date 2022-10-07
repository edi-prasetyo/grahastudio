<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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
        $this->load->model('tour_model');
        $this->load->model('schedule_model');
        $this->load->model('meta_model');
        $this->load->model('transaction_model');
        $this->load->model('product_model');
        $this->load->model('bank_model');

        $this->load->library('pagination');
    }
    public function index()
    {
        redirect(base_url(), 'refresh');
    }
    public function item($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail_member($user_id);
        // var_dump($user_id);
        // die;
        $meta       = $this->meta_model->get_meta();
        $product       = $this->product_model->product_detail($id);
        $bank = $this->bank_model->get_allbank();

        if ($user_id) {
            $data = array(
                'title'                       => 'Order',
                'deskripsi'                   => 'Order - ' . $meta->description,
                'keywords'                    => 'Order - ' . $meta->keywords,
                'paginasi'                    => $this->pagination->create_links(),
                'product'                     => $product,
                'bank'                        => $bank,
                'user'                        => $user,
                'content'                     => 'front/order/item'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('auth'), 'refresh');
        }
    }
    public function create()
    {
        $this->form_validation->set_rules(
            'fullname',
            'Nama',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Order',
                'content'                         => 'order/trip/index'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $invoice_number = strtoupper(random_string('numeric', 7));

            $price = $this->input->post('price');
            $quantity = 1;
            $total_price = (int)$price * (int)$quantity;

            $data  = [
                'user_id'           => $this->input->post('user_id'),
                'fullname'              => $this->input->post('fullname'),
                'email'                 => $this->input->post('email'),
                'phone'                 => $this->input->post('phone'),
                'product_id'               => $this->input->post('product_id'),
                'product_name'            => $this->input->post('product_name'),
                'bank_id'            => $this->input->post('bank_id'),
                'quantity'              => $quantity,
                'price'                 => $price,
                'total_price'            => $total_price,
                'invoice_number'        => $invoice_number,
                'payment_status'        => 'pending',
                'created_at'            => date('Y-m-d')
            ];
            $insert_id = $this->transaction_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('order/success/' . md5($insert_id)), 'refresh');
        }
    }
    public function success($insert_id)
    {
        $transaction = $this->transaction_model->last_detail($insert_id);
        // var_dump($transaction);
        // die;
        $data = array(
            'title'                       => 'Tour',
            'deskripsi'                   => 'Trip',
            'keywords'                    => 'Trip ',
            'transaction'                     => $transaction,
            'content'                     => 'front/order/success'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}

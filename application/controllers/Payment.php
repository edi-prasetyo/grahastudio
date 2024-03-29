<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
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
        $this->load->model('meta_model');
        $this->load->model('transaction_model');
        $this->load->model('setting_model');
        $this->load->model('bank_model');
        $this->load->library('pagination');

        // $sender = $this->pengaturan_model->sender();
        // $server_key = $sender->midtrans_server_key;
        // $payment_environment = $sender->midtrans_environment;

        // var_dump($whatsapp_api);
        // die;

        // Midtrans Payment gateway
        $setting = $this->setting_model->detail();
        $server_key = $setting->midtrans_server_key;
        $payment_environment = $setting->midtrans_environment;
        // var_dump($payment_environment);
        // die;

        $params = array('server_key' =>  $server_key, 'production' => (bool)$payment_environment);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->helper('url');
    }
    public function index()
    {
        $insert_id = $this->input->get('id');
        $transaction        = $this->transaction_model->payment($insert_id);
        $bank = $this->bank_model->get_allbank();
        // Desktop View
        $data                           = array(
            'title'                       => 'Product',
            'deskripsi'                   => 'Product',
            'keywords'                    => 'keywords',
            'transaction'                 => $transaction,
            'bank'                        => $bank,
            'content'                     => 'front/payment/index'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function vtweb_checkout()
    {
        $transaksi_id = $this->input->post('transaksi_id');
        $gross_amount = $this->input->post('gross_amount');
        $amount = $this->input->post('amount');
        $name = $this->input->post('name');
        $first_name = $this->input->post('first_name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $quantity = $this->input->post('quantity');

        $transaction_details = array(
            'order_id'             => uniqid(),
            'gross_amount'     => $gross_amount
        );

        // Populate items
        $items = [
            array(
                'id'                => 'item1',
                'price'             => $amount,
                'quantity'          => $quantity,
                'name'              => $name
            ),

        ];

        // Populate customer's Info
        $customer_details = array(
            'first_name'                => $first_name,
            'last_name'                 => "",
            'email'                     => $email,
            'phone'                     => $phone,

        );

        // Data yang akan dikirim untuk request redirect_url.
        // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
        $transaction_data = array(
            'payment_type'              => 'vtweb',
            'vtweb'                     => array(
                //'enabled_payments' 	=> ['credit_card'],
                'credit_card_3d_secure' => true
            ),
            'transaction_details'       => $transaction_details,
            'item_details'              => $items,
            'customer_details'          => $customer_details
        );
        $order_id = $transaction_details['order_id'];

        try {
            $vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
            header('Location: ' . $vtweb_url);
            $this->insert_payment($vtweb_url, $transaksi_id, $order_id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insert_payment($vtweb_url, $transaksi_id, $order_id)
    {

        $data  = [
            'id'                    => $transaksi_id,
            'payment_url'           => $vtweb_url,
            'order_id'              => $order_id

        ];
        $this->transaction_model->update($data);
    }



    public function notification()
    {
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result, 'true');


        $order_id = $result['order_id'];
        if ($result['payment_type'] == 'bank_transfer') {
            $data = [
                'order_id'                => $order_id,
                'status_code'            => $result['status_code'],
                'payment_type'            => $result['payment_type'],
                'gross_amount'            => $result['gross_amount'],
                'bank'                    => $result['va_numbers'][0]['bank'],
                'va_number'                => $result['va_numbers'][0]['va_number']
            ];
            $this->transaction_model->update_notif($data);
            redirect(base_url('payment/finish'), 'refresh');
        } elseif ($result['payment_type'] == 'cstore') {
            $data = [
                'order_id'                => $order_id,
                'status_code'            => $result['status_code'],
                'payment_type'            => $result['payment_type'],
                'gross_amount'            => $result['gross_amount'],
                'payment_code'            => $result['payment_code'],
            ];
            $this->transaction_model->update_notif($data);
            redirect(base_url('payment/finish'), 'refresh');
        } else {
            $data = [
                'order_id'                => $order_id,
                'status_code'            => $result['status_code'],
                'gross_amount'            => $result['gross_amount'],
                'payment_type'            => $result['payment_type'],
            ];
            $this->transaction_model->update_notif($data);
            redirect(base_url('payment/finish'), 'refresh');
        }
    }

    public function finish()
    {
        $order_id = $this->input->get('order_id');
        $status_code = $this->input->get('status_code');
        $transaction_status = $this->input->get('transaction_status');
        $transaction_detail = $this->transaction_model->finish($order_id);
        $data                           = array(
            'title'                       => 'Product',
            'deskripsi'                   => 'Product',
            'keywords'                    => 'keywords',
            'order_id'                    => $order_id,
            'status_code'                  => $status_code,
            'transaction_status'         => $transaction_status,
            'transaction_detail'        => $transaction_detail,
            'content'                     => 'front/payment/finish'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function unfinish()
    {

        echo 'Unfinish';
    }
    public function error()
    {

        echo 'Error';
    }
    public function handling()
    {

        echo 'handling';
    }
}

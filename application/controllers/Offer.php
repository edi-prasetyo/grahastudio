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
        $this->load->model('meta_model');
        $this->load->model('transaction_model');
    }

    public function index()
    {
        $meta           = $this->meta_model->get_meta();
        $offer           = $this->transaction_model->get_alloffer();

        $data = array(
            'title'       => 'Halaman',
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'offer'        => $offer,
            'content'     => 'front/offer/index'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    public function custom()
    {
        $user_id = $this->session->userdata('id');

        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Penawaran',
                'deskripsi'                 => 'Penawaran',
                'keywords'                  => 'Penawaran',
                'content'                         => 'front/offer/create_custom'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            $id_offer = strtoupper(random_string('numeric', 7));

            $data  = [
                'user_id'       => $user_id,
                'id_offer'  => $id_offer,
                'name'                   => $this->input->post('name'),
                'email'                => $this->input->post('email'),
                'whatsapp'                => $this->input->post('whatsapp'),
                'type'                => $this->input->post('type'), //personal / perusahaan
                'business_name'                => $this->input->post('business_name'),
                'business_fields'                => $this->input->post('business_fields'), //bidang Usaha
                'app_description'                => $this->input->post('app_description'),
                'app_featured'                => $this->input->post('app_featured'),
                'product_type'                => 'custom',
                'status_read'                => 0,
                'created_at'                      => date('Y-m-d H:i:s')
            ];
            $insert_id = $this->transaction_model->create_offer($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('offer/success/' . md5($insert_id)), 'refresh');
        }
    }
    public function website()
    {
        $user_id = $this->session->userdata('id');

        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Penawaran',
                'deskripsi'                 => 'Penawaran',
                'keywords'                  => 'Penawaran',
                'content'                         => 'front/offer/create_website'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'user_id'       => $user_id,
                'name'                   => $this->input->post('name'),
                'email'                => $this->input->post('email'),
                'whatsapp'                => $this->input->post('whatsapp'),
                'type'                => $this->input->post('type'), //personal / perusahaan
                'business_name'                => $this->input->post('business_name'),
                'business_fields'                => $this->input->post('business_fields'), //bidang Usaha
                'app_description'                => $this->input->post('app_description'),
                'app_featured'                => $this->input->post('app_featured'),
                'product_type'                => 'website',
                'status_read'                => 0,
                'created_at'                      => date('Y-m-d H:i:s')
            ];
            $insert_id = $this->transaction_model->create_offer($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('offer/success/' . md5($insert_id)), 'refresh');
        }
    }
    public function success($insert_id)
    {
        $offer = $this->transaction_model->view_offer($insert_id);
        $data = [
            'title'                           => 'Sukses',
            'deskripsi'                 => 'Sukses',
            'keywords'                  => 'Sukses',
            'offer'             => $offer,
            'content'                         => 'front/offer/success'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}

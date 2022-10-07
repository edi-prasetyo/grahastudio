<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('string');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('images_model');
        $this->load->model('user_model');
    }

    // List product
    public function index()
    {
        $meta = $this->meta_model->get_meta();


        $config['base_url']       = base_url('admin/product/index/');
        $config['total_rows']     = count($this->product_model->total_row());
        $config['per_page']       = 10;
        $config['uri_segment']    = 4;

        //Membuat Style pagination untuk BootStrap v4
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

        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $product = $this->product_model->get_product($limit, $start);

        // End Listing Berita dengan paginasi
        $data = array(
            'title'         => 'Product',
            'meta'          => $meta,
            'product'       => $product,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'admin/product/index'
        );
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // create
    public function create()
    {
        $category = $this->category_model->get_category();
        $this->form_validation->set_rules(
            'product_name',
            'Judul',
            'required',
            [
                'required'              => 'Judul Post harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'product_description',
            'Deskripsi Post',
            'required',
            [
                'required'              => 'Deskripsi Post harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']      = './assets/img/product/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = 5000000;
            $config['max_width']        = 5000000;
            $config['max_height']       = 5000000;
            $config['remove_spaces']    = TRUE;
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('product_image')) {

                $data = [
                    'title'                 => 'Tambah Post',
                    'category'              => $category,
                    'error_upload'          => $this->upload->display_errors(),
                    'content'               => 'admin/product/create'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);
            } else {
                $upload_data                = array('uploads'  => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
                $config['new_image']        = './assets/img/product/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $slugcode = random_string('numeric', 5);
                $product_slug  = url_title($this->input->post('product_name'), 'dash', TRUE);
                $data  = [
                    'user_id'               => $this->session->userdata('id'),
                    'category_id'           => $this->input->post('category_id'),
                    'product_slug'          => $slugcode . '-' . $product_slug,
                    'product_name'          => $this->input->post('product_name'),
                    'product_description'   => $this->input->post('product_description'),
                    'product_featured'      => $this->input->post('product_featured'),
                    'product_image'         => $upload_data['uploads']['file_name'],
                    'meta_title'            => $this->input->post('meta_title'),
                    'meta_description'      => $this->input->post('meta_description'),
                    'meta_keywords'         => $this->input->post('meta_keywords'),
                    'product_price'         => $this->input->post('product_price'),
                    'product_status'        => $this->input->post('product_status'),
                    'product_link'          => $this->input->post('product_link'),
                    'product_framework'          => $this->input->post('product_framework'),
                    'created_at'            => date('Y-m-d H:i:s')
                ];
                $this->product_model->create($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data Produk telah ditambahkan</div>');
                redirect(base_url('admin/product'), 'refresh');
            }
        }

        $data = [
            'title'                       => 'Tambah Produk',
            'category'                    => $category,
            'content'                     => 'admin/product/create'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // update
    public function Update($id)
    {
        $product = $this->product_model->detail($id);
        $category = $this->category_model->category_product();

        $valid = $this->form_validation;
        $valid->set_rules(
            'product_name',
            'Judul Produk',
            'required',
            ['required'                   => '%s harus diisi']
        );

        if ($valid->run()) {

            if (!empty($_FILES['product_image']['name'])) {

                $config['upload_path']        = './assets/img/product/';
                $config['allowed_types']      = 'gif|jpg|png|jpeg';
                $config['max_size']           = 5000000;
                $config['max_width']          = 5000000;
                $config['max_height']         = 5000000;
                $config['remove_spaces']      = TRUE;
                $config['encrypt_name']       = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('product_image')) {

                    $data = [
                        'title'                 => 'Edit Post',
                        'category'              => $category,
                        'product'                  => $product,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'admin/product/update'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);
                } else {

                    $upload_data                = array('uploads'  => $this->upload->data());
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
                    $config['new_image']        = './assets/img/product/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    if ($product->product_image != "") {
                        unlink('./assets/img/product/' . $product->product_image);
                    }

                    $data  = [
                        'id'                  => $id,
                        'user_id'             => $this->session->userdata('id'),
                        'category_id'           => $this->input->post('category_id'),
                        'product_name'          => $this->input->post('product_name'),
                        'product_description'   => $this->input->post('product_description'),
                        'product_featured'      => $this->input->post('product_featured'),
                        'product_image'         => $upload_data['uploads']['file_name'],
                        'meta_title'            => $this->input->post('meta_title'),
                        'meta_description'      => $this->input->post('meta_description'),
                        'meta_keywords'         => $this->input->post('meta_keywords'),
                        'product_price'         => $this->input->post('product_price'),
                        'product_status'        => $this->input->post('product_status'),
                        'product_link'          => $this->input->post('product_link'),
                        'product_framework'          => $this->input->post('product_framework'),
                        'updated_at'            => date('Y-m-d H:i:s')
                    ];
                    $this->product_model->update($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
                    redirect(base_url('admin/product'), 'refresh');
                }
            } else {

                if ($product->product_image != "")
                    $data  = [
                        'id'                  => $id,
                        'user_id'             => $this->session->userdata('id'),
                        'category_id'           => $this->input->post('category_id'),
                        'product_name'          => $this->input->post('product_name'),
                        'product_description'   => $this->input->post('product_description'),
                        'product_featured'      => $this->input->post('product_featured'),
                        'meta_title'            => $this->input->post('meta_title'),
                        'meta_description'      => $this->input->post('meta_description'),
                        'meta_keywords'         => $this->input->post('meta_keywords'),
                        'product_price'         => $this->input->post('product_price'),
                        'product_status'        => $this->input->post('product_status'),
                        'product_link'          => $this->input->post('product_link'),
                        'product_framework'          => $this->input->post('product_framework'),
                        'updated_at'            => date('Y-m-d H:i:s')
                    ];
                $this->product_model->update($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
                redirect(base_url('admin/product'), 'refresh');
            }
        }

        $data = [
            'title'               => 'Update Post',
            'category'            => $category,
            'product'                => $product,
            'content'             => 'admin/product/update'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    public function upload_image($id)
    {
        $product = $this->product_model->detail($id);
        $images = $this->images_model->image_product($id);
        $this->form_validation->set_rules(
            'image_title',
            'Judul',
            'required',
            [
                'required'              => 'Judul Post harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']      = './assets/img/product/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = 5000000;
            $config['max_width']        = 5000000;
            $config['max_height']       = 5000000;
            $config['remove_spaces']    = TRUE;
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('product_image')) {

                $data = [
                    'title'                 => 'Tambah Gambar',
                    'error_upload'          => $this->upload->display_errors(),
                    'product'               => $product,
                    'images'                => $images,
                    'content'               => 'admin/product/image'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);
            } else {
                $upload_data                = array('uploads'  => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
                $config['new_image']        = './assets/img/product/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data  = [
                    'product_id'            => $id,
                    'image_title'           => $this->input->post('image_title'),
                    'image'                 => $upload_data['uploads']['file_name'],
                    'created_at'            => date('Y-m-d H:i:s')
                ];
                $this->images_model->create($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data Produk telah ditambahkan</div>');
                redirect(base_url('admin/product/upload_image/' . $product->id), 'refresh');
            }
        }

        $data = [
            'title'                       => 'Tambah Gambar',
            'product'                   => $product,
            'images'                        => $images,
            'content'                     => 'admin/product/image'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function delete_image($id)
    {
        is_login();
        $images = $this->images_model->image_detail($id);

        if ($images->image != "") {
            unlink('./assets/img/product/' . $images->image);
            unlink('./assets/img/product/thumbs/' . $images->image);
        }

        $data = ['id'                   => $images->id];
        $this->images_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function upload_files($id)
    {
        $product = $this->product_model->detail($id);
        $files = $this->images_model->file_product($id);
        $this->form_validation->set_rules(
            'file_title',
            'Judul',
            'required',
            [
                'required'              => 'Judul Post harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']      = './assets/ey7jfdglui4763-956yyeb7u537583tjfgfs74586045hhdjsoudkshdva/';
            $config['allowed_types']    = 'zip|rar|tar|';
            $config['max_size']         = 50000000000000000;
            // $config['max_width']        = 50000000000000000;
            // $config['max_height']       = 50000000000000000;
            $config['remove_spaces']    = TRUE;
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('product_file')) {

                $data = [
                    'title'                 => 'Tambah File',
                    'error_upload'          => $this->upload->display_errors(),
                    'product'               => $product,
                    'files'                => $files,
                    'content'               => 'admin/product/file'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);
            } else {
                $upload_data                = array('uploads'  => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/956yyeb7u537583tjfgfs74586045hhdjsoudkshdva/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = FALSE;
                $config['maintain_ratio']   = FALSE;
                $config['thumb_marker']     = '';
                $this->load->library('image_lib', $config);


                $data  = [
                    'product_id'            => $id,
                    'file_title'           => $this->input->post('file_title'),
                    'file'                 => $upload_data['uploads']['file_name'],
                    'created_at'            => date('Y-m-d H:i:s')
                ];
                $this->images_model->create_file($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data Produk telah ditambahkan</div>');
                redirect(base_url('admin/product/upload_files/' . $product->id), 'refresh');
            }
        }

        $data = [
            'title'                       => 'Tambah File',
            'product'                   => $product,
            'files'                        => $files,
            'content'                     => 'admin/product/file'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
}

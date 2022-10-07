<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Images_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alliklan()
    {
        $this->db->select('*');
        $this->db->from('image');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }



    //Kirim Data Berita ke database
    public function create($data)
    {
        $this->db->insert('image', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('image', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('image', $data);
    }

    public function image_product($id)
    {
        $this->db->select('*');
        $this->db->from('image');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function image_detail($id)
    {
        $this->db->select('*');
        $this->db->from('image');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    // FILES
    public function create_file($data)
    {
        $this->db->insert('files', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function file_product($id)
    {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function file_download($product_id)
    {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        return $query->row();
    }
}

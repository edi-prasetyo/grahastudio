<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public function get_allproduct($limit, $start)
    {
        $this->db->select('product.*, user.user_image');
        $this->db->from('product');
        // join
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Get Product Front Page
    public function get_product($limit, $start)
    {
        $this->db->select('product.*, user.user_image, category.category_slug, category.category_name');
        $this->db->from('product');
        // join
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function product_detail($id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('md5(id)', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    //Kirim Data Product ke database
    public function create($data)
    {
        $this->db->insert('product', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('product', $data);
    }
    // FRONT VIEW

    //Read Product
    public function read($product_slug)
    {
        $this->db->select('product.*,user.user_name, user.user_image, category.category_name');
        $this->db->from('product');
        // Join
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        $this->db->join('category', 'category.id = product.category_id', 'LEFT');
        //End Join
        $this->db->where('product.product_slug',  $product_slug);
        $query = $this->db->get();
        return $query->row();
    }
    // Update Counter Product
    public function update_counter($product_slug)
    {
        // return current article views
        $this->db->where('product_slug', urldecode($product_slug));
        $this->db->select('product_views');
        $count = $this->db->get('product')->row();
        // then increase by one
        $this->db->where('product_slug', urldecode($product_slug));
        $this->db->set('product_views', ($count->product_views + 1));
        $this->db->update('product');
    }
    public function get_popular()
    {
        $this->db->select('product.*, user.user_image');
        $this->db->from('product');
        // join
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        // End Join
        $this->db->order_by('product_views', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }
    public function product_home()
    {
        $this->db->select('product.*, user.user_image');
        $this->db->from('product');
        // join
        $this->db->join('user', 'user.id = product.user_id', 'LEFT');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }
}

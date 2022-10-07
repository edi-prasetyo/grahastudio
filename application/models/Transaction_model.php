<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alltransaction()
    {
        $this->db->select('*');
        $this->db->from('transaction');
        // $this->db->where('transaction.status', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_transaction_success()
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('transaction.payment_status', 'success');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function new_transaction()
    {
        $this->db->select('*');
        $this->db->from('transaction');
        // $this->db->where('transaction.status', 1);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_transaction($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        // $this->db->where('transaction.status', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function total_row()
    {
        $this->db->select('transaction.*, user.user_name');
        $this->db->from('transaction');
        // Join
        $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
        //End Join
        // $this->db->where('transaction.status', 1);
        $this->db->order_by('transaction.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail($id)
    {
        $this->db->select('transaction. *, user.user_name');
        $this->db->from('transaction');
        // Join
        $this->db->join('user', 'user.id = transaction.user_id', 'LEFT');
        $this->db->where(['transaction.id' => $id]);
        $query = $this->db->get();
        return $query->row();
    }
    public function last_detail($insert_id)
    {
        $this->db->select('transaction.*, bank.bank_name, bank.bank_number, bank.bank_account, bank.bank_logo');
        $this->db->from('transaction');
        // Join
        $this->db->join('bank', 'bank.id = transaction.bank_id', 'LEFT');
        //End Join
        $this->db->where(['md5(transaction.id)' => $insert_id]);
        $query = $this->db->get();
        return $query->row();
    }
    public function payment($insert_id)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where(['md5(transaction.id)' => $insert_id]);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_chart()
    {
        $this->db->select('transaction.*, COUNT(id) AS total');
        $this->db->from('transaction');
        // $this->db->where('transaction.status', 1);
        $this->db->group_by(['total' => 'MONTH(created_at)']);
        $this->db->order_by('DATE(created_at)', 'ASC');
        $this->db->limit(12);
        $query = $this->db->get();
        return $query->result();
    }

    //Create
    public function create($data)
    {
        $this->db->insert('transaction', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('transaction', $data);
    }
    public function update_paid($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('transaction', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('transaction', $data);
    }

    // MEMBER AREA
    public function transaction_user($limit, $start, $user_id)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('transaction.user_id', $user_id);
        $this->db->order_by('transaction.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function total_transaction_user($user_id)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('transaction.user_id', $user_id);
        $this->db->order_by('transaction.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function transaction_detail($id)
    {
        $this->db->select('transaction.*, bank.bank_name, bank.bank_number, bank.bank_account, bank.bank_logo');
        $this->db->from('transaction');
        // Join
        $this->db->join('bank', 'bank.id = transaction.bank_id', 'LEFT');
        //End Join
        $this->db->where(['md5(transaction.id)' => $id]);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_notifNewOrder()
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('transaction.status_read', 0);
        $this->db->order_by('transaction.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    // OFFER TABLE
    public function get_alloffer()
    {
        $this->db->select('*');
        $this->db->from('offer');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_offer($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('offer');
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_offer($id)
    {
        $this->db->select('*');
        $this->db->from('offer');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    public function view_offer($insert_id)
    {
        $this->db->select('*');
        $this->db->from('offer');
        $this->db->where('md5(id)', $insert_id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    public function create_offer($data)
    {
        $this->db->insert('offer', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function update_offer($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('offer', $data);
    }

    public function total_row_offer()
    {
        $this->db->select('*');
        $this->db->from('offer');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_notifNewOffer()
    {
        $this->db->select('*');
        $this->db->from('offer');
        $this->db->where('offer.status_read', 0);
        $this->db->order_by('offer.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}

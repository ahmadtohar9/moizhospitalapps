<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{

    // Ambil 1 user (untuk form edit/detail)
    public function get_user_by_id($id)
    {
        return $this->db->select('
                            id,
                            username,
                            nama_user,
                            email,
                            role_id,
                            is_active,
                            kd_pegawai,
                            kd_dokter
                        ')
            ->from('moizhospital_users')
            ->where('id', $id)
            ->get()
            ->row_array();
    }

    // Ambil semua user (list) + info role
    public function get_all_users()
    {
        return $this->db->select('
                u.id,
                u.username,
                u.nama_user,
                u.email,
                u.role_id,
                u.is_active,
                u.kd_pegawai,
                u.kd_dokter,
                r.role_name
            ')
            ->from('moizhospital_users u')
            ->join('moizhospital_roles r', 'u.role_id = r.id', 'left')
            ->order_by('u.id', 'ASC')
            ->get()
            ->result_array();
    }


    // Insert user baru
    public function insert_user($user_data)
    {
        // pastikan hanya kolom yang ada di tabel yang dikirim
        return $this->db->insert('moizhospital_users', $user_data);
    }

    // Update user by id
    public function update_user($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('moizhospital_users', $data);
    }

    // Hapus user by id
    public function delete_user($id)
    {
        return $this->db->where('id', $id)
            ->delete('moizhospital_users');
    }

    // Ambil user dengan role tertentu (untuk filter list)
    public function get_role_by_user($role_id)
    {
        return $this->db->select('
                            id,
                            username,
                            nama_user,
                            email,
                            role_id,
                            is_active,
                            kd_pegawai,
                            kd_dokter
                        ')
            ->from('moizhospital_users')
            ->where('role_id', $role_id)
            ->get()
            ->result_array();
    }

    // Cek duplikasi username
    public function is_username_exist($username)
    {
        return $this->db->select('id')
            ->from('moizhospital_users')
            ->where('username', $username)
            ->get()
            ->num_rows() > 0;
    }

    // (Opsional) Cek duplikasi email
    public function is_email_exist($email)
    {
        return $this->db->select('id')
            ->from('moizhospital_users')
            ->where('email', $email)
            ->get()
            ->num_rows() > 0;
    }
}

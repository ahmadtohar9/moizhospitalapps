<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplaySettings_model extends CI_Model
{

    /**
     * Get all global settings
     */
    public function get_all_global_settings()
    {
        $query = $this->db->get_where('moizhospital_display_global_settings', ['is_active' => 'Ya']);
        $settings = [];

        foreach ($query->result_array() as $row) {
            $settings[$row['setting_key']] = [
                'value' => $row['setting_value'],
                'type' => $row['setting_type'],
                'group' => $row['setting_group'],
                'description' => $row['description']
            ];
        }

        return $settings;
    }

    /**
     * Get setting value by key
     */
    public function get_setting_value($key, $default = null)
    {
        $query = $this->db->get_where('moizhospital_display_global_settings', [
            'setting_key' => $key,
            'is_active' => 'Ya'
        ]);

        if ($query->num_rows() > 0) {
            return $query->row()->setting_value;
        }

        return $default;
    }

    /**
     * Update global settings (UPSERT)
     */
    public function update_global_settings($settings)
    {
        $this->db->trans_start();

        foreach ($settings as $key => $value) {
            // Check if exists
            $exists = $this->db->get_where('moizhospital_display_global_settings', [
                'setting_key' => $key
            ])->num_rows() > 0;

            if ($exists) {
                // Update
                $this->db->where('setting_key', $key);
                $this->db->update('moizhospital_display_global_settings', [
                    'setting_value' => $value,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                // Insert
                $this->db->insert('moizhospital_display_global_settings', [
                    'setting_key' => $key,
                    'setting_value' => $value,
                    'setting_type' => 'text',
                    'setting_group' => 'general',
                    'is_active' => 'Ya',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * Get all dokter with their display settings
     */
    public function get_all_dokter_settings()
    {
        $sql = "
            SELECT 
                d.kd_dokter,
                d.nm_dokter,
                ds.foto_path,
                ds.foto_url,
                ds.show_in_display,
                ds.display_order,
                ds.is_active
            FROM dokter d
            LEFT JOIN moizhospital_display_dokter_settings ds ON d.kd_dokter = ds.kd_dokter
            WHERE d.status = '1'
            ORDER BY ds.display_order ASC, d.nm_dokter ASC
        ";

        return $this->db->query($sql)->result_array();
    }

    /**
     * Get all active dokter
     */
    public function get_all_dokter()
    {
        $this->db->select('kd_dokter, nm_dokter');
        $this->db->from('dokter');
        $this->db->where('status', '1');
        $this->db->order_by('nm_dokter', 'ASC');

        return $this->db->get()->result_array();
    }

    /**
     * Get dokter setting by kd_dokter
     */
    public function get_dokter_setting($kd_dokter)
    {
        $query = $this->db->get_where('moizhospital_display_dokter_settings', [
            'kd_dokter' => $kd_dokter
        ]);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        return null;
    }

    /**
     * Update or insert dokter foto
     */
    public function update_dokter_foto($kd_dokter, $foto_path)
    {
        $existing = $this->get_dokter_setting($kd_dokter);

        if ($existing) {
            // Update
            $this->db->where('kd_dokter', $kd_dokter);
            return $this->db->update('moizhospital_display_dokter_settings', [
                'foto_path' => $foto_path,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            // Insert
            return $this->db->insert('moizhospital_display_dokter_settings', [
                'kd_dokter' => $kd_dokter,
                'foto_path' => $foto_path,
                'show_in_display' => 'Ya',
                'is_active' => 'Ya',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

    /**
     * Toggle dokter display
     */
    public function toggle_dokter_display($kd_dokter, $show_in_display)
    {
        $existing = $this->get_dokter_setting($kd_dokter);

        if ($existing) {
            $this->db->where('kd_dokter', $kd_dokter);
            return $this->db->update('moizhospital_display_dokter_settings', [
                'show_in_display' => $show_in_display,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            return $this->db->insert('moizhospital_display_dokter_settings', [
                'kd_dokter' => $kd_dokter,
                'show_in_display' => $show_in_display,
                'is_active' => 'Ya',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

    /**
     * Get foto dokter path
     */
    public function get_dokter_foto($kd_dokter)
    {
        $setting = $this->get_dokter_setting($kd_dokter);

        if ($setting && $setting['foto_path']) {
            return $setting['foto_path'];
        }

        // Return default
        return $this->get_setting_value('default_doctor_photo', 'assets/dist/img/user1-128x128.jpg');
    }
}

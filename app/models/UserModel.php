<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct(){
        parent::__construct();
    }


    public function get_user_by_id($id)
        {
            return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get();
        }

        public function get_all_users()
        {
            return $this->db->table($this->table)->get_all();
        }
}   
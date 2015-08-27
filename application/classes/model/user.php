<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User {

    function has_role($role){
        return $this->has('roles', ORM::factory('role', array('name' => array($role))));
    }

    function get_user_roles($id = false){
        return DB::select('roles.*')
            ->from('roles_users')
            ->where('user_id', '=', ($id ? $id : $this->id))
            ->join('roles')
            ->on('roles.id', '=', 'roles_users.role_id')
            ->execute()
            ->as_array();
    }
    function get_all_roles(){
        return DB::select(DB::expr('roles.*'))
            ->from('roles')
            ->execute()
            ->as_array();
    }

    function change_user_details($id, $details){
        unset($details['id']); //make sure we're note trying to change the id

        $delete_roles = DB::delete('roles_users')->where('user_id', '=', $id);
        $delete_roles->execute();

        foreach ($details['role'] as $role) {
            $insert_roles = DB::insert('roles_users', array('user_id', 'role_id'))->values(array($id, $role));
            $insert_roles->execute();
        }
        unset($details['role']);


        $update_user = DB::update('users')
            ->set($details)
            ->where('id', '=', $id);
        $update_user->execute();

    }

} // End User Model
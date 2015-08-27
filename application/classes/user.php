<?php

class User{
	private $user_data = array();
    private static $instance;
    protected $user_id;
    static $upload = array(
    		'cv' => 'upload/user/cv/',
    		'image' => 'upload/user/image/'
    	);
    static $imagetypes = array(
    	'jpg' => 'image/jpeg',
    	'png' => 'image/png'
    );
	/**
	 * Constructor
	 *
	 * @param int $user_id       - Specific user id. Pass FALSE to use username and password
	 * @param str $username      - Ignored if $user_id is passed
	 * @param str $password      - Plain text password, ignored if $user_id is passed
	 * @param str $instance_name - Instance name
	 * @param bol $session       - Defines if the logged in user id should be saved in session
	 */
	public function __construct($username = false, $password = false)
	{
		if (($username) && ($password))
		{
			$this->instance()->login_by_username_and_password($username, $password);
		}
	}

    /**
	 * Instance
	 * Singleton function
	 *
	 * @return object
	 */
    static function instance(){
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;

    }

    /**
	 * getId
	 * returns the current users userID
	 *
	 * @return int
	 */
    function getId(){
        return $this->user_id;
    }

    /**
	 * encrypt_password
	 * encrypts and returns the string
	 *
	 * @param string password
	 * @return string
	 */
    public static function encrypt_password($password){
        return md5($password);
    }
    /**
	 * Change user password
	 * encrypts and returns the string
	 *
	 * @param int userid
	 * @param string password
	 */
    public static function change_password($userid, $password){
        $query = DB::update('user')
        			->set(array('password' => self::encrypt_password($password)))
        			->where('user_id', '= ', $userid)
        			->execute();
    }

    /**
	 * Create User
	 * Creates a basic user to access more of the site
	 *
	 * @param string fname
	 * @param string lname
	 * @param string username
	 * @param string password
	 * @return int
	 */
    public static function create_user($fname, $lname, $username, $password, $email, $usertype =1){
        $query = DB::insert('user', array('fname', 'lname', 'username', 'password', 'email',  'acceptTos', 'usertype'))
                            ->values(
                                array(
                                    $fname,
                                    $lname,
                                    $username,
                                	self::encrypt_password($password),
                                	$email,
                                    1,
                                    $usertype
                                )
                             );
		return $query->execute();
    }

    /**
	 * Login by username and password
	 * Takes username and password, searches the db for a match and then calls login_by_user_id
	 *
	 * @param string username
	 * @param string password
	 * @return mixed
	 */
    function login_by_username_and_password($username, $password){
        $sql = DB::select('user_id')
                ->from('user')
                ->where('username','=',$username)
                ->and_where('password','=',$this->encrypt_password($password));
        $id = $sql->execute()
                ->as_array();
        if(count($id) > 0){
            return $this->login_by_user_id($id[0]['user_id']);
        } else {
            return false;
        }
    }

    /**
	 * Login by user id
	 * Takes userid and logs the user in
	 *
	 * @param int id
	 * @return mixed
	 */
    function login_by_user_id($id){
        if($this->instance()->get_username_by_id($id)){
            return $this->instance()->load_user_data($id);
        } else {
            return false;
        }
    }

    /**
	 * Load user data
	 * Called when login occurs. Loads the users data into the object
	 *
	 * @param int id
	 * @return mixed
	 */
    function load_user_data($id){
        $data = $this->get_user_data($id);
        if($data){
            $this->instance()->user_id = $id;
            $this->instance()->user_data = $data;
            return $this;
        }
        return false;
    }

    /**
	 * Get user data
	 * Gets the userdata from the database
	 *
	 * @param int id
	 * @return array
	 */
    public static function get_user_data($id){
        $data = DB::select('*')->from('user')->where('user_id','=',$id)->execute()->as_array();
        if(count($data)){
            unset($data[0]['user_id'], $data[0]['password']);
            return $data[0];
        } else {
            return array();
        }
    }
    static function get_data_by_user_id($field, $user_id){
    	$data = DB::select($field)->from('user')->where('user_id','=',$user_id)->execute()->as_array();
        if(count($data) > 0){
            return $data[0][$field];
        } else {
            return false;
        }
    }
    /**
	 * Get username by id
	 * returns the username corresponding to the user_id
	 *
	 * @param int id
	 * @return mixed string username on success else false
	 */
    static function get_username_by_id($id){
    	return self::get_data_by_user_id('username', $id);
    }
    /**
     * Get full name by id
     * returns the username corresponding to the user_id
     *
     * @param int id
     * @return mixed string full name on success else false
     */

    static function get_name_by_id($id){
        $username = DB::select_array(array('fname', 'lname'))->from('user')->where('user_id','=',$id)->execute()->as_array();
        if(count($username) > 0){
            return $username[0]['fname']. ' '. $username[0]['lname'];
        } else {
            return false;
        }
    }
    /**
     * Get userid from field
     * returns the userid corresponding to the field value
     *
     * @param string field
     * @param string value
     * @return mixed userid on success else false
     */

    static function get_userid_by_field($field, $value){
        $userid = DB::select('user_id')->from('user')->where($field,'=',$value)->execute()->as_array();
        if(count($userid) > 0){
            return $userid[0]['user_id'];
        } else {
            return false;
        }
    }

    /**
	 * Logged in
	 * Checks to see if the user is currently logged in.
	 *
	 * @return bool
	 */
    function logged_in(){
        if(isset($this->user_id) && is_numeric($this->user_id)){
            return true;
        } else {
            return false;
        }
    }

    /**
	 * isAdmin
	 * Checks whether or not the user has administrative rights
	 *
	 * @return bool
	 */
    function isAdmin(){
        if($this->logged_in() && $this->user_data['usertype'] == 3)
            return true;
        else
            return false;
    }
    /**
	 * get full name
	 * Returns the full name of the current user
	 *
	 * @return string
	 */
    public function get_full_name(){
        return $this->user_data['firstname'].' '.$this->user_data['lastname'];
    }

    /**
	 * free username
	 * Used in the validation process to check whether or not a username is taken
	 *
	 * @param string username
	 * @return bool
	 */
    static function free_username($username){
        $free = DB::select('username')->from('users')->where('username','=',$username)->execute()->as_array();
        if(count($free) == 0)
            return true;
        else
            return false;
    }

    static function find_user_image($id = NULL){
    	foreach(self::$imagetypes as $ext => $it){
	    	if(is_file(self::$upload['image'].$id.'.'.$ext)){
    			return self::$upload['image'].$id.'.'.$ext;
    		}
    	}
    	return false;
    }
    public static function random_password($length = 8){
        $chars = 'abcdefghigjklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ1234567890';
        $pass = "";
        for($i =0; $i<$length;$i++){
            $r = rand(0, strlen($chars)-1);
            $pass .= $chars[$r];
        }
        return $pass;
    }
}




?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

 * CodeIgniter Notification Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Library
 * @category	Library
 * @author		Andri Setiawan
 * @link		https://github.com/shevtiawan
 */

// ------------------------------------------------------------------------

class Auth {
	
	var $users_table = '';
	var $CI;
	
	function Auth()
	{
		$this->CI =& get_instance();
		$this->users_table = 'perusahaan';
	}
	
	//cek apakah username & password sesuai
	function is_verified($username,$password)
	{
		$this->CI->db->where('username',$username);
    	$this->CI->db->where('password',$password);
    	$query = $this->CI->db->get($this->users_table);
		return ($query->num_rows()>0) ? true : false;
	}
	
	//menyimpan userdata
	function authenticate($username,$role)
	{
		$newdata = array(
               'username'  => $username,
				'role'     => $role,
               'logged_in' => TRUE
           );
         return ($this->CI->session->set_userdata($newdata)) ? true : false;
	}
	
	//hapus semua userdata di session (logout)
	function unauthenticate()
	{
		return ($this->CI->session->sess_destroy()) ? true : false;
	}
	
	//cek apakah current user sudah login
	function is_logged_in()
	{
		return ($this->CI->session->userdata('logged_in')) ? true : false;
	}

	//mendapatkan data user yang sedang login
	function get_current_user()
	{
		return ($this->CI->session->userdata('username')) ? $this->CI->session->userdata('username') : false;
	}

	//cek apakah yg sedang login adalah admin
	function is_admin()
	{
		return ($this->CI->session->userdata('role') == 'admin') ? true : false;
	}

	//cek apakah user yg sedang login punya role $role
	function is_current_user_role($role)
	{
		return ($this->CI->session->userdata('role') == $role) ? true : false;
	}

	//apa role dari user yg sedang login
	function get_current_role()
	{
		return ($this->CI->session->userdata('role')) ? $this->CI->session->userdata('role') : false;
	}

	//cek apakah yg sedang login adalah $username
	function is_current_user($username)
	{
		return ($this->CI->session->userdata('username') == $username) ? true : false;
	}
	
}

?>
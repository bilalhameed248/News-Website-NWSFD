<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_model 
{
	function logout()
	{
		//$this->session->unset_userdata('');
		$this->session->sess_destroy();
		$this->session->unset_userdata('token');
		return true;

	}
	function register($data)
	{
		$data=array(
		    'full_name' => $data['full_name'],
		    'email' => $data['email'],
		    'password'=>md5($data['password']),
		    'phone' => $data['phone'],
		);
		$isinsert=$this->db->insert('users', $data);
		if($isinsert)
		{
			$userdata = array(
			    'user_id' =>$user_id,
		        'email'     => $email,
		        'full_name'     => $full_name,
			    'logged_in' => TRUE
			);
			$this->session->set_userdata($userdata);
			return true;
		}		
	}
	
	function is_email_reg($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		$count=$query->num_rows();
		if($count>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function checklogin($data)
	{
		//print_r($data);
		$email=$data['email'];
		$password=$data['password'];
		$password = md5($password); 
		$query = $this->db->get_where('users', array('email' => $email,'password' =>$password));
		
		$count=$query->num_rows();
		if($count>0)
		{
			$info=$query->result();
			$full_name=$info[0]->full_name;
			$user_id=$info[0]->id;
			$userdata = array(
		        'user_id' =>$user_id,
		        'email'     => $email,
		        'full_name'     => $full_name,
		        'logged_in' => TRUE
				);
			$this->session->set_userdata($userdata);
			return true;	
		}
		else
		{
			return false;
		}
	}
	function count_all_news()
	{
		return $this->db->count_all('news_feed');
	}
	function get_authors($limit, $start) 
	{
        $this->db->limit($limit, $start);
        $this->db->order_by("id","desc");
        $query = $this->db->get('news_feed');
        return $query->result();
    }
	function get_all_news()
	{
		$this->db->select('*');
		$this->db->from('news_feed');
		$this->db->order_by("id","desc");
		$query = $this->db->get()->result();
		return $query;
	}
	function get_specific_news($id)
	{
		$query = $this->db->get_where('news_feed', array('id' => $id));
		 $row=$query->result();
		 return $row[0];
	}
	function add_news_to_db($data)
	{
		$data=array(
		    'title' => $data['title'],
		    'description' => $data['description'],
		    'image_url'   => $data['image_url'],
		    'url'   => $data['url'],
		    'created_at' => $data['created_at'],
		);
		$isinsert=$this->db->insert('news_feed', $data);
		if($isinsert)
		{
			return true;
		}		
	}
	function delete_news($id)
	{
		$this->db->where('id', $id);
   		$this->db->delete('news_feed'); 
	}
}

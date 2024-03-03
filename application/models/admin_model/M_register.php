
<?php
class M_register extends CI_Model{
    function simpan_user($username,$nama,$email,$password){
		$hsl=$this->db->query("INSERT INTO tabel_useradmin(username,nama,email,password) VALUES ('$username','$nama','$email',md5('$password'))");
		return $hsl;
}
}
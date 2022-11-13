<?php
class users
{
	var $con;
	var $user;
	var $username;
	var $userfullname;
	var $usercategory;
	var $userdate;
	var $gender;
	var $address;
	var $email;
	var $phone;
	var $password;
	var $photo;
	var $remarks;
	var $status;
	var $usercategoryname;
	var $userurl;
	var $userflag;
	function userinfo()
	{
	
				$user= $this -> user;
				$con= $this -> con;
				$uselect="SELECT a.*, b.* FROM `user` a, `user_category` b WHERE a.Categoryid=b.cid	AND `Uid`='$user'";
				$uresult=mysqli_query($con,$uselect);
				$urow=mysqli_fetch_array($uresult);
				
	$this->username=$urow["Userid"];
	$this->userfullname=$urow["Name"];
	$this->usercategory=$urow["Categoryid"];
	$this->usercategoryname=$urow["Category"];
	$this->userurl=$urow["url"];
	$this->userdate=$urow["Datetime"];
	$this->gender=$urow["Gender"];
	$this->address=$urow["Address"];
	$this->email=$urow["Email"];
	$this->phone=$urow["Phone"];
	$this->password=$urow["Password"];
	if($urow["Photo"]!='')
	{
	$this->photo=$urow["Photo"];
	}
	elseif($urow["Photo"]=='' && $urow["Gender"]=="male")
	{
	$this->photo="male.jpg";
	}
	elseif($urow["Photo"]=='' && $urow["Gender"]=="female")
	{
	$this->photo="female.jpg";
	}
	else
	{
		$this->photo="hanbaz.jpg";
	}
	$this->remarks=$urow["Remark"];
	$this->status=$urow["Status"];
	$this->uflag=$urow["Uflag"];
	}
}
?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	if(isset($_POST['update']))
	{
		$name=$_POST['name'];
		$contactno=$_POST['contactno'];
		$query=mysqli_query($con,"update users set name='$name',contactno='$contactno' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Your info has been updated');</script>";
		}
	}


date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT password FROM  users where password='".md5($_POST['cpass'])."' && id='".$_SESSION['id']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update students set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where id='".$_SESSION['id']."'");
echo "<script>alert('Password Changed Successfully !!');</script>";
}
else
{
	echo "<script>alert('Current Password not match !!');</script>";
}
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
	</head>
    <body class="cnt-home">
<header class="header-style-1">

<link rel="stylesheet" href="bootstrap/css/myacc.css">
<style type="text/css">
.btn-primary:hover, .btn-black:hover, .btn-primary:focus, .btn-black:focus {
    background: #000000;
}
</style>
</header>
<!-- ============================================== HEADER : END ============================================== -->
<?php
include('header.php');
?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="checkout-box inner-bottom-sm">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
						<?php include('includes/myaccount-sidebar.php');?>
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">

    	<h4 class="unicase-checkout-title">

	        <a  class="collapsed" >
	          <span>1</span>My Profile
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		
<h4>Personal info</h4>
				<div class="col-md-12 col-sm-12 already-registered-login">

<?php
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
?>

					<form class="register-form" role="form" method="post">
<div class="form-group">
					    <label class="info-title" for="name">Name<span>*</span></label>
					    <input type="text" class="form-control" value="<?php echo $row['name'];?>" id="name" name="name" required="required" >
					  </div>



						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
			 <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="<?php echo $row['email'];?>" readonly>
					  </div>
					  <div class="form-group">
					    <label class="info-title" for="Contact No.">Contact No. <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" required="required" value="<?php echo $row['contactno'];?>"  maxlength="10">
					  </div>
					  <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
					</form>
					<?php } ?>
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					    <!-- checkout-step-02  -->
					  	<div class="panel panel-default checkout-step-02">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a class="collapsed" >
						          <span>2</span>Change Password
						        </a>
						      </h4>
						   
						    <div id="collapseTwo">
						      <div class="panel-body">
						     
					<form class="register-form" role="form" method="post" name="chngpwd" onSubmit="return valid();">
<div class="form-group">
					    <label class="info-title" for="Current Password">Current Password<span>*</span></label>
					    <input type="password" class="form-control unicase-form-control text-input" id="cpass" name="cpass" required="required">
					  </div>



						<div class="form-group">
					    <label class="info-title" for="New Password">New Password <span>*</span></label>
			 <input type="password" class="form-control unicase-form-control text-input" id="newpass" name="newpass">
					  </div>
					  <div class="form-group">
					    <label class="info-title" for="Confirm Password">Confirm Password <span>*</span></label>
					    <input type="password" class="form-control unicase-form-control text-input" id="cnfpass" name="cnfpass" required="required" >
					  </div>
					  <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Change </button>
					</form> 

						      </div>
						    </div>
					  	</div>
					  	<!-- checkout-step-02  -->
					  
					</div><!-- /.checkout-steps -->
				</div>
			  	
			</div><!-- /.row -->

		</div><!-- /.checkout-box -->
</div>

</div>


	<!-- For demo purposes – can be removed on production -->
</body>
</html>
<?php } ?>
<?php
function head_part_home()
{
	?><head>
     <meta charset="UTF-8">
    <meta content="../favicon.ico" itemprop="image">
    <meta http-equiv="refresh" content="900" />
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <title>ORDER MANAGEMENT | Control Panel</title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
   <link href="../downloads/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../downloads/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
  
     
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    
      <!-- page script -->
  
    <link href="../dist/css/skins/skin-black.min.css" rel="stylesheet" type="text/css" />

    </head>

    <script type="text/javascript" async src="../export/ga.js"></script>
    <script src="../export/jquery.min.js"></script>

<script type="text/javascript" src="../export/tableExport.js"></script>
<script type="text/javascript" src="../export/jquery.base64.js"></script>
<script type="text/javascript" src="../export/html2canvas.js"></script>
<script type="text/javascript" src="../export/sprintf.js"></script>
<script type="text/javascript" src="../export/jspdf.js"></script>
<script type="text/javascript" src="../export/base64.js"></script>
    <?php
}
?>


<?php
function head_part()
{
	?><head>
     <meta charset="UTF-8">
    <meta content="../favicon.ico" itemprop="image">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <title>ORDER MANAGEMENT | Control Panel</title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="../downloads/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <link href="../downloads/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
      
    <!-- DATA TABLES -->
     
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    
      <!-- page script -->
  
    <link href="../dist/css/skins/skin-black.min.css" rel="stylesheet" type="text/css" />
    
     <!-- daterange picker -->
    <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="../plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="../plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="../plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

        <link href="../select/select2.css" rel="stylesheet"/>
    </head>
 
    <script type="text/javascript" async src="../export/ga.js"></script>
    <script src="../export/jquery.min.js"></script>

<script type="text/javascript" src="../export/tableExport.js"></script>
<script type="text/javascript" src="../export/jquery.base64.js"></script>
<script type="text/javascript" src="../export/html2canvas.js"></script>
<script type="text/javascript" src="../export/sprintf.js"></script>
<script type="text/javascript" src="../export/jspdf.js"></script>
<script type="text/javascript" src="../export/base64.js"></script>
 
    <?php
}
?>

<?php
function top($con)
{
	?>
       <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser'];
	$userclasst->con=$con;
	$userclasst->userinfo();
?>
	 <!-- Main Header -->
      <header class="main-header">

      <a href=" ">
        <img src="../profile/LOGO1.png"/>
        </a>

        <!-- Logo -->
        
   

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
             <?php
			 $allflag=0;
			 
			 if($allflag!=0)
			 {
			 ?>
             
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>                            
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <!-- The message -->
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->                      
                    </ul><!-- /.menu -->
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li><!-- /.messages-menu -->

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li><!-- end notification -->                      
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks Menu -->
              <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- Inner menu: contains the tasks -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <!-- Task title and progress text -->
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <!-- The progress bar -->
                          <div class="progress xs">
                            <!-- Change the css width attribute to simulate progress -->
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->                      
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              
              
              
              <?php
			 }
				?>
			  
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="../profile/<?php echo $userclasst->photo; ?>" class="user-image" alt="User Image"/>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
               
                  <span class="hidden-xs"> <?php echo $userclasst->userfullname; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="../profile/<?php echo $userclasst->photo; ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $userclasst->userfullname; ?> - <?php echo $userclasst->usercategoryname; ?>
                      <small>Member since 
                      <?php
					  $datefrom=$userclasst->userdate;
					  $year=substr($datefrom,0,4);
					  $monthint=substr($datefrom,5,2);
					  if($monthint==1)
					  {
						  $month="Jan";
					  }
					  elseif($monthint==2)
					  {
						  $month="Feb";
					  }
					  elseif($monthint==3)
					  {
						  $month="Mar";
					  }
					  elseif($monthint==4)
					  {
						  $month="Apr";
					  }
					  elseif($monthint==5)
					  {
						  $month="May";
					  }
					  elseif($monthint==6)
					  {
						  $month="Jun";
					  }
					  elseif($monthint==7)
					  {
						  $month="Jul";
					  }
					  elseif($monthint==8)
					  {
						  $month="Aug";
					  }
					  elseif($monthint==9)
					  {
						  $month="Sep";
					  }
					  elseif($monthint==10)
					  {
						  $month="Oct";
					  }
					  elseif($monthint==11)
					  {
						  $month="Nov";
					  }
					  elseif($monthint==12)
					  {
						  $month="Dec";
					  }
					  else
					  {
						  $month="";
					  }
					  ?>
                      <?php echo $month.". ".$year;  ?></small>
                    </p>
                  </li>
                 
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="../login/logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
    <?php
}
?>


<?php 
function admin_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
         <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
          <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>

           
            <li class="treeview"><a href="moved-orders.php">
                <i class="fa fa-rocket"></i><span>Moved Orders</span></a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-list-ul"></i>
                <span>Delivery Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="alloted-orders.php"><i class="fa  fa-paperclip"></i> Order Status</a></li>
               <li><a href="district-orders.php"><i class="fa fa-bullseye"></i> District Wise</a></li>
                <li><a href="product-orders.php"><i class="fa fa-tags"></i> Product Wise</a></li>
                <li><a href="dist-orders.php"><i class="fa fa-truck"></i> District Wise Products</a></li>
                <li><a href="pending-orders.php"><i class="fa fa-question-circle"></i> Pending Orders</a></li>
                <li><a href="order_by_campaigns.php"><i class="fa fa-phone"></i> Orders by Campaigns</a></li>
              </ul>
            </li>
      
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Agents Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="acc-summary.php"><i class="fa fa-book"></i> Account Summary</a></li>
              <li><a href="trans-report.php"><i class="fa fa-truck"></i>Inventory Transactions</a></li>
              <li><a href="acc-report.php"><i class="fa fa-inr"></i>Account Transactions</a></li>
              <li><a href="agent-balance.php"><i class="fa fa-book"></i> Agent Balance</a></li>
                <li><a href="stock-report.php"><i class="fa fa-tags"></i> Agent Stock</a></li>               
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Call Centre Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

              <li><a href="order-value.php"><i class="fa fa-money"></i> Order Value (BPE)</a></li>

              <li><a href="call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                <li><a href="order-summary.php"><i class="fa fa-shopping-cart"></i>Order Summary</a></li>
                <li><a href="bpe-performance.php"><i class="fa fa-star-half-o"></i>BPE Performance</a></li>
                <li><a href="campaign-summary.php"><i class="fa fa-bar-chart-o"></i>Campaign Summary</a></li>
                <li><a href="direct-summary.php"><i class="fa fa-comments-o"></i> Direct Leads Summary</a></li>
                </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Alloted Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="fresh-data-alloted.php"><i class="fa fa-sitemap"></i> Fresh Leads</a></li>
               <li><a href="sec-data-alloted.php"><i class="fa fa-sitemap"></i> Secondary Leads</a></li>
               <li><a href="dir-data-alloted.php"><i class="fa fa-comments-o"></i> Direct Leads</a></li>
               <li><a href="pending-follow-up.php"><i class="fa fa-paperclip"></i> Pending Follow Up</a></li>
               </ul>
            </li>
            
              <li><a href="edit_order.php"><i class="fa fa-edit"></i>Order Edit</a></li>
              <li><a href="order_slip.php"><i class="fa fa-print"></i>Delivery Slip</a></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-upload"></i> <span>Data Upload</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="upload_fresh.php"><i class="fa fa-bell-o"></i> Fresh Data</a></li>
              	<li><a href="upload_secondary.php"><i class="fa fa-database"></i>Secondary Data</a></li>
                <li><a href="campaigns.php"><i class="fa fa-phone-square"></i>Campaigns</a></li>
              </ul>
            </li>
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Manage Agents</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="inventory.php"><i class="fa fa-shopping-cart"></i> Inventory</a></li>
              	<li><a href="account.php"><i class="fa fa-dollar"></i>Account Balance</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i> <span>Users</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="user_search.php"><i class="fa fa-list-ul"></i>Users List</a></li>
               <li><a href="users.php"><i class="fa fa-edit"></i>Manage Users</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#">
                <i class="fa fa-tag"></i> <span>Products</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="product_search.php"><i class="fa fa-list-ul"></i>Product List</a></li>
               <li><a href="products.php"><i class="fa fa-edit"></i>Manage Products</a></li>
               
              </ul>
            </li>

             
             
              <li><a href="order_search.php"><i class="fa fa-search"></i>Order Search</a></li>
            
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>


<?php 
function system_nav($con)
{
  ?>
    <?php
require_once("class/user.php");
    $userclasst=new users();
    $userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
  $userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
         <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
          <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>

            <li class="treeview"><a href="bulk-orders.php">
                <i class="fa fa-truck"></i><span>Bulk Orders to Confirm</span></a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-list-ul"></i>
                <span>Delivery Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="alloted-orders.php"><i class="fa  fa-paperclip"></i> Order Status</a></li>
               <li><a href="district-orders.php"><i class="fa fa-bullseye"></i> District Wise</a></li>
                <li><a href="product-orders.php"><i class="fa fa-tags"></i> Product Wise</a></li>
                <li><a href="dist-orders.php"><i class="fa fa-truck"></i> District Wise Products</a></li>
                <li><a href="pending-orders.php"><i class="fa fa-question-circle"></i> Pending Orders</a></li>
              </ul>
            </li>
      
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Agents Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="acc-summary.php"><i class="fa fa-book"></i> Account Summary</a></li>
              <li><a href="trans-report.php"><i class="fa fa-truck"></i>Inventory Transactions</a></li>
              <li><a href="acc-report.php"><i class="fa fa-inr"></i>Account Transactions</a></li>
              <li><a href="agent-balance.php"><i class="fa fa-book"></i> Agent Balance</a></li>
                <li><a href="stock-report.php"><i class="fa fa-tags"></i> Agent Stock</a></li>               
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Call Centre Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

              <li><a href="order-value.php"><i class="fa fa-money"></i> Order Value (BPE)</a></li>

              <li><a href="call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                <li><a href="order-summary.php"><i class="fa fa-shopping-cart"></i>Order Summary</a></li>
                <li><a href="bpe-performance.php"><i class="fa fa-star-half-o"></i>BPE Performance</a></li>
                <!--<li><a href="campaign-summary.php"><i class="fa fa-bar-chart-o"></i>Campaign Summary</a></li>-->
                </ul>
            </li>
            
              <li><a href="edit_order.php"><i class="fa fa-edit"></i>Order Edit</a></li>
              <li><a href="order_slip.php"><i class="fa fa-print"></i>Delivery Slip</a></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-upload"></i> <span>Data Upload</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="upload_fresh.php"><i class="fa fa-bell-o"></i> Fresh Data</a></li>
                <li><a href="upload_secondary.php"><i class="fa fa-database"></i>Secondary Data</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-paperclip"></i> <span>Data Allotment</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li class="treeview"><a href="fresh.php">
                <i class="fa fa-bell-o"></i><span>Fresh Data Allotment</span></a>
            </li>
            
            <li class="treeview"><a href="secondary.php">
                <i class="fa fa-database"></i><span>Secondary Data Allotment</span></a>
            </li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Alloted Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="fresh-data-alloted.php"><i class="fa fa-sitemap"></i> Fresh Leads</a></li>
               <li><a href="sec-data-alloted.php"><i class="fa fa-sitemap"></i> Secondary Leads</a></li>
               </ul>
            </li>

              <li><a href="order_search.php"><i class="fa fa-search"></i>Order Search</a></li>
            
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
                <li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
  <?php
}
?>
<?php 
function footer($con)
{
	?>
  <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
           info@test.in
        </div>
        <!-- Default to the left --> 
        <strong>Copyright &copy; 
		<script language="javascript" type="text/javascript">
var today = new Date()
var year = today.getFullYear()
document.write(year)
</script>
 <a href="http://test.in/">ORDER MANAGEMENT</a>.</strong> All rights reserved.
      </footer>	
    <?php
	mysqli_close($con);
}
?>


<?php
function jss()
{
	?>

     
    <script src="../select/select2.js"></script>
    <script>
        $(document).ready(function() {
            $("#states").select2();
			$("#post").select2();
			$("#citys").select2();
			$("#product").select2();
        });
    </script>
  
  
    <!-- jQuery UI 1.11.2 -->
    <!--<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>-->
    <script src="../downloads/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
      <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>  
    <!-- Morris.js charts -->
    <!--<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
    <script src="../downloads/raphael-min.js"></script>
    
    <script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
   
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>


<!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    
    <!-- InputMask -->
    <script src="../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="../plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    
    
    <?php
}
?>

<?php 
function afm_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../profile/<?php echo $userclasst->photo; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $userclasst->userfullname; ?></p>
              <!-- Status -->
              <?php
			  $flag=$userclasst->uflag;
			  if($flag==1)
			  {
			  ?>
              <a href="index.php"><i class="fa fa-circle text-success"></i> Online</a>
              <?php
			  }
			  else
			  {
			  ?>
               <a href="index.php"><i class="fa fa-circle text-danger"></i> Offline</a>
               <?php
			  }
			  ?>
              
            </div>
          </div>

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
         
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
            <li class="treeview">
              <a href="live.php">
                <i class="fa fa-check-circle-o"></i>
                <span>Live Franchisees</span>
              </a>
              </li>
              
               <li class="treeview">
              <a href="locations.php">
                <i class="fa fa-map-marker"></i>
                <span>Locations</span>
              </a>
              </li>
             
            <li class="treeview">
              <a href="post.php">
                <i class="fa fa-truck"></i>
                <span>Post Office Coverage</span>
              </a>
              </li>
            
            
         <!--   <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Manage Franchisees</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="my_franchise.php"><i class="fa fa-check-square-o"></i> My Franchisees </a></li>
               <li><a href="orders.php"><i class="fa fa-tags"></i> Manage Orders</a></li>
               <li><a href="stock.php"><i class="fa fa-signal"></i> Manage Stock</a></li>
               <li><a href="invoices.php"><i class="fa fa-barcode"></i> Show Invoices</a></li>  
               <li><a href="create_franchise.php"><i class="fa fa-plus-circle"></i> Create a Franchise </a></li>
               <li><a href="areas.php"><i class="fa fa-map-marker"></i> Manage Area </a></li>
               <li><a href="pos.php"><i class="fa fa-map-marker"></i> Manage POs </a></li>
              <li><a href="#"><i class="fa fa-mail-forward"></i> Transfer</a></li>         
              </ul>
            </li>-->
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tasks"></i> <span>My Tasks (Primary)</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="afm_new_data.php"><i class="fa fa-eye"></i> Show New Data</a></li>
               <li><a href="afm_my_schedules.php"><i class="fa fa-clock-o"></i>Scheduled Follow-Ups</a></li>
               <li><a href="afm_followups.php"><i class="fa fa-comments-o"></i> Pending Follow-Ups</a></li>
               
                <li><a href="afm_pending.php"><i class="fa fa-question"></i> Follow-Up Search</a></li>
                
               
                <li><a href="afm_user_feedback.php"><i class="fa fa-comments-o"></i>User Feedbacks</a></li>
              </ul>
            </li>
            
            
            
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>My Tasks (Secondary)</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="safm_new_data.php"><i class="fa fa-eye"></i> Show New Data</a></li>
               <li><a href="safm_my_schedules.php"><i class="fa fa-clock-o"></i>Scheduled Follow-Ups</a></li>
               <li><a href="safm_followups.php"><i class="fa fa-comments-o"></i> Pending Follow-Ups</a></li>
               
                <li><a href="safm_pending.php"><i class="fa fa-question"></i> Follow-Up Search</a></li>
                
               <li><a href="afm_closed_calls.php"><i class="fa fa-phone"></i>Closed Calls</a></li>
               
                <li><a href="afm_profile_edit.php"><i class="fa fa-edit"></i>My Profiles</a></li>
               
              </ul>
            </li>
            
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>My Tasks</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="my_schedule.php"><i class="fa fa-calendar"></i> My Schedules </a></li>
               <li><a href="leads.php"><i class="fa fa-comments"></i> Manage Leads</a></li>
               <li><a href="response.php"><i class="fa fa-thumbs-o-up"></i> Manage Follow-ups</a></li>-->
               
               <!--<li><a href="payment.php"><i class="fa fa-money"></i> Manage Payments</a></li>--> 
              <!-- <li><a href="schedule.php"><i class="fa fa-calendar"></i> Manage Schedules </a></li>-->
              
             <!-- <li><a href="status.php"><i class="fa fa-thumbs-up"></i> Manage Status </a></li>   
              <li><a href="create_franchise.php"><i class="fa fa-plus-circle"></i> Create a Franchise </a></li>  
              <li><a href="my_franchise.php"><i class="fa fa-check-square-o"></i> My Franchisees </a></li>
   
              </ul>
            </li>-->
            
            
           <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             	<li><a href="#"><i class="fa fa-bar-chart-o"></i> Status Report</a></li>
                <li><a href="#"><i class="fa fa-flag-o"></i> My Franchisees</a></li>
                <li><a href="#"><i class="fa fa-truck"></i> Stock Report</a></li>
                 <li><a href="#"><i class="fa fa-signal"></i> Coverage Report</a></li>
                <li><a href="#"><i class="fa fa-bar-chart-o"></i> Perfomance Report</a></li>
                <li><a href="#"><i class="fa fa-bar-chart-o"></i> Collection Report</a></li>
              </ul>
            </li>-->
           
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Routine Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             	<li><a href="ofm_call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                
                <li><a href="ofm_tme-performance.php"><i class="fa fa-star-half-o"></i>AFM Performance</a></li>
                
                                                             
                
              </ul>
            </li>
           
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
               <li><a href="area_search.php"><i class="fa fa-map-marker"></i> Franchisee Area</a></li>
               <li><a href="po_search.php"><i class="fa  fa-envelope-o"></i> Franchisee PO</a></li>
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                <li><a href="customer_search.php"><i class="fa fa-smile-o"></i> Customers</a></li>
              </ul>
              
              </li>
            
            
          
              <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>

<?php 
function bdm_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
           <li><a href="order_stati.php"><i class="fa fa-edit"></i> Delivery Status Update</a></li> 
           <li><a href="order_slip.php"><i class="fa fa-print"></i> Order Slips </a></li> 
           
             <li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i>
                <span>Orders</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="scheduled_orders.php"><i class="fa fa-lightbulb-o"></i> Scheduled Orders </a></li> 
              <li><a href="pending_orders.php"><i class="fa fa-exclamation-triangle"></i> Pending Orders </a></li>
              <li><a href="delivered_orders.php"><i class="fa fa-check-circle"></i> Delivered Orders </a></li> 
 			<li><a href="canceled_orders.php"><i class="fa fa-times-circle"></i> Canceled Orders </a></li> 
             <li><a href="rejected_orders.php"><i class="fa fa-reply-all"></i> Rejected Orders </a></li> 
               </ul>
            </li>
            
            
               
              <li class="treeview">
              <a href="#">
                <i class="fa fa-list-ul"></i>
                <span>Order Details</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="product-orders.php"><i class="fa fa-tags"></i> Product Wise</a></li>
              <li><a href="dist-orders.php"><i class="fa fa-truck"></i>  Product to Sub Agents</a></li>
                
              </ul>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Manage Sub Agents</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
              <li><a href="create_franchise.php"><i class="fa fa-plus-circle"></i> Create a Sub Agent </a></li>  
                
              </ul>
            </li>
            
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             	<li><a href="pending-orders.php"><i class="fa fa-bar-chart-o"></i>Order Summary</a></li>
               <li><a href="stock-report.php"><i class="fa fa-tags"></i> Stock Report</a></li>
                <li><a href="trans-report.php"><i class="fa fa-truck"></i> Transactions Report</a></li>
                <li><a href="acc-report.php"><i class="fa fa-inr"></i> Payment Report</a></li>
                <li><a href="acc-summary.php"><i class="fa fa-book"></i> Account Summary</a></li>
                <li><a href="#"><i class="fa fa-flag-o"></i> My Sub Agents</a></li>
              </ul>
            </li>
           
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
              <li><a href="order_status.php"><i class="fa fa-book"></i> Track Order</a></li>
              </ul>
              
              </li>
    <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>


<?php 
function online_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          
         
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
            <li class="treeview">
              <a href="live.php">
                <i class="fa fa-check-circle-o"></i>
                <span>Order Entry</span>
              </a>
              </li>
             
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Manage Franchisees</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              
               <li><a href="areas.php"><i class="fa fa-map-marker"></i> Manage Area </a></li>
               <li><a href="pos.php"><i class="fa fa-map-marker"></i> Manage POs </a></li>
                            
              </ul>
            </li>
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i>
                <span>Manage Orders</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              
              <li><a href="order_stati.php"><i class="fa fa-signal"></i> Status Management [i]</a></li>
              
              <li><a href="order_allocation.php"><i class="fa fa-sitemap"></i> Order Allocation </a></li>
              <li><a href="rejected_orders.php"><i class="fa fa-thumbs-down"></i> Rejected Orders </a></li>
              <li><a href="order_slip.php"><i class="fa fa-print"></i> Order Slips </a></li> 
              <li><a href="alloted_orders.php"><i class="fa fa-thumb-tack"></i> Alloted Orders </a></li> 
              <li><a href="withheld_orders.php"><i class="fa fa-briefcase"></i> Withheld Orders </a></li>
              <li><a href="canceled_orders.php"><i class="fa fa-times-circle"></i> Cancelled Orders </a></li> 
              <li><a href="delivered_orders.php"><i class="fa fa-check-circle"></i> Delivered Orders </a></li> 
              <li><a href="pending_orders.php"><i class="fa fa-exclamation-triangle"></i> Pending Orders </a></li> 
              <li><a href="overdue_orders.php"><i class="fa fa-lightbulb-o"></i> Overdue Orders </a></li>
              <li><a href="order_stat.php"><i class="fa fa-signal"></i> Status Management </a></li>     
              </ul>
            </li>
            
            
            
              <li class="treeview">
              <a href="#">
                <i class="fa fa-list-ul"></i>
                <span>Secondary Sales</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="district-orders.php"><i class="fa fa-bullseye"></i> District Wise</a></li>
              
             	<li><a href="franchisee-orders.php"><i class="fa fa-book"></i> Franchise Wise</a></li>
                
                <li><a href="location-orders.php"><i class="fa fa-map-marker"></i> Location Wise</a></li>
                
               <!-- <li><a href="#"><i class="fa fa-user"></i> Manager Wise</a></li>-->
               
                 
                <li><a href="product-orders.php"><i class="fa fa-tags"></i> Product Wise</a></li>
                
                <li><a href="dist-orders.php"><i class="fa fa-truck"></i>  Product to Franchise</a></li>
                
                <li><a href="pending-orders.php"><i class="fa fa-question-circle"></i> Pending Orders</a></li>
              
              </ul>
            </li>
            
            
            
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             	<li><a href="#"><i class="fa fa-bar-chart-o"></i> Status Report</a></li>
                <li><a href="#"><i class="fa fa-flag-o"></i> My Franchisees</a></li>
                <li><a href="#"><i class="fa fa-truck"></i> Stock Report</a></li>
                 <li><a href="#"><i class="fa fa-signal"></i> Coverage Report</a></li>
                <li><a href="#"><i class="fa fa-bar-chart-o"></i> Perfomance Report</a></li>
                <li><a href="#"><i class="fa fa-bar-chart-o"></i> Collection Report</a></li>
              </ul>
            </li>
           
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
               <li><a href="area_search.php"><i class="fa fa-map-marker"></i> Franchisee Area</a></li>
               <li><a href="po_search.php"><i class="fa  fa-envelope-o"></i> Franchisee PO</a></li>
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                <li><a href="customer_search.php"><i class="fa fa-smile-o"></i> Customers</a></li>
                 <li><a href="order_status.php"><i class="fa fa-book"></i> Track Order</a></li>
              </ul>
              
              </li>
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>


<?php 
function frm_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
         
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            <li><a href="order_sheet.php"><i class="fa fa-list"></i>Delivery Sheet</a></li>
            <li><a href="order_slip.php"><i class="fa fa-print"></i>Delivery Slip</a></li>
            <li><a href="order_stati.php"><i class="fa fa-edit"></i> Delivery Status (Provisional)</a></li>
            <li><a href="order_allstat.php"><i class="fa fa-edit"></i> Delivery Status (Bulk Entry)</a></li> 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Mange Agents</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="sales.php"><i class="fa fa-shopping-cart"></i> Sales</a></li>
              	<li><a href="payments.php"><i class="fa fa-inr"></i>Payments</a></li>
                <li><a href="return.php"><i class="fa fa-reply"></i> Returns</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list-ul"></i>
                <span>Delivery Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="alloted-orders.php"><i class="fa  fa-paperclip"></i> Order Status</a></li>
               <li><a href="district-orders.php"><i class="fa fa-bullseye"></i> District Wise</a></li>
                <li><a href="product-orders.php"><i class="fa fa-tags"></i> Product Wise</a></li>
                <li><a href="dist-orders.php"><i class="fa fa-truck"></i> District Wise Products</a></li>
                <li><a href="pending-orders.php"><i class="fa fa-question-circle"></i> Pending Orders</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i>
                <span>Orders</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="allotment.php"><i class="fa  fa-paperclip"></i> Allotment Pending</a></li>
                <li><a href="alloted.php"><i class="fa  fa-clock-o"></i> Recent Allotments</a></li>
                <li><a href="rejected.php"><i class="fa fa-reply-all"></i> Rejected Allotments</a></li>
                <li><a href="withheld.php"><i class="fa fa-close"></i> Withhelded Allotments</a></li>
              </ul>
            </li>
      
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Agents Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="acc-summary.php"><i class="fa fa-book"></i> Account Summary</a></li>
              <li><a href="trans-report.php"><i class="fa fa-truck"></i>Inventory Transactions</a></li>
              <li><a href="acc-report.php"><i class="fa fa-inr"></i>Account Transactions</a></li>
              <li><a href="agent-balance.php"><i class="fa fa-book"></i> Agent Balance</a></li>
                <li><a href="stock-report.php"><i class="fa fa-tags"></i> Agent Stock</a></li>               
              </ul>
            </li>
           
           
           <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
		<li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Pending Orders</a></li>
   <li><a href="order_status.php"><i class="fa fa-book"></i> Track Order</a></li>
              </ul>
              
              </li>
            
             
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Advanced Options</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">             	
                <li><a href="districts.php"><i class="fa fa-wrench"></i> Agents Configuration</a></li>
               <!-- <li><a href="warehouse.php"><i class="fa fa-location-arrow"></i> Manage Warehouse</a></li>-->              
              </ul>
            </li>
            
            
          
              <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>


<?php 
function super_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
            <li class="treeview"><a href="fresh.php">
                <i class="fa fa-paperclip"></i><span>Fresh Data Allotment</span></a>
            </li>
            
            <li class="treeview"><a href="secondary.php">
                <i class="fa fa-database"></i><span>Secondary Data Allotment</span></a>
            </li>
            
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Alloted Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="fresh-data-alloted.php"><i class="fa fa-sitemap"></i> Fresh Leads</a></li>
               <li><a href="sec-data-alloted.php"><i class="fa fa-sitemap"></i> Secondary Leads</a></li>
               </ul>
            </li>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

              <li><a href="order-value.php"><i class="fa fa-money"></i> Order Value (BPE)</a></li>

             	<li><a href="call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                <li><a href="order-summary.php"><i class="fa fa-shopping-cart"></i>Order Summary</a></li>
                <li><a href="bpe-performance.php"><i class="fa fa-star-half-o"></i>BPE Performance</a></li>
                <li><a href="campaign-summary.php"><i class="fa fa-bar-chart-o"></i>Campaign Summary</a></li>
                </ul>
            </li>
            
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
            <li><a href="order_status.php"><i class="fa fa-book"></i> Track Order</a></li>
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                <li><a href="product_search.php"><i class="fa fa-tags"></i> Product List</a></li>
                <li><a href="user_search.php"><i class="fa fa-users"></i> Users List</a></li>
              </ul>
              
              </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>

<?php 
function biz_nav($con)
{
  ?>
    <?php
require_once("class/user.php");
    $userclasst=new users();
    $userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
  $userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
             <li class="treeview"><a href="bulk-orders.php">
                <i class="fa fa-truck"></i><span>Bulk Orders to Confirm</span></a>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Alloted Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="fresh-data-alloted.php"><i class="fa fa-sitemap"></i> Fresh Leads</a></li>
               <li><a href="sec-data-alloted.php"><i class="fa fa-sitemap"></i> Secondary Leads</a></li>
               </ul>
            </li>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

              <li><a href="order-value.php"><i class="fa fa-money"></i> Order Value (BPE)</a></li>

              <li><a href="call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                <li><a href="order-summary.php"><i class="fa fa-shopping-cart"></i>Order Summary</a></li>
                <li><a href="bpe-performance.php"><i class="fa fa-star-half-o"></i>BPE Performance</a></li>
                <!--<li><a href="campaign-summary.php"><i class="fa fa-bar-chart-o"></i>Campaign Summary</a></li> -->
                </ul>
            </li>
            
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
            <li><a href="order_status.php"><i class="fa fa-book"></i> Track Order</a></li>
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                <li><a href="product_search.php"><i class="fa fa-tags"></i> Product List</a></li>
                <li><a href="user_search.php"><i class="fa fa-users"></i> Users List</a></li>
              </ul>
              
              </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
                <li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
  <?php
}
?>


<?php 
function tme_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar no-print">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar no-print"><!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
          
               <li><a href="fresh_data.php"><i class="fa fa-paperclip"></i> Fresh Data</a></li>
                <li><a href="secondary_data.php"><i class="fa fa-database"></i> Secondary Data</a></li>
               <li><a href="my_schedules.php"><i class="fa fa-clock-o"></i>Scheduled Follow-Ups</a></li>
               <li><a href="followups.php"><i class="fa fa-comments-o"></i> Pending Follow-Ups</a></li>
               
                <li><a href="manage_orders.php"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
                <li><a href="manage_bulk_orders.php"><i class="fa fa-truck"></i>My Bulk Orders</a></li>
                
                <li><a href="pending.php"><i class="fa fa-question"></i> Follow-Up Search</a></li>
                 <li><a href="lead_entry.php"><i class="fa fa-comments-o"></i> Lead Entry</a></li>
               <li><a href="closed_calls.php"><i class="fa fa-phone"></i>Closed Calls</a></li>
              
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             	<li><a href="call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                <li><a href="order-summary.php"><i class="fa fa-shopping-cart"></i>Order Summary</a></li>
                <li><a href="my-performance.php"><i class="fa fa-star-half-o"></i>My Performance</a></li>
              </ul>
            </li>
           
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
                <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
              <li><a href="order_status.php"><i class="fa fa-book"></i> Track Order</a></li>
              </ul></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
         
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>



<?php 
function mgmt_nav($con)
{
	?>
     <?php
require_once("class/user.php");
    $userclasst=new users();
    $userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
  $userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
         <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
          <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>

           <li class="treeview">
              <a href="#">
                <i class="fa fa-list-ul"></i>
                <span>Delivery Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="alloted-orders.php"><i class="fa  fa-paperclip"></i> Order Status</a></li>
               <li><a href="district-orders.php"><i class="fa fa-bullseye"></i> District Wise</a></li>
                <li><a href="product-orders.php"><i class="fa fa-tags"></i> Product Wise</a></li>
                <li><a href="dist-orders.php"><i class="fa fa-truck"></i> District Wise Products</a></li>
                <li><a href="pending-orders.php"><i class="fa fa-question-circle"></i> Pending Orders</a></li>
              </ul>
            </li>
      
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Agents Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="acc-summary.php"><i class="fa fa-book"></i> Account Summary</a></li>
              <li><a href="trans-report.php"><i class="fa fa-truck"></i>Inventory Transactions</a></li>
              <li><a href="acc-report.php"><i class="fa fa-inr"></i>Account Transactions</a></li>
              <li><a href="agent-balance.php"><i class="fa fa-book"></i> Agent Balance</a></li>
                <li><a href="stock-report.php"><i class="fa fa-tags"></i> Agent Stock</a></li>               
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Call Centre Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

              <li><a href="order-value.php"><i class="fa fa-money"></i> Order Value (BPE)</a></li>

              <li><a href="call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                <li><a href="order-summary.php"><i class="fa fa-shopping-cart"></i>Order Summary</a></li>
                <li><a href="bpe-performance.php"><i class="fa fa-star-half-o"></i>BPE Performance</a></li>
                <li><a href="campaign-summary.php"><i class="fa fa-bar-chart-o"></i>Campaign Summary</a></li>
                </ul>
            </li>


            <li class="treeview">
              <a href="#">
                <i class="fa fa-search"></i> <span>Search</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="user_search.php"><i class="fa fa-group"></i>Users List</a></li>
                <li><a href="product_search.php"><i class="fa fa-tags"></i>Product List</a></li>
                <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i>Order Search</a></li>
              </ul>
            </li>
 
            
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
                <li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>

<?php 
function acc_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../profile/<?php echo $userclasst->photo; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $userclasst->userfullname; ?></p>
              <!-- Status -->
              <?php
			  $flag=$userclasst->uflag;
			  if($flag==1)
			  {
			  ?>
              <a href="index.php"><i class="fa fa-circle text-success"></i> Online</a>
              <?php
			  }
			  else
			  {
			  ?>
               <a href="index.php"><i class="fa fa-circle text-danger"></i> Offline</a>
               <?php
			  }
			  ?>
              
            </div>
          </div>

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
         
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
            <li class="treeview">
              <a href="live.php">
                <i class="fa fa-check-circle-o"></i>
                <span>Live Franchisees</span>
              </a>
              </li>
              
                <li class="treeview">
              <a href="locations.php">
                <i class="fa fa-map-marker"></i>
                <span>Locations</span>
              </a>
              </li>
             
            <li class="treeview">
              <a href="post.php">
                <i class="fa fa-truck"></i>
                <span>Post Office Coverage</span>
              </a>
              </li>
            
     
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Rountine Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				 <li><a href="order-summary.php"><i class="fa fa-shopping-cart"></i>Order Summary</a></li>
                <li><a href="campaign-summary.php"><i class="fa fa-bar-chart-o"></i>Campaign Summary</a></li>
              </ul>
            </li>
           
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
               <li><a href="area_search.php"><i class="fa fa-map-marker"></i> Franchisee Area</a></li>
               <li><a href="po_search.php"><i class="fa fa-envelope-o"></i> Franchisee PO</a></li>
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                <li><a href="customer_search.php"><i class="fa fa-smile-o"></i> Customers</a></li>
              </ul>
              
              </li>
            
	  <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>


<?php 
function ds_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../profile/<?php echo $userclasst->photo; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $userclasst->userfullname; ?></p>
              <!-- Status -->
              <?php
			  $flag=$userclasst->uflag;
			  if($flag==1)
			  {
			  ?>
              <a href="index.php"><i class="fa fa-circle text-success"></i> Online</a>
              <?php
			  }
			  else
			  {
			  ?>
               <a href="index.php"><i class="fa fa-circle text-danger"></i> Offline</a>
               <?php
			  }
			  ?>
              
            </div>
          </div>

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
         
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
            
             <li class="treeview">
              <a href="post.php">
                <i class="fa fa-truck"></i>
                <span>Post Office Coverage</span>
              </a>
              </li>
           
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
               
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
               </ul>
              
              </li>
            
	  <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>

<?php 
function ofm_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../profile/<?php echo $userclasst->photo; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $userclasst->userfullname; ?></p>
              <!-- Status -->
              <?php
			  $flag=$userclasst->uflag;
			  if($flag==1)
			  {
			  ?>
              <a href="index.php"><i class="fa fa-circle text-success"></i> Online</a>
              <?php
			  }
			  else
			  {
			  ?>
               <a href="index.php"><i class="fa fa-circle text-danger"></i> Offline</a>
               <?php
			  }
			  ?>
              
            </div>
          </div>

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
         
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
              
            
             
  
             
           <li class="treeview">
              <a href="#">
                <i class="fa fa-bullseye"></i>
                <span>AFM Corner</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="afm_data-allotment.php"><i class="fa fa-paperclip"></i> Data Allotment</a></li>
              <li><a href="afm_data-reallotment.php"><i class="fa fa-mail-reply-all"></i> Secondary Allotment</a></li>
              
               <li><a href="afm_upload_csv.php"><i class="fa fa-upload"></i> Upload Data (.csv)</a></li>
                <li><a href="afm_campaign.php"><i class="fa fa-bullhorn"></i> Manage Campaigns</a></li>
                <li><a href="afm_data-alloted.php"><i class="fa fa-sitemap"></i> Alloted Data (Open)</a></li>
               <li><a href="afm_data-closed.php"><i class="fa fa-sitemap"></i> Alloted Data (Closed)</a></li>
               <li><a href="afm_just-data.php"><i class="fa fa-sitemap"></i> Alloted Data (Just)</a></li>

                        
                            
              </ul>
            </li>
            
              
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Franchise Center</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             	<li><a href="ofm_call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                
                <li><a href="ofm_tme-performance.php"><i class="fa fa-star-half-o"></i>AFM Performance</a></li>
                
                <li><a href="ofm_campaign-summary.php"><i class="fa fa-bar-chart-o"></i>Campaign Summary</a></li>
                
                <li><a href="ofm_cc-district-profile.php"><i class="fa fa-bullseye"></i> District Wise Profiles</a></li>
                
                <li><a href="ofm_cc-location-profile.php"><i class="fa fa-bullseye"></i> Location Wise Profiles</a></li>
                
                 <li><a href="ofm_pro_search.php"><i class="fa fa-search"></i> Profile Search</a></li> 
                
                 <li><a href="ofm_response_search.php"><i class="fa  fa-book"></i> Follow-up Search</a></li> 
                
              </ul>
            </li>
            
                    
          
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Franchisees</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
     			    <li><a href="live.php"><i class="fa fa-check-circle-o"></i><span>Live Franchisees</span></a></li>
                        
              </ul>
            </li>
            
     
           
           <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
               <li><a href="area_search.php"><i class="fa fa-map-marker"></i> Franchisee Area</a></li>
               <li><a href="po_search.php"><i class="fa  fa-envelope-o"></i> Franchisee PO</a></li>
               
              </ul>
              
              </li>
       
          
              <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>

<?php 
function cc_nav($con)
{
	?>
    <?php
require_once("class/user.php");
   	$userclasst=new users();
   	$userclasst->user=$_SESSION['homsuser']; $userclasst->con=$con;
	$userclasst->userinfo();
?>
      <aside class="main-sidebar no-print">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar no-print">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel no-print">
            <div class="pull-left image">
              <img src="../profile/<?php echo $userclasst->photo; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $userclasst->userfullname; ?></p>
              <!-- Status -->
              <?php
			  $flag=$userclasst->uflag;
			  if($flag==1)
			  {
			  ?>
              <a href="index.php"><i class="fa fa-circle text-success"></i> Online</a>
              <?php
			  }
			  else
			  {
			  ?>
               <a href="index.php"><i class="fa fa-circle text-danger"></i> Offline</a>
               <?php
			  }
			  ?>
              
            </div>
          </div>

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
         
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
            <li class="treeview">
              <a href="#">   
                <i class="fa fa-tasks"></i> <span>My Tasks</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="add_enquiry3.php"><i class="fa fa-question-circle"></i> Add Enquiry</a></li>
               <li><a href="pending-enquiries.php"><i class="fa fa-warning (alias)"></i> Pending Enquiries</a></li>
               <li><a href="my_schedules.php"><i class="fa fa-clock-o"></i>Scheduled Complaints</a></li>
               <li><a href="followups.php"><i class="fa fa-comments-o"></i>Pending Complaints</a></li>
               <li><a href="closed_complaints.php"><i class="fa fa-thumbs-up"></i>Closed Complaints</a></li>
                <li><a href="closed_replacements.php"><i class="fa fa-exchange"></i>Replacements</a></li>
                <li><a href="enquiry-search.php"><i class="fa  fa-search"></i>Enquiry Search</a></li>
                
              </ul>
            </li>
            
            <li class="treeview">
              <a href="live.php">
                <i class="fa fa-check-circle-o"></i>
                <span>Live Franchisees</span>
              </a>
              </li>
             
            <li class="treeview">
              <a href="post.php">
                <i class="fa fa-truck"></i>
                <span>Post Office Coverage</span>
              </a>
              </li>
                     
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Routine Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="enquiry-summary.php"><i class="fa  fa-phone"></i>Enquiry Summary</a></li>
             	<li><a href="complaint_Summary.php"><i class="fa fa-wrench"></i>Complaint Summary</a></li>
                <li><a href="replacement_Summary.php"><i class="fa fa-exchange"></i>Replacement Summary</a></li>
                <li><a href="complaint_closed.php"><i class="fa fa-thumbs-up"></i>Closed Complaints</a></li>
                <li><a href="call_summary.php"><i class="fa  fa-phone"></i>Call Summary</a></li>
                <li><a href="my_performance.php"><i class="fa fa-star"></i>Performance Summary</a></li>
                <li><a href="confirmed_replaces.php"><i class="fa  fa-thumbs-o-up"></i>Confirmed Replacements</a></li>
                <li><a href="replacement_status.php"><i class="fa  fa-check"></i>Replacement Status</a></li>
              </ul>
            </li>
           
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
               <li><a href="area_search.php"><i class="fa fa-map-marker"></i> Franchisee Area</a></li>
               <li><a href="po_search.php"><i class="fa fa-envelope-o"></i> Franchisee PO</a></li>
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
               <li><a href="customer_search.php"><i class="fa fa-smile-o"></i> Customers</a></li>
               <li><a href="all_closedComplaints.php"><i class="fa fa-thumbs-up"></i> Closed Complaints</a></li>
               <li><a href="all_replacements.php"><i class="fa fa-exchange"></i> Replacements</a></li>
               <li><a href="complaint_status.php"><i class="fa fa-check-circle"></i> Complaint Status</a></li>
              </ul>
              
              </li>
              
            
          <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Advanced Options</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">             	
                <li><a href="replacement_slip.php"><i class="fa fa-print"></i> Replacement Slip</a></li>
              </ul>
            </li>
          
          
          
              <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
              	<li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
            
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	<?php
}
?>

<?php 
function dt_nav($con)
{
  ?>
    <?php
require_once("class/user.php");
    $userclasst=new users();
    $userclasst->user=$_SESSION['homsuser'];
	$userclasst->con=$con;
  $userclasst->userinfo();
?>
      <aside class="main-sidebar no-print">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar no-print">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel no-print">
            <div class="pull-left image">
              <img src="../profile/<?php echo $userclasst->photo; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $userclasst->userfullname; ?></p>
              <!-- Status -->
              <?php
        $flag=$userclasst->uflag;
        if($flag==1)
        {
        ?>
              <a href="index.php"><i class="fa fa-circle text-success"></i> Online</a>
              <?php
        }
        else
        {
        ?>
               <a href="index.php"><i class="fa fa-circle text-danger"></i> Offline</a>
               <?php
        }
        ?>
              
            </div>
          </div>

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
         
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           <!-- <li class="header">MAIN NAVIGATION</li>-->
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Control Panel</span> 
           </a>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tasks"></i> <span>My Tasks</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="new_data.php"><i class="fa fa-eye"></i> Show New Data</a></li>
               <li><a href="my_schedules.php"><i class="fa fa-clock-o"></i>Scheduled Follow-Ups</a></li>
               <li><a href="followups.php"><i class="fa fa-comments-o"></i> Pending Follow-Ups</a></li>
               
                <li><a href="pending.php"><i class="fa fa-question"></i> Follow-Up Search</a></li>
                
               <li><a href="closed_calls.php"><i class="fa fa-phone"></i>Closed Calls</a></li>
             </ul>
            </li>
            
            
         
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Rountine Reports</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="call-summary.php"><i class="fa fa-phone"></i> Call Summary</a></li>
                
              </ul>
            </li>
           
           
             <li class="treeview">
             <a href="#">
            <i class="fa fa-search"></i> <span>Advanced Search</span>
             <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
               <li><a href="area_search.php"><i class="fa fa-map-marker"></i> Franchisee Area</a></li>
               <li><a href="po_search.php"><i class="fa fa-envelope-o"></i> Franchisee PO</a></li>
               <li><a href="order_search.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                <li><a href="customer_search.php"><i class="fa fa-smile-o"></i> Customers</a></li>
              </ul>
              
              </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="password.php"><i class="fa fa-magic"></i> Change Password</a></li>
                <li><a href="../login/logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
             </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
  <?php
}
?>

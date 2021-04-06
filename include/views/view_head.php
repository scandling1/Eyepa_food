<?php
 class ViewHead{

     var $restaurant;
     var $app = APP_NAME;
     var $base_url = BASEURL;
     var $assets_url = ASSETSURL;

    function title($page){
         echo'<title>'.$page.' - '.$this->app.'</title>';
    }

    function meta_head(){
         echo' 
         <meta charset="UTF-8">
         <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
         <link rel="stylesheet" href="assets/css/app.min.css">
         <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
         <link rel="stylesheet" href="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
         <link rel="stylesheet" href="assets/bundles/chocolat/dist/css/chocolat.css">
         <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
         <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
         <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
         <link rel="stylesheet" href="assets/bundles/prism/prism.css">
         <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
         <!-- Template CSS -->
         <link rel="stylesheet" href="assets/css/style.css">
         <link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
         <link rel="stylesheet" href="assets/css/components.css">
         <!-- Custom style CSS -->
         <link rel="stylesheet" href="assets/css/custom.css">
         <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico" />';
    }

    function header_navbar(){
        echo'
        <div class="loader"></div>
        <div id="app">
          <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
          <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                collapse-btn"> <i data-feather="align-justify"></i></a></li>
              <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                  <i data-feather="maximize"></i>
                </a></li>
              ';$this->header_search(); echo'
            </ul>
          </div>
          <ul class="navbar-nav navbar-right">
            '; $this->header_messages(); 
               $this->header_notification();
               $this->header_profile_settings(); echo'
          </ul>
        </nav>';
    }
  
    function header_search(){
      echo'<li>
      <form class="form-inline mr-auto">
        <div class="search-element">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
          <button class="btn" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
     </li>';
    }
  
    function header_messages(){
        echo'<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
        class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
        <span class="badge headerBadge1">
          1 </span> </a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
        <div class="dropdown-header">
          Messages
          <div class="float-right">
            <a href="#">Mark All As Read</a>
          </div>
        </div>
        <div class="dropdown-list-content dropdown-list-message">
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
              <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
            </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                Smith</span> <span class="time messege-text">Client Requirements</span>
              <span class="time">2 Days Ago</span>
            </span>
          </a>
        </div>
        <div class="dropdown-footer text-center">
          <a href="#">View All <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
     </li>';
    }
  
    function header_notification(){
        echo'<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
        class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
      </a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
        <div class="dropdown-header">
          Notifications
          <div class="float-right">
            <a href="#">Mark All As Read</a>
          </div>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
          </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
                  fa-bell"></i>
            </span> <span class="dropdown-item-desc"> Welcome to Eyepa Foods <span class="time">Yesterday</span>
            </span>
          </a>
        </div>
        <div class="dropdown-footer text-center">
          <a href="#">View All <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
     </li>';
    }
  
    function header_profile_settings(){
      global $session;
           
      echo'<li class="dropdown"><a href="#" data-toggle="dropdown"
        class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="'.$session->user_picture.'"
          class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
      <div class="dropdown-menu dropdown-menu-right pullDown">
        <div class="dropdown-title">'.$session->name.'</div>
        <a href="#" class="dropdown-item has-icon"> <i class="far
              fa-user"></i> Profile
        </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
          Activities
        </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
          Settings
        </a>
        <div class="dropdown-divider"></div>
        <a href="process.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
          Logout
        </a>
      </div>
     </li>';
    }

    function sidebar($main, $sub){                                                                                                                                                                                                                                                                                                                                          
      global $session;
      echo'
      <!-- Main Content -->
      <div class="main-sidebar sidebar-style-2">
      <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
          <a href="index.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
              class="logo-name">Eyepa</span>
          </a>
        </div>
        <ul class="sidebar-menu">
          <li class="menu-header">Main</li>
          <li class="dropdown '; if ($main == 'index'){echo'active';}echo'">
            <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
          </li>
          <li class="menu-header">Orders</li>
          <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                data-feather="shopping-cart"></i><span>Orders</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="#">All Orders</a></li>
              <li><a class="nav-link" href="#">Ongoing Orders</a></li>
              <li><a class="nav-link" href="#">Completed Orders</a></li>
            </ul>
          </li>
          <li class="menu-header">Food Joints</li>
          <li class="dropdown '; if ($main == 'restaurant'){echo'active';}echo'">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-store"></i><span>Restaurant</span></a>
            <ul class="dropdown-menu">
              <li '; if ($sub == 'all restaurant'){echo'class="active"';}echo'><a class="nav-link" href="all_restaurants.php">All Restaurants</a></li>
              <li '; if ($sub == 'add restaurant'){echo'class="active"';}echo'><a class="nav-link" href="restaurants.php">Add Restaurant</a></li>
            <!--  <li><a class="nav-link" href="create-post.html">All Menu</a></li>
              <li><a class="nav-link" href="#">Add Menu</a></li>
              <li><a class="nav-link" href="#">Edit Restaurant</a></li> -->
            </ul>
          </li>
          <li class="menu-header">People</li>
          <li class="dropdown '; if ($main == 'users'){echo'active';}echo'">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Users</span></a>
            <ul class="dropdown-menu">
              <li '; if ($sub == 'add user'){echo'class="active"';}echo'><a class="nav-link" href="add_user.php">Add User</a></li>
              <li '; if ($sub == 'country admins'){echo'class="active"';}echo'><a class="nav-link" href="country_admins.php">Country Admins</a></li>
              <li '; if ($sub == 'city admins'){echo'class="active"';}echo'><a class="nav-link" href="city_admins.php">City Admins</a></li>
              <li '; if ($sub == 'res admins'){echo'class="active"';}echo'><a class="nav-link" href="res_admins.php">Restaurant Admins</a></li>
              <li '; if ($sub == 'drivers'){echo'class="active"';}echo'><a class="nav-link" href="drivers.php">Drivers</a></li>
              <li '; if ($sub == 'customers'){echo'class="active"';}echo'><a class="nav-link" href="customers.php">Customers</a></li>
            </ul>
          </li>
          <li class="menu-header">Cost</li>
          <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="dollar-sign"></i><span>Earnings</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="#">Daily</a></li>
              <li><a class="nav-link" href="#">weekly</a></li>
              <li><a class="nav-link" href="#">Monthly</a></li>
            </ul>
          </li>
          <li class="menu-header">Messages / Alerts</li>
          <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="message-circle"></i><span>Compose Message</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="#">Notifications</a></li>
              <li><a class="nav-link" href="#">To One Customer</a></li>
              <li><a class="nav-link" href="#">Broadcast</a></li>
              <li><a class="nav-link" href="#">Templates</a></li>
            </ul>
          </li>
          <li class="menu-header">Country Settings</li>
          <li class="dropdown '; if ($main == 'settings'){echo'active';}echo'">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                data-feather="flag"></i><span>Settings</span></a>
            <ul class="dropdown-menu">
              <li '; if ($sub == 'city'){echo'class="active"';}echo'><a class="nav-link" href="cities.php">City</a></li>
              <li '; if ($sub == 'currency'){echo'class="active"';}echo'><a class="nav-link" href="currency.php">Currency</a></li>
            </ul>
          </li>
        </ul>
       </aside>
     </div>
     
     <div class="main-content">
        <section class="section"> 
        <div class="section-body">';
    }

    function import_header_script(){
      echo'
      <script src="assets/js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript">
      $(document).ready(function() {
        $("#frmCSVImport").on("submit", function () {

        $("#response").attr("class", "");
           $("#response").html("");
            var fileType = ".csv";
             var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
         if (!regex.test($("#file").val().toLowerCase())) {
             $("#response").addClass("error");
             $("#response").addClass("display-block");
             $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
               return false;
          }
             return true;
       });
     });
     </script>';
    }

 }
  
?>
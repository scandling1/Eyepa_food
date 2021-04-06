<?php
  class ViewBody{
    var $results;
    var $assets_url = ASSETSURL;
    var $session;
    var $form;
    var $view_dbs;


    function __construct(){
      global $database, $session, $form, $view_dbs;
       $this->conn     = $database->connect();
       $this->session  = $session;
       $this->form     = $form;
       $this->view_dbs = $view_dbs;
    }

    function login(){
    
        echo'<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Login</h4>
          </div>
          <div class="card-body">
                <form method="POST" action="process.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Username</label>
                    '.$this->form->error("user").'
                    <input id="name" type="text" class="form-control" name="user" tabindex="1" value="'.$this->form->value("user").'" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    '.$this->form->error("pass").'
                    <input id="password" type="password" class="form-control" name="pass" tabindex="2" value="'.$this->form->value("pass").'" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="sublogin" value="1">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
            </div>
        </div>
        <div class="mt-5 text-muted text-center">
          Don\'t have an account? <a href="#">Create One</a>
        </div>
      </div>';
  
    }

    function alert2($alert){
      echo'<div class="alert alert-success alert-dismissible show fade">
               <div class="alert-body">
                 <button class="close" data-dismiss="alert">
                   <span>&times;</span>
                 </button>
                 <h6>'.$alert.'</h6>
               </div>
             </div>
               ';
    }

    function alert($alert){
      echo'<div class="alert alert-danger alert-dismissible show fade">
               <div class="alert-body">
                 <button class="close" data-dismiss="alert">
                   <span>&times;</span>
                 </button>
                 <h6>'.$alert.'</h6>
               </div>
             </div>
               ';
    }

    function index_bcnr(){
      echo'<div class="row ">
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-15">Orders</h5>
                    <h2 class="mb-3 font-18">258</h2>
                    <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img">
                    <img src="assets/img/banner/1.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-15"> Customers</h5>
                    <h2 class="mb-3 font-18">1,287</h2>
                    <p class="mb-0"><span class="col-orange">09%</span> Decrease</p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img">
                    <img src="assets/img/banner/2.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-15">Done Orders</h5>
                    <h2 class="mb-3 font-18">128</h2>
                    <p class="mb-0"><span class="col-green">18%</span>
                      Increase</p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img">
                    <img src="assets/img/banner/3.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-15">Revenue</h5>
                    <h2 class="mb-3 font-18">$48,697</h2>
                    <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img">
                    <img src="assets/img/banner/4.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>';
    }

    function index_revenueChart(){
      echo'<div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card ">
          <div class="card-header">
            <h4>Revenue chart</h4>
            <div class="card-header-action">
              <div class="dropdown">
                <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                <div class="dropdown-menu">
                  <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                  <a href="#" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                    Delete</a>
                </div>
              </div>
              <a href="#" class="btn btn-primary">View All</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-9">
                <div id="chart1"></div>
                <div class="row mb-0">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="list-inline text-center">
                      <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                          class="col-green"></i>
                        <h5 class="m-b-0">$675</h5>
                        <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="list-inline text-center">
                      <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
                          class="col-orange"></i>
                        <h5 class="m-b-0">$1,587</h5>
                        <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="list-inline text-center">
                      <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                          class="col-green"></i>
                        <h5 class="mb-0 m-b-0">$45,965</h5>
                        <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="row mt-5">
                  <div class="col-7 col-xl-7 mb-3">Total customers</div>
                  <div class="col-5 col-xl-5 mb-3">
                    <span class="text-big">8,257</span>
                    <sup class="col-green">+09%</sup>
                  </div>
                  <div class="col-7 col-xl-7 mb-3">Total Income</div>
                  <div class="col-5 col-xl-5 mb-3">
                    <span class="text-big">$9,857</span>
                    <sup class="text-danger">-18%</sup>
                  </div>
                  <div class="col-7 col-xl-7 mb-3">Project completed</div>
                  <div class="col-5 col-xl-5 mb-3">
                    <span class="text-big">28</span>
                    <sup class="col-green">+16%</sup>
                  </div>
                  <div class="col-7 col-xl-7 mb-3">Total expense</div>
                  <div class="col-5 col-xl-5 mb-3">
                    <span class="text-big">$6,287</span>
                    <sup class="col-green">+09%</sup>
                  </div>
                  <div class="col-7 col-xl-7 mb-3">New Customers</div>
                  <div class="col-5 col-xl-5 mb-3">
                    <span class="text-big">684</span>
                    <sup class="col-green">+22%</sup>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>';
    }

    function index_charts(){
      echo'<div class="row">
      <div class="col-12 col-sm-12 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4>Chart</h4>
          </div>
          <div class="card-body">
            <div id="chart4" class="chartsh"></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4>Chart</h4>
          </div>
          <div class="card-body">
            <div class="summary">
              <div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
                <div id="chart3" class="chartsh"></div>
              </div>
              <div data-tab-group="summary-tab" id="summary-text">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4>Chart</h4>
          </div>
          <div class="card-body">
            <div id="chart2" class="chartsh"></div>
          </div>
        </div>
      </div>
     </div>';
    }

    function index_assignTaskTable(){
      echo'<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Assign Task Table</h4>
            <div class="card-header-form">
              <form>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search">
                  <div class="input-group-btn">
                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped">
                <tr>
                  <th class="text-center">
                    <div class="custom-checkbox custom-checkbox-table custom-control">
                      <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                        class="custom-control-input" id="checkbox-all">
                      <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                  </th>
                  <th>Task Name</th>
                  <th>Members</th>
                  <th>Task Status</th>
                  <th>Assigh Date</th>
                  <th>Due Date</th>
                  <th>Priority</th>
                  <th>Action</th>
                </tr>
                <tr>
                  <td class="p-0 text-center">
                    <div class="custom-checkbox custom-control">
                      <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                        id="checkbox-1">
                      <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                    </div>
                  </td>
                  <td>Create a mobile app</td>
                  <td class="text-truncate">
                    <ul class="list-unstyled order-list m-b-0 m-b-0">
                      <li class="team-member team-member-sm"><img class="rounded-circle"
                          src="assets/img/users/user-8.png" alt="user" data-toggle="tooltip" title=""
                          data-original-title="Wildan Ahdian"></li>
                      <li class="team-member team-member-sm"><img class="rounded-circle"
                          src="assets/img/users/user-9.png" alt="user" data-toggle="tooltip" title=""
                          data-original-title="John Deo"></li>
                      <li class="team-member team-member-sm"><img class="rounded-circle"
                          src="assets/img/users/user-10.png" alt="user" data-toggle="tooltip" title=""
                          data-original-title="Sarah Smith"></li>
                      <li class="avatar avatar-sm"><span class="badge badge-primary">+4</span></li>
                    </ul>
                  </td>
                  <td class="align-middle">
                    <div class="progress-text">50%</div>
                    <div class="progress" data-height="6">
                      <div class="progress-bar bg-success" data-width="50%"></div>
                    </div>
                  </td>
                  <td>2018-01-20</td>
                  <td>2019-05-28</td>
                  <td>
                    <div class="badge badge-success">Low</div>
                  </td>
                  <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
     </div>';
    }

    function index_stpp(){
      echo'<div class="row">
      <div class="col-md-6 col-lg-12 col-xl-6">
        <!-- Support tickets -->
        <div class="card">
          <div class="card-header">
            <h4>Support Ticket</h4>
            <form class="card-header-form">
              <input type="text" name="search" class="form-control" placeholder="Search">
            </form>
          </div>
          <div class="card-body">
            <div class="support-ticket media pb-1 mb-3">
              <img src="assets/img/users/user-1.png" class="user-img mr-2" alt="">
              <div class="media-body ml-3">
                <div class="badge badge-pill badge-success mb-1 float-right">Feature</div>
                <span class="font-weight-bold">#89754</span>
                <a href="javascript:void(0)">Please add advance table</a>
                <p class="my-1">Hi, can you please add new table for advan...</p>
                <small class="text-muted">Created by <span class="font-weight-bold font-13">John
                    Deo</span>
                  &nbsp;&nbsp; - 1 day ago</small>
              </div>
            </div>
          </div>
          <a href="javascript:void(0)" class="card-footer card-link text-center small ">View
            All</a>
        </div>
        <!-- Support tickets -->
      </div>
      <div class="col-md-6 col-lg-12 col-xl-6">
        <div class="card">
          <div class="card-header">
            <h4>Projects Payments</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>7</td>
                    <td>
                      Hasan Basri
                    </td>
                    <td>07-09-2018</td>
                    <td>Cash</td>
                    <td>$128</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     </div>';
    }

    function basic_data_table(){
      echo'<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Recent Orders</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th class="text-center">
                      ID
                    </th>
                    <th>Customer</th>
                    <th>Meal Ordered</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Date / Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                       12
                    </td>
                    <td>
                       <img src="assets/img/users/user-8.png" alt="user" width="35" height="35"
                        data-toggle="tooltip" data-original-title="Wildan Ahdian">
                    </td>
                    <td class="align-middle">
                      Fried rice
                    </td>
                    <td>
                      Cash on delivery
                    </td>
                    <td>
                      <div class="badge badge-success badge-shadow">Completed</div>
                    </td>
                    <td>
                      2020-12-22
                    </td>
                    <td>
                      <a href="#" class="btn btn-outline-primary">Detail</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     </div>';
    }

    function multi_select_table(){
      echo'<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Multi Select</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-2">
                <thead>
                  <tr>
                    <th class="text-center pt-3">
                      <div class="custom-checkbox custom-checkbox-table custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                          class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                      </div>
                    </th>
                    <th>Task Name</th>
                    <th>Progress</th>
                    <th>Members</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center pt-2">
                      <div class="custom-checkbox custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                          id="checkbox-4">
                        <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                      </div>
                    </td>
                    <td>Input data</td>
                    <td class="align-middle">
                      <div class="progress progress-xs">
                        <div class="progress-bar bg-success width-per-40"></div>
                      </div>
                    </td>
                    <td>
                      <img alt="image" src="assets/img/users/user-2.png" width="35">
                      <img alt="image" src="assets/img/users/user-5.png" width="35">
                      <img alt="image" src="assets/img/users/user-4.png" width="35">
                      <img alt="image" src="assets/img/users/user-1.png" width="35">
                    </td>
                    <td>2018-01-16</td>
                    <td>
                      <div class="badge badge-success badge-shadow">Completed</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     </div>';
    }

    function clear_table(){
      echo'<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Table With State Save</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Donna Snider</td>
                    <td>Customer Support</td>
                    <td>New York</td>
                    <td>27</td>
                    <td>2011/01/25</td>
                    <td>$112,000</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     </div>';
    }

    function import_form(){
      echo'<form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" 
      enctype="multipart/form-data">
      <div class="input-row">
          <label class="col-md-4 control-label">Choose CSV
              File</label> <input type="file" name="file"
              id="file" accept=".csv">
          <button type="submit" id="submit" name="import"
              class="btn-submit">Import</button>
          <br />

      </div>

     </form>';
    }

    function cities(){
      echo'<div class="row">
      <div class="col-12 col-md-6 col-lg-5">
        <div class="card card-secondary">
          <div class="card-header">
            <h4>Add City</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="process.php">

             <div class="form-group col-10">
               <label for="frist_name">Select Country</label>
                   <select class="form-control selectric" name="country_id" value="" required="">
                     <option></option>';
                       if ($this->results = $this->view_dbs->allcountries()){
                        foreach ($this->results as $row) {
                          $country_id = $row['country_id'];
                          $country_name = $row['country_name'];

                          echo '<option value="'.$country_id.'">'.$country_name.'</option>';
                         }
                       }
                  echo'
                   </select>
             </div>
             <div class="form-group col-10">
                   <label for="frist_name">City Name</label>
                   <input id="frist_name" type="text" class="form-control" name="city_name" placeholder="Eg: Accra" required="" autofocus>
             </div> 
             <div class="form-group col-10">
                 <label for="frist_name">Service Fee</label>
                 <input id="frist_name" type="text" class="form-control" name="service_fee" placeholder="Eg: 3" required="" autofocus>
             </div> 
             <div class="card-footer text-right">
                 <input type="hidden" name="subarea" value="1">
                 <button class="btn btn-primary">Submit</button>
             </div>
            </form>
          </div>
        </div>
      </div>


      <div class="col-12 col-md-6 col-lg-7">
        <div class="card card-success">
          <div class="card-header">
            <h4>Cities</h4>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Flag</th>
                  <th>Country</th>
                  <th>City</th>
                  <th>Service Fee</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              ';
                       if ($this->results = $this->view_dbs->get_countries_areas()){
                        foreach ($this->results as $row) {
                          $country_icon = $row['country_icon'];
                          $country_id = $row['country_id'];
                          $country_name = $row['country_name'];
                          $city_name = $row['city_name'];
                          $service_fee = $row['service_fee'];
                        
                  echo'
                <tr>
                  <td><img alt="image" class="mr-3 rounded-square" width="50" src="assets/bundles/flag-icon-css/flags/4x3/'.$country_icon.'"></td>
                  <td>'.$country_name.'</td>
                  <td>'.$city_name.'</td>
                  <td>'.$service_fee.'</td>
                  <td>
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-light dropdown-toggle">Options</a>
                      <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-pencil-alt"></i>Edit</a>       
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-trash"></i>Delete</a>
                        <div class="dropdown-divider"></div>
                      </div>
                    </div>
                  </td>
                </tr>';
              }
            } 
            echo'
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      </div>';
    }

    function add_restaurant($q){
      echo'<div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h4>Add Restaurant</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="process.php" enctype="multipart/form-data">
            <div class="row">
             
             <div class="form-group col-6">
                   <label for="frist_name">Restaurant Name</label>
                   <input id="frist_name" type="text" class="form-control" name="res_name" placeholder="" required="" autofocus>
             </div> 
             <input type="hidden" class="form-control" name="res_city" value="'.$q.'" required="" autofocus>
             <div class="form-group col-6">
                 <label for="frist_name">Select Admin</label>
                 <select class="form-control selectric" name="res_admin" value="" required="">
                   <option></option>';
                   if ($this->results = $this->view_dbs->get($q)){
                   foreach ($this->results as $row) {
                    $user_id = $row['username'];
                    $user_name = $row['name'];
  
                    echo '<option value="'.$user_id.'">'.$user_name.'</option>';
                   }
                  }else{
                    echo'<optgroup label="No Restaurant Admin has been created for the selected City">';
                  }
        echo' 
             </select>
             </div>
           
             </div>

             <div class="row">
             <div class="form-group col-6">
                   <label for="frist_name">Restaurant Email</label>
                   <input id="email" type="email" class="form-control" name="res_email" placeholder="" required="" autofocus>
             </div> 
             <div class="form-group col-6">
                <label for="frist_name">Subsription type</label>
                <input id="frist_name" type="text" class="form-control" name="res_type" placeholder="" required="" autofocus>
             </div> 
             </div>

             <div class="row">
             <div class="form-group col-4">
             <label>Status</label>
             <div class="row">
              <div class="pretty p-icon p-curve p-tada"> 
                   <input type="radio" name="res_hours" value="Open" checked>
                   <div class="state p-primary-o">
                     <i class="icon material-icons">done</i>
                     <label> Active</label>
                   </div>
                 </div>
                 <div class="pretty p-icon p-curve p-tada">
                 <input type="radio" value="close" name="res_hours">
                 <div class="state p-primary-o">
                   <i class="icon material-icons">done</i>
                   <label> Inctive</label>
                 </div>
               </div>
              </div>
             </div>
             <div class="form-group col-4">
                 <label for="frist_name">Restaurant Picture</label>
                 <input class="form-control" type="file" name="res_picture" id="image-upload" required="">
             </div> 
             <div class="form-group col-4">
             <label for="frist_name">Featured Image</label>
             <input class="form-control" type="file" name="res_featured_image" id="image-upload" required="">
         </div> 
             </div>

             <div class="row">
                <div class="form-group col-6">
                   <label for="frist_name">Restaurant Description</label>
                   <textarea class="form-control" name="res_description"></textarea>
                 </div> 
                 <div class="form-group col-6">
                   <label for="frist_name">Restaurant Address</label>
                   <textarea class="form-control" name="res_address"></textarea>
                 </div> 
              </div>


             <div class="card-footer text-right">
                 <input type="hidden" name="subrestaurant" value="1">
                 <button class="btn btn-primary">Submit</button>
             </div>
             
            </form>
          </div>
        </div>
      </div>
      </div>';
    }

    function sellect_city(){
      echo'
      <div class="col-12 col-md-6 col-lg-4">
      <div class="card card-secondary">
         <div class="card-header">
            <h4>Select Restaurant City</h4>
          </div>
          <div class="card-body">
      <div class="form-group col-12">
          <select class="form-control selectric" name="res_city" onchange="showUser(this.value)" required="">
            <option></option>';
              if ($this->results = $this->view_dbs->get_cities()){
               foreach ($this->results as $row) {
                 $city_name  = $row['city_name'];
                 $id         = $row['id'];

                 echo '<option value="'.$id.'">'.$city_name.'</option>';
                }
              }
         echo'
          </select>
     </div>
     </div>
     </div>
     </div>';
    }

    function all_restaurant(){
      echo' <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-success">
          <div class="card-header">
            <h4>Restaurants</h4>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>Country</th>
                  <th>City</th>
                  <th>Restaurant</th>
                  <th>image</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>Admin</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              ';
                       if ($this->results = $this->view_dbs->get_restaurants()){
                        foreach ($this->results as $row) {
                          $res_id = $row['restaurant_id'];
                          $country_icon = $row['country_icon'];
                          $country_name = $row['country_name'];
                          $res_city = $row['city_name'];
                          $res_city_id = $row['city_id'];
                          $res_admin_picture = $row['profile_picture'];
                          $res_admin_name = $row['name'];
                          $res_name = $row['res_name'];
                          $res_email = $row['res_email'];
                          $res_picture = $row['res_picture'];
                          $res_type = $row['res_subscription_type'];
                          $res_hours = $row['res_hours'];
                        
                  echo'
                <tr>
                  <td><img src="assets/bundles/flag-icon-css/flags/4x3/'.$country_icon.'"
                     alt="user" width="35" height="35"
                     data-toggle="tooltip" data-original-title="'.$country_name.'">
                     </td>
                  <td>'.$res_city.'</td>
                  <td>'.$res_name.'</td>
                  <td><img alt="image" class="mr-3 rounded-circle" width="40" height="40" src="'.$res_picture.'"></td>
                  <td>'.$res_email.'</td>
                  <td>'.$res_type.'</td>
                  <td> <img src="'.$res_admin_picture.'" alt="user" width="35" height="35"
                  data-toggle="tooltip" data-original-title="'.$res_admin_name.'"></td>
                  <td>'.$res_hours.'</td>
                  <td>
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-light dropdown-toggle">Options</a>
                      <div class="dropdown-menu">
                        <a href="meals.php?res='.$res_id.'&city='.$res_city_id.'" class="dropdown-item has-icon"><i class="fas fa-mortar-pestle"></i>Food menu</a>
                        <a href="add_menu.php?res='.$res_id.'&city='.$res_city_id.'" class="dropdown-item has-icon"><i class="fas fa-plus"></i>Add meal</a>
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-pencil-alt"></i>Edit</a>       
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-trash"></i>Delete</a>
                        <div class="dropdown-divider"></div>
                      </div>
                    </div>
                  </td>
                </tr>';
              }
            } 
            echo'
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      </div>';
    }

    function all_paticular_user($userlevel, $title){
      echo' <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-success">
          <div class="card-header">
            <h4>'.$title.'</h4>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>Country</th>
                  <th>City</th>
                  <th>User</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              ';
                if ($this->results = $this->view_dbs->get_paticular_users($userlevel)){
                  foreach ($this->results as $row) {
                   $country_icon = $row['country_icon'];
                   $country_name = $row['country_name'];
                   $res_city = $row['city_name'];
                   $user_picture = $row['profile_picture'];
                   $user_name = $row['name'];
                   $user_email = $row['email'];
                   $user_phone = $row['phone'];
                        
                  echo'
                <tr>
                  <td><img src="assets/bundles/flag-icon-css/flags/4x3/'.$country_icon.'"
                     alt="user" width="35" height="35"
                     data-toggle="tooltip" data-original-title="'.$country_name.'">
                     </td>
                  <td>'.$res_city.'</td>
                  <td><a href="#">
                  <img alt="'.$user_name.'" src="'.$user_picture.'" class="rounded-circle" width="35"
                    data-toggle="title" title="">
                  <span class="d-inline-block ml-1">'.$user_name.'</span>
                </a></td>
                  <td>'.$user_email.'</td>
                  <td>'.$user_phone.'</td>
                  <td>
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-light dropdown-toggle">Options</a>
                      <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-pencil-alt"></i>Edit</a>       
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-trash"></i>Delete</a>
                        <div class="dropdown-divider"></div>
                      </div>
                    </div>
                  </td>
                </tr>';
              }
            } 
            echo'
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      </div>';
    }

    function all_paticular_customers($title){
      echo' <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-success">
          <div class="card-header">
            <h4>'.$title.'</h4>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>Country</th>
                  <th>City</th>
                  <th>User</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              ';
                if ($this->results = $this->view_dbs->get_all_customers()){
                  foreach ($this->results as $row) {
                   $country_icon = $row['country_icon'];
                   $country_name = $row['country_name'];
                   $res_city = $row['city_name'];
                   $user_picture = $row['picture'];
                   $user_name = $row['user_name'];
                   $user_email = $row['email'];
                   $user_phone = $row['phone'];
                        
                  echo'
                <tr>
                  <td><img src="assets/bundles/flag-icon-css/flags/4x3/'.$country_icon.'"
                     alt="user" width="35" height="35"
                     data-toggle="tooltip" data-original-title="'.$country_name.'">
                     </td>
                  <td>'.$res_city.'</td>
                  <td><a href="#">
                  <img alt="'.$user_name.'" src="'.$user_picture.'" class="rounded-circle" width="35"
                    data-toggle="title" title="">
                  <span class="d-inline-block ml-1">'.$user_name.'</span>
                </a></td>
                  <td>'.$user_email.'</td>
                  <td>'.$user_phone.'</td>
                  <td>
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-light dropdown-toggle">Options</a>
                      <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-pencil-alt"></i>Edit</a>       
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-trash"></i>Delete</a>
                        <div class="dropdown-divider"></div>
                      </div>
                    </div>
                  </td>
                </tr>';
              }
            } 
            echo'
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      </div>';
    }

    function add_user(){
       
      if(isset($_GET['succ'])){
        $this->alert2('New user created successfully');
      }
      elseif(isset($_GET['not'])){
        $this->alert('Oops! An error ocured, please try again latter');
      }
      echo'<div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h4>Add User</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="process.php" enctype="multipart/form-data">
            <div class="row">
             
             <div class="form-group col-4">
                   <label for="frist_name">Full Name</label>
                   <input id="frist_name" type="text" class="form-control" name="name" placeholder="" required="" autofocus>
             </div> 
             <div class="form-group col-4">
                 <label for="frist_name">Username</label>
                 <input id="frist_name" type="text" class="form-control" name="user" placeholder="" required="" autofocus>
             </div> 
             <div class="form-group col-4">
                   <label for="frist_name">Email</label>
                   <input id="email" type="email" class="form-control" name="email" placeholder="" required="" autofocus>
             </div> 
             </div>

             <div class="row">
             <div class="form-group col-4">
                <label for="frist_name">Password</label>
                <input id="frist_name" type="password" class="form-control" name="pass" placeholder="" required="" autofocus>
             </div> 
             <div class="form-group col-4">
                <label for="frist_name">Mobile Number</label>
                <input id="frist_name" type="text" class="form-control" name="phone" placeholder="" required="" autofocus>
             </div> 
             <div class="form-group col-4">
                 <label for="frist_name">Profile Picture</label>
                 <input type="file" name="res_picture" id="image-upload" required="">
             </div> 
             </div>

             <div class="row">
             <div class="form-group col-4">
                 <label for="frist_name">Select City</label>
                 <select class="form-control selectric" name="city_id" value="" required="">
                   <option></option>';
                   if ($this->results = $this->view_dbs->get_cities()){
                    foreach ($this->results as $row) {
                      $city_name = $row['city_name'];
                      $city_id = $row['id'];
         
                      echo '<option value="'.$city_id.'">'.$city_name.'</option>';
                     }
                   }
        echo' 
             </select>
             </div>
             <div class="form-group col-4">
                 <label for="frist_name">Select User Type</label>
                 <select class="form-control selectric" name="user_level" value="" required="">
                   <option></option>
                   <option value="7">County Admin</option>
                   <option value="6">City Admin</option>
                   <option value="5">Restaurant Admin</option>
                   <option value="3">Driver</option>
                  </select>
              </div>
              </div>
             <div class="card-footer text-right">
                 <input type="hidden" name="subjoin" value="1">
                 <button class="btn btn-primary">Submit</button>
             </div>
             
            </form>
          </div>
        </div>
      </div>
      </div>';
    }

    function add_meal($city_id, $res_id){
      echo'<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
              <h4>Add Meal</h4>   
            <div class="card-header-action">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal">
              Add category
             </button>
             <a href="meals.php?city='.$city_id.'&res='.$res_id.'" class="btn btn-primary">All meals</a>
            </div>
          </div>
          <div class="card-body">

           <form method="POST" action="process.php" enctype="multipart/form-data">
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title *</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" name="meal_name" class="form-control" required="">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category *</label>
              <div class="col-sm-12 col-md-7">
                <select class="form-control selectric" name="meal_category" required="">
                <option></option>
                ';
                   if ($this->results = $this->view_dbs->get_meal_category($city_id, $res_id)){
                    foreach ($this->results as $row) {
                      $id = $row['id'];
                      $title = $row['title'];
         
                      echo '<option value="'.$id.'">'.$title.'</option>';
                     }
                   }
                   else {
                    echo' <optgroup label="No meal category">';
                 }
               echo' 
                </select>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price *</label>
              <div class="col-sm-12 col-md-7">
                <input type="number" name="meal_price" class="form-control" required="">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
              <div class="col-sm-12 col-md-7">
                <textarea name="meal_description" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
              <div class="col-sm-12 col-md-7">
                <div id="image-preview" class="image-preview">
                  <label for="image-upload" id="image-label">Choose File</label>
                  <input type="file" name="image" id="image-upload" />
                </div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
              <div class="col-sm-12 col-md-7">
                <select name="meal_status" class="form-control selectric" required="">
                  <option value="publish">Publish</option>
                  <option value="pending">Pending</option>
                </select>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
              <div class="col-sm-12 col-md-7">
                 <input type="hidden" name="city_id" value="'.$city_id.'">
                 <input type="hidden" name="res_id" value="'.$res_id.'">
                 <input type="hidden" name="subaddmeal" value="1">
                <button class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
     </div>';
    }
     
    function res_stats_mini($city_id, $res_id){
    
      if ($this->results = $this->view_dbs->get_single_restaurant($city_id, $res_id)){
       foreach ($this->results as $row) {
        
         $res_city = $row['city_name'];
         $res_name = $row['res_name'];
         $res_email = $row['res_email'];
         $res_picture = $row['res_picture'];
         $res_type = $row['res_subscription_type'];
         $res_hours = $row['res_hours'];
 
      echo' <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-wrap">
            <div class="padding-20">
              <div class="text-center">
                <h6 class="font-light mb-0">
                  <i class="ti-arrow-up text-success"></i> '.$res_name.'
                </h6>
                <span class="text-muted">
                <br />'.$res_city.'</span>
              </div>
            </div>
          </div>
        </div>
      </div>';
       }
      }
      echo'
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon l-bg-green">
            <i class="fas fa-cart-plus"></i>
          </div>
          <div class="card-wrap">
            <div class="padding-20">
              <div class="text-right">
                <h3 class="font-light mb-0">
                  <i class="ti-arrow-up text-success"></i> 158
                </h3>
                <span class="text-muted">New Clients</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon l-bg-cyan">
            <i class="fas fa-chart-line"></i>
          </div>
          <div class="card-wrap">
            <div class="padding-20">
              <div class="text-right">
                <h3 class="font-light mb-0">
                  <i class="ti-arrow-up text-success"></i> 785
                </h3>
                <span class="text-muted">New Orders</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon l-bg-orange">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="padding-20">
              <div class="text-right">
                <h3 class="font-light mb-0">
                  <i class="ti-arrow-up text-success"></i> $5,263
                </h3>
                <span class="text-muted">Todays Income</span>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>';
    }

    function meal_category_modal($city_id, $res_id){
      echo' <!-- basic modal -->
      <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" action="process.php" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" class="form-control" required>
              <div class="invalid-feedback">
                Please fill in the title
              </div>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control"></textarea>
            </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <input type="hidden" name="city_id" value="'.$city_id.'">
              <input type="hidden" name="res_id" value="'.$res_id.'">
              <input type="hidden" name="subaddmealcat" value="1">
              <button class="btn btn-primary">Save changes</button>
            </div>
           </form>

          </div>
        </div>
      </div>
      <!-- Modal with form -->';
    }

    function food_meals($city_id, $res_id){
      echo'<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Menu</h4>
            <div class="card-header-action">
            <a href="add_menu.php?city='.$city_id.'&res='.$res_id.'" class="btn btn-primary">Add Meal</a>
           </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th class="text-center">
                      ID
                    </th>
                    <th>Meal</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                ';
                if ($this->results = $this->view_dbs->get_meals($res_id)){
                 foreach ($this->results as $row) {
                   $meal_id = $row['mid'];
                   $meal_name = $row['meal_name'];
                   $meal_price= $row['meal_price'];
                   $meal_picture= $row['meal_picture'];
                   $meal_category= $row['title'];
                   $meal_description= $row['meal_description'];
                   $meal_status= $row['meal_status'];
                   $dates= $row['dates'];
                
                 echo'
                  <tr>
                    <td>
                      '.$meal_id.'
                    </td>
                    <td>
                      '.$meal_name.'
                    </td>
                    <td>
                    <img src="'.$meal_picture.'" alt="user" width="35" height="35"
                    data-toggle="tooltip" data-original-title="'.$meal_name.'">
                    </td>
                    <td>
                    GHc '.$meal_price.'
                    </td>
                    <td>
                      '.$meal_description.'
                  </td>
                    <td>
                      '.$meal_category.'
                    </td>
                    <td>
                    <div class="dropdown d-inline mr-2">
                      <button class="badge '; if ($meal_status == 'publish'){echo'badge-success';}
                        else if ($meal_status == 'pending'){echo'badge-danger';} echo'" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       '.ucwords($meal_status).'
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Pending</a>
                        <a class="dropdown-item" href="#">Publish</a>
                      </div>
                    </div>
                    </td>
                    <td>
                      '.$dates.'
                    </td>
                  </tr>
                  ';
                }
              }
              echo'
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     </div>';
        
    }

  };
?>
<?php
  class ViewFooter{
    var $assets_url = ASSETSURL;

    function footer(){
      echo'</div>
      </div>
      <footer class="main-footer">
      <div class="footer-left">
        <a href="templateshub.net">StagesHub IT Solutions</a>
      </div>
      <div class="footer-right">
      </div>
     </footer>
     </div>
     </div>';
    }

    function footer_down(){
      echo'<!-- General JS Scripts -->
      <script src="assets/js/app.min.js"></script>
      <!-- JS Libraies -->
      <script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
      <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
      <script src="assets/bundles/summernote/summernote-bs4.js"></script>
      <script src="assets/bundles/chocolat/dist/js/jquery.chocolat.min.js"></script>
      <script src="assets/bundles/datatables/datatables.min.js"></script>
      <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
      <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
      <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
      <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
      <script src="assets/bundles/prism/prism.js"></script>
      <!-- Page Specific JS File -->
      <script src="assets/js/page/datatables.js"></script>
      <script src="assets/js/page/posts.js"></script>
      <!-- Page Specific JS File -->
      <script src="assets/js/page/create-post.js"></script>
      <script src="assets/js/page/index.js"></script>
      <!-- Template JS File -->
      <script src="assets/js/scripts.js"></script>
      <!-- Custom JS File -->
      <script src="assets/js/custom.js"></script>';
    }

    function settings(){
      echo'
      </section>
      <div class="settingSidebar">
      <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
      </a>
      <div class="settingSidebar-body ps-container ps-theme-default">
        <div class=" fade show active">
          <div class="setting-panel-header">Setting Panel
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Select Layout</h6>
            <div class="selectgroup layout-color w-50">
              <label class="selectgroup-item">
                <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                <span class="selectgroup-button">Light</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                <span class="selectgroup-button">Dark</span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Sidebar Color</h6>
            <div class="selectgroup selectgroup-pills sidebar-color">
              <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                  data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                  data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Color Theme</h6>
            <div class="theme-setting-options">
              <ul class="choose-theme list-unstyled mb-0">
                <li title="white" class="active">
                  <div class="white"></div>
                </li>
                <li title="cyan">
                  <div class="cyan"></div>
                </li>
                <li title="black">
                  <div class="black"></div>
                </li>
                <li title="purple">
                  <div class="purple"></div>
                </li>
                <li title="orange">
                  <div class="orange"></div>
                </li>
                <li title="green">
                  <div class="green"></div>
                </li>
                <li title="red">
                  <div class="red"></div>
                </li>
              </ul>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <div class="theme-setting-options">
              <label class="m-b-0">
                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                  id="mini_sidebar_setting">
                <span class="custom-switch-indicator"></span>
                <span class="control-label p-l-10">Mini Sidebar</span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <div class="theme-setting-options">
              <label class="m-b-0">
                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                  id="sticky_header_setting">
                <span class="custom-switch-indicator"></span>
                <span class="control-label p-l-10">Sticky Header</span>
              </label>
            </div>
          </div>
          <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
              <i class="fas fa-undo"></i> Restore Default
            </a>
          </div>
        </div>
      </div>
     </div>';
    }

    function import_footer(){
      echo'<script src="assets/js/jquery-3.2.1.min.js"></script>';
    }

  }

?>
 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= base_url(); ?>" class="site_title"><i class="fa fa-dashboard"></i> <span>ADMIN PANEL</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?= base_url('assets/images/img.jpg'); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat datang,</span>
                <h2><?= session('nama'); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Beranda</a></li>
                  <?php if (session('role') == 1) : ?>
				  <li><a><i class="fa fa-folder"></i> Master<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					  <li><a href="<?= site_url('master_jabatan'); ?>">Master jabatan</a></li>
                      <li><a href="<?= site_url('unit_kerja'); ?>">Master Unit kerja dan Hirarki jabatan</a></li>
                      <li><a href="<?= site_url('syarat_jabatan'); ?>">Master syarat jabatan</a></li>
                      <li><a href="<?= site_url('tugas_pokok_jabatan'); ?>">Master Tugas pokok jabatan</a></li>
					  <li><a href="<?= site_url('lingkungan_kerja'); ?>">Master Kondisi Lingkungan</a></li>
					  <li><a href="<?= site_url('keterampilan'); ?>">Master Keterampilan Kerja</a></li>
					  <li><a href="<?= site_url('bakat'); ?>">Master Bakat Kerja</a></li>
					  <li><a href="<?= site_url('temperamen'); ?>">Master Temperamen Kerja</a></li>
					  <li><a href="<?= site_url('minat'); ?>">Master Minat Kerja</a></li>
					  <li><a href="<?= site_url('upaya_fisik'); ?>">Master Upaya Fisik</a></li>
					  <li><a href="<?= site_url('fungsi_fisik'); ?>">Master Fungsi Fisik</a></li>
                    </ul>
                  </li>
				  <li><a href="<?= site_url('users'); ?>"><i class="fa fa-user"></i> Data User</a></li>
				  <?php endif; ?>
                  <li><a href="<?= site_url('anjab'); ?>"><i class="fa fa-users"></i> Data Jabatan</a></li>
				  <li><a><i class="fa fa-file-text"></i> Laporan <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					  <li><a href="<?= site_url('laporan/peta'); ?>">Peta jabatan</a></li>
					  
					</ul>
				  </li>
                  
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              &nbsp;
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
		
		<!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?= base_url('assets/images/img.jpg'); ?>" alt=""><?= session('nama'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li><a href="<?= site_url('index/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
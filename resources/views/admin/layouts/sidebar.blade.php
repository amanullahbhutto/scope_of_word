  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      {{--  <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>  --}}

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              {{--  <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>  --}}
              {{--  <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>  --}}
          </div>



          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">

                  <li class="nav-item">
                      <a href="{{ route('products.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-box"></i>
                          <p>Products</p>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p> Categories</p>
                    </a>
                </li>

                  <li class="nav-item">
                      <a href="{{ route('management-teams.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Management Team</p>
                      </a>
                  </li>


               
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-list"></i>
                          <p>
                              Other Side Bar
                              <i class="fas fa-angle-left right"></i> <!-- This icon shows the dropdown arrow -->
                          </p>
                      </a>

                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{ route('users.index') }}" class="nav-link">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>User Management</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('permissions.index') }}" class="nav-link">
                                  <i class="nav-icon fas fa-user-shield"></i>
                                  <p>Roles & Permissions</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="nav-icon fas fa-hand-holding-heart"></i>
                                  <p>Our Responsibilities</p>
                              </a>
                          </li>


                          <li class="nav-item">
                              <a href="{{ route('contacts.index') }}" class="nav-link">
                                  <i class="nav-icon fas fa-envelope"></i>
                                  <p>Contact Us</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('jobs.index') }}" class="nav-link">
                                  <i class="nav-icon fas fa-briefcase"></i> <!-- Icon for Jobs -->
                                  <p>Jobs</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="nav-icon fas fa-info-circle"></i>
                                  <p>About Us</p>
                              </a>
                          </li>

                          <li class="nav-item">
                            <a href="{{ route('media.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-photo-video"></i>
                                <p>Media</p>
                            </a>
                        </li>


                      </ul>
                  </li>


                  <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                   </li>

              </ul>
          </nav>
      </div>
  </aside>

<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex"> 
        <div class="image">
            <img src="{{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : url('backend/dist/img/user-photo.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info"> 
            <a href="#" class="d-block"> 
                @php 
                    $sentences = explode(' ', Auth::user()->name); 
                    echo $sentences[0] . ' ' . (isset($sentences[1]) ? $sentences[1] . ' ' : ''); 
                @endphp
            </a> 
        </div> 
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('index-peminjaman-anggota') }}" class="nav-link">
                  <i class="nav-icon fas fa-upload"></i>
                    <p>
                        Data Peminjaman
                    </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('index-pengembalian-anggota') }}" class="nav-link">
                  <i class="nav-icon fas fa-upload"></i>
                    <p>
                        Data Pengembalian
                    </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('index-buku') }}" class="nav-link">
                  <i class="nav-icon fas fa-search"></i>
                    <p>
                        Cari Buku
                    </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('index-user') }}" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                    <p>
                        Data Anggota
                    </p>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon  fas fa-sign-out-alt"></i>
                <p>
                    Log Out
                </p>
            </a>
          </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
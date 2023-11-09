<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ url('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">ADMIN</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
              <a href={{ route('admin-dashboard') }} class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
              </a>
          </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-file-alt"></i>
                <p>
                  Data
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('buku.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Buku</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('kategori.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('rak.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rak</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                  Transaksi
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('peminjaman.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Peminjaman</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengembalian</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                  <p>
                      Data Pengguna
                  </p>
              </a>
            </li>
            <li class="nav-item">
            <a href="{{ route('denda.index') }}" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
                <p>
                    Denda
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
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
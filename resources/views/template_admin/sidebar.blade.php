<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Bismillah Skiripsi</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">BS</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header"></li>
              <li class="nav-item dropdown">
                <a href="{{route('home')}}" class="nav-link"><i class="fa-solid fa-fire"></i></i><span>Dashboard</span></a>
              </li>
              <li><a class="nav-link" href="{{route('matakuliah.index')}}"><i class="fa-solid fa-book-open-reader"></i><span>Mata Kuliah</span></a></li>
              <li><a class="nav-link" href="{{route('learningjurnal.index')}}"><i class="fa-solid fa-book"></i><span>Tambah Learning Jurnal</span></a></li>
              <li><a class="nav-link" href="{{route('jawaban.index')}}"><i class="fa-regular fa-file-lines"></i><span>Data Jawaban</span></a></li>
              <li><a class="nav-link" href="{{route('filterjawaban.index')}}"><i class="fa-solid fa-award"></i><span>Penilaian</span></a></li>
              <li>
                  <a class="nav-link text-danger" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i></i><span>Logout</span>
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>              
              </li>   
            </ul>
        </aside>
      </div>

<div class="fixed flex flex-col top-0 left-0 w-64 h-full border-r z-[5] bg-[#557C55]">
  <div class="flex items-center justify-center h-14 border-b text-white">
    <div><img src="assets/img/logo.png"style="float:left;margin:0 8px 4px 0;” alt="Logo" class="h-8 w-auto">Dinas Pertanian TPHP Kabupaten Bangkalan</div>
  </div>
  <div class="overflow-y-auto overflow-x-hidden flex-grow">
    <ul class="flex flex-col py-4 space-y-1">
      
      <?php

      if (isset($_SESSION['uname'])) {
        // Gunakan pg_escape_string() untuk PostgreSQL
        $uname_escaped = pg_escape_string($conn, $_SESSION['uname']);
        $sql = 'SELECT gambar FROM admin WHERE nama_lengkap = \'' . $uname_escaped . '\'';
        $result = pg_query($conn, $sql);

        if ($result && pg_num_rows($result) > 0) {
          $row = pg_fetch_assoc($result);
          $gambar = $row['gambar'];

          // Cek apakah gambar ada dan tambahkan spasi antara src dan alt
          if ($gambar) {
            $element = '<img class="ml-4 object-cover rounded-full w-7 h-7" src="' . htmlspecialchars($gambar) . '" alt="">';
          } else {
            // Elemen default jika gambar tidak ada
            $element = '<span class="inline-flex justify-center items-center ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>';
          }

          // Tampilkan menu profil dan logout
          echo '    
          <li class="px-5">
              <div class="flex flex-row items-center h-8">
                  <div class="text-sm font-bold tracking-wide text-white">Profil</div>
              </div>
          </li>
          <li>
              <a href="edit_profile.php?uname=' . urlencode($_SESSION['uname']) . '" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                  ' . $element . '
                  <span class="ml-2 text-sm tracking-wide truncate">Admin ' . htmlspecialchars($_SESSION['uname']) . '</span>
              </a>
          </li>';
        }
      }


      // Tampilkan konten dashboard di sini
      ?>
      <li class="px-5">
        <div class="flex flex-row items-center h-8">
          <div class="text-sm font-bold tracking-wide text-white">Menu</div>
        </div>
      </li>
      <?php
      if (!isset($_SESSION['uname'])) {
        echo '
           <li>
        <a href="dashboard.php"
           class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
          <span class="inline-flex justify-center items-center ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
              </path>
            </svg>
          </span>
          <span class="ml-2 text-sm tracking-wide truncate">Home</span>
        </a>
      </li>';
      }
      ?>
      <?php
      if (isset($_SESSION['uname'])) {
        echo '
           <li>
        <a href="dashboard.php"
           class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
          <span class="inline-flex justify-center items-center ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
              </path>
            </svg>
          </span>
          <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
        </a>
      </li>';
      }
      ?>

      <?php
      if (isset($_SESSION['uname'])) {
        echo '
      <li>
        <a href="lihat_data_produksi.php"
          class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
          <span class="inline-flex justify-center items-center ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
              </path>
            </svg>
          </span>
          <span class="ml-2 text-sm tracking-wide truncate">Data Produksi</span>
        </a>
      </li>';
      }
      ?>
      <li>
        <a href="informasi_data_produksi.php"
          class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
          <span class="inline-flex justify-center items-center ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
          </span>
          <span class="ml-2 text-sm tracking-wide truncate">Informasi Data Produksi</span>
        </a>
      </li>
      <li class="px-5">
        <div class="flex flex-row items-center h-8">
          <div class="text-sm font-bold tracking-wide text-white">Peta</div>
        </div>
      </li>
      <li>
        <a href="peta_persebaran_aset.php"
          class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
          <span class="inline-flex justify-center items-center ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
              </path>
            </svg>
          </span>
          <span class="ml-2 text-sm tracking-wide truncate">Persebaran Produksi</span>
        </a>
      </li>
      <?php
      if (!isset($_SESSION['uname'])) {
        echo '
      <li>
          <a href="login.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
            <span class="inline-flex justify-center items-center ml-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </span>
            <span class="ml-2 text-sm tracking-wide truncate">Login</span>
          </a>
      </li>';
      }
      else {
        echo '<li>
                  <a href="logout.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                      <span class="inline-flex justify-center items-center ml-4">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                          </svg>
                      </span>
                      <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
                  </a>
              </li>';
      }
      ?>


    </ul>
  </div>
</div>
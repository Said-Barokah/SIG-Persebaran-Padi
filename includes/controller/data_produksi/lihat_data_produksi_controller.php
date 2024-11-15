<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('includes\koneksi.php'); 

// Tangkap input pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Modifikasi query untuk menambahkan klausa pencarian jika ada input
$query = "SELECT produksi_padi.*, kecamatan.nama_kecamatan
FROM produksi_padi
JOIN kecamatan ON produksi_padi.kode_kecamatan = kecamatan.id ORDER BY produksi_padi.id DESC";

if ($search) {
    $query .= " WHERE kecamatan.nama_kecamatan ILIKE '%$search%' 
                OR produksi_padi.luas_tanam::text ILIKE '%$search%'
                OR produksi_padi.jenis_padi::text ILIKE '%$search%'
                OR produksi_padi.luas_panen::text ILIKE '%$search%'
                OR produksi_padi.produktivitas::text ILIKE '%$search%'
                OR produksi_padi.produksi_padi::text ILIKE '%$search%'";
}

$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        echo '<tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <div class="flex items-center">
                <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                        '.$row['nama_kecamatan'].'
                    </p>
                </div>
            </div>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">' . $row['jenis_padi'] . '</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">' . $row['luas_tanam'] . '</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
            ' . $row['luas_panen'] . '
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
            ' . $row['produktivitas'] . '
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
            ' . $row['produksi_padi'] . '
            </p>
        </td>
        <td class="flex justify-around px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <a href="detail_data_produksi.php?id=' . $row['id'] . '" class="inset-0 my-5 opacity-50 rounded-full">
                <!-- SVG detail icon -->
            </a>';
        
        // Check if the session is set before displaying edit and delete links
        if(isset($_SESSION['uname'])) {
            echo '<a title="edit" href="edit_data_produksi.php?id=' . $row['id'] . '" class="inset-0 my-5 opacity-50 rounded-full mr-5">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!-- Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
            </svg>
          </a>
          <a title="hapus" href="includes/controller/data_produksi/hapus_data_produksi.php?id=' . $row['id'] . '" class="inset-0 my-5 opacity-50 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!-- Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
            </svg>
          </a>';
        }
        echo '</td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="6" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">No data found</td></tr>';
}
?>
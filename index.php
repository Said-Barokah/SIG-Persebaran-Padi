<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        .hero-container {
            display: flex;
            overflow-x: hidden;
            scroll-behavior: smooth;
            padding: 0 1rem;
            height: 100vh;
        }
        .hero {
            flex: 0 0 100%;
            min-width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: #fff;
            border-radius: 12px;
            margin-right: 1rem;
        }
        .hero img {
            max-width: 50%;
            height: auto;
            border-radius: 12px;
        }
        .scroll-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            font-size: 1.5rem;
        }
        .scroll-button:hover {
            background: rgba(0, 0, 0, 0.8);
        }
        .scroll-button.left {
            left: 1rem;
            font-weight: bold;
            margin-left: 20px;
        }
        .scroll-button.right {
            right: 1rem;
            font-weight: bold;
            margin-right: 20px;
        }
        .hero-text {
            padding-left: 80px;
            max-width: 65%;
        }
        .hero-text h1 {
            font-size: 2.5rem;
            line-height: 1.2;
        }
        .hero-text p {
            font-size: 1.125rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <?php include 'template/sidebar.php'; ?>
    <?php include 'includes/controller/data_produksi/count_dashboard.php'; ?>
    <?php
    include 'template/sidebar.php';
    include 'includes/controller/peta/geografis_information_controller.php';
    ?>

    <!-- Main Content -->
    <div class="ml-[240px] top-0 bg-whites">
        <div class="relative">
            <!-- Hero Section Container -->
            <div class="hero-container">
                <!-- First Hero -->
                <div class="hero bg-[url('assets/img/bg-home.jpg')]">
                    <div class="hero-text">
                        <h1 class="text-4xl text-white font-bold">Selamat Datang</h1>
                        <p class="mt-4 text-lg text-white">Kami menyediakan informasi lengkap mengenai produksi padi di Bangkalan. Jelajahi data dan temukan informasi penting tentang padi sawah dan padi ladang.</p>
                    </div>
                </div>

                <!-- Second Hero -->
                <div class="hero bg-[url('assets/img/padi-sawah.jpg')]">
                    <div class="hero-text ">
                        <h1 class="text-4xl text-white font-bold">Padi Sawah</h1>
                        <p class="mt-4 text-white">Padi sawah merupakan jenis padi yang ditanam di lahan basah. Dikenal dengan pertumbuhan yang optimal di area dengan pasokan air yang baik.</p>
                    </div>
                </div>

                <!-- Third Hero -->
                <div class="hero bg-[url('assets/img/padi-ladang.jpg')]">
                    <div class="hero-text">
                        <h1 class="text-4xl text-white font-bold">Padi Ladang</h1>
                        <p class="mt-4 text-lg text-white">Padi ladang tumbuh di lahan kering dengan sedikit atau tanpa irigasi. Umumnya ditanam di tanah yang kering dan memerlukan perhatian khusus terhadap kondisi cuaca.</p>
                    </div>
                </div>
            </div>

            <!-- Scroll Buttons -->
            <button class="scroll-button left text-bold" onclick="scrollContainer(-1)">
                &lt;
            </button>
            <button class="scroll-button right" onclick="scrollContainer(1)">
                &gt;
            </button>
        </div>
    </div>

    <script>
        function scrollContainer(direction) {
            const container = document.querySelector('.hero-container');
            const scrollAmount = container.clientWidth * direction;
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("css/main.css") ?>">
    <title>Nasi Goreng</title>
</head>

<body class="bg-blue-400">
    <main class="max-w-4xl w-full mx-auto bg-white">
        <header class="flex items-center justify-between bg-zinc-950 py-3 px-8 rounded shadow">
            <a href="<?= base_url() ?>">
                <h1 class="font-bold text-2xl text-emerald-400">Nasi Goreng Delivery</h1>
            </a>
            <div class="flex items-center gap-x-3">
                <!-- shopping cart -->
                <a href="<?= base_url("detail") ?>" class="relative cursor-pointer p-2 rounded-full hover:bg-zinc-900">
                    <span
                        class="absolute text-white bg-rose-500 rounded-full w-4 h-4 right-0 top-0 flex items-center justify-center text-xs <?= $keranjang == 0 ? 'hidden' : '' ?>"><?= $keranjang ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 text-yellow-400">
                        <path
                            d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                    </svg>
                </a>

            </div>
        </header>
        <?php if (session()->getFlashdata("error")): ?>
        <div class="flex-1 px-3 py-2 bg-rose-300 text-rose-800 m-3 rounded">
            Gagal Menambahkan ke keranjang
        </div>
        <?php endif; ?>
        <div class="grid grid-cols-3 justify-center gap-3 w-full p-3">
            <!-- card -->
            <?php foreach ($menus as $key => $menu): ?>
            <div class="flex-1 rounded shadow overflow-clip">
                <div class="w-full h-52 overflow-hidden flex-1 justify-center">
                    <img src="<?= base_url("uploads/" . $menu["gambar"]) ?>" alt="" srcset=""
                        class="h-full w-full object-contain">
                </div>
                <div class="px-3 py-2">
                    <h3 class="font-semibold text-lg capitalize">
                        <?= $menu["nm_menu"] ?>
                    </h3>
                    <small class="text-sm text-zinc-400">Rp.
                        <?= number_format($menu["harga"], 0, ',', '.') ?>
                    </small>
                    <form action="<?= base_url() ?>" method="post">
                        <input type="hidden" name="kd_menu" value="<?= $menu["kd_menu"] ?>">
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center flex-1">
                                <!-- Minus -->
                                <input type="button" class="p-2 bg-zinc-100 cursor-pointer minus" value="-">
                                <!-- count -->
                                <input type="number" name="jumlah" pattern="0-9"
                                    class="count flex-1 max-w-[36px] h-full text-center focus:outline-transparent"
                                    tabindex="-1" inputmode="numeric" value="1">
                                <!-- plus -->
                                <input type="button" class="p-2 bg-zinc-100 cursor-pointer plus" value="+">
                            </div>
                            <button type="submit"
                                class="px-3 py-2 bg-rose-500 text-white text-sm uppercase rounded">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </main>
    <script>
    var plus = document.querySelectorAll(".plus")
    var minus = document.querySelectorAll(".minus")
    var count = document.querySelectorAll(".count")

    minus.forEach((min, i) => {
        min.addEventListener("click", (e) => {
            if (count[i].value > 1) {
                count[i].value = parseInt(count[i].value) - 1
            } else {
                count[i].value = 0
            }
        })
        return false;
    })
    plus.forEach((item, i) => {
        item.addEventListener("click", (e) => {
            count[i].value = parseInt(count[i].value) + 1
        })
        return false;
    })

    // function tambah(i) {
    //     count[i].value = parseInt(count[i].value) + 1;
    // }

    // function kurang(i) {
    //     if (count[i].value > 0) {
    //         count[i].value = parseInt(count[i].value) - 1
    //     }
    //     else {
    //         count[i].value = 0
    //     }
    // }
    </script>
</body>

</html>
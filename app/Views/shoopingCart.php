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
    <main class="max-w-4xl w-full mx-auto bg-white min-h-screen">
        <header class="flex items-center justify-between bg-zinc-950 py-3 px-8 rounded shadow">
            <a href="<?= base_url() ?>">
                <h1 class="font-bold text-2xl text-emerald-400">Nasi Goreng Delivery</h1>
            </a>
            <div class="flex items-center gap-x-3">
                <!-- shopping cart -->
                <div class="relative cursor-pointer p-2 rounded-full hover:bg-zinc-900">
                    <span
                        class="absolute text-white bg-rose-500 rounded-full w-4 h-4 right-0 top-0 flex items-center justify-center text-xs <?= $keranjang == 0 ? 'hidden' : '' ?>"><?= $keranjang ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 text-amber-400">
                        <path
                            d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                    </svg>
                </div>

            </div>
        </header>
        <?php if (session()->getFlashdata("error")): ?>
            <div class="flex-1 px-3 py-2 bg-rose-300 text-rose-800 m-3 rounded">
                Gagal melakukan transaksi!
            </div>
        <?php endif; ?>

        <div class="w-full overflow-x-auto p-3">
            <table class="table-auto w-full">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <tr>
                        <th class="p-2">
                            <div class="font-semibold text-left">Nama Menu</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-left">Harga</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-left">Jumlah</div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-right">Sub Total</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="text-sm divide-y divide-gray-100">
                    <?php foreach ($details as $key => $detail): ?>
                        <tr>
                            <td class="p-2 min-w-[150px]">
                                <div class="text-left capitalize">
                                    <?= model(MenuModel::class)->where(["kd_menu" => $detail["kd_menu"]])->first()["nm_menu"] ?>
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-left">
                                    Rp.
                                    <?= number_format($detail["harga"], 0, ',', '.') ?>
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-left">
                                    <?= $detail["jumlah_pesanan"] ?>
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="text-right">
                                    Rp.
                                    <?= number_format($detail["sub_total"], 0, ',', '.') ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="flex items-center justify-between mt-2 px-3 py-2 border-t">
                <h3>Total Harga</h3>
                <p>
                    Rp.
                    <?= number_format($total, 0, ',', '.') ?>
                </p>
            </div>
            <div class="flex items-center justify-end mt-3">
                <button id="bayar" class="uppercase px-5 py-2 rounded bg-emerald-500 text-white">Bayar</button>
            </div>
        </div>
    </main>
    <!-- transaksi dialog -->
    <div class="absolute top-0 left-0 w-full h-screen bg-zinc-900 bg-opacity-50 flex items-center justify-center invisible"
        id="dialog">
        <?= form_open(base_url("detail")) ?>
        <div class="w-full max-w-lg h-96 bg-white rounded p-5 relative">
            <header class="flex items-center justify-center">
                <h2 class="font-semibold text-xl border-b-2 mb-2 border-emerald-500">Transaksi</h2>
            </header>
            <!-- close btn -->
            <button type="reset" class="absolute top-3 right-3 text-zinc-400 hover:text-300" id="closeDialog">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <div class="px-3 py-2">
                <input type="hidden" name="_method" value="POST">
                <input type="text" name="nama" id="nama"
                    class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500 outline-transparent"
                    placeholder="Nama" required>
                <input type="text" name="alamat" id="alamat"
                    class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500 outline-transparent"
                    placeholder="Alamat" required>
                <input type="number" inputmode="numeric" name="telp" id="telp"
                    class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500 outline-transparent"
                    placeholder="No Telp" required>
                <button type="submit"
                    class="uppercase text-white bg-emerald-500 flex-1 w-full px-3 py-2 font-semibold rounded mt-3 hover:bg-emerald-400 cursor-pointer">
                    bayar
                </button>
            </div>
        </div>
        <?php form_close() ?>
    </div>
    <script>
        const open = document.querySelector("#bayar")
        const dialog = document.querySelector("#dialog")
        const close = document.querySelector("#closeDialog")

        open.addEventListener("click", (e) => {
            e.preventDefault();
            dialog.classList.remove("invisible")
        })
        close.addEventListener("click", (e) => {
            e.preventDefault();
            dialog.classList.add("invisible")
        })
    </script>
</body>

</html>
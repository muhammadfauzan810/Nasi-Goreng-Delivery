<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | transaksi</title>
    <link rel="stylesheet" href="<?= base_url("css/main.css") ?>">
</head>

<body class="bg-neutral-200">
    <div class="flex h-screen overflow-hidden">
        <?= view("components/sidebar", ["active" => "transaksi"]) ?>
        <div class="flex-1 h-screen overscroll-y-auto p-3">
            <header class="sticky top-0 z-50 w-full shadow-md rounded-md transition-all flex-1 h-32 overflow-clip"
                id="indexHeader"
                style="background-image: url('<?= base_url("image/bg-4.jpg") ?>'); background-position: left;">
                <div class="grid grid-cols-2 items-center gap-y-3 h-full py-3 px-6 bg-slate-900 bg-opacity-25">
                    <h1 class="text-4xl font-bold text-slate-50">
                        Transaksi
                    </h1>
                </div>
            </header>
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200 m-3">
                <!-- table -->
                <div class="overflow-x-auto p-3">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">kode transaksi</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">tanggal</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">pembeli</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">alamat</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">telp</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">total</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">kode admin</div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-sm divide-y divide-gray-100">
                            <!-- record 1 -->
                            <?php foreach ($transaksi as $key => $item): ?>
                            <tr>
                                <td class="p-2">
                                    <div class="text-gray-800">
                                        <?= $item["kd_transaksi"] ?>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">
                                        <?= $item["tgl_transaksi"] ?>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left font-medium text-emerald-500 capitalize">
                                        <?= $item["nama_pembeli"] ?>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">
                                        <?= $item["alamat"] ?>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">
                                        <?= $item["no_telp"] ?>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left font-medium text-sky-500">Rp.
                                        <?= number_format($item["total_bayar"], 0, ',', '.') ?>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">
                                        <?= $item["kd_admin"] ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
</body>

</html>
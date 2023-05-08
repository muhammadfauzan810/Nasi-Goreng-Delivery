<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Menu</title>
    <link rel="stylesheet" href="<?= base_url("css/main.css") ?>">
</head>

<body class="bg-neutral-200">
    <div class="flex h-screen overflow-hidden">
        <?= view("components/sidebar", ["active" => "menu"]) ?>
        <div class="flex-1 h-screen overscroll-y-auto p-3">
            <header class="sticky top-0 z-50 w-full shadow-md rounded-md transition-all flex-1 h-32 overflow-clip"
                id="indexHeader"
                style="background-image: url('<?= base_url("image/bg-4.jpg") ?>'); background-position: left;">
                <div class="grid grid-cols-2 items-center gap-y-3 h-full py-3 px-6 bg-slate-900 bg-opacity-25">
                    <h1 class="text-4xl font-bold text-slate-50">
                        Menu
                    </h1>
                    <div class="flex items-center flex-1 justify-end">
                        <a href="<?= base_url("admin/menu/create") ?>"
                            class="px-3 py-2 bg-emerald-500 text-white rounded-md">
                            Tambah menu
                        </a>
                    </div>
                </div>
            </header>
            <div class="grid grid-flow-row grid-cols-4 gap-3 my-2 py-3">
                <!-- card field -->
                <?php foreach ($menus as $key => $item): ?>
                    <!-- card -->
                    <div class="rounded-md shadow-md bg-zinc-100 overflow-clip flex-1 group">
                        <div class="w-full h-48 overflow-clip relative">
                            <!-- tools -->
                            <div
                                class="absolute group-hover:opacity-100 opacity-0 transition-all ease-out flex items-center justify-center gap-x-3 w-full h-full bg-zinc-900 bg-opacity-60 z-10">
                                <!-- edit button -->
                                <a href="<?= base_url("admin/menu/{$item["id"]}/edit/") ?>"
                                    class="cursor-pointer text-zinc-50 hover:text-zinc-300" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                        <path
                                            d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                    </svg>
                                </a>
                                <!-- delete button -->
                                <?= form_open(base_url("admin/menu/{$item["id"]}/delete")) ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="text-zinc-50 hover:text-red-400" title="Delete"
                                    onclick="return confirm('yakin ingin menghapus menu <?= $item['nm_menu'] ?>')  ">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <?= form_close() ?>
                            </div>
                            <img src="<?= base_url("uploads/" . $item["gambar"]) ?>" alt="" loading="lazy"
                                class="object-cover h-full group-hover:scale-110 transition-transform ease-out mx-auto">
                        </div>
                        <div class="px-3 py-1">
                            <h2 class="font-semibold text-lg capitalize">
                                <?= $item["nm_menu"] ?>
                            </h2>
                            <small class="text-zinc-700 text-sm">Rp.
                                <?= number_format($item["harga"], 0, ',', '.') ?>
                            </small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="absolute bottom-3 right-3 bg-emerald-600 text-white p-3 rounded-md shadow-md" id="alert" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <script>
        setTimeout(() => {
            document.querySelector("#alert").remove();
        }, 2500);
    </script>
</body>

</html>
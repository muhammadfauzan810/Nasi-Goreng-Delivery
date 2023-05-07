<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Edit Menu</title>
    <link rel="stylesheet" href="<?= base_url("css/main.css") ?>">
</head>

<body class="bg-blue-400">
    <div class="my-4 max-w-3xl mx-auto">
        <header class="w-full shadow-md rounded-md transition-all flex-1 h-32 overflow-clip"
            style="background-image: url('<?= base_url("image/bg-4.jpg") ?>');  background-position: left;">
            <div class="flex items-center h-full py-3 px-6 bg-slate-900 bg-opacity-25 gap-x-3">
                <a href="<?= base_url("admin/menu") ?>" class="p-2 rounded bg-emerald-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-zinc-50">
                    Edit Menu
                </h1>
            </div>
        </header>
        <?= form_open_multipart(base_url("admin/menu/{$id}/edit")) ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="space-y-3 mt-3 py-3 px-6 rounded-md shadow-md bg-zinc-50">
            <div class="flex flex-col gap-y-2  col-span-3">
                <h3>Gambar</h3>
                <input type="file" name="gambar" id="gambar" accept="image/png, image/jpeg"
                    class=" px-3 py-2 rounded-md flex-1 border border-zinc-900 bg-transparent focus:outline-none">
                <?php if (isset($validation["gambar"])): ?>
                    <small class="text-red-500 text-sm">
                        <?= $validation["gambar"] ?>
                    </small>
                <?php endif ?>
            </div>
            <div class="flex flex-col gap-y-2 my-3">
                <h3>Nama Menu</h3>
                <input type=" text" name="menu" id="menu"
                    class="px-3 py-2 rounded-md flex-1 border border-zinc-900 bg-transparent focus:outline-none"
                    placeholder="Nama menu" value="<?= $nm_menu ?>" required>
                <?php if (isset($validation["menu"])): ?>
                    <small class="text-red-500 text-sm">
                        <?= $validation["menu"] ?>
                    </small>
                <?php endif ?>
            </div>
            <div class="space-y-3">
                <div class="flex flex-col gap-y-2 my-3">
                    <h3>Harga</h3>
                    <input type="number" name="harga" id="harga" min="0"
                        class="px-3 py-2 rounded-md flex-1 border border-zinc-900 bg-transparent focus:outline-none"
                        placeholder="Harga" value="<?= $harga ?>" required>
                    <?php if (isset($validation["harga"])): ?>
                        <small class="text-red-500 text-sm">
                            <?= $validation["harga"] ?>
                        </small>
                    <?php endif ?>
                </div>
            </div>
            <div class="flex justify-end flex-1">
                <button type="submit" class="px-3 py-2 bg-emerald-500 text-white rounded-md">Simpan</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</body>

</html>
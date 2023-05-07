<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <link rel="stylesheet" href="<?= base_url("css/main.css") ?>">
</head>

<body>
    <div class="w-full h-screen overflow-hidden flex items-center justify-center"
        style="background-image: url('<?= base_url("image/bg-4.jpg") ?>'); background-position: top;">
        <div class="flex items-center w-full h-[450px] max-w-md rounded-2xl shadow-md overflow-clip bg-white">
            <div class="flex-1 h-full flex flex-col justify-center max-w-xs mx-auto">
                <div class="w-full flex justify-center">
                    <h1 class="font-bold text-2xl text-zinc-950 mb-5 pb-2 border-b-4 border-emerald-500">Daftar</h1>
                </div>
                <form action="<?= base_url("register") ?>" method="post">
                    <!-- username -->
                    <input type="text" name="username" id="username"
                        class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500"
                        placeholder="Username" value="<?= isset($username) ? $username : "" ?>" required>
                    <?php if (isset($validation["username"])): ?>
                    <small class="text-red-500 text-sm">
                        <?= $validation["username"] ?>
                    </small>
                    <?php endif ?>

                    <!-- nama -->
                    <input type="text" name="nama" id="nama"
                        class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500"
                        placeholder="Nama" value="<?= isset($nama) ? $nama : "" ?>" required>
                    <?php if (isset($validation["nama"])): ?>
                    <small class="text-red-500 text-sm">
                        <?= $validation["nama"] ?>
                    </small>
                    <?php endif ?>

                    <!-- no telp -->
                    <input type="text" name="telp" id="telp"
                        class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500"
                        placeholder="No Telp" inputmode="numeric" value="<?= isset($telp) ? $telp : "" ?>" required>
                    <?php if (isset($validation["telp"])): ?>
                    <small class="text-red-500 text-sm">
                        <?= $validation["telp"] ?>
                    </small>
                    <?php endif ?>

                    <!-- password -->
                    <input type="password" name="password" id="password"
                        class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500"
                        placeholder="Password" required>

                    <button type="submit"
                        class="uppercase font-medium w-full p-3 mt-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full shadow-md">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
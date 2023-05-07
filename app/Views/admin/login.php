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
        style="background-image: url('<?= base_url("image/bg-4.jpg") ?>');  background-position: left;">
        <div class="flex items-center w-full h-[450px] max-w-3xl rounded-2xl shadow-md overflow-clip bg-white">
            <div class="basis-1/2 w-full h-full flex items-center justify-center bg-cyan-400">
                <div class="w-full max-w-xs">
                    <div class="w-full flex items-center">
                        <h1 class="text-zinc-950 font-bold text-2xl border-b-4 border-yellow-400 pb-2">Selamat datang
                        </h1>
                    </div>
                    <p class="text-zinc-950 text-justify text-sm my-8">Nikmati berbagai menu spesial dari restaurant
                        kami
                        dengan
                        masuk
                        ke akun Anda. Belum punya akun?
                        Daftar sekarang juga!</p>
                    <div class="flex-1 mt-2">
                        <a href="<?= base_url("register") ?>"
                            class="px-5 py-2 rounded-full bg-transparent border border-white-500 text-zinc-950 hover:bg-yellow-400">Register</a>
                    </div>
                </div>

            </div>
            <div class="flex-1 h-full flex items-center justify-center">
                <div class="w-full max-w-xs">
                    <div class="w-full flex justify-center">
                        <h1 class="font-bold text-2xl text-zinc-950 mb-5 pb-2 border-b-4 border-cyan-400">Masuk</h1>
                    </div>
                    <form action="<?= base_url("login") ?>" method="post">
                        <div class="flex-1">
                        </div>
                        <!-- username -->
                        <input type="text" name="username" id="username"
                            class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500"
                            placeholder="Username" value="<?= isset($username) ? $username : "" ?>" required>
                        <?php if (isset($validation["username"])): ?>
                            <small class="text-red-500 text-sm">
                                <?= $validation["username"] ?>
                            </small>
                        <?php endif ?>

                        <!-- password -->
                        <input type="password" name="password" id="password"
                            class="flex-1 w-full px-3 py-2 mb-3 focus:outline-transparent border-b-2 transition-colors border-zinc-300 focus:border-emerald-500"
                            value="<?= isset($password) ? $password : "" ?>" placeholder="password" required>
                        <button type="submit"
                            class="uppercase font-medium w-full p-3 mt-3 bg-cyan-400 hover:bg-blue-500 text-white rounded-full shadow-md">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<aside class="w-60 m-3">
    <div class="w-full rounded-md shadow-md px-3 py-2 mb-3 border border-emerald-500">
        <h2 class="font-bold text-lg">
            <?= session()->get("nama") ?>
        </h2>
        <form action="<?= base_url("logout") ?>" method="post">
            <button type="submit" class="border-none outline-none bg-transparent text-emerald-500">Logout</button>
        </form>
    </div>
    <a href="<?= base_url("admin/menu") ?>"
        class="flex items-center px-3 py-2 mb-3 rounded-md shadow-md <?= $active == "menu" ? "bg-emerald-500 text-white" : "hover:bg-slate-100" ?>">
        Menu
    </a>
    <a href="<?= base_url("admin/transaksi") ?>"
        class="flex items-center px-3 py-2 mb-3 rounded-md shadow-md <?= $active == "transaksi" ? "bg-emerald-500 text-white" : "hover:bg-slate-100" ?>">
        Transaksi
    </a>
</aside>
<!-- ADMIN CRUD -->
 
<div class="w-full bg-gray-50 border-b">
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4 font-general">Admin: Kelola Paket</h2>

        <?php if ($successMsg): ?>
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm"><?php e($successMsg); ?></div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm">
                <ul class="list-disc pl-5">
                    <?php foreach ($errors as $err): ?>
                        <li><?php e($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-4 rounded-xl shadow-sm">
            <input type="hidden" name="action" value="<?php echo $editData ? "update" : "create"; ?>">
            <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?php e($editData["id"]); ?>">
            <?php endif; ?>

            <div>
                <label class="text-sm text-gray-700">Nama Paket</label>
                <input type="text" name="nama_paket" value="<?php e($editData["nama_paket"] ?? ""); ?>" class="w-full mt-1 p-2 border rounded-lg" placeholder="Bali Paradise Escape">
            </div>
            <div>
                <label class="text-sm text-gray-700">Durasi</label>
                <input type="text" name="durasi" value="<?php e($editData["durasi"] ?? ""); ?>" class="w-full mt-1 p-2 border rounded-lg" placeholder="5 Hari 4 Malam">
            </div>
            <div>
                <label class="text-sm text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" value="<?php e($editData["lokasi"] ?? ""); ?>" class="w-full mt-1 p-2 border rounded-lg" placeholder="Bali, Indonesia">
            </div>
            <div>
                <label class="text-sm text-gray-700">Harga (angka)</label>
                <input type="number" name="harga" value="<?php e($editData["harga"] ?? ""); ?>" class="w-full mt-1 p-2 border rounded-lg" placeholder="4500000">
            </div>
            <div>
                <label class="text-sm text-gray-700">URL Gambar</label>
                <input type="text" name="gambar" value="<?php e($editData["gambar"] ?? ""); ?>" class="w-full mt-1 p-2 border rounded-lg" placeholder="https://...">
            </div>
            <div>
                <label class="text-sm text-gray-700">Label (Opsional)</label>
                <input type="text" name="label" value="<?php e($editData["label"] ?? ""); ?>" class="w-full mt-1 p-2 border rounded-lg" placeholder="Promo / Hot Deal">
            </div>
            <div>
                <label class="text-sm text-gray-700">Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" value="<?php e($editData["rating"] ?? 5); ?>" class="w-full mt-1 p-2 border rounded-lg">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded-lg">
                    <?php echo $editData ? "Update" : "Tambah"; ?>
                </button>
                <?php if ($editData): ?>
                    <a href="paket.php" class="w-full text-center border py-2 rounded-lg">Batal</a>
                <?php endif; ?>
            </div>
        </form>

        <div class="mt-6 bg-white rounded-xl shadow-sm overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3">Nama</th>
                        <th class="text-left p-3">Durasi</th>
                        <th class="text-left p-3">Lokasi</th>
                        <th class="text-left p-3">Harga</th>
                        <th class="text-left p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$paketList): ?>
                        <tr><td colspan="5" class="p-3 text-gray-500">Belum ada data.</td></tr>
                    <?php else: ?>
                        <?php foreach ($paketList as $p): ?>
                            <tr class="border-t">
                                <td class="p-3"><?php e($p["nama_paket"]); ?></td>
                                <td class="p-3"><?php e($p["durasi"]); ?></td>
                                <td class="p-3"><?php e($p["lokasi"]); ?></td>
                                <td class="p-3">Rp <?php echo number_format((int)$p["harga"], 0, ",", "."); ?></td>
                                <td class="p-3 flex gap-2">
                                    <a href="?action=edit&id=<?php e($p["id"]); ?>" class="text-blue-600">Edit</a>
                                    <a href="?action=delete&id=<?php e($p["id"]); ?>" class="text-red-600" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

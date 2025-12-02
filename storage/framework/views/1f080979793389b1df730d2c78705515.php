<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; }
        h1 { font-size: 18px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cccccc; padding: 6px 8px; }
        th { background-color: #f3f4f6; text-align: left; }
    </style>
</head>
<body>
<h1>Laporan Transaksi</h1>
<p>Dicetak pada: <?php echo e(now()->format('d/m/Y H:i')); ?></p>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Produk</th>
        <th>Total Qty</th>
        <th>Diskon</th>
        <th>Total</th>
        <th>Metode</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>#<?php echo e($t->id); ?></td>
            <td><?php echo e($t->created_at?->format('d/m/Y H:i')); ?></td>
            <td>
                <?php $__currentLoopData = $t->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div><?php echo e($item->product->name ?? 'N/A'); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td><?php echo e($t->total_qty); ?></td>
            <td><?php echo e($t->discount > 0 ? 'Rp ' . number_format($t->discount, 0, ',', '.') : '-'); ?></td>
            <td>Rp <?php echo e(number_format($t->total_price, 0, ',', '.')); ?></td>
            <td><?php echo e($t->payment_method === 'ewallet' ? 'Qris' : ucfirst($t->payment_method)); ?></td>
            <td><?php echo e($t->payment_status); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</body>
</html>
<?php /**PATH C:\laragon\www\thrif\resources\views/exports/transactions-pdf.blade.php ENDPATH**/ ?>
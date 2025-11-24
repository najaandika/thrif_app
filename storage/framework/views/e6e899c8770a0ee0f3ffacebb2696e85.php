<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Orders</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; }
        h1 { font-size: 18px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cccccc; padding: 6px 8px; }
        th { background-color: #f3f4f6; text-align: left; }
    </style>
</head>
<body>
<h1>Laporan Orders</h1>
<p>Dicetak pada: <?php echo e(now()->format('d/m/Y H:i')); ?></p>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Pembeli</th>
        <th>Kontak</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Status</th>
        <th>Update</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>#<?php echo e(str_pad($order->id, 4, '0', STR_PAD_LEFT)); ?></td>
            <td><?php echo e($order->product->name ?? '-'); ?></td>
            <td><?php echo e($order->buyer_name); ?></td>
            <td><?php echo e($order->buyer_contact ?: '-'); ?></td>
            <td><?php echo e($order->quantity); ?></td>
            <td>Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
            <td><?php echo e(ucfirst($order->status)); ?></td>
            <td><?php echo e($order->updated_at?->format('d/m/Y H:i')); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</body>
</html>
<?php /**PATH C:\laragon\www\thrif\resources\views/exports/orders-pdf.blade.php ENDPATH**/ ?>
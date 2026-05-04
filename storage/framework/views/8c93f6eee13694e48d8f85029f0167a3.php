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
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
<h1>Laporan Orders</h1>
<p>Dicetak pada: <?php echo e(now()->format('d/m/Y H:i')); ?></p>
<table>
    <thead>
    <tr>
        <th class="text-center">No. Invoice</th>
        <th>Produk</th>
        <th>Pembeli</th>
        <th>Kontak</th>
        <th class="text-center">Qty</th>
        <th class="text-right">Total</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center"><?php echo e($order->invoice_number); ?></td>
            <td>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>- <?php echo e($item->product->name ?? '-'); ?> (x<?php echo e($item->quantity); ?>)</div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td><?php echo e($order->buyer_name); ?></td>
            <td><?php echo e($order->buyer_contact ?: '-'); ?></td>
            <td class="text-center"><?php echo e($order->items->sum('quantity')); ?></td>
            <td class="text-right"><?php echo e(rupiah($order->total_price)); ?></td>
            <td><?php echo e(ucfirst($order->status)); ?></td>
            <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</body>
</html>
<?php /**PATH C:\laragon\www\thrif\resources\views\exports\orders-pdf.blade.php ENDPATH**/ ?>
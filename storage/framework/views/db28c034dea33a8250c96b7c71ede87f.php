<script>
    document.addEventListener('alpine:init', () => {
        <?php $ord = $selectedOrder ?? $order ?? null; ?>
        Alpine.data('receiptModal', () => ({
            downloading: false,

            downloadReceipt() {
                this.downloading = true;
                const element = document.getElementById('receipt-content');
                
                if (typeof html2canvas === 'undefined') {
                    alert('Error: Library html2canvas not loaded.');
                    this.downloading = false;
                    return;
                }

                html2canvas(element, {
                    scale: 2, 
                    backgroundColor: '#ffffff',
                    useCORS: true 
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'Receipt-' + '<?php echo e($ord->invoice_number ?? "INV"); ?>' + '.jpg';
                    link.href = canvas.toDataURL('image/jpeg', 0.9);
                    link.click();
                    this.downloading = false;
                }).catch(err => {
                    console.error(err);
                    alert('Gagal mendownload struk.');
                    this.downloading = false;
                });
            },

            printReceipt() {
                const content = document.getElementById('receipt-content').innerHTML;
                const win = window.open('', '', 'height=700,width=400');
                win.document.write('<html><head><title>Cetak Struk</title>');
                win.document.write('<style>');
                win.document.write('body { font-family: monospace; font-size: 12px; margin: 0; padding: 10px; color: #000; }');
                win.document.write('.text-center { text-align: center; }');
                win.document.write('.flex { display: flex; }');
                win.document.write('.justify-between { justify-content: space-between; }');
                win.document.write('.text-right { text-align: right; }');
                win.document.write('.font-bold { font-weight: bold; }');
                win.document.write('.border-b-2 { border-bottom: 1px dashed #000; margin: 10px 0; }');
                win.document.write('.mb-6 { margin-bottom: 15px; }');
                win.document.write('.mb-4 { margin-bottom: 10px; }');
                win.document.write('.mb-2 { margin-bottom: 5px; }');
                win.document.write('.mb-1 { margin-bottom: 2px; }');
                win.document.write('.mt-1 { margin-top: 2px; }');
                win.document.write('.mt-8 { margin-top: 20px; }');
                win.document.write('.space-y-3 > * + * { margin-top: 0.75rem; }');
                win.document.write('.space-y-1 > * + * { margin-top: 0.25rem; }');
                win.document.write('.pt-1 { padding-top: 2px; }');
                win.document.write('.pt-2 { padding-top: 4px; }');
                win.document.write('.text-xs { font-size: 10px; }');
                win.document.write('.text-sm { font-size: 12px; }');
                win.document.write('.text-xl { font-size: 16px; }');
                win.document.write('img { max-height: 50px; display: block; margin: 0 auto; filter: grayscale(100%); }'); 
                win.document.write('</style>');
                win.document.write('</head><body>');
                win.document.write(content);
                win.document.write('</body></html>');
                win.document.close();
                win.focus();
                setTimeout(() => { win.print(); win.close(); }, 500);
            },

            shareToWa() {
                const phone = '<?php echo e($ord->buyer_contact ?? ""); ?>';
                let finalPhone = phone.replace(/\D/g, '');
                if (finalPhone.startsWith('0')) { finalPhone = '62' + finalPhone.substring(1); }
                
                let items = '';
                <?php if($ord): ?>
                    <?php $__currentLoopData = $ord->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    items += '• <?php echo e(addslashes($item->product->name ?? "Item")); ?> (x<?php echo e($item->quantity); ?>)\n';
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                let message = '*STRUK DIGITAL - <?php echo e(strtoupper(\App\Models\Setting::get("shop_name") ?? "THRIF STUDIO")); ?>*\n';
                message += '--------------------------------\n';
                message += 'No. Invoice: <?php echo e($ord->invoice_number ?? "-"); ?>\n';
                message += 'Tanggal: <?php echo e(optional($ord->created_at)->format("d/m/Y H:i") ?? "-"); ?>\n\n';
                message += '*Detail Belanja:*\n';
                message += items;

                <!--[if BLOCK]><![endif]--><?php if(($ord->discount ?? 0) > 0): ?>
                message += '\nDiskon: - Rp <?php echo e(number_format($ord->discount, 0, ",", ".")); ?>';
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                message += '\n--------------------------------\n';
                message += '*TOTAL: Rp <?php echo e(number_format($ord->total_price ?? 0, 0, ",", ".")); ?>*\n';
                message += '--------------------------------\n';
                message += 'Terima kasih sudah berbelanja!';

                const url = `https://wa.me/${finalPhone}?text=${encodeURIComponent(message)}`;
                window.open(url, '_blank');
            }
        }))
    })
</script>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/orders/_modal_scripts.blade.php ENDPATH**/ ?>
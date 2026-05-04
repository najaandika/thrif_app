<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize';
    protected $description = 'Optimize existing product and logo images for better performance';

    public function handle()
    {
        $manager = new ImageManager(new Driver());
        $disk = Storage::disk('public');

        // Optimize product images
        $this->info('Optimizing product images...');
        $productFiles = $disk->files('products');
        $optimized = 0;

        foreach ($productFiles as $file) {
            if (!str_ends_with($file, '.webp') && !str_ends_with($file, '.jpg') && !str_ends_with($file, '.png')) {
                continue;
            }

            $path = $disk->path($file);
            $size = filesize($path);

            // Skip if already small (under 50KB)
            if ($size < 50000) {
                $this->line("  Skip (already small): {$file}");
                continue;
            }

            try {
                $img = $manager->read($path);
                $img->scaleDown(width: 480);
                $encoded = $img->toWebp(75);

                // Save as webp (replace original)
                $newPath = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.webp', $file);
                $disk->put($newPath, (string) $encoded);

                // Delete original if different extension
                if ($newPath !== $file) {
                    $disk->delete($file);
                }

                $newSize = $disk->size($newPath);
                $saved = round(($size - $newSize) / 1024);
                $this->info("  ✓ {$file} → saved {$saved}KB");
                $optimized++;
            } catch (\Exception $e) {
                $this->error("  ✗ {$file}: {$e->getMessage()}");
            }
        }

        // Optimize logo images
        $this->info('Optimizing logo images...');
        $logoFiles = $disk->files('logos');

        foreach ($logoFiles as $file) {
            $path = $disk->path($file);
            
            try {
                $img = $manager->read($path);
                $img->scaleDown(width: 96); // Logo only needs 96px (3x retina of 32px)
                $encoded = $img->toWebp(80);

                $newPath = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.webp', $file);
                $disk->put($newPath, (string) $encoded);

                if ($newPath !== $file) {
                    $disk->delete($file);
                }

                $this->info("  ✓ {$file} optimized");
                $optimized++;
            } catch (\Exception $e) {
                $this->error("  ✗ {$file}: {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info("Done! Optimized {$optimized} images.");
    }
}

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title inertia><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Favicon -->
        <?php
            $faviconSetting = \Illuminate\Support\Facades\Cache::remember('favicon_setting', 3600, function() {
                return \App\Models\Setting::where('key', 'favicon')->first();
            });
            $faviconUrl = $faviconSetting && $faviconSetting->value 
                ? asset('storage/' . $faviconSetting->value) 
                : asset('favicon.ico');
        ?>
        <link rel="icon" type="image/x-icon" href="<?php echo e($faviconUrl); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e($faviconUrl); ?>">
        <link rel="apple-touch-icon" href="<?php echo e($faviconUrl); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e($faviconUrl); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($faviconUrl); ?>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Tighten\Ziggy\BladeRouteGenerator')->generate(); ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"]); ?>
        <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->head; } ?>
    </head>
    <body class="font-sans antialiased">
        <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
    </body>
</html>
<?php /**PATH G:\xampp\htdocs\online-tools\resources\views/app.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- <title><?php echo e(config('app.name', 'Laravel')); ?></title> -->

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <style>
      #menu-toggle:checked + #menu {
        display: block;
      }
    </style>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
        <?php echo e(app('laravel-splade-seo')->renderHead()); ?>

 <!-- AlpineJS -->
 <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
        <div id="app" data-components="<?php echo e(json_encode($components)); ?>" data-html="<?php echo e(json_encode($html)); ?>" data-dynamics="<?php echo e(json_encode($dynamics)); ?>" data-splade="<?php echo e(json_encode($splade)); ?>">
<?php echo $ssrBody; ?>

</div>



    </body>
</html>
<?php /**PATH C:\Users\Dev\Desktop\Project\cbo ingenzi\ingenzi\resources\views/root.blade.php ENDPATH**/ ?>
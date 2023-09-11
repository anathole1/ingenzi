<span class="block mb-1 text-gray-700 font-sans">
    <?php echo $label; ?>

    <?php if($attributes->has('required') || $attributes->has('data-required')): ?>
        <span aria-hidden="true" class="text-red-600" title="<?php echo e(__('This field is required')); ?>">*</span>
    <?php endif; ?>
</span>
<?php /**PATH C:\Users\Dev\Desktop\Project\cbo ingenzi\ingenzi\resources\views/vendor/splade/form/label.blade.php ENDPATH**/ ?>
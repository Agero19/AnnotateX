<body>
    <div class="main-container">
        <?php require 'header.php'; ?>
        <?php if ($name == 'Home'):
            require 'grid.php'; ?>
        <?php endif; ?>
    </div>
    <?php require 'footer.php'; ?>
</body>
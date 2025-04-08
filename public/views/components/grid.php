<main class="pt-5 mt-3">
    <div class="container">
        <div class="filters">Filters</div>

        <ul class="grid-container list-unstyled">
            <?php if (!empty($images)): ?>
                <?php foreach ($images as $image): ?>
                    <?php if ((int) $image['visibility'] === 1): ?>
                        <li class="grid-item">
                            <a href="#" class="img-wrap">
                                <!-- Adjust the path if needed -->
                                <img src="<?= $image['file_path'] ?>" alt="<?= htmlspecialchars($image['title']) ?>">
                                <div class="title"><?= htmlspecialchars($image['title']) ?></div>
                            </a>
                            <div class="info-wrap">
                                <div class="author-name">User ID: <?= $image['user_id'] ?></div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No images found.</li>
            <?php endif; ?>
        </ul>
    </div>
</main>
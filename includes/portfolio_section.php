<?php

require_once __DIR__ . '/../config/database.php';

$projects = $pdo->query(
    'SELECT p.*, c.name AS category_name
     FROM projects p
     LEFT JOIN categories c ON c.id = p.category_id
     ORDER BY p.created_at DESC'
)->fetchAll();

?>

<!-- Selected Work Section -->
<section class="work-section text-center text-white" id="portfolio">

    <div class="container">

        <div class="work-header">
            <h2 class="work-title">Selected Work</h2>
            <p class="work-subtext">
                A closer look at a few projects and the impact they made
            </p>
        </div>

        <?php if (!$projects): ?>

            <p class="work-description">
                No projects available yet.
            </p>

        <?php else: ?>

            <?php foreach ($projects as $index => $project): ?>

                <div class="row align-items-center text-start work-item">

                    <?php if ($index % 2 === 0): ?>

                        <!-- Image Left -->
                        <div class="col-lg-6 col-md-12">
                            <div class="work-image-wrapper">

                                <?php if (!empty($project['image_path'])): ?>

                                    <img
                                        src="<?= htmlspecialchars($project['image_path'], ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>"
                                        class="work-image">

                                <?php endif; ?>

                            </div>
                        </div>

                        <!-- Details Right -->
                        <div class="col-lg-6 col-md-12">

                            <span class="work-meta">
                                <?= htmlspecialchars($project['category_name'] ?? 'PROJECT', ENT_QUOTES, 'UTF-8') ?>

                                <?php if (!empty($project['year'])): ?>
                                    · <?= htmlspecialchars($project['year'], ENT_QUOTES, 'UTF-8') ?>
                                <?php endif; ?>
                            </span>

                            <h3 class="work-project-title">
                                <?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>
                            </h3>

                            <p class="work-description">
                                <?= htmlspecialchars($project['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </p>

                            <?php if (!empty($project['project_link'])): ?>

                                <a
                                    href="<?= htmlspecialchars($project['project_link'], ENT_QUOTES, 'UTF-8') ?>"
                                    class="work-link"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    View case study
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            <?php endif; ?>

                        </div>

                    <?php else: ?>

                        <!-- Details Left -->
                        <div class="col-lg-6 col-md-12 order-lg-1">

                            <span class="work-meta">
                                <?= htmlspecialchars($project['category_name'] ?? 'PROJECT', ENT_QUOTES, 'UTF-8') ?>

                                <?php if (!empty($project['year'])): ?>
                                    · <?= htmlspecialchars($project['year'], ENT_QUOTES, 'UTF-8') ?>
                                <?php endif; ?>
                            </span>

                            <h3 class="work-project-title">
                                <?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>
                            </h3>

                            <p class="work-description">
                                <?= htmlspecialchars($project['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </p>

                            <?php if (!empty($project['project_link'])): ?>

                                <a
                                    href="<?= htmlspecialchars($project['project_link'], ENT_QUOTES, 'UTF-8') ?>"
                                    class="work-link"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    View case study
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            <?php endif; ?>

                        </div>

                        <!-- Image Right -->
                        <div class="col-lg-6 col-md-12 order-lg-2">
                            <div class="work-image-wrapper">

                                <?php if (!empty($project['image_path'])): ?>

                                    <img
                                        src="<?= htmlspecialchars($project['image_path'], ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') ?>"
                                        class="work-image">

                                <?php endif; ?>

                            </div>
                        </div>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</section>
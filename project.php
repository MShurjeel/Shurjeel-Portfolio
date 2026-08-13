<?php

require_once __DIR__ . '/admin/config/config.php';


$id = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;


if ($id <= 0) {

    header('Location: index.php');

    exit;
}


$stmt = $pdo->prepare(
    'SELECT
        p.*,
        c.name AS category_name
     FROM projects p
     LEFT JOIN categories c
        ON c.id = p.category_id
     WHERE p.id = ?
     LIMIT 1'
);

$stmt->execute([$id]);

$project = $stmt->fetch();


if (!$project) {

    header('Location: index.php');

    exit;
}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= htmlspecialchars($project['title']) ?>
    </title>

    <link
        rel="stylesheet"
        href="assets/bootstrap/css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

    <link
        rel="stylesheet"
        href="assets/icons/bootstrap-icons.css"
    >

</head>


<body>


<section class="work-section text-white">

    <div class="container">

        <div class="work-header">

            <a
                href="index.php#portfolio"
                class="work-link"
            >
                <i class="bi bi-arrow-left"></i>
                Back to Projects
            </a>

            <h1 class="work-title mt-4">

                <?= htmlspecialchars(
                    $project['title'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>

            </h1>


            <p class="work-meta">

                <?= htmlspecialchars(
                    $project['category_name'] ?? 'PROJECT',
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>

                <?php if (!empty($project['year'])): ?>

                    ·

                    <?= htmlspecialchars(
                        $project['year'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                <?php endif; ?>

            </p>

        </div>


        <?php if (!empty($project['image_path'])): ?>

            <div class="work-image-wrapper mb-5">

                <img
                    src="<?= htmlspecialchars(
                        $project['image_path'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    alt="<?= htmlspecialchars(
                        $project['title'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    class="work-image"
                >

            </div>

        <?php endif; ?>


        <div class="row justify-content-center">

            <div class="col-lg-8">

                <p class="work-description">

                    <?= nl2br(
                        htmlspecialchars(
                            $project['description'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    ) ?>

                </p>


                <?php if (!empty($project['project_link'])): ?>

                    <a
                        href="<?= htmlspecialchars(
                            $project['project_link'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                        class="work-link"
                        target="_blank"
                        rel="noopener noreferrer"
                    >

                        Visit Live Project

                        <i class="bi bi-arrow-right"></i>

                    </a>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>


</body>

</html>
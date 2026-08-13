<?php

require_once __DIR__ . '/includes/auth.php';
requireLogin();

$activeNav = 'projects';
$errors = [];

$editId = isset($_GET['id']) ? (int) $_GET['id'] : null;
$isEdit = $editId !== null;

$project = [
    'title'        => '',
    'category_id'  => '',
    'year'         => '',
    'description'  => '',
    'image_path'   => '',
    'project_link' => '',
];

if ($isEdit) {

    $stmt = $pdo->prepare(
        'SELECT * FROM projects WHERE id = ? LIMIT 1'
    );

    $stmt->execute([$editId]);

    $found = $stmt->fetch();

    if (!$found) {

        setFlash('error', 'Project not found.');

        header('Location: dashboard.php');

        exit;
    }

    $project = $found;
}


/*
|--------------------------------------------------------------------------
| Get Categories
|--------------------------------------------------------------------------
*/

$categories = $pdo->query(
    'SELECT id, name FROM categories ORDER BY name'
)->fetchAll();


/*
|--------------------------------------------------------------------------
| Form Submit
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!verifyCsrf()) {

        $errors[] = 'Your session expired. Please try again.';
    }

    $title = trim($_POST['title'] ?? '');

    $categoryId = !empty($_POST['category_id'])
        ? (int) $_POST['category_id']
        : null;

    $newCategory = trim($_POST['new_category'] ?? '');

    $year = trim($_POST['year'] ?? '');

    $description = trim($_POST['description'] ?? '');

    $projectLink = trim($_POST['project_link'] ?? '');


    /*
    |--------------------------------------------------------------------------
    | Existing image
    |--------------------------------------------------------------------------
    */

    $imagePath = $project['image_path'] ?? '';


    /*
    |--------------------------------------------------------------------------
    | Basic Validation
    |--------------------------------------------------------------------------
    */

    if ($title === '') {

        $errors[] = 'Project title is required.';
    }


    if ($year !== '' && !preg_match('/^\d{4}$/', $year)) {

        $errors[] = 'Year must be a 4-digit number, e.g. 2024.';
    }


    if (
        $projectLink !== '' &&
        !filter_var($projectLink, FILTER_VALIDATE_URL)
    ) {

        $errors[] = 'Project link must be a valid URL.';
    }


    /*
    |--------------------------------------------------------------------------
    | New Category
    |--------------------------------------------------------------------------
    */

    if ($newCategory !== '') {

        $stmt = $pdo->prepare(
            'SELECT id FROM categories WHERE name = ? LIMIT 1'
        );

        $stmt->execute([$newCategory]);

        $existingCategory = $stmt->fetch();

        if ($existingCategory) {

            $categoryId = (int) $existingCategory['id'];

        } else {

            $stmt = $pdo->prepare(
                'INSERT INTO categories (name) VALUES (?)'
            );

            $stmt->execute([$newCategory]);

            $categoryId = (int) $pdo->lastInsertId();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Image Upload
    |--------------------------------------------------------------------------
    */

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
    ) {

        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {

            $errors[] = 'There was a problem uploading the image.';

        } else {

            $file = $_FILES['image'];

            $allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp',
                'image/gif'
            ];

            $maxSize = 5 * 1024 * 1024; // 5 MB


            /*
            | Check file size
            */

            if ($file['size'] > $maxSize) {

                $errors[] = 'Image must be smaller than 5 MB.';
            }


            /*
            | Check MIME type
            */

            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            $mimeType = finfo_file(
                $finfo,
                $file['tmp_name']
            );

            finfo_close($finfo);


            if (!in_array($mimeType, $allowedTypes, true)) {

                $errors[] = 'Only JPG, PNG, WEBP and GIF images are allowed.';
            }


            /*
            | Save image
            */

            if (empty($errors)) {

                $extensionMap = [
                    'image/jpeg' => 'jpg',
                    'image/png'  => 'png',
                    'image/webp' => 'webp',
                    'image/gif'  => 'gif'
                ];

                $extension = $extensionMap[$mimeType];

                $filename =
                    'project_' .
                    time() .
                    '_' .
                    bin2hex(random_bytes(5)) .
                    '.' .
                    $extension;


                /*
                | Physical folder
                */

                $uploadDirectory =
                    dirname(__DIR__) .
                    '/assets/images/portfolio-images/';


                /*
                | Create folder if it doesn't exist
                */

                if (!is_dir($uploadDirectory)) {

                    mkdir(
                        $uploadDirectory,
                        0755,
                        true
                    );
                }


                $destination =
                    $uploadDirectory .
                    $filename;


                if (move_uploaded_file(
                    $file['tmp_name'],
                    $destination
                )) {

                    /*
                    | Path saved in database
                    */

                    $imagePath =
                        'assets/images/portfolio-images/' .
                        $filename;

                } else {

                    $errors[] =
                        'Could not save the uploaded image.';
                }
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Save Project
    |--------------------------------------------------------------------------
    */

    if (empty($errors)) {

        if ($isEdit) {

            $stmt = $pdo->prepare(
                'UPDATE projects
                 SET title = ?,
                     category_id = ?,
                     year = ?,
                     description = ?,
                     image_path = ?,
                     project_link = ?
                 WHERE id = ?'
            );

            $stmt->execute([
                $title,
                $categoryId,
                $year ?: null,
                $description,
                $imagePath ?: null,
                $projectLink ?: null,
                $editId
            ]);

            setFlash(
                'success',
                'Project updated.'
            );

        } else {

            $stmt = $pdo->prepare(
                'INSERT INTO projects
                (
                    title,
                    category_id,
                    year,
                    description,
                    image_path,
                    project_link,
                    created_by
                )
                VALUES (?, ?, ?, ?, ?, ?, ?)'
            );

            $stmt->execute([
                $title,
                $categoryId,
                $year ?: null,
                $description,
                $imagePath ?: null,
                $projectLink ?: null,
                $_SESSION['admin_id']
            ]);

            setFlash(
                'success',
                'Project created.'
            );
        }

        header('Location: dashboard.php');

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Re-render form after error
    |--------------------------------------------------------------------------
    */

    $project = [
        'title'        => $title,
        'category_id'  => $categoryId,
        'year'         => $year,
        'description'  => $description,
        'image_path'   => $imagePath,
        'project_link' => $projectLink,
    ];
}


$pageTitle = $isEdit
    ? 'Edit Project'
    : 'Add New Project';


require __DIR__ . '/includes/dash_header.php';

?>


<div class="panel-card panel-card-narrow">

    <div class="panel-header">

        <h2 class="panel-title">

            <?= $isEdit
                ? 'Edit Project'
                : 'Add New Project'
            ?>

        </h2>

        <a
            href="dashboard.php"
            class="auth-link-small"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Projects
        </a>

    </div>


    <?php if ($errors): ?>

        <div class="admin-alert alert-error">

            <?php foreach ($errors as $err): ?>

                <div>
                    <?= e($err) ?>
                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>


    <form
        method="POST"
        action="project_form.php<?= $isEdit ? '?id=' . $editId : '' ?>"
        enctype="multipart/form-data"
        novalidate
    >

        <?= csrfField() ?>


        <!-- TITLE -->

        <div class="mb-3">

            <label class="auth-label">
                Title
            </label>

            <input
                type="text"
                name="title"
                class="form-control auth-input"
                value="<?= e($project['title']) ?>"
                required
            >

        </div>


        <!-- CATEGORY -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="auth-label">
                    Category
                </label>

                <select
                    name="category_id"
                    class="form-control auth-input"
                >

                    <option value="">
                        — None —
                    </option>

                    <?php foreach ($categories as $cat): ?>

                        <option
                            value="<?= (int) $cat['id'] ?>"
                            <?= (int) $project['category_id']
                                === (int) $cat['id']
                                ? 'selected'
                                : ''
                            ?>
                        >

                            <?= e($cat['name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- NEW CATEGORY -->

            <div class="col-md-6 mb-3">

                <label class="auth-label">
                    Or Add New Category
                </label>

                <input
                    type="text"
                    name="new_category"
                    class="form-control auth-input"
                    placeholder="e.g. E-commerce"
                >

            </div>

        </div>


        <!-- YEAR -->

        <div class="mb-3">

            <label class="auth-label">
                Year
            </label>

            <input
                type="text"
                name="year"
                class="form-control auth-input"
                placeholder="2026"
                value="<?= e((string) $project['year']) ?>"
            >

        </div>


        <!-- IMAGE -->

        <div class="mb-3">

            <label class="auth-label">
                Project Image
            </label>

            <input
                type="file"
                name="image"
                class="form-control auth-input"
                accept=".jpg,.jpeg,.png,.webp,.gif"
            >

            <small class="text-muted">
                JPG, PNG, WEBP or GIF — maximum 5 MB.
            </small>

            <?php if (!empty($project['image_path'])): ?>

                <div class="mt-3">

                    <p class="text-muted mb-2">
                        Current Image:
                    </p>

                    <img
                        src="../<?= e($project['image_path']) ?>"
                        alt=""
                        style="max-width: 180px; border-radius: 10px;"
                    >

                </div>

            <?php endif; ?>

        </div>


        <!-- PROJECT LINK -->

        <div class="mb-3">

            <label class="auth-label">
                Project Link
            </label>

            <input
                type="url"
                name="project_link"
                class="form-control auth-input"
                placeholder="https://example.com"
                value="<?= e($project['project_link']) ?>"
            >

        </div>


        <!-- DESCRIPTION -->

        <div class="mb-4">

            <label class="auth-label">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="form-control auth-input"
            ><?= e($project['description']) ?></textarea>

        </div>


        <button
            type="submit"
            class="btn admin-btn-primary"
        >

            <?= $isEdit
                ? 'Save Changes'
                : 'Create Project'
            ?>

        </button>

    </form>

</div>


<?php require __DIR__ . '/includes/dash_footer.php'; ?>
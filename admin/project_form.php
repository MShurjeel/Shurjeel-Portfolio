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
    $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = ? LIMIT 1');
    $stmt->execute([$editId]);
    $found = $stmt->fetch();
    if (!$found) {
        setFlash('error', 'Project not found.');
        header('Location: dashboard.php');
        exit;
    }
    $project = $found;
}

$categories = $pdo->query('SELECT id, name FROM categories ORDER BY name')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        $errors[] = 'Your session expired. Please try again.';
    }

    $title       = trim($_POST['title'] ?? '');
    $categoryId  = $_POST['category_id'] !== '' ? (int) $_POST['category_id'] : null;
    $year        = trim($_POST['year'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $imagePath   = trim($_POST['image_path'] ?? '');
    $projectLink = trim($_POST['project_link'] ?? '');

    $project = [
        'title'        => $title,
        'category_id'  => $categoryId,
        'year'         => $year,
        'description'  => $description,
        'image_path'   => $imagePath,
        'project_link' => $projectLink,
    ];

    if ($title === '') {
        $errors[] = 'Project title is required.';
    }
    if ($year !== '' && !preg_match('/^\d{4}$/', $year)) {
        $errors[] = 'Year must be a 4-digit number, e.g. 2024.';
    }
    if ($projectLink !== '' && !filter_var($projectLink, FILTER_VALIDATE_URL)) {
        $errors[] = 'Project link must be a valid URL.';
    }

    if (empty($errors)) {
        if ($isEdit) {
            $stmt = $pdo->prepare(
                'UPDATE projects
                 SET title = ?, category_id = ?, year = ?, description = ?, image_path = ?, project_link = ?
                 WHERE id = ?'
            );
            $stmt->execute([$title, $categoryId, $year ?: null, $description, $imagePath ?: null, $projectLink ?: null, $editId]);
            setFlash('success', 'Project updated.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO projects (title, category_id, year, description, image_path, project_link, created_by)
                 VALUES (?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([$title, $categoryId, $year ?: null, $description, $imagePath ?: null, $projectLink ?: null, $_SESSION['admin_id']]);
            setFlash('success', 'Project created.');
        }
        header('Location: dashboard.php');
        exit;
    } else {
        // Re-normalize keys for the form re-render below.
        $project = [
            'title'        => $title,
            'category_id'  => $categoryId,
            'year'         => $year,
            'description'  => $description,
            'image_path'   => $imagePath,
            'project_link' => $projectLink,
        ];
    }
}

$pageTitle = $isEdit ? 'Edit Project' : 'Add New Project';
require __DIR__ . '/includes/dash_header.php';
?>
                <div class="panel-card panel-card-narrow">
                    <div class="panel-header">
                        <h2 class="panel-title"><?= $isEdit ? 'Edit Project' : 'Add New Project' ?></h2>
                        <a href="dashboard.php" class="auth-link-small"><i class="bi bi-arrow-left"></i> Back to Projects</a>
                    </div>

                    <?php if ($errors): ?>
                        <div class="admin-alert alert-error">
                            <?php foreach ($errors as $err): ?>
                                <div><?= e($err) ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="project_form.php<?= $isEdit ? '?id=' . $editId : '' ?>" novalidate>
                        <?= csrfField() ?>
                        <div class="mb-3">
                            <label class="auth-label">Title</label>
                            <input type="text" name="title" class="form-control auth-input"
                                   value="<?= e($project['title']) ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="auth-label">Category</label>
                                <select name="category_id" class="form-control auth-input">
                                    <option value="">— None —</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= (int) $cat['id'] ?>"
                                            <?= (int) $project['category_id'] === (int) $cat['id'] ? 'selected' : '' ?>>
                                            <?= e($cat['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="auth-label">Year</label>
                                <input type="text" name="year" class="form-control auth-input"
                                       placeholder="2024" value="<?= e((string) $project['year']) ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="auth-label">Image Path / URL</label>
                            <input type="text" name="image_path" class="form-control auth-input"
                                   placeholder="assets/images/portfolio-images/portfolio-1.webp"
                                   value="<?= e($project['image_path']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="auth-label">Project Link</label>
                            <input type="url" name="project_link" class="form-control auth-input"
                                   placeholder="https://example.com" value="<?= e($project['project_link']) ?>">
                        </div>
                        <div class="mb-4">
                            <label class="auth-label">Description</label>
                            <textarea name="description" rows="4" class="form-control auth-input"><?= e($project['description']) ?></textarea>
                        </div>
                        <button type="submit" class="btn admin-btn-primary">
                            <?= $isEdit ? 'Save Changes' : 'Create Project' ?>
                        </button>
                    </form>
                </div>
<?php require __DIR__ . '/includes/dash_footer.php'; ?>

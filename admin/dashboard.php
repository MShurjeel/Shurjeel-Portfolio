<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();

$pageTitle = 'Projects';
$activeNav = 'projects';

$stats = [
    'projects'   => (int) $pdo->query('SELECT COUNT(*) AS c FROM projects')->fetch()['c'],
    'categories' => (int) $pdo->query('SELECT COUNT(*) AS c FROM categories')->fetch()['c'],
];

$projects = $pdo->query(
    'SELECT p.id, p.title, p.year, p.image_path, p.created_at, c.name AS category_name
     FROM projects p
     LEFT JOIN categories c ON c.id = p.category_id
     ORDER BY p.created_at DESC'
)->fetchAll();

require __DIR__ . '/includes/dash_header.php';
?>
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-kanban"></i></div>
                        <div>
                            <p class="stat-number"><?= $stats['projects'] ?></p>
                            <p class="stat-label">Total Projects</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-tags"></i></div>
                        <div>
                            <p class="stat-number"><?= $stats['categories'] ?></p>
                            <p class="stat-label">Categories</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-person-check"></i></div>
                        <div>
                            <p class="stat-number">1</p>
                            <p class="stat-label">Active Admin</p>
                        </div>
                    </div>
                </div>

                <div class="panel-card">
                    <div class="panel-header">
                        <h2 class="panel-title">All Projects</h2>
                        <a href="project_form.php" class="btn admin-btn-primary">
                            <i class="bi bi-plus-lg"></i> Add New Project
                        </a>
                    </div>

                    <?php if (!$projects): ?>
                        <p class="empty-state">No projects yet. Click "Add New Project" to create your first one.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table-admin">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Year</th>
                                        <th>Added</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($projects as $p): ?>
                                        <tr>
                                            <td>
                                                <div class="project-cell">
                                                    <?php if ($p['image_path']): ?>
                                                        <img src="<?= e($p['image_path']) ?>" class="project-thumb" alt="">
                                                    <?php else: ?>
                                                        <span class="project-thumb project-thumb-empty"><i class="bi bi-image"></i></span>
                                                    <?php endif; ?>
                                                    <span><?= e($p['title']) ?></span>
                                                </div>
                                            </td>
                                            <td><?= e($p['category_name'] ?? '—') ?></td>
                                            <td><?= e($p['year'] ?? '—') ?></td>
                                            <td><?= date('M j, Y', strtotime($p['created_at'])) ?></td>
                                            <td class="text-end">
                                                <a href="project_form.php?id=<?= (int) $p['id'] ?>" class="action-icon" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="delete_project.php" method="POST" class="d-inline delete-form">
                                                    <?= csrfField() ?>
                                                    <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                                                    <button type="submit" class="action-icon action-icon-danger" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
<?php require __DIR__ . '/includes/dash_footer.php'; ?>

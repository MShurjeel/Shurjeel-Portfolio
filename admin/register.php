<?php
require_once __DIR__ . '/includes/auth.php';
redirectIfLoggedIn();

$errors = [];
$old = [
    'firstname' => '',
    'lastname'  => '',
    'email'     => '',
    'gender'    => '',
    'phone'     => '',
    'address'   => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        $errors[] = 'Your session expired. Please try again.';
    }  

    $firstName = trim($_POST['firstname'] ?? '');
    $lastName  = trim($_POST['lastname'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['confirm_password'] ?? '';
    $gender    = $_POST['gender'] ?? '';
    $phone     = trim($_POST['phone'] ?? '');
    $address   = trim($_POST['address'] ?? '');

    // Multi-select "skills[]" comes in as an array — turn it into a comma
    // separated string so it fits in one TEXT column.
    $skillsArray = $_POST['skills'] ?? [];
    $skills      = implode(',', array_map('trim', $skillsArray));

    $old = [
        'firstname' => $firstName,
        'lastname'  => $lastName,
        'email'     => $email,
        'gender'    => $gender,
        'phone'     => $phone,
        'address'   => $address,
    ];

    if ($firstName === '' || $lastName === '' || $email === '' || $password === '' || $confirm === '') {
        $errors[] = 'Please fill in all required fields.';
    }
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($password !== '' && mb_strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }
    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }
    if ($gender === '') {
        $errors[] = 'Please select a gender.';
    }

    if (empty($errors)) {
        $check = $pdo->prepare('SELECT id FROM admins WHERE email = ? LIMIT 1');
        $check->execute([$email]);
        if ($check->fetch()) {
            $errors[] = 'An account with that email already exists.';
        }
    }

    // ----- Profile image upload (optional field) -----
    $profileImagePath = null;
    if (empty($errors) && !empty($_FILES['profile_image']['name'])) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed, true)) {
            $errors[] = 'Profile image must be a JPG, PNG, or WEBP file.';
        } else {
            $uploadDir = __DIR__ . '/assets/images/profiles/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = uniqid('admin_') . '.' . $ext;
            $destination = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $destination)) {
                // stored relative to project root, used directly in <img src="">
                $profileImagePath = 'assets/images/profiles/' . $fileName;
            } else {
                $errors[] = 'Failed to upload profile image. Please try again.';
            }
        }
    }

    if (empty($errors)) {
        $fullName = $firstName . ' ' . $lastName;
        $hash = hashPassword($password);

        $insert = $pdo->prepare(
            'INSERT INTO admins
                (full_name, firstname, lastname, email, password_hash, gender, phone, skills, address, profile_image)
             VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $insert->execute([
            $fullName,
            $firstName,
            $lastName,
            $email,
            $hash,
            $gender,
            $phone ?: null,
            $skills ?: null,
            $address ?: null,
            $profileImagePath,
        ]);

        setFlash('success', 'Account created. Please sign in.');
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register · Workfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body class="auth-page">
    <div class="auth-wrapper">
        <div class="register-auth-card fade-up">
            <div class="auth-logo">
                <div class="logo-box">W</div>
                <p class="logo-text">Workfolio</p>
            </div>
            <h1 class="auth-title">Create Admin Account</h1>
            <p class="auth-subtext">Register to manage your portfolio</p>

            <?php if ($errors): ?>
                <div class="admin-alert alert-error">
                    <?php foreach ($errors as $err): ?>
                        <div><?= e($err) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- enctype zaroori hai, warna file (profile_image) upload nahi hogi -->
            <form method="POST" action="register.php" enctype="multipart/form-data" novalidate>
                <?= csrfField() ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="auth-label">First Name</label>
                        <input type="text" name="firstname" class="form-control auth-input"
                               value="<?= e($old['firstname']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="auth-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control auth-input"
                               value="<?= e($old['lastname']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="auth-label">Email</label>
                    <input type="email" name="email" class="form-control auth-input"
                           placeholder="you@example.com" value="<?= e($old['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="auth-label">Password</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="passwordField" class="form-control auth-input"
                               placeholder="At least 8 characters" required>
                        <i class="bi bi-eye-slash password-toggle" data-target="passwordField"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="auth-label">Confirm Password</label>
                    <div class="position-relative">
                        <input type="password" name="confirm_password" id="confirmField" class="form-control auth-input"
                               placeholder="Re-enter password" required>
                        <i class="bi bi-eye-slash password-toggle" data-target="confirmField"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="auth-label d-block">Gender</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="male" id="genderMale"
                            <?= $old['gender'] === 'male' ? 'checked' : '' ?> required>
                        <label class="form-check-label" for="genderMale">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="female" id="genderFemale"
                            <?= $old['gender'] === 'female' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="genderFemale">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="other" id="genderOther"
                            <?= $old['gender'] === 'other' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="genderOther">Other</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="auth-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control auth-input" value="<?= e($old['phone']) ?>">
                </div>

                <div class="mb-3">
                    <label class="auth-label">Skills</label>
                    <select name="skills[]" class="form-control auth-input" multiple size="5">
                        <option value="html">HTML</option>
                        <option value="css">CSS</option>
                        <option value="javascript">JavaScript</option>
                        <option value="php">PHP</option>
                        <option value="mysql">MySQL</option>
                        <option value="bootstrap">Bootstrap</option>
                        <option value="react">React</option>
                        <option value="node">Node.js</option>
                    </select>
                    <small class="auth-subtext">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
                </div>

                <div class="mb-3">
                    <label class="auth-label">Address</label>
                    <textarea name="address" rows="3" class="form-control auth-input"><?= e($old['address']) ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="auth-label">Profile Picture</label>
                    <input type="file" name="profile_image" class="form-control auth-input" accept="image/*">
                </div>

                <button type="submit" class="btn auth-submit-btn w-100">Create Account</button>
            </form>

            <p class="auth-footer-text">
                Already have an account? <a href="login.php" class="auth-link">Sign in</a>
            </p>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
</html>
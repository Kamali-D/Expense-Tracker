<?php
require_once 'functions.php';
$hint = null; $submitted = false; $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Enter a valid email address.';
    } else {
        try {
            $stmt = $pdo->prepare('SELECT password_hint FROM users WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            if ($row) { $hint = $row['password_hint'] ?? ''; }
            $submitted = true;
        } catch (PDOException $e) {
            $error = 'Password hints are not set up in the database yet. Follow the database update step in README.md.';
        }
    }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Password hint · Expense Tracker</title><link rel="stylesheet" href="assets/style.css"><script defer src="assets/app.js"></script></head>
<body class="auth-body"><div class="auth-layout"><section class="auth-art"><a class="logo light" href="login.php"><span class="mark">E</span>Expense Tracker</a><div class="art-copy"><span class="tag">ACCOUNT RECOVERY</span><h1>A little reminder.<br><em>Back on track.</em></h1><p>Use the personal reminder you added when creating your account.</p><div class="float-card"><span class="bubble">✦</span><div><small>Your account</small><b>Protected with care</b></div></div></div><small class="art-foot">Your password is never stored as readable text.</small></section><section class="auth-side"><form class="auth-card" method="post"><div class="symbol">✦</div><h2>Forgot password?</h2><p>Enter your account email to view your password hint.</p>
<?php if ($error): ?><div class="alert danger"><?=e($error)?></div><?php endif; ?>
<?php if ($submitted): ?>
  <?php if ($hint !== null && $hint !== ''): ?><div class="alert success"><strong>Your password hint</strong><br><?=e($hint)?></div><p class="muted">This is only a reminder—not your actual password.</p>
  <?php elseif ($hint !== null): ?><div class="alert warning">No password hint is saved for this account. Please contact your project administrator.</div>
  <?php else: ?><div class="alert warning">If an account exists for that email, its hint would be available to the account owner.</div><?php endif; ?>
  <a class="primary full button-link" href="login.php">Back to login →</a>
<?php else: ?>
  <label>Email address<input type="email" name="email" required autocomplete="email" placeholder="you@example.com"></label><button class="primary full">Show my hint →</button><p class="switch"><a href="login.php">← Back to login</a></p>
<?php endif; ?><small class="secure">🔒 For safety, this page never reveals the actual password.</small></form></section></div></body></html>

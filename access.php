<?php
// Temporary password gate for the development site.
// Remove this file and the matching block in .htaccess when the site goes public.

const ACCESS_COOKIE = 'keeplanet_site_access';
const ACCESS_TOKEN = 'kp_6f41c8e2a73d91b4f06e';
const ACCESS_PASSWORD_HASH = '$2y$12$OejL1zjq/Aia8oexv.qeKurww3S6uZz1TwTYZZXLa/7tU.g3babeq';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = isset($_POST['password']) ? (string) $_POST['password'] : '';

    if (password_verify($password, ACCESS_PASSWORD_HASH)) {
        setcookie(ACCESS_COOKIE, ACCESS_TOKEN, [
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        header('Location: /', true, 302);
        exit;
    }

    $error = 'Mot de passe incorrect.';
}

header('X-Robots-Tag: noindex, nofollow, noarchive', true);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow,noarchive">
    <title>Accès protégé — Keeplanet</title>
    <style>
        :root { color-scheme: light; --blue:#0d4f8b; --green:#70b62c; --ink:#15324a; --muted:#667887; --bg:#f4f8fb; }
        * { box-sizing:border-box; }
        body { margin:0; min-height:100vh; display:grid; place-items:center; padding:24px; font-family:Arial,Helvetica,sans-serif; background:linear-gradient(145deg,#eef6fb,#f7fbf3); color:var(--ink); }
        .card { width:min(100%,430px); background:#fff; border:1px solid #dbe7ef; border-radius:22px; padding:32px; box-shadow:0 18px 50px rgba(13,79,139,.12); }
        .brand { font-size:28px; font-weight:800; color:var(--blue); margin-bottom:8px; }
        .brand span { color:var(--green); }
        h1 { font-size:24px; margin:18px 0 8px; }
        p { color:var(--muted); line-height:1.5; margin:0 0 22px; }
        label { display:block; font-weight:700; margin-bottom:8px; }
        input { width:100%; height:48px; border:1px solid #cbd9e2; border-radius:12px; padding:0 14px; font-size:16px; outline:none; }
        input:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(13,79,139,.10); }
        button { width:100%; height:48px; margin-top:14px; border:0; border-radius:12px; background:var(--blue); color:#fff; font-weight:800; font-size:16px; cursor:pointer; }
        button:hover { filter:brightness(.96); }
        .error { margin:0 0 14px; padding:10px 12px; border-radius:10px; background:#fff1f1; color:#a32222; font-weight:700; }
        .note { margin-top:18px; font-size:13px; color:#8494a0; }
    </style>
</head>
<body>
    <main class="card">
        <div class="brand">Kee<span>planet</span></div>
        <h1>Site en cours de préparation</h1>
        <p>Cette version du nouveau site est réservée aux personnes autorisées.</p>
        <?php if ($error !== ''): ?>
            <div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <form method="post" action="/access.php" autocomplete="off">
            <label for="password">Mot de passe</label>
            <input id="password" name="password" type="password" required autofocus>
            <button type="submit">Accéder au site</button>
        </form>
        <div class="note">Accès temporaire au site de développement Keeplanet.</div>
    </main>
</body>
</html>

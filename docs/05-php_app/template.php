<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <title>Keycloak + PHP</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand text-success-emphasis">PHP-App</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="nav-link text-light link-info link-underline-opacity-100-hover"
                            aria-current="page"
                            href="/">Home</a>
                    </li>
                    <?php if ($isAuthed): ?>
                        <li class="nav-item">
                            <a
                                class="nav-link text-light link-info link-underline-opacity-100-hover"
                                href="/profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link text-warning link-danger link-underline-opacity-100-hover"
                                href="/logout.php">LOGOUT (Keycloak)</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a
                                class="nav-link text-info link-info link-underline-opacity-100-hover"
                                href="/login.php">LOGIN with Keycloak</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>
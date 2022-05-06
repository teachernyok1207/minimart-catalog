<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <!-- Brand -->
    <a href="#" class="navbar-brand">
        <h1 class="h4">MiniMart Catalog</h1>
    </a>

    <!-- Button -->
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#main_menu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="main_menu">
        <!-- Left Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="products.php" class="nav-link">Products</a>
            </li>
            <li class="nav-item">
                <a href="sections.php" class="nav-link">Sections</a>
            </li>
        </ul>
        <!-- Right Links -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="profile.php" class="nav-link fw-bold"><?= $_SESSION['full_name'] ?></a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">Log Out</a>
            </li>
        </ul>
    </div>
</nav>
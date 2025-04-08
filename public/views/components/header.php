<header class="header">
    <div class="container">
        <a href="<?= $baseUrl ?>index.php" class="logo">
            <img src="<?= $baseUrl ?>img/Logo.svg" alt="Logo" />
        </a>

        <!-- Main nav -->
        <nav class="nav">
            <ul class="list-unstyled">
                <li><a href="<?php __DIR__ . '/../../index.php' ?>">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="<?= $baseUrl ?>pages/uploads.php">Uploads</a></li>
            </ul>
        </nav>

        <!-- Search -->
        <div class="search-container">
            <input type="text" id="search" placeholder="Search..." />
            <button type="submit" class="search-btn">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </div>

        <!-- User icon -->
        <div class="user-dropdown">
            <button class="user-btn">
                <svg class="user-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="7" r="4"></circle>
                    <path d="M5 20h14c0-5-3-7-7-7H12c-4 0-7 2-7 7z"></path>
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="<?= $baseUrl ?>pages/profile.php">Profile</a>
                <a href="#">Settings</a>
            </div>
        </div>
    </div>
</header>
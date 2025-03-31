<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Viewport -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <!-- Preloaded web font (Inter) -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet"
          href="css/reset.css">
    <link rel="stylesheet"
          href="css/main.css">

    <title>Home</title>
</head>

<body>
<div class="main-container">

    <header class="header">
        <div class="container">

            <a href="homeView.php"
               class="logo">
                <img src="img/Logo.svg"
                     alt="">
            </a>

            <!-- Main nav -->
            <nav class="nav">
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>

            <!-- Search -->
            <div class="search-container">
                <input type="text"
                       id="search"
                       placeholder="Search...">
                <button type="submit"
                        class="search-btn">
                    <svg class="search-icon"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <circle cx="11"
                                cy="11"
                                r="8"></circle>
                        <line x1="21"
                              y1="21"
                              x2="16.65"
                              y2="16.65"></line>
                    </svg>
                </button>
            </div>

            <!-- User icon -->
            <div class="user-dropdown">
                <button class="user-btn">
                    <svg class="user-icon"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <circle cx="12"
                                cy="7"
                                r="4"></circle>
                        <path d="M5 20h14c0-5-3-7-7-7H12c-4 0-7 2-7 7z"></path>
                    </svg>
                </button>
                <div class="dropdown-content">
                    <a href="profileView.php">Profile</a>
                    <a href="#">Settings</a>
                </div>
            </div>

        </div>
    </header>

    <main class="pt-5 mt-3">
        <div class="container">

            <div class="filters">Filters</div>

            <ul class="grid-container list-unstyled">
                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/01.webp"
                             alt="">
                        <div class="title">Shadows of the Past</div>
                        <ul class="categories">
                            <li class="cat-01">Fantasy</li>
                            <li class="cat-02">Adventure</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">Eleanor Blake</div>
                    </div>
                </li>

                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/02.webp"
                             alt="">
                        <div class="title">Echoes of Eternity</div>
                        <ul class="categories">
                            <li class="cat-03">Design</li>
                            <li class="cat-04">Photo</li>
                            <li class="cat-05">Inspiration</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">James Whitmore</div>
                    </div>
                </li>

                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/03.webp"
                             alt="">
                        <div class="title">Whispers in the Wind</div>
                        <ul class="categories">
                            <li class="cat-04">Photo</li>
                            <li class="cat-05">Inspiration</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">Sophia Carter</div>
                    </div>
                </li>

                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/04.webp"
                             alt="">
                        <div class="title">The Forgotten Realm</div>
                        <ul class="categories">
                            <li class="cat-02">Adventure</li>
                            <li class="cat-01">Fantasy</li>
                            <li class="cat-04">Photo</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">Liam Patterson</div>
                    </div>
                </li>

                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/05.webp"
                             alt="">
                        <div class="title">Silent Horizons</div>
                        <ul class="categories">
                            <li class="cat-03">Design</li>
                            <li class="cat-04">Photo</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">Ava Montgomery</div>
                    </div>
                </li>

                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/06.webp"
                             alt="">
                        <div class="title">Celestial Dawn</div>
                        <ul class="categories">
                            <li class="cat-05">Inspiration</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">Nathaniel Rhodes</div>
                    </div>
                </li>

                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/07.webp"
                             alt="">
                        <div class="title">Fragments of Light</div>
                        <ul class="categories">
                            <li class="cat-04">Photo</li>
                            <li class="cat-02">Adventure</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">Olivia Bennett</div>
                    </div>
                </li>

                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/08.webp"
                             alt="">
                        <div class="title">Beyond the Horizon</div>
                        <ul class="categories">
                            <li class="cat-01">Fantasy</li>
                            <li class="cat-02">Adventure</li>
                            <li class="cat-03">Design</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">Ethan Chandler</div>
                    </div>
                </li>

                <li class="grid-item">
                    <a href="#"
                       class="img-wrap">
                        <img src="img/exmp/09.png"
                             alt="">
                        <div class="title">Echoes of the Unknown</div>
                        <ul class="categories">
                            <li class="cat-05">Inspiration</li>
                        </ul>
                    </a>
                    <div class="info-wrap">
                        <div class="author-name">Ethan Chandler</div>
                    </div>
                </li>
            </ul>

        </div>
    </main>

</div>

<footer class="footer">Footer</footer>
</body>

</html>

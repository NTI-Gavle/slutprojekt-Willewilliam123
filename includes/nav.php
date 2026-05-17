<div class="bg-purple-950">
    <nav class="w-65 sidebar">  
        <ul class="grid grid-cols-1 grid-rows-6">
            <li class="" >
                <a href="mainmenu.php" class="nav-link">

                    <svg class="nav-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 10.75L12 3l9 7.75V21a1 1 0 0 1-1 1h-5.5a1 1 0 0 1-1-1v-5.5h-3V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V10.75z"/>
                    </svg>  

                    <span class="text-decoration-none text-rose-200">
                        Home
                    </span>
                </a>
            </li>
            <li>
                <a href="../includes/profile.php?user=<?= urlencode($_SESSION["user"]["Username"]) ?>" class="nav-link">
                    
                    <svg class="nav-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 12a5 5 0 1 0-5-5a5 5 0 0 0 5 5zm0 2c-4.42 0-8 2.69-8 6v1h16v-1c0-3.31-3.58-6-8-6z"/>
                    </svg>

                    <span class="text-decoration-none text-rose-200">
                        Profile
                    </span>
                </a>
            </li>
            <li>
                <a href="settings.php" class="nav-link">
                    
                    <svg class="nav-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M19.14 12.94c.04-.31.06-.63.06-.94s-.02-.63-.06-.94l2.03-1.58a.5.5 0 0 0 .12-.64l-1.92-3.32a.5.5 0 0 0-.6-.22l-2.39.96a7.03 7.03 0 0 0-1.63-.94l-.36-2.54A.5.5 0 0 0 13.9 1h-3.8a.5.5 0 0 0-.49.42l-.36 2.54c-.58.22-1.12.53-1.63.94l-2.39-.96a.5.5 0 0 0-.6.22L2.71 7.48a.5.5 0 0 0 .12.64l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94L2.83 13.16a.5.5 0 0 0-.12.64l1.92 3.32a.5.5 0 0 0 .6.22l2.39-.96c.51.41 1.05.72 1.63.94l.36 2.54a.5.5 0 0 0 .49.42h3.8a.5.5 0 0 0 .49-.42l.36-2.54c.58-.22 1.12-.53 1.63-.94l2.39.96a.5.5 0 0 0 .6-.22l1.92-3.32a.5.5 0 0 0-.12-.64l-2.03-1.58zM12 15.5A3.5 3.5 0 1 1 12 8.5a3.5 3.5 0 0 1 0 7z"/>
                    </svg>
                
                    <span class="text-decoration-none text-rose-200">
                        Settings
                    </span>
                </a>
            </li>
        </ul>

        <div class="center button">
            <button class="post_button mb-10 p-3 rounded-2xl w-50 text-rose-200">
                <svg class="nav-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M17.59 3.59a2 2 0 0 1 2.82 2.82l-11 11L5 18l.59-4.41l11-11zM4 20h16v2H4z"/>
                </svg>

                <span>
                    New Post
                </span>
            </button>
        </div>
    </nav>
</div>
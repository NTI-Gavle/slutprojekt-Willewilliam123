 <-- PurpleSky README -->

 - PurpleSky is a small social media style web application built using PHP, MySQL, HTMX, Tailwind, JavaScript, and CSS. The site lets users register, log in, create posts, reply with comments, edit their profile, change account settings, and choose a visual theme. The code is split up into three segments, the "database" files which is the backend code for the project, the "includes" files which is the frontend code for the project and the "public" files which is where the css and javascript files can be found.

 <-- Database Files -->

// 'create_comment.php'
 - Creates a new comment or reply for a post. It checks that the user is logged in, validates the comment text, saves it to the 'Comments' table, and then reloads the comments section.

// 'create_post.php'
 - Creates a new post from the logged-in user. It checks that the post text exists, limits the length to 1000 characters, inserts the post into the 'Posts' table, and reloads the feed.

// 'db.php'
 - Connects the project to the MySQL database using PDO. It loads database login details from the '.env' file and sets PDO to throw exceptions when database errors happen.

// 'delete_account.php'
 - Deletes the currently logged-in user's account. It first removes the user's comments and posts, then deletes the user from the 'Users' table, destroys the session, and sends the user back to the login page.

// 'delete_comment.php'
 - Deletes a comment made by the logged-in user. It checks that the comment exists and belongs to the current user, deletes child replies first, deletes the main comment, and reloads the comments section.

// 'delete_post.php'
 - Deletes a post made by the logged-in user. It checks that the post exists and belongs to the current user before removing it from the 'Posts' table and reloading the feed.

// 'load_comments.php'
 - Loads and displays all comments for a selected post. It joins comments with user data, organizes replies under their parent comments, and uses a recursive function to render nested comment threads.

// 'load_feed.php'
 - Loads and displays the main post feed. It fetches posts together with user information, orders the newest posts first, and renders each post with profile links and action buttons.

// 'logout.php'
 - Logs the user out of the website. It clears the session, destroys it, and redirects the user to the login page.

// 'register2.php'
 - Handles new account registration. It checks if the username already exists, hashes the password, saves the new user to the database, and redirects the user to the login page.

// 'Signin.php' 
 - Handles user login. It searches for the username, verifies the password with 'password_verify', stores the user data in the session, and redirects the user to the main menu.

// 'update_account.php'
 - Updates the logged-in user's username. It checks that the new username is not already taken, updates the 'Users' table, updates the session, and redirects back to settings.

// 'update_password.php'
 - Updates the logged-in user's password. It checks the current password, hashes the new password, saves it to the database, and redirects back to settings.

// 'update_profile.php'
 - Updates the logged-in user's profile information. It saves the display name, bio, and avatar URL to the database, updates the session values, and redirects back to the profile page.

// 'update_theme.php'
 - Updates the user's selected visual theme. It only allows the themes 'dark', 'light', and 'purple', saves the selected theme to the database, updates the session, and redirects back to settings.

 <-- Include Files -->

// 'head.php'
 - Contains scripts that are reused in multiple pages. It loads HTMX for dynamic page updates and Tailwind through a CDN.

// 'login.php'
 - Displays the login page. It shows login errors from the session, includes the shared head file, and sends the username and password to 'signin.php'.

// 'mainmenu.php'
 - Displays the main home/feed page after login. It protects the page from users who are not logged in, includes the navigation sidebar, contains the post form, and loads the feed with HTMX.

// 'nav.php'
 - Contains the sidebar navigation used across the logged-in pages. It links to the home page, profile page, and settings page, and also includes a styled new post button.

// 'post.php'
 - Displays a single post page. It loads one selected post by 'postId', shows the post content, includes a comment form, and loads replies with HTMX.

// 'profile.php'
 - Displays a user's profile page. It loads the selected user, shows profile information, displays the user's posts and replies, and lets the owner edit their profile.

// 'register.php'
 - Displays the account registration page. It shows registration errors from the session and sends the new username and password to 'register2.php'.

// 'settings.php'
 - Displays the account settings page for logged-in users. It lets the user change username, change password, delete the account, and choose between available themes.

 <-- Public Files -->

// 'styles.css'
 - Contains the main styling for the whole website. It controls the layout, sidebar, feed, posts, comments, profiles, settings, login/register pages, themes, and mobile responsiveness.

// 'comment.js'
 - Handles showing and hiding reply forms under comments. It toggles the display state of a selected reply form when the reply button is clicked.

// 'profile.js'
 - Controls interactive features on the profile page. It toggles the edit profile form and switches between profile tabs while updating the active tab style.

// 'settings.js'
 - Controls tab navigation on the settings page. It switches between settings sections and updates the active tab button styling.

 <-- HTMX Integration -->

// 'HTMX'
 - HTMX is used throughout the project to update parts of the page without fully reloading the website. It is mainly used for loading feeds, comments, replies, and form submissions dynamically, creating a smoother and faster user experience.

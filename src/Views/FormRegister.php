<?php
include_once ('Header.php');
?>
    <main>
        <h2>Register new magical user</h2>
        <form action="/register" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Register">
    </form>
    </main>

<?php
include_once ('Footer.php');
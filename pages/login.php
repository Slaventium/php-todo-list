<?php
include(__DIR__ . '/../bootstrap.php');

$users = [
    'Slaven' => '$2y$10$jh9br7M./dxkehxYnnYt3epxE8cYneQZgOn0IcJ.ZDWJear11xNSK',
    'TestUser1' => '$2y$10$H099GP.Y9Ja3Q1fLe3y0CexYbCuj59RMnTOUOa.6JjliYt40QKH7m'
];

if (isset($_POST['username'], $_POST['password'])) {
// The user has submitted the login form
    $expectedPasswordHash = $users[$_POST['username']];
    if (password_verify($_POST['password'], $expectedPasswordHash)) {
// The provided password is also correct
// Remember the username of the user who just logged in
        $_SESSION['authenticated_user'] = $_POST['username'];
        // Redirect to /tasks.php
        header('Location: /../tasks');
        exit;
    }
}
$title = 'Login';
?>
<?php
include(__DIR__ . '/../_header.php');
?>

<form method="post">
    <div>
        <label for="username">
            Username:
        </label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">
            Password:
        </label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
<?php include(__DIR__ . '/../_footer.php'); ?>

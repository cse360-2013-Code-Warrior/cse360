<script language="php">
    session_start();

    $_SESSION['user_name_post']     = strtoupper($_POST['user_name_post']);
    $_SESSION['user_password_post'] = $_POST['user_password_post'];
    header( "location:login.php" );
</script>

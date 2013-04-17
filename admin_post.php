<script language="php">
    session_start();

    $_SESSION['Selection'] = $_POST['Menu_Selection'];
    header( "location:admin.php" );
</script>

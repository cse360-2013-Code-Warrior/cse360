<script language="php">
    session_start();

    $_SESSION['user_name_first']     = $_POST['user_name_first'];
    $_SESSION['user_name_last']      = $_POST['user_name_last'];
    $_SESSION['user_name_email']     = $_POST['user_name_email'];
    $_SESSION['user_name_login']     = $_POST['user_name_login'];
    $_SESSION['user_name_password']  = $_POST['user_name_password'];
    $_SESSION['user_name_password2'] = $_POST['user_name_password2'];
    $_SESSION['user_name_doctor']    = $_POST['user_name_doctor'];
    $_SESSION['user_ssn']            = $_POST['user_ssn'];
    $_SESSION['contact_phone']       = $_POST['contact_phone'];
    $_SESSION['contact_address']     = $_POST['contact_address'];
    $_SESSION['contact_city']        = $_POST['contact_city'];
    $_SESSION['contact_zip']         = $_POST['contact_zip'];
    $_SESSION['pharmacy_name']       = $_POST['pharmacy_name'];
    $_SESSION['pharmacy_address']    = $_POST['pharmacy_address'];
    $_SESSION['pharmacy_city']       = $_POST['pharmacy_city'];
    $_SESSION['pharmacy_phone']      = $_POST['pharmacy_phone'];

    header( "location:register.php" );
</script>

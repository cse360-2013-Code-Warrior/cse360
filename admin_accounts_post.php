<script language="php">
    session_start();

    $_SESSION['Selection']                    = "Accounts Post";
    $_SESSION['pst_user_id']                  = $_POST["pst_user_id"];
    $_SESSION['pst_user_name_first']          = $_POST["pst_user_name_first"];
    $_SESSION['pst_user_name_last']           = $_POST["pst_user_name_last"];
    $_SESSION['pst_user_name_doctor']         = $_POST["pst_user_name_doctor"];
    $_SESSION['pst_user_name_login']          = $_POST["pst_user_name_login"];
    $_SESSION['pst_user_name_email']          = $_POST["pst_user_name_email"];
    $_SESSION['pst_user_name_password']       = $_POST["pst_user_name_password"];
    $_SESSION['pst_user_name_admin_approved'] = $_POST["pst_user_name_admin_approved"];
    $_SESSION['pst_user_name_active']         = $_POST["pst_user_name_active"];
    $_SESSION['pst_user_name_description']    = $_POST["pst_user_name_description"];
    $_SESSION['Account Modify']               = $_POST["Modify"];

    header( "location:admin.php" );
</script>

<script language="php">
    session_start();

    include 'database.php';

    if( isset($_POST['user_name_last']) == TRUE )
    {
        if( $_POST['user_name_password'] == $_POST['user_name_password2'] )
        {
            $query          = "UPDATE personal SET user_name_first='".$_POST['user_name_first']."', user_name_last='".$_POST['user_name_last']."', user_name_email='".$_POST['user_name_email']."', user_name_password='".$_POST['user_name_password']."' WHERE user_id='".$_SESSION['login_id']."'";
        }
        else
        {
            $query          = "UPDATE personal SET user_name_first='".$_POST['user_name_first']."', user_name_last='".$_POST['user_name_last']."', user_name_email='".$_POST['user_name_email']."' WHERE user_id='".$_SESSION['login_id']."'";
        }
        $sql_connection = new database_SQL;
        $sql_result     = $sql_connection->SQL_command( $query );
        $sql_connection = NULL;
        
        $query          = "UPDATE contact SET contact_phone='".$_POST['contact_phone']."', contact_address='".$_POST['contact_address']."', contact_city='".$_POST['contact_city']."', contact_zip='".$_POST['contact_zip']."' WHERE user_id='".$_SESSION['login_id']."'";
        $sql_connection = new database_SQL;
        $sql_result     = $sql_connection->SQL_command( $query );
        $sql_connection = NULL;

        $query          = "UPDATE pharmacy SET pharmacy_name='".$_POST['pharmacy_name']."', pharmacy_address='".$_POST['pharmacy_address']."', pharmacy_city='".$_POST['pharmacy_city']."', pharmacy_phone='".$_POST['pharmacy_phone']."' WHERE user_id='".$_SESSION['login_id']."'";
        $sql_connection = new database_SQL;
        $sql_result     = $sql_connection->SQL_command( $query );
        $sql_connection = NULL;
    }


    header("location:index.php");
</script>

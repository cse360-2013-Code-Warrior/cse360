<script language="php">
    session_start();

    include 'database.php';

    if( $_POST['Menu_Selection'] == "Submit Changes" )
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

    if( $_POST['Menu_Selection'] == "Modify Record" )
    {
        $query          = "UPDATE medical_records SET medical_records_doctor_notes='".$_POST['medical_records_doctor_notes']."', medical_records_patient_notes='".$_POST['medical_records_patient_notes']."', medical_records_bloodpressure='".$_POST['medical_records_bloodpressure']."', medical_records_glucose='".$_POST['medical_records_glucose']."', medical_records_weight='".$_POST['medical_records_weight']."', medical_records_prescriptions_current='".$_POST['medical_records_prescriptions_current']."', medical_records_prescriptions_new='".$_POST['medical_records_prescriptions_new']."' WHERE user_id='".$_POST['pst_user_id']."' AND medical_records_date='".$_POST['medical_records_date']."'";
        $sql_connection = new database_SQL;
        $sql_result     = $sql_connection->SQL_command( $query );
        $sql_connection = NULL;
    }

    if( $_POST['Menu_Selection'] == "Add Record" )
    {
        if( ($_SESSION['login_type'] == 'doctor') || ($_SESSION['login_type'] == 'staff') )
        {
            $medical_records_patient_notes     = "";
            $medical_records_doctor_notes      =  $_POST['medical_records_doctor_notes'];
            $medical_records_prescriptions_new =  $_POST['medical_records_prescriptions_new'];
        }
        else
        {
            $medical_records_prescriptions_new = "";
            $medical_records_doctor_notes      = "";
            $medical_records_patient_notes     =  $_POST['medical_records_patient_notes'];
        }

        $query          = "INSERT INTO medical_records(user_id, medical_records_doctor_notes, medical_records_patient_notes, medical_records_bloodpressure, medical_records_glucose, medical_records_weight, medical_records_prescriptions_current, medical_records_prescriptions_new) VALUES('".$_POST['pst_user_id']."', '".$medical_records_doctor_notes."', '".$medical_records_patient_notes."', '".$_POST['medical_records_bloodpressure']."', '".$_POST['medical_records_glucose']."', '".$_POST['medical_records_weight']."', '".$_POST['medical_records_prescriptions_current']."', '".$medical_records_prescriptions_new."' )";
        $sql_connection = new database_SQL;
        $sql_result     = $sql_connection->SQL_command( $query );
        $sql_connection = NULL;
    }

    header("location:index.php");
</script>

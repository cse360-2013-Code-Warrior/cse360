<script language="php">

    class RECORD
    {
        public function RECORD_personal()
        {
            $sql_connection = new database_SQL;
            $query          = "SELECT * FROM personal WHERE user_id='".$_SESSION['login_id']."'";
            $sql_result     = $sql_connection->SQL_command( $query );
            $row_data       = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC );
            $sql_connection = NULL;
            
            print ( '            <form action="record_post.php" method="post">' );
            print ( '                <pre><BR>' );
            print ( '                    First Name               <input type="text" size="'.strlen($row_data['user_name_first']).'" value="'.$row_data['user_name_first'].'" name="user_name_first"><BR>' );
            print ( '                    Last Name                <input type="text" size="'.strlen($row_data['user_name_last']).'" value="'.$row_data['user_name_last'].'" name="user_name_last"><BR>' );
            print ( '                    Password                 <input type="password" name="user_name_password" size="'.strlen($row_data['user_name_password']).'" value="'.$row_data['user_name_password'].'"><BR>' );
            print ( '                    Re-enter Password        <input type="password" name="user_name_password2" size="'.strlen($row_data['user_name_password']).'" value="'.$row_data['user_name_password'].'"><BR>' );
            print ( '                    Email                    <input type="text" size="'.strlen($row_data['user_id']).'" value="'.$row_data['user_name_email'].'" name="user_name_email"><BR>' );
            print ( '                    <BR>' ); 

            $sql_connection = new database_SQL;
            $query          = "SELECT * FROM contact WHERE user_id='".$_SESSION['login_id']."'";
            $sql_result     = $sql_connection->SQL_command( $query );
            $row_data       = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC );
            $sql_connection = NULL;

            print ( '                    Mailing Address          <input type="text" size="'.strlen($row_data['contact_address']).'" value="'.$row_data['contact_address'].'" name="contact_address"><BR>' );
            print ( '                    Mailing City             <input type="text" size="'.strlen($row_data['contact_city']).'" value="'.$row_data['contact_city'].'" name="contact_city"><BR>' );
            print ( '                    Mailing Zip Code         <input type="text" size="'.strlen($row_data['contact_zip']).'" value="'.$row_data['contact_zip'].'" name="contact_zip"><BR>' );
            print ( '                    Contact phone number     <input type="text" size="'.strlen($row_data['contact_phone']).'" value="'.$row_data['contact_phone'].'" name="contact_phone"><BR>' );
            print ( '                    <BR>' );

            $sql_connection = new database_SQL;
            $query          = "SELECT * FROM pharmacy WHERE user_id='".$_SESSION['login_id']."'";
            $sql_result     = $sql_connection->SQL_command( $query );
            $row_data       = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC );
            $sql_connection = NULL;

            print ( '                    Pharmacy Name            <input type="text" size="'.strlen($row_data['pharmacy_name']).'" value="'.$row_data['pharmacy_name'].'" name="pharmacy_name"><BR>' );
            print ( '                    Pharmacy Address         <input type="text" size="'.strlen($row_data['pharmacy_address']).'" value="'.$row_data['pharmacy_address'].'" name="pharmacy_address"><BR>' );
            print ( '                    Pharmacy City            <input type="text" size="'.strlen($row_data['pharmacy_city']).'" value="'.$row_data['pharmacy_city'].'" name="pharmacy_city"><BR>' );
            print ( '                    Pharmacy Phone           <input type="text" size="'.strlen($row_data['pharmacy_phone']).'" value="'.$row_data['pharmacy_phone'].'" name="pharmacy_phone"><BR>' );
            print ( '                    <BR>' );

            print ( '                    <input type="submit" name="Menu_Selection" value="Submit Changes">' );
            print ( '                </pre><BR>' );
            print ( '            </form>' );
        }
    
        public function RECORD_medical_view($user_id)
        {
            $sql_connection = new database_SQL;
            $query          = "SELECT * FROM personal WHERE user_id='".$user_id."'";
            $sql_result     = $sql_connection->SQL_command( $query );
            $row_data       = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC );
            $sql_connection = NULL;

            $user_FirstName     = $row_data['user_name_first'];
            $user_LastName      = $row_data['user_name_last'];

            $sql_connection = new database_SQL;
            $query          = "SELECT * FROM medical_records WHERE user_id='".$user_id."' ORDER BY medical_records_date DESC";
            $sql_result     = $sql_connection->SQL_command( $query );

            while( $row_data = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC ) )
            {
                print ( '            <form action="record_post.php" method="post">' );
                print ( '                <pre><BR>' );
                print('Account ID                ');
                print('<input type="text" name="pst_user_id" size="'.strlen($user_id).'" value="'.$user_id.'" readonly> ');
                print('<br>');
    
                print('First Name                ');
                print('<input type="text" name="pst_user_name_first" size="'.strlen($user_FirstName).'" value="'.$user_FirstName.'" readonly> ');
                print('<br>');
            
                print('Last Name                 ');
                print('<input type="text" name="pst_user_name_last" size="'.strlen($user_LastName).'" value="'.$user_LastName.'" readonly> ');
                print('<br><br>');

                print('Record Date:              ');
                print('<input type="text" name="medical_records_date" size="'.strlen($row_data['medical_records_date']).'" value="'.$row_data['medical_records_date'].'" readonly> ');
                print('<br>');

                print('Doctor Notes:             ');
                print('<input type="text" name="medical_records_doctor_notes" size="'.strlen($row_data['medical_records_doctor_notes']).'" value="'.$row_data['medical_records_doctor_notes'] );
                if( ($_SESSION['login_type'] != 'doctor') && ($_SESSION['login_type'] != 'staff') )
                {
                    print( '" readonly> ' );
                }
                else
                {
                    print( '"> ' );
                }
                print('<br>');
                
                print('Patient Notes:            ');
                print('<input type="text" name="medical_records_patient_notes" size="'.strlen($row_data['medical_records_patient_notes']).'" value="'.$row_data['medical_records_patient_notes'].'"' );
                if( $_SESSION['login_type'] != 'patient' )
                {
                    print( '" readonly> ' );
                }
                else
                {
                    print( '"> ' );
                }
                print('<br><br>');
                
                print('Blood Preasure Measurement:       ');
                print('<input type="text" name="medical_records_bloodpressure" size="'.strlen($row_data['medical_records_bloodpressure']).'" value="'.$row_data['medical_records_bloodpressure'].'" > ');
                print('<br>');
                
                print('Glucose Reading:                  ');
                print('<input type="text" name="medical_records_glucose" size="'.strlen($row_data['medical_records_glucose']).'" value="'.$row_data['medical_records_glucose'].'" > ');
                print('<br>');
                
                print('Weight:                           ');
                print('<input type="text" name="medical_records_weight" size="'.strlen($row_data['medical_records_weight']).'" value="'.$row_data['medical_records_weight'].'" > ');
                print('<br>');

                print('Current Prescriptions:            ');
                print('<input type="text" name="medical_records_prescriptions_current" size="'.strlen($row_data['medical_records_prescriptions_current']).'" value="'.$row_data['medical_records_prescriptions_current'] );
                if( ($_SESSION['login_type'] != 'doctor') && ($_SESSION['login_type'] != 'staff') )
                {
                    print( '" readonly> ' );
                }
                else
                {
                    print( '"> ' );
                }
                print('<br>');

                print('New Prescriptions:                ');
                print('<input type="text" name="medical_records_prescriptions_new" size="'.strlen($row_data['medical_records_prescriptions_new']).'" value="'.$row_data['medical_records_prescriptions_new']);
                if( ($_SESSION['login_type'] != 'doctor') || ($_SESSION['login_type'] != 'staff') )
                {
                    print( '" readonly> ' );
                }
                else
                {
                    print( '"> ' );
                }
                print('<br>');
                print ( '                    <input type="submit" name="Menu_Selection" value="Modify Record">' );
                print ( '                </pre><BR><BR>' );
                print ( '            </form>' );
            }
        }
        
        public function RECORD_add($user_id)
        {
            $sql_connection = new database_SQL;
            $query          = "SELECT * FROM personal WHERE user_id='".$user_id."'";
            $sql_result     = $sql_connection->SQL_command( $query );
            $row_data       = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC );
            $sql_connection = NULL;

            print ( '            <form action="record_post.php" method="post">' );
            print ( '                <pre><BR>' );
            print('Account ID                ');
            print('<input type="text" name="pst_user_id" size="'.strlen($user_id).'" value="'.$user_id.'" readonly> ');
            print('<br>');

            print('First Name                ');
            print('<input type="text" name="pst_user_name_first" size="'.strlen($row_data['user_name_first']).'" value="'.$row_data['user_name_first'].'" readonly> ');
            print('<br>');
        
            print('Last Name                 ');
            print('<input type="text" name="pst_user_name_last" size="'.strlen($row_data['user_name_last']).'" value="'.$row_data['user_name_last'].'" readonly> ');
            print('<br>');

            if( ($_SESSION['login_type'] == 'doctor') || ($_SESSION['login_type'] == 'staff') )
            {
                print('Doctor Notes:             ');
                print('<input type="text" name="medical_records_doctor_notes" >' );
            }
            print('<br>');
            
            if( $_SESSION['login_type'] == 'patient' )
            {
                print('Patient Notes:            ');
                print('<input type="text" name="medical_records_patient_notes" >' );
            }
            print('<br><br>');
            
            print('Blood Preasure Measurement:       ');
            print('<input type="text" name="medical_records_bloodpressure" > ');
            print('<br>');
            
            print('Glucose Reading:                  ');
            print('<input type="text" name="medical_records_glucose" > ');
            print('<br>');
            
            print('Weight:                           ');
            print('<input type="text" name="medical_records_weight" > ');
            print('<br>');

            print('Current Prescriptions:            ');
            print('<input type="text" name="medical_records_prescriptions_current" >' );
            print('<br>');

            if( ($_SESSION['login_type'] == 'doctor') || ($_SESSION['login_type'] == 'staff') )
            {
                print('New Prescriptions:                ');
                print('<input type="text" name="medical_records_prescriptions_new" >' );
            }
            print('<br>');
            print ( '                    <input type="submit" name="Menu_Selection" value="Add Record">' );
            print ( '                </pre><BR><BR>' );
            print ( '            </form>' );
        }
    }

</script>

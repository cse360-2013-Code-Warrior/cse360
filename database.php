<script language="php">

    // Checking if database already exists, if not creating database along with default users
    $sqlAccess   = new mysqli('localhost', 'root', 'usbw', 'cse360');
    if ( ($sqlAccess->connect_error) == True ) 
    {
        $sqlAccess->close();
        $sqlAccess   = new mysqli('localhost', 'root', 'usbw');
        // Create database
        mysqli_query( $sqlAccess, "CREATE DATABASE IF NOT EXISTS cse360 CHARACTER SET ascii COLLATE ascii_bin" );

        $sqlAccess->close();
        $sqlAccess   = new mysqli('localhost', 'root', 'usbw', 'cse360');
        
        // Create table personal  NOT NULL AUTO_INCREMENT
        mysqli_query( $sqlAccess, "CREATE TABLE personal (    user_id                      INT ,    user_name_first              CHAR(128) NOT NULL,    user_name_last               CHAR(128) NOT NULL,    user_ssn                     INT(11) NOT NULL,    user_name_login              CHAR(128) NOT NULL,    user_name_password           CHAR(128) NOT NULL,    user_name_email              CHAR(128) NOT NULL,    user_name_description        CHAR(10) NOT NULL,    user_name_doctor             CHAR(128),    user_name_doctor2            CHAR(128),    user_name_admin_approved     CHAR(1) NOT NULL,    user_name_active             CHAR(1) NOT NULL )" );

        // Create table contact
        mysqli_query( $sqlAccess, "CREATE TABLE contact(    user_id                      INT,    contact_phone                CHAR(32) NOT NULL,    contact_address              CHAR(128) NOT NULL,    contact_city                 CHAR(128) NOT NULL,    contact_zip                  CHAR(32) NOT NULL)" );
        
        // Create table insurance
        mysqli_query( $sqlAccess, "CREATE TABLE insurance(    user_id                      INT,    insurance_name               CHAR(128) NOT NULL,    insurance_account            CHAR(128) NOT NULL,    insurance_phone              CHAR(32) NOT NULL)" );
        
        // Create table pharmacy
        mysqli_query( $sqlAccess, "CREATE TABLE pharmacy(    user_id                      INT,    pharmacy_name                CHAR(128) NOT NULL,    pharmacy_address             CHAR(128) NOT NULL,    pharmacy_city                CHAR(128) NOT NULL,    pharmacy_zip                 CHAR(32) NOT NULL,    pharmacy_phone               CHAR(32) NOT NULL)" );

        // Create medical_records
        mysqli_query( $sqlAccess, "CREATE TABLE medical_records(    user_id                        INT,    medical_records_date                   CHAR(10) NOT NULL,    medical_records_doctor_notes           TEXT,    medical_records_patient_notes          TEXT,    medical_records_bloodpressure          CHAR(32),    medical_records_glucose                CHAR(32),    medical_records_weight                 CHAR(32),    medical_records_prescriptions_current  TEXT,    medical_records_prescriptions_new      TEXT)" );
        
        // Add users for demonstration
        //    user_name_first, user_name_last, user_ssn, user_name_login, user_name_password, user_name_email, user_name_description, user_name_doctor, user_name_doctor2, user_name_admin_approved, user_name_active
        //username:  DOCTOR
        //password:   test
        //
        //username:  ADMIN
        //password:   test
        //
        //username:  STAFF
        //password:   test
        //
        //username:  PATIENT
        //password:   test
        mysqli_query( $sqlAccess, "INSERT INTO personal (user_name_first, user_name_last, user_ssn, user_name_login, user_name_password, user_name_email, user_name_description, user_name_admin_approved, user_name_active) VALUES ('CSE', 'Demonstration', '000-00-0000', 'DOCTOR', 'test', 'cse360@asu.edu', 'doctor', 'Y','Y')" );
        mysqli_query( $sqlAccess, "INSERT INTO personal (user_name_first, user_name_last, user_ssn, user_name_login, user_name_password, user_name_email, user_name_description, user_name_admin_approved, user_name_active) VALUES ('CSE', 'Demonstration', '000-00-0000', 'ADMIN', 'test', 'cse360@asu.edu', 'admin', 'Y','Y')" );
        mysqli_query( $sqlAccess, "INSERT INTO personal (user_name_first, user_name_last, user_ssn, user_name_login, user_name_password, user_name_email, user_name_description, user_name_admin_approved, user_name_active) VALUES ('CSE', 'Demonstration', '000-00-0000', 'STAFF', 'test', 'cse360@asu.edu', 'staff', 'Y','Y')" );
        mysqli_query( $sqlAccess, "INSERT INTO personal (user_name_first, user_name_last, user_ssn, user_name_login, user_name_password, user_name_email, user_name_description, user_name_admin_approved, user_name_active) VALUES ('CSE', 'Demonstration', '000-00-0000', 'PATIENT', 'test', 'cse360@asu.edu', 'patient', 'N','Y')" );
        mysqli_commit($sqlAccess);
    }

    // Closing mysql object created
    $sqlAccess->close();


    class database_SQL
    {
        public function SQL_command( $SQL_String )
        {
            //print("database called <BR>");
            //  Check username and password against MySQL
            DEFINE('DB_USER', 'root');
            DEFINE('DB_PASSWORD', 'usbw');
            DEFINE('DB_HOST', 'localhost');
            DEFINE('DB_NAME', 'cse360');

            $database_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if( $database_connection == TRUE )
            {
                //  Setting auto commit to false
                mysqli_autocommit($database_connection, FALSE);

                //if Insert due row_data else due sql_result
                $sql_result = mysqli_query($database_connection, $SQL_String);
                $row_data   = mysqli_fetch_array($sql_result, MYSQLI_ASSOC);

                // commit transaction so that we have a insurance information
                mysqli_commit($database_connection);

                if ( $_SESSION['login_name'] == 'guest')            // Alternate route, non-functional  -> ( strpos($SQL_String, '*') > 0 )
                {
                    return $row_data;
                }
                else
                {
                    return $sql_result;
                }
            }
            else
            {
                return "ERROR OPENING DATABASE";
            }
        }
    }
</script>

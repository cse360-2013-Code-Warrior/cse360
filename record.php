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
    
        public function RECORD_medical(user_id)
        {

        }
    }

</script>

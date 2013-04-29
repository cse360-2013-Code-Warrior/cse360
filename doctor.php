<script language="php">
    session_start();
    include 'database.php';
    include 'record.php';

    class DOCTOR
    {
        public function DOCTOR_header()
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body  background="background_image.jpg">' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.$_SESSION['Website'] );
            print ( '            </title>' );
        }
    
        public function DOCTOR_selection()
        {
            switch( $_SESSION['Selection'] )
            {
                case 'Update Personal Information':
                    $personal_record = new RECORD;
                    $personal_record->RECORD_personal();
                    $personal_record = NULL;
                    unset($_SESSION['Selection']);
                    break;

                case 'Account Administration':
                    include('admin_accounts.php');
                    unset($_SESSION['Selection']);
                    break;

                case 'Accounts Post':
                    $database_connection = new database_SQL;
                    
                    if( $_SESSION['Account Modify'] == 'Modify' )
                    {
                        $query_login = "UPDATE personal SET user_name_first='".$_SESSION['pst_user_name_first']."', user_name_last='".$_SESSION['pst_user_name_last']."', user_name_doctor='".$_SESSION['pst_user_name_doctor']."', user_name_doctor2='".$_SESSION['pst_user_name_doctor2']."',  user_name_login='".$_SESSION['pst_user_name_login']."', user_name_email='".$_SESSION['pst_user_name_email']."', user_name_password='".$_SESSION['pst_user_name_password']."', user_name_admin_approved='".$_SESSION['pst_user_name_admin_approved']."', user_name_active='".$_SESSION['pst_user_name_active']."', user_name_description='".$_SESSION['pst_user_name_description']."' WHERE user_id='".$_SESSION['pst_user_id']."'";

                        //  Running Query
                        $user_exists = $database_connection->SQL_command( $query_login );
    
                        if( $user_exists == TRUE )
                        {
                            $_SESSION['register_sucess'] = TRUE;
                            print('<br>');
                            print('<br>');
                            print('<br>');
                            print('<br>Account successfully modified.');
                        }
                        else
                        {
                            print('<br>');
                            print('<br>');
                            print_r($query_login);
                            print('<br>');
                            print('<br>Query failed to update database.');
                            print('<br>Please try again.');
                        }
                    }
                    // unset all previously set terms
                    unset($_SESSION['Selection']);
                    break;

                case 'Server Information':
                    phpinfo();
                    unset($_SESSION['Selection']);
                    break;

                case "Admin":
                    print('<br>');
                    print('<br>');
                    print('<br>');
                    print('<pre>');
                    print('<table>');
            
                    //  Account Administration
                    print('<tr><td>');
                    print( '<form action="admin_post.php" method="post">' );
                    print( '<input type="submit" name="Menu_Selection" value="Account Administration">' );
                    print( '</form>' );
                    print('</td>');
                    print('<td>');
                    print(' - enable or disable account access');
                    print('</td></tr>');
            
                    //  Server Information
                    print('<tr><td>');
                    print( '<form action="admin_post.php" method="post">' );
                    print( '<input type="submit" name="Menu_Selection" value="Server Information">' );
                    print( '</form>' );
                    print('</td>');
                    print('<td>');
                    print(' - display current php information');
                    print('</td></tr>');
            
                    print('</table>');
                    print('</pre>');
                    unset($_SESSION['Selection']);
                    break;

                case "UNKNOWN":
                    include( 'news.txt' );
                    break;

                case "Logout":
                    header( "location:logout.php" );
                    break;

                case "Medical Visit Information":
                    print('<br>');
                    print('<br>');
                    print('<br>');
                    print('<pre>');
                    print('<table>');
            
                    //  Enter new record information
                    print('<tr><td>');
                    print( '<form action="index.php" method="post">' );
                    print( '<input type="submit" name="Menu_Selection" value="New Visit  ">' );
                    print( '</form>' );
                    print('</td>');
                    print('<td>');
                    print(' - Enter new record information for a patient under your care');
                    print('</td></tr>');
            
                    //  View Previous record
                    print('<tr><td>');
                    print( '<form action="index.php" method="post">' );
                    print( '<input type="submit" name="Menu_Selection" value="Past Visit  ">' );
                    print( '</form>' );
                    print('</td>');
                    print('<td>');
                    print(' - View the information for a patient from a previous visit ');
                    print('</td></tr>');
            
                    print('</table>');
                    print('</pre>');
                    unset($_SESSION['Selection']);
                    break;

                case "Medical Staff":
                    if( $_SESSION['login_type'] =='doctor' )
                    {
                        $query          = "SELECT * FROM personal WHERE user_name_doctor='".$_SESSION['login_name']."' OR user_name_doctor2='".$_SESSION['login_name']."'";
                    }
                    if( $_SESSION['login_type'] =='staff' )
                    {
                        $query          = "SELECT * FROM personal WHERE user_id='".$_SESSION['login_id']."'";
                        $sql_connection = new database_SQL;
                        $sql_result_doc = $sql_connection->SQL_command( $query );
                        $row_data       = mysqli_fetch_array( $sql_result_doc, MYSQLI_ASSOC );
                        $query          = "SELECT * FROM personal WHERE user_name_doctor='".$row_data['user_name_doctor']."' OR user_name_doctor2='".$row_data['user_name_doctor']."'";
                    }

                    $sql_connection = new database_SQL;
                    $sql_result_doc = $sql_connection->SQL_command( $query );
                
                    while( $row_data = mysqli_fetch_array( $sql_result_doc, MYSQLI_ASSOC ) )
                    {
                        print('<form action="admin_accounts_post.php" method="post">');
                        print('<pre>');
                
                        print('Account ID          ');
                        print('<input type="text" name="pst_user_id" size="'.strlen($row_data['user_id']).'" value="'.$row_data['user_id'].'" readonly> ');
                        print('<br>');
                
                        print('First Name          ');
                        print('<input type="text" name="pst_user_name_first" size="'.strlen($row_data['user_name_first']).'" value="'.$row_data['user_name_first'].'"> ');
                        print('<br>');
                    
                        print('Last Name           ');
                        print('<input type="text" name="pst_user_name_last" size="'.strlen($row_data['user_name_last']).'" value="'.$row_data['user_name_last'].'"> ');
                        print('<br>');
                    
                        print('Primary Doctor      ');
                        print('<input type="text" name="pst_user_name_doctor" size="64" value="'.$row_data['user_name_doctor'].'"> ');
                        print('<br>');

                        $query          = "SELECT * FROM contact WHERE user_id='".$row_data['user_id']."'";
                        $sql_connection = new database_SQL;
                        $sql_result     = $sql_connection->SQL_command( $query );
                        $row_data       = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC );

                        print('Phone               ');
                        print('<input type="text" name="pst_contact_phone" size="'.strlen($row_data['contact_phone']).'" value="'.$row_data['contact_phone'].'"> ');
                        print('<br>');
                    
                        print('Address             ');
                        print('<input type="text" name="pst_contact_address" size="'.strlen($row_data['contact_address']).'" value="'.$row_data['contact_address'].'"> ');
                        print('<br>');
                    
                        print('City                ');
                        print('<input type="text" name="pst_contact_city" size="'.strlen($row_data['contact_city']).'" value="'.$row_data['contact_city'].'"> ');
                        print('<br>');
                        
                        print('ZIP                 ');
                        print('<input type="text" name="pst_contact_zip" size="'.strlen($row_data['contact_zip']).'" value="'.$row_data['contact_zip'].'"> ');
                        print('<br>');
                        
                        $query          = "SELECT * FROM pharmacy WHERE user_id='".$row_data['user_id']."'";
                        $sql_connection = new database_SQL;
                        $sql_result     = $sql_connection->SQL_command( $query );
                        $row_data       = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC );

                        print('Pharmacy Name       ');
                        print('<input type="text" name="pst_pharmacy_name" size="'.strlen($row_data['pharmacy_name']).'" value="'.$row_data['pharmacy_name'].'"> ');
                        print('<br>');
                    
                        print('Pharmacy Address    ');
                        print('<input type="text" name="pst_pharmacy_address" size="'.strlen($row_data['pharmacy_address']).'" value="'.$row_data['pharmacy_address'].'"> ');
                        print('<br>');
                    
                        print('Pharmacy City       ');
                        print('<input type="text" name="pst_pharmacy_city" size="'.strlen($row_data['pharmacy_city']).'" value="'.$row_data['pharmacy_city'].'"> ');
                        print('<br>');
                        
                        print('Pharmacy Phone      ');
                        print('<input type="text" name="pst_pharmacy_phone" size="'.strlen($row_data['pharmacy_phone']).'" value="'.$row_data['pharmacy_phone'].'"> ');
                        print('<br>');
                    
                        print('<br>');
                        print('       <input name="Modify" type="submit" value="Modify" >');
                    
                        print('<br>');
                        print('<br>');
                        print('<pre>');
                        print('</form>');
                    }
                    print('</table>');

                    unset($_SESSION['Selection']);
                    break;

                case "New Visit  ":
                    print( '<form action="index.php" method="post">' );
                    if( $_SESSION['login_type'] =='doctor' )
                    {
                        $query          = "SELECT * FROM personal WHERE user_name_doctor='".$_SESSION['login_name']."' OR user_name_doctor2='".$_SESSION['login_name']."' ORDER BY user_name_last ASC";
                    }
                    if( $_SESSION['login_type'] =='staff' )
                    {
                        $query          = "SELECT * FROM personal WHERE user_id='".$_SESSION['login_id']."'";
                        $sql_connection = new database_SQL;
                        $sql_result_doc = $sql_connection->SQL_command( $query );
                        $row_data       = mysqli_fetch_array( $sql_result_doc, MYSQLI_ASSOC );
                        $query          = "SELECT * FROM personal WHERE user_name_doctor='".$row_data['user_name_doctor']."' OR user_name_doctor2='".$row_data['user_name_doctor']."' ORDER BY user_name_last ASC";
                    }
                    $sql_connection = new database_SQL;
                    $sql_result_doc = $sql_connection->SQL_command( $query );

                    print('<select name="USER_ID_Selected">');
                    while( $row_data = mysqli_fetch_array( $sql_result_doc, MYSQLI_ASSOC ) )
                    {
                        print('<option value="'.$row_data['user_id'].'">'.$row_data['user_name_last'].',   '.$row_data['user_name_first'].'</option>');
                    }
                    print('</select>');
                    print('<br>');
                    print( '<input type="submit" name="Menu_Selection" value="New Visit">' );
                    print('<br>');
                    print('<br>');
                    print('<pre>');
                    print('</form>');
                    unset($_SESSION['Selection']);
                    break;

                case "Past Visit  ":
                    print( '<form action="index.php" method="post">' );
                    if( $_SESSION['login_type'] =='doctor' )
                    {
                        $query          = "SELECT * FROM personal WHERE user_name_doctor='".$_SESSION['login_name']."' OR user_name_doctor2='".$_SESSION['login_name']."' ORDER BY user_name_last ASC";
                    }
                    if( $_SESSION['login_type'] =='staff' )
                    {
                        $query          = "SELECT * FROM personal WHERE user_id='".$_SESSION['login_id']."'";
                        $sql_connection = new database_SQL;
                        $sql_result_doc = $sql_connection->SQL_command( $query );
                        $row_data       = mysqli_fetch_array( $sql_result_doc, MYSQLI_ASSOC );
                        $query          = "SELECT * FROM personal WHERE user_name_doctor='".$row_data['user_name_doctor']."' OR user_name_doctor2='".$row_data['user_name_doctor']."' ORDER BY user_name_last ASC";
                    }
                    $sql_connection = new database_SQL;
                    $sql_result_doc = $sql_connection->SQL_command( $query );

                    print('<select name="USER_ID_Selected">');
                    while( $row_data = mysqli_fetch_array( $sql_result_doc, MYSQLI_ASSOC ) )
                    {
                        print('<option value="'.$row_data['user_id'].'">'.$row_data['user_name_last'].',   '.$row_data['user_name_first'].'</option>');
                    }
                    print('</select>');
                    print('<br>');
                    print( '<input type="submit" name="Menu_Selection" value="Past Visits">' );
                    print('<br>');
                    print('<br>');
                    print('<pre>');
                    print('</form>');
                    unset($_SESSION['Selection']);
                    break;

                case "New Visit":
                    $personal_record = new RECORD;
                    $personal_record->RECORD_add($_SESSION['USER_ID_Selected']);
                    $personal_record = NULL;
                    unset($_SESSION['USER_ID_Selected']);
                    unset($_SESSION['Selection']);
                    break;

                case "Past Visits":
                    $personal_record = new RECORD;
                    $personal_record->RECORD_medical_view($_SESSION['USER_ID_Selected']);
                    $personal_record = NULL;
                    unset($_SESSION['Selection']);
                    break;

                default:
                    print_r( $_SESSION );
                    print( "<BR><BR><BR>" );
                    print( "You choose:  " );
                    print_r( $_SESSION['Selection'] );
                    break;
            }
        }

        public function DOCTOR_menu()
        {
            print( '                <table border="1" width="100%" cellpadding="10%">' );
            print( '                <tr>' );
            print( '                <td width="20%" valign="top">' );
            print( '                <br>' );
            print( '                <a href="index.php">' );
            print( '                Homepage' );
            print( '                </a>' );
    
            print ( '                <br>' );
            print ( "                <br><pre>User:    ".$_SESSION['login_name'] );
            print ( "                <br>Your IP: ".$_SERVER['REMOTE_ADDR']."</pre>" );
            print ( '                <ul>' );
    
            print( '<li>');
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Update Personal Information">' );
            print( '</form>' );
            print( '</li>');
    
            print ( '               </ul>' ) ;
            print ( '<pre>' );
    
            print ( "<ul>" );
    
            print( '<li>');
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Medical Visit Information">' );
            print( '</form>' );
            print( '</li>');

            print ( '<li>' );
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Medical Staff">' );
            print( '</form>' );
            print ( '</li>' );
    
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Admin">' );
            print( '</form>' );

            print( '<li>');
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Logout">' );
            print( '</form>' );
            print( '</li>');
    
            print('</pre>');
    
            print ( '               </td>' );
            print ( '               <td width="80%" valign="top" id="view_page_data">' );
            print ( '               <b>' );
    
            // Seeing if any accounts have no doctor or are not active
            $query          = "SELECT * FROM personal";
            $sql_connection = new database_SQL;
            $sql_result_doc = $sql_connection->SQL_command( $query );
            print('<BR>Accounts awaiting activation:<BR>');
            print('<pre>');
            print( '                <table border="1" width="100%" cellpadding="10%">' );
            print('    <tr><td>Last Name</td><td>First Name</td><td>User Login</td></tr>');
            while( $row_data = mysqli_fetch_array( $sql_result_doc, MYSQLI_ASSOC ) )
            {
                if( $row_data['user_name_active'] == NULL )
                {
                    print('<b><tr><td>'.$row_data['user_name_last'].'</td><td>'.$row_data['user_name_first'].'</td><td>'.$row_data['user_name_login'].'</tr></b>' );
                }
            }
            print('</table></pre><BR><BR>');

            print('<b>Users awaiting a doctor assignment<BR>');
            print('<pre>');
            $query          = "SELECT * FROM personal ";
            $sql_connection = new database_SQL;
            $sql_result_doc = $sql_connection->SQL_command( $query );
            print( '                <table border="1" width="100%" cellpadding="10%">' );
            print('    <tr><td>Last Name</td><td>First Name</td><td>User Login</td></tr>');
            while( $row_data = mysqli_fetch_array( $sql_result_doc, MYSQLI_ASSOC ) )
            {
                if( ($row_data['user_name_doctor'] == NULL) && ($row_data['user_name_doctor2'] == NULL) )
                {
                    print('<b><tr><td>'.$row_data['user_name_last'].'</td><td>'.$row_data['user_name_first'].'</td><td>'.$row_data['user_name_login'].'</td></tr></b>' );
                }
            }
            print('</table></pre></b><BR><BR>');
            
            // seeing what was selected if anything
            if( isset($_SESSION['Selection']) == TRUE )
            {
                $this->DOCTOR_selection();
            }
            else
            {
                include( 'news.txt' );
            }

            print ( '               </b>' );
            print ( '               </td>' );

        }

        public function DOCTOR_footer()
        {
            print ( '        </head>' );
            print ( '    </body>' );
            print ( '</html>' );
        }
    }

    //logging daily reports of visitors and actions
    $date = new DateTime();
    $logfile    = $_SERVER['DOCUMENT_ROOT'].'\\'.(date("Y_m_d")).'_daily_report.log'; 
    $log_event  = fopen( $logfile,'a' );
    fwrite($log_event, ((date("Y_m_d  H:i:s"))."\t".$_SERVER['REMOTE_ADDR']."\t".$_SESSION['login_name']."\t".$_SESSION['Selection']."\r\n") );

    $web_user = new DOCTOR();
    $web_user->DOCTOR_header( );
    $web_user->DOCTOR_menu( );
    $web_user->DOCTOR_footer( );
</script>

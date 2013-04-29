<script language="php">
    session_start();
    include 'database.php';
    include 'record.php';

    class ADMIN
    {
        public function ADMIN_header( )
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body>' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.$_SESSION['Website'] );
            print ( '            </title>' );
        }
    
        public function ADMIN_selection()
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

                case "Logout":
                    header( "location:logout.php" );
                    break;

                case "UNKNOWN":
                    include( 'news.txt' );
                    break;

                default:
                    print_r( $_SESSION );
                    print( "<BR><BR><BR>" );
                    print( "You choose:  " );
                    print_r( $_SESSION['Selection'] );
            }
        }

        public function ADMIN_menu(  )
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
            print( '<form action="admin_post.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Update Personal Information">' );
            print( '</form>' );
            print( '</li>');
    
            print ( '               </ul>' ) ;
            print ( '<pre>' );
    
            print ( "<ul>" );
            print( '<li>');    
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Admin">' );
            print( '</form>' );
            print( '</li>');

            print( '<li>');
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Logout">' );
            print( '</form>' );
            print( '</li>');
    
            print('</pre>');
    
            print ( '               </td>' );
            print ( '               <td width="80%" valign="top" id="view_page_data">' );
            print ( '               <b>' );
    
            // seeing what was selected if anything
            if( isset($_SESSION['Selection']) == TRUE )
            {
                $this->ADMIN_selection();
            }
            else
            {
                include( 'news.txt' );
            }

            print ( '               </b>' );
            print ( '               </td>' );

        }

        public function ADMIN_footer()
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

    //  Automatic garbage collection occures at end of script every time.
    $web_user = new ADMIN();
    $web_user->ADMIN_header( );
    $web_user->ADMIN_menu( );
    $web_user->ADMIN_footer( );
</script>

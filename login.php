<script language="php">
    session_start();

    include 'database.php';

    class LOGIN
    {
        public function LOGIN_header( )
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body  background="background_image.jpg">' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.($_SESSION['Website']) );
            print ( '            </title>' );
        }
    
        public function LOGIN_menu()
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
    
            print ( '               </ul>' ) ;
            print ( '<pre>' );
            print('</pre>');
    
            print ( '               </td>' );
            print ( '               <td width="80%" valign="top" id="view_page_data">' );
            print ( '               <b>' );

            if ( isset($_SESSION['user_name_post']) == False )
            {
                $this->LOGIN_print();
            }
            else
            {
                $this->LOGIN_user();
            }
        }

        public function LOGIN_footer()
        {
            print ( '        </head>' );
            print ( '    </body>' );
            print ( '</html>' );
        }

        public function LOGIN_print()
        {
            print('<br>');
            print('<br>');
            print('<br>');
            print('<pre>');
            print('<form action="login_post.php" method="post">');
            print('Username:  ');
            print('<input type="text" name="user_name_post">');
            print('<br>');
            print('Password:  ');
            print('<input type="password" name="user_password_post">');
            print('<br><br>');
            print('                <input type="submit" name="Menu_Selection" value="Login">');
            print('</form>');
            print('</pre>');
        }

        public function LOGIN_user()
        {
            $sql_connection = new database_SQL;

            $login_name     = $_SESSION['user_name_post'];
            $login_pass     = $_SESSION['user_password_post'];

            print( $login_name + "<BR>" );
            print( $login_pass + "<BR>" );

            $login_query    = "SELECT * FROM personal WHERE user_name_login='".$login_name."'";
            $sql_result     = $sql_connection->SQL_command( $login_query );
            $sql_result     = mysqli_fetch_array($sql_result, MYSQLI_ASSOC);

            if( count($sql_result) > 0 )
            {
                if( ($login_pass == $sql_result['user_name_password']) && ( $login_name == $sql_result['user_name_login']) && ( 'Y' == strtoupper($sql_result['user_name_active'])))
                {
                    $_SESSION['login_name']          = $login_name;
                    $_SESSION['login_address']       = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['login_active']        = strtoupper($sql_result['user_name_active']);
                    $_SESSION['login_admin']         = strtoupper($sql_result['user_name_admin_approved']);
                    $_SESSION['login_type']          = $sql_result['user_name_description'];
                    $_SESSION['login_id']            = $sql_result['user_id'];

                    $login_query    = "INSERT INTO web_tracking(user_id, web_tracking_browser, web_tracking_ip, web_tracking_session_id) VALUES('".$_SESSION['login_id']."', '".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['REMOTE_ADDR']."', '".session_id()."')";
                    $sql_result     = $sql_connection->SQL_command( $login_query );

                    unset( $_SESSION['Selection'] );

                    header("location:index.php");
                }
                else
                {
                    $_SESSION['login_failed'] = "Incorrect password";
                    // Ending session
                    session_destroy();
                }
            }
            else
            {
                print( "<BR>Unable to verify login<BR>" );
                // Ending session
                session_destroy();
            }
        }
    }

    //logging daily reports of visitors and actions
    $date = new DateTime();
    $logfile    = $_SERVER['DOCUMENT_ROOT'].'\\'.(date("Y_m_d")).'_daily_report.log'; 
    $log_event  = fopen( $logfile,'a' );
    fwrite($log_event, ((date("Y_m_d  H:i:s"))."\t".$_SERVER['REMOTE_ADDR']."\t".$_SESSION['login_name']."\tLogging In\r\n") );

    $web_user = new LOGIN();
    $web_user->LOGIN_header( );
    $web_user->LOGIN_menu( );
    $web_user->LOGIN_footer( );
</script>

<script language="php">
    session_start();

    include 'database.php';

    class LOGIN
    {
        public function LOGIN_header( )
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body>' );
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

            print_r( $sql_result );

            if( count($sql_result) > 0 )
            {
                if( ($login_pass == $sql_result['user_name_password']) && ( $login_name == $sql_result['user_name_login']) && ( 'Y' == strtoupper($sql_result['user_name_active'])))
                {
                    $_SESSION['login_name']          = $login_name;
                    $_SESSION['login_address']       = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['login_active']        = strtoupper($sql_result['user_name_active']);
                    $_SESSION['login_admin']         = strtoupper($sql_result['user_name_admin_approved']);
                    $_SESSION['login_type']          = $sql_result['user_name_description'];

                    header("location:index.php");
                }
                else
                {
                    $_SESSION['login_failed'] = "Incorrect password";
                }
            }
            else
            {
                print( "<BR>Unable to verify login<BR>" );
                $_SESSION['login_failed'] = "No such user id";
            }
        }
    }


    $web_user = new LOGIN();
    $web_user->LOGIN_header( );
    $web_user->LOGIN_menu( );
    $web_user->LOGIN_footer( );
</script>

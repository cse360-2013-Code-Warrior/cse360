

<script language="php">
    session_start();

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

            $this->register_print();

        }

        public function LOGIN_footer()
        {
            print ( '        </head>' );
            print ( '    </body>' );
            print ( '</html>' );
        }

        public function LOGIN_print()
        {
            print ( '            <form action="guest.php" method="post">' );
            print ( '                <pre><BR>' );

            print ( '                    First Name               <input type="text" name="user_name_first"><BR>' );
            print ( '                    Last Name                <input type="text" name="user_name_last"><BR>' );
            print ( '                    SSN                      <input type="text" name="user_ssn"><BR>' );
            print ( '                    Username                 <input type="text" name="user_name_login"><BR>' );
            print ( '                    Password                 <input type="password" name="user_name_password"><BR>' );
            print ( '                    Re-enter Password        <input type="password" name="user_name_password"><BR>' );
            print ( '                    Email                    <input type="text" name="user_name_email"><BR>' );
            print ( '                    <BR>' ); 

            print ( '                    Mailing Address          <input type="text" name="contact_address"><BR>' );
            print ( '                    Mailing City             <input type="text" name="contact_city"><BR>' );
            print ( '                    Mailing Zip Code         <input type="text" name="contact_zip"><BR>' );
            print ( '                    Contact phone number     <input type="text" name="contact_phone"><BR>' );
            print ( '                    <BR>' );

            print ( '                    Pharmacy Name            <input type="text" name="pharmacy_name"><BR>' );
            print ( '                    Pharmacy Address         <input type="text" name="pharmacy_address"><BR>' );
            print ( '                    Pharmacy City            <input type="text" name="pharmacy_city"><BR>' );
            print ( '                    Pharmacy Phone           <input type="text" name="pharmacy_phone"><BR>' );
            print ( '                    <BR>' );

            print ( '                    <input type="submit" name="Menu_Selection" value="Submit Registration">' );
            print ( '                </pre><BR>' );
            print ( '            </form>' );
        }
        
        public function LOGIN_user( )
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body>' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.($_SESSION['Website']) );
            print ( '            </title>' );
        }
        
                public function login_user()
        {
            $sql_connection = new database_SQL;

            $login_name     = strtoupper($_POST['user_name_post']);
            $login_pass     = $_POST['user_password_post'];


            $login_query    = "SELECT * FROM personal WHERE user_name_login='".$login_name."'";
            $sql_result     = $sql_connection->SQL_command( $login_query );

            if( count($sql_result) > 0 )
            {
                if( ($login_pass == $sql_result['user_name_password']) && ( $login_name == $sql_result['user_name_login']) && ( 'Y' == $sql_result['user_name_active']))
                {
                    $_SESSION['login_name']          = $login_name;
                    $_SESSION['login_address']       = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['login_active']        = $sql_result['user_name_active'];
                    $_SESSION['login_admin']         = $sql_result['user_name_admin_approved'];
                    $_SESSION['login_description']   = $sql_result['user_name_description'];
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
        
                public function login_print()
        {
            print('<br>');
            print('<br>');
            print('<br>');
            print('<pre>');
            print('<form action="index.php" method="post">');
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
    

    }


    $web_user = new HTML();
    $web_user->HTML_header( );
    $web_user->HTML_menu( );
    $web_user->HTML_footer( );
</script>

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

            $this->LOGIN_print();
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
    }


    $web_user = new LOGIN();
    $web_user->LOGIN_header( );
    $web_user->LOGIN_menu( );
    $web_user->LOGIN_footer( );
</script>

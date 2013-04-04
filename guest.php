<script language="php">
    session_start();

    include 'database.php';

    if( isset($_POST['Menu_Selection']) == TRUE )
    {
        $_SESSION['Selection'] =  $_POST['Menu_Selection'];
    }

    class GUEST
    {
        public function GUEST_header( )
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body>' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.($_SESSION['Website']) );
            print ( '            </title>' );
        }
    
        public function GUEST_selection( )
        {
            switch( $_SESSION['Selection'] )
            {
                case "Register":
                    header( "location:register.php" );
                    exit();
                    //$this->register_print();
                    break;

                case "Sign In":
                    //$this->login_print();
                    break;

                default:
                    print( 'You choose:  '.$web_selection );
            }
        }

        public function GUEST_menu()
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
    
            print( '<br>');
            print( '<li>');
            print( '<form action="register.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Register">' );
            print( '</form>' );

            print( '<li>');
            print( '<form action="login.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Sign In">' );
            print( '</form>' );
   
            print ( '               </ul>' ) ;
            print ( '<pre>' );
            print('</pre>');
    
            print ( '               </td>' );
            print ( '               <td width="80%" valign="top" id="view_page_data">' );
            print ( '               <b>' );
    
            include( 'news.txt' );

            print ( '               </b>' );
            print ( '               </td>' );

        }

        public function GUEST_footer()
        {
            print ( '        </head>' );
            print ( '    </body>' );
            print ( '</html>' );
        }
    }


    $web_user = new GUEST();
    $web_user->GUEST_header( );
    $web_user->GUEST_menu( );
    $web_user->GUEST_footer( );
</script>

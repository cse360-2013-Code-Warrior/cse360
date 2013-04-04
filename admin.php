<script language="php">
    session_start();

    include "database.php" ;

    if( isset($_POST['Menu_Selection']) == TRUE )
    {
        $web_selection = $_POST['Menu_Selection'];
    }

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
    
        public function ADMIN_selection( $web_selection )
        {
            switch( $web_selection )
            {
                case "Register":
                    $this->register_print();
                    break;

                case "Sign In":
                    $this->login_print();
                    break;

                case "Login":
                    $this->login_user();
                    break;

                default:
                    print( 'You choose:  '.$web_selection );
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
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Update Personal Information">' );
            print( '</form>' );
            print( '</li>');
    
            print ( '               </ul>' ) ;
            print ( '<pre>' );
    
            print ( "<ul>" );
    
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
    
            // seeing what was selected if anything
            if( isset($_POST['Menu_Selection']) == TRUE )
            {
                $this->ADMIN_selection( $_POST['Menu_Selection'] );
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


    //  Automatic garbage collection occures at end of script every time.
    $web_user = new ADMIN();
    $web_user->ADMIN_header( );
    $web_user->ADMIN_menu( );
    $web_user->ADMIN_footer( );
</script>

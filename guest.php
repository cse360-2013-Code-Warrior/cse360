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
            print ( '    <body  background="background_image.jpg">' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.($_SESSION['Website']) );
            print ( '            </title>' );
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
    
            if( isset($_SESSION['Selection']) == TRUE)
            {
                print( '<BR>Registration completed.  <BR>Awaiting doctor office to approve account request.  <BR>When approved you will recieve an email confirming activation of account.<BR><BR>' );
                unset($_SESSION['Selection']);
            }
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

    //logging daily reports of visitors and actions
    $date = new DateTime();
    $logfile    = $_SERVER['DOCUMENT_ROOT'].'\\'.(date("Y_m_d")).'_daily_report.log'; 
    $log_event  = fopen( $logfile,'a' );
    fwrite($log_event, ((date("Y_m_d  H:i:s"))."\t".$_SERVER['REMOTE_ADDR']."\t".$_SESSION['login_name']."\t".$_SESSION['Selection']."\r\n") );

    $web_user = new GUEST();
    $web_user->GUEST_header( );
    $web_user->GUEST_menu( );
    $web_user->GUEST_footer( );
</script>

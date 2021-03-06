<script language="php">
    session_start();
    include 'database.php';
    include 'record.php';

    class PATIENT
    {
        public function PATIENT_header()
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body  background="background_image.jpg">' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.$_SESSION['Website'] );
            print ( '            </title>' );
        }
    
        public function PATIENT_selection()
        {
            switch( $_SESSION['Selection'] )
            {
                case 'Update Personal Information':
                    $personal_record = new RECORD;
                    $personal_record->RECORD_personal();
                    $personal_record = NULL;
                    unset($_SESSION['Selection']);
                    break;

                case "Logout":
                    header( "location:logout.php" );
                    break;

                case "UNKNOWN":
                    include( 'news.txt' );
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
                    print( '<input type="submit" name="Menu_Selection" value="New Visit">' );
                    print( '</form>' );
                    print('</td>');
                    print('<td>');
                    print(' - Enter new record information for a patient under your care');
                    print('</td></tr>');
            
                    //  View Previous record
                    print('<tr><td>');
                    print( '<form action="index.php" method="post">' );
                    print( '<input type="submit" name="Menu_Selection" value="Past Visits">' );
                    print( '</form>' );
                    print('</td>');
                    print('<td>');
                    print(' - View the information for a patient from a previous visit ');
                    print('</td></tr>');
            
                    print('</table>');
                    print('</pre>');
                    unset($_SESSION['Selection']);
                    break;

                case "New Visit":
                    $personal_record = new RECORD;
                    $personal_record->RECORD_add($_SESSION['login_id']);
                    $personal_record = NULL;
                    unset($_SESSION['Selection']);
                    break;

                case "Past Visits":
                    $personal_record = new RECORD;
                    $personal_record->RECORD_medical_view($_SESSION['login_id']);
                    $personal_record = NULL;
                    unset($_SESSION['Selection']);
                    break;

                default:
                    print_r( $_SESSION );
                    print( "<BR><BR><BR>" );
                    print( "You choose:  " );
                    print_r( $_SESSION['Selection'] );
            }
        }

        public function PATIENT_menu()
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
                $this->PATIENT_selection();
            }
            else
            {
                include( 'news.txt' );
            }

            print ( '               </b>' );
            print ( '               </td>' );

        }

        public function PATIENT_footer()
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

    $web_user = new PATIENT();
    $web_user->PATIENT_header( );
    $web_user->PATIENT_menu( );
    $web_user->PATIENT_footer( );
</script>

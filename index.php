<script language="php">
    ////////////////////////////////////////////////////////////////////////////
    //  Automatic garbage collection occures at end of script every time.
    //  Because of this we will store variables on the server side using 
    //  the session object.
    ////////////////////////////////////////////////////////////////////////////

    session_start() or exit(basename(__FILE__).'(): Could not start session');

    // variables
    $_SESSION['Website']   = "CSE360 Medical Database";

    // If there is no username variable yet (session just created) create it and assign 'guest'
    if( isset($_SESSION['login_name']) == FALSE )
    {
        $_SESSION['login_name'] = 'guest';
        $_SESSION['login_type'] = 'guest';
    }

    if( isset($_POST['Menu_Selection']) == TRUE )
    {
        $_SESSION['Selection'] = $_POST['Menu_Selection'];
    }

    if( isset($_SESSION['Selection']) == FALSE )
    {
        $_SESSION['Selection']  = 'UNKNOWN';
    }
</script>
    
<script language="php">

    class Web_Menu
    {
        public function Menu_selection( )
        {
            //  header("location:main.php");
            switch( $_SESSION['login_type'] )
            {
                case "guest":
                    header( "location:guest.php" );
                    //header( "location:guest.php?" . session_name() . '=' . session_id() );
                    exit();
                    break;

                case "admin":
                    header("location:admin.php");
                    break;

                case "doctor":
                    header("location:doctor.php");
                    break;

                case "staff":
                    header("location:staff.php");
                    break;

                case "patient":
                    header("location:patient.php");
                    break;

                default:
                    print( 'You choose:  '.$_SESSION['login_type'] );
            }
        }

    }


    $web_user = new Web_Menu();
    $web_user->Menu_selection( );

</script>

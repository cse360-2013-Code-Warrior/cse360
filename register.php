<script language="php">
    session_start();

    include 'database.php';

    class REGISTER
    {
        public function REGISTER_header( )
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body>' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.($_SESSION['Website']) );
            print ( '            </title>' );
        }
    
        public function REGISTER_menu()
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

        public function REGISTER_footer()
        {
            print ( '        </head>' );
            print ( '    </body>' );
            print ( '</html>' );
        }

        public function REGISTER_print()
        {
            if( isset($_POST['user_name_password']) == TRUE )
            {
                $this->REGISTER_add();
                print( "True" );
                unset($_POST['Menu_Selection']);
                return;
            }

            //if( isset($_POST['Menu_Selection']) == FALSE )
            //{
                print ( '            <form action="register.php" method="post">' );
                print ( '                <pre><BR>' );
    
                print ( '                    First Name               <input type="text" name="user_name_first"><BR>' );
                print ( '                    Last Name                <input type="text" name="user_name_last"><BR>' );
                print ( '                    SSN                      <input type="text" name="user_ssn"><BR>' );
                print ( '                    Username                 <input type="text" name="user_name_login"><BR>' );
                print ( '                    Password                 <input type="password" name="user_name_password"><BR>' );
                print ( '                    Re-enter Password        <input type="password" name="user_name_password2"><BR>' );
                print ( '                    Email                    <input type="text" name="user_name_email"><BR>' );
                print ( '                    <BR>' ); 

                print ( '                    <BR>' ); 
                print ( '                    Doctor                    <input type="text" name="user_name_doctor"><BR>' );
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
            //}
        }

        public function REGISTER_add()
        {
            $database_connection = new database_SQL;

            $first_name     = $_POST['user_name_first'];
            $last_name      = $_POST['user_name_last'];
            $email_data     = $_POST['user_name_email'];
            $user_name      = strtoupper($_POST['user_name_login']);
            $password_data  = $_POST['user_name_password'];
            $doctor_name    = $_POST['user_name_doctor'];
            $SSN            = $_POST['user_ssn'];
            $phone          = $_POST['pharmacy_phone'];
            $address        = $_POST['contact_address'];
            $city           = $_POST['contact_city'];
            $zip            = $_POST['contact_zip'];
            $pharmacy_name  = $_POST['pharmacy_name'];
            $pharmacy_addr  = $_POST['pharmacy_address'];
            $pharmacy_city  = $_POST['pharmacy_city'];
            $pharmacy_ph    = $_POST['pharmacy_phone'];

            $query_login = "INSERT INTO personal(user_name_first, user_name_last, user_ssn, user_name_login, user_name_password, user_name_email, user_name_description, user_name_doctor, user_name_admin_approved, user_name_active) VALUES('".$first_name."', '".$last_name."', '".$SSN."', '".$user_name."', '".$password_data."', '".$email_data."', 'patient', '".$doctor_name."', 'N','N')";
            $database_connection->SQL_command( $query_login );
            header("location:index.php");
        }
    }


    $web_user = new REGISTER();
    $web_user->REGISTER_header( );
    $web_user->REGISTER_menu( );
    $web_user->REGISTER_footer( );
</script>

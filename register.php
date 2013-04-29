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


            if( isset($_SESSION['user_name_password']) == TRUE )
            {
                if( $_SESSION['user_name_password'] != $_SESSION['user_name_password2'] )
                {
                    print( "<BR>MISMATCH Password<BR>PASSWORDS FIELDS MUST HAVE SAME PASSWORD ENTERED<BR><BR>" );
                    $this->register_print();
                    return;
                }

                $this->REGISTER_add();
                return;
            }

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
            if( isset($_SESSION['user_name_password']) == TRUE )
            {
                print ( '            <form action="register_post.php" method="post">' );
                print ( '                <pre><BR>' );
                print ( '                    First Name               <input type="text" value="' . $_SESSION["user_name_first"] . '" name="user_name_first"><BR>' );
                print ( '                    Last Name                <input type="text" value="' . $_SESSION["user_name_last"]  . '" name="user_name_last"><BR>' );
                print ( '                    SSN                      <input type="text" value="' . $_SESSION["user_ssn"]        . '" name="user_ssn"><BR>' );
                print ( '                    Username                 <input type="text" value="' . $_SESSION["user_name_login"] . '" name="user_name_login"><BR>' );
                print ( '                    Password                 <input type="password" name="user_name_password"><BR>' );
                print ( '                    Re-enter Password        <input type="password" name="user_name_password2"><BR>' );
                print ( '                    Email                    <input type="text" value="' . $_SESSION['user_name_email'] . '" name="user_name_email"><BR>' );
                print ( '                    <BR>' ); 
    
                print ( '                    <BR>' ); 
                print ( '                    Doctor                   <input type="text" value="' . $_SESSION["user_name_doctor"] . '" name="user_name_doctor"><BR>' );
                print ( '                    <BR>' ); 
    
                print ( '                    Mailing Address          <input type="text" value="' . $_SESSION["contact_address"] . '" name="contact_address"><BR>' );
                print ( '                    Mailing City             <input type="text" value="' . $_SESSION["contact_city"]    . '" name="contact_city"><BR>' );
                print ( '                    Mailing Zip Code         <input type="text" value="' . $_SESSION["contact_zip"]     . '" name="contact_zip"><BR>' );
                print ( '                    Contact phone number     <input type="text" value="' . $_SESSION["contact_phone"]   . '" name="contact_phone"><BR>' );
                print ( '                    <BR>' );
    
                print ( '                    Pharmacy Name            <input type="text" value="' . $_SESSION["pharmacy_name"]    . '" name="pharmacy_name"><BR>' );
                print ( '                    Pharmacy Address         <input type="text" value="' . $_SESSION["pharmacy_address"] . '" name="pharmacy_address"><BR>' );
                print ( '                    Pharmacy City            <input type="text" value="' . $_SESSION["pharmacy_city"]    . '" name="pharmacy_city"><BR>' );
                print ( '                    Pharmacy Phone           <input type="text" value="' . $_SESSION["pharmacy_phone"]   . '" name="pharmacy_phone"><BR>' );
                print ( '                    <BR>' );
    
                print ( '                    <input type="submit" name="Menu_Selection" value="Submit Registration">' );
                print ( '                </pre><BR>' );
                print ( '            </form>' );

                unset( $_SESSION['user_name_first'] );
                unset( $_SESSION['user_name_last'] );
                unset( $_SESSION['user_name_email'] );
                unset( $_SESSION['user_name_login'] );
                unset( $_SESSION['user_name_password'] );
                unset( $_SESSION['user_name_password2'] );
                unset( $_SESSION['user_name_doctor'] );
                unset( $_SESSION['user_ssn'] );
                unset( $_SESSION['contact_phone'] );
                unset( $_SESSION['contact_address'] );
                unset( $_SESSION['contact_city'] );
                unset( $_SESSION['contact_zip'] );
                unset( $_SESSION['pharmacy_name'] );
                unset( $_SESSION['pharmacy_address'] );
                unset( $_SESSION['pharmacy_city'] );
                unset( $_SESSION['pharmacy_phone'] );

                return;
            }

            print ( '            <form action="register_post.php" method="post">' );
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
            print ( '                    Doctor                   <input type="text" name="user_name_doctor"><BR>' );
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

        public function REGISTER_add()
        {
            $database_connection = new database_SQL;

            $first_name     = $_SESSION['user_name_first'];
            $last_name      = $_SESSION['user_name_last'];
            $email_data     = $_SESSION['user_name_email'];
            $user_name      = strtoupper($_SESSION['user_name_login']);
            $password_data  = $_SESSION['user_name_password'];
            $doctor_name    = strtoupper($_SESSION['user_name_doctor']);
            $SSN            = $_SESSION['user_ssn'];
            $phone          = $_SESSION['contact_phone'];
            $address        = $_SESSION['contact_address'];
            $city           = $_SESSION['contact_city'];
            $zip            = $_SESSION['contact_zip'];
            $pharmacy_name  = $_SESSION['pharmacy_name'];
            $pharmacy_addr  = $_SESSION['pharmacy_address'];
            $pharmacy_city  = $_SESSION['pharmacy_city'];
            $pharmacy_ph    = $_SESSION['pharmacy_phone'];

            unset( $_SESSION['user_name_first'] );
            unset( $_SESSION['user_name_last'] );
            unset( $_SESSION['user_name_email'] );
            unset( $_SESSION['user_name_login'] );
            unset( $_SESSION['user_name_password'] );
            unset( $_SESSION['user_name_password2'] );
            unset( $_SESSION['user_name_doctor'] );
            unset( $_SESSION['user_ssn'] );
            unset( $_SESSION['contact_phone'] );
            unset( $_SESSION['contact_address'] );
            unset( $_SESSION['contact_city'] );
            unset( $_SESSION['contact_zip'] );
            unset( $_SESSION['pharmacy_name'] );
            unset( $_SESSION['pharmacy_address'] );
            unset( $_SESSION['pharmacy_city'] );
            unset( $_SESSION['pharmacy_phone'] );
            unset( $_SESSION['Selection'] );

            $query_login = "INSERT INTO personal(user_name_first, user_name_last, user_ssn, user_name_login, user_name_password, user_name_email, user_name_description, user_name_doctor, user_name_admin_approved, user_name_active) VALUES('".$first_name."', '".$last_name."', '".$SSN."', '".$user_name."', '".$password_data."', '".$email_data."', 'patient', '".$doctor_name."', 'N','N')";
            $database_connection->SQL_command( $query_login );
            $database_connection = NULL;

            $database_connection = new database_SQL;
            $query_login = "SELECT * FROM personal WHERE user_name_first='".$first_name."' AND user_name_last='".$last_name."'";
            $sql_result  = $database_connection->SQL_command( $query_login );
            $row_data       = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC );

            $query_login = "INSERT INTO contact(user_id, contact_phone, contact_address, contact_city, contact_zip) VALUES('".$row_data['user_id']."', '".$phone."', '".$address."', '".$city."', '".$zip."')";
            $database_connection->SQL_command( $query_login );

            $query_login = "INSERT INTO pharmacy(user_id, pharmacy_name, pharmacy_address, pharmacy_city, pharmacy_phone) VALUES('".$row_data['user_id']."','".$pharmacy_name."', '".$pharmacy_addr."', '".$pharmacy_city."', '".$pharmacy_ph."')";
            $database_connection->SQL_command( $query_login );

            $_SESSION['Selection'] = 'Registration Completed';

            header("location:index.php");
        }
    }


    $web_user = new REGISTER();
    $web_user->REGISTER_header( );
    $web_user->REGISTER_menu( );
    $web_user->REGISTER_footer( );
</script>

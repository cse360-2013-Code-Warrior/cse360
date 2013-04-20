<script language="php">
    session_start();

    class DOCTOR
    {
        public function DOCTOR_header()
        {
            print ( '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transittional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' );
            print ( '<html>' );
            print ( '    <body>' );
            print ( '        <head>' );
            print ( '            <title>' );
            print ( '                '.$_SESSION['Website'] );
            print ( '            </title>' );
        }
    
        public function DOCTOR_selection()
        {
            switch( $_SESSION['Selection'] )
            {
                case 'Update Personal Information':
                    print("<BR>Only logged in personal can see thier information here");
                    print("<BR>Change / Update personal information (Last name, login, password, email, primary doctor");
                    print("<BR>Change / Update contact information");
                    print("<BR>Change / Update Insurance information");
                    unset($_SESSION['Selection']);
                    break;

                case 'Account Administration':
                    include('admin_accounts.php');
                    unset($_SESSION['Selection']);
                    break;

                case 'Accounts Post':
                    // unset all previously set terms
                    print_r( $_SESSION );
                    unset($_SESSION['Selection']);
                    break;

                case 'Server Information':
                    phpinfo();
                    unset($_SESSION['Selection']);
                    break;

                case "Admin":
                    print('<br>');
                    print('<br>');
                    print('<br>');
                    print('<pre>');
                    print('<table>');
            
                    //  Account Administration
                    print('<tr><td>');
                    print( '<form action="admin_post.php" method="post">' );
                    print( '<input type="submit" name="Menu_Selection" value="Account Administration">' );
                    print( '</form>' );
                    print('</td>');
                    print('<td>');
                    print(' - enable or disable account access');
                    print('</td></tr>');
            
                    //  Server Information
                    print('<tr><td>');
                    print( '<form action="admin_post.php" method="post">' );
                    print( '<input type="submit" name="Menu_Selection" value="Server Information">' );
                    print( '</form>' );
                    print('</td>');
                    print('<td>');
                    print(' - display current php information');
                    print('</td></tr>');
            
                    print('</table>');
                    print('</pre>');
                    unset($_SESSION['Selection']);
                    break;

                case "Logout":
                    header( "location:logout.php" );
                    break;

                default:
                    print_r( $_SESSION );
                    print( "<BR><BR><BR>" );
                    print( "You choose:  " );
                    print_r( $_SESSION['Selection'] );
            }
        }

        public function DOCTOR_menu()
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

            print ( '<li>' );
            print( '<form action="index.php" method="post">' );
            print( '<input type="submit" name="Menu_Selection" value="Medical Staff">' );
            print( '</form>' );
            print ( '</li>' );
    
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
            if( isset($_SESSION['Selection']) == TRUE )
            {
                $this->DOCTOR_selection();
            }
            else
            {
                include( 'news.txt' );
            }

            print ( '               </b>' );
            print ( '               </td>' );

        }

        public function DOCTOR_footer()
        {
            print ( '        </head>' );
            print ( '    </body>' );
            print ( '</html>' );
        }
    }

    $web_user = new DOCTOR();
    $web_user->DOCTOR_header( );
    $web_user->DOCTOR_menu( );
    $web_user->DOCTOR_footer( );
</script>
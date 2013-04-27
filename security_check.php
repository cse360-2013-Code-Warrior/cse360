<script language="php">
    //  Check to see if we have logged in and if the session login is from the same IP address, security checkpoint
    if( (isset($_SESSION['login_name']) == TRUE) && (isset($_SESSION['login_address']) == TRUE) )
    {
        //  Somebody is logged in
        if( $_SERVER['REMOTE_ADDR'] != $_SESSION['login_address'] )
        {
            //  Somebody logged in with this IP address and this Session ID but somehow changed thier IP address, odd error or malicious attack?
            session_destroy();

            //  session error page
            print("<BR>SECURITY ERROR:  We have detected somebody logged into this session from a different IP");
            print("<BR>SESSION CLOSED<BR>");
            print("<BR>REDIRECTING YOU IN 10 SECONDS");
            sleep(10);
            header( "location:index.php" );
        }
    }
</script>

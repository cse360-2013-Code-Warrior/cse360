<script language="php">
    session_start();
    // Ending session
    session_destroy();
</script>
<script language="php">
    // Sending user to index.php
    header( "location:index.php" );
</script>

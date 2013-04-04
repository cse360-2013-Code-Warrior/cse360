<script language="php">
    class database_SQL
    {
        public function SQL_command( $SQL_String )
        {
            print("database called <BR>");
            //  Check username and password against MySQL
            DEFINE('DB_USER', 'root');
            DEFINE('DB_PASSWORD', 'usbw');
            DEFINE('DB_HOST', 'localhost');
            DEFINE('DB_NAME', 'cse360');

            $database_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if( $database_connection == TRUE )
            {
                //  Setting auto commit to false
                mysqli_autocommit($database_connection, FALSE);

                $sql_result = mysqli_query($database_connection, $SQL_String);
                $row_data   = mysqli_fetch_array($sql_result, MYSQLI_ASSOC);

                // commit transaction so that we have a insurance information
                mysqli_commit($database_connection);

                return $row_data;
            }
            else
            {
                return "ERROR OPENING DATABASE";
            }
        }
    }
</script>

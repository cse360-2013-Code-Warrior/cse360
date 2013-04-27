<script language="php">

    $query          = "SELECT * FROM personal";
    $sql_connection = new database_SQL;
    $sql_result     = $sql_connection->SQL_command( $query );

    while( $row_data = mysqli_fetch_array( $sql_result, MYSQLI_ASSOC ) )
    {
        print('<form action="admin_accounts_post.php" method="post">');
        print('<pre>');

        print('Account ID          ');
        print('<input type="text" name="pst_user_id" size="'.strlen($row_data['user_id']).'" value="'.$row_data['user_id'].'" readonly> ');
        print('<br>');

        print('First Name          ');
        print('<input type="text" name="pst_user_name_first" size="'.strlen($row_data['user_name_first']).'" value="'.$row_data['user_name_first'].'"> ');
        print('<br>');
    
        print('Last Name           ');
        print('<input type="text" name="pst_user_name_last" size="'.strlen($row_data['user_name_last']).'" value="'.$row_data['user_name_last'].'"> ');
        print('<br>');
    
        print('Primary Doctor      ');
        print('<input type="text" name="pst_user_name_doctor" size="64" value="'.$row_data['user_name_doctor'].'"> ');
        print('<br>');
    
        print('Login               ');
        print('<input type="text" name="pst_user_name_login" size="'.strlen($row_data['user_name_login']).'" value="'.$row_data['user_name_login'].'"> ');
        print('<br>');
    
        print('Email               ');
        print('<input type="text" name="pst_user_name_email" size="'.strlen($row_data['user_name_email']).'" value="'.$row_data['user_name_email'].'"> ');
        print('<br>');
    
        print('Pass                ');
        print('<input type="password" name="pst_user_name_password" size="'.strlen($row_data['user_name_password']).'" value="'.$row_data['user_name_password'].'"> ');
        print('<br>');
    
        print('Administrator       ');
        print('<select name="pst_user_name_admin_approved">');
        if( ($row_data['user_name_admin_approved']) == 'Y' )
        {
            print('<option value="Y" selected="selected">Y</option>');
            print('<option value="N">N</option>');
        }
        else
        {
            print('<option value="Y">Y</option>');
            print('<option value="N" selected="selected">N</option>');
        }
        print('</select>');
        print('<br>');
    
        print('Account Active      ');
        print('<select name="pst_user_name_active"> ');
        if( ($row_data['user_name_active']) == 'Y' )
        {
            print('<option value="Y" selected="selected">Y</option>');
            print('<option value="N">N</option>');
        }
        else
        {
            print('<option value="Y">Y</option>');
            print('<option value="N" selected="selected">N</option>');
        }
        print('</select>');
        print('<br>');
    
        print('User Description    ');
        print('<select name="pst_user_name_description">');
        if( ($row_data['user_name_description']) == 'staff' )
        {
            print('<option value="staff" selected="selected">staff</option>');
            print('<option value="patient">patient</option>');
            print('<option value="doctor">doctor</option>');
            print('<option value="admin">admin</option>');
        }
    
        if( ($row_data['user_name_description']) == 'patient' )
        {
            print('<option value="staff">staff</option>');
            print('<option value="patient" selected="selected">patient</option>');
            print('<option value="doctor">doctor</option>');
            print('<option value="admin">admin</option>');
        }

        if( ($row_data['user_name_description']) == 'doctor' )
        {
            print('<option value="staff">staff</option>');
            print('<option value="patient">patient</option>');
            print('<option value="doctor" selected="doctor">doctor</option>');
            print('<option value="admin">admin</option>');
        }
    
        if( ($row_data['user_name_description']) == 'admin' )
        {
            print('<option value="staff">staff</option>');
            print('<option value="patient">patient</option>');
            print('<option value="doctor">doctor</option>');
            print('<option value="admin" selected="selected">admin</option>');
        }
    
        print('</select>');
        print('<br>');
    
        print('<br>');
        print('       <input name="Modify" type="submit" value="Modify" >');
    
        print('<br>');
        print('<br>');
        print('<pre>');
        print('</form>');
    }
    print('</table>');
</script>

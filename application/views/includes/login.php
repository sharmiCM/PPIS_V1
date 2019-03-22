<div id="login_form">
 <h1>Login</h1>
 <?php if(! is_null($msg)) echo $msg;?>  
    <?php 
 echo form_open('LoginRegister/validate_credentials');
 echo form_input('EmployeeID', 'Username');
 echo form_password('password', 'Password');
 echo form_submit('submit', 'Login');
 echo anchor('LoginRegister/signup', 'Create Account','style=padding-left:10px;');
 echo form_close();
 ?>
</div>

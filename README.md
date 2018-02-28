# Session
Session helper class

# How to use?
Configure the file in **'settings/config.php'**

`Session::initialize();`

`$username = 'Guilherme';`

`$password = 'mypassword';`

`Session::set('username', $username);`

`Session::set('password', $password);`

`echo Session::get('username') . '<br>';`

`echo Session::get('password') . '<br><br>';`

`Session::destroy('password');`

`echo Session::get('username') . '<br>';`

`echo Session::get('password');`

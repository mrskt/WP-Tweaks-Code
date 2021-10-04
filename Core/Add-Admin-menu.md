```
add_action('admin_menu', 'more_menu');
```
```
function more_menu() { 
 add_menu_page( 
      'More', 
      'More', 
      'more_opts', 
      'more_opt', 
      'more_callback_function', 
      'dashicons-editor-insertmore' 

     );
}
```
```
add_menu_page( 
      'More', 
      'More', 
      'more_opts', 
      'more_opt', 
      'more_callback_function', 
      'dashicons-editor-insertmore' 

     );
```

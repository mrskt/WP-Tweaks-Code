Regenerating the `option_id` values in a WordPress database can be a bit tricky as it involves changing the primary key values of the `wp_options` table. It's generally not recommended to modify the database directly, as it can cause serious issues with the functioning of your WordPress site.

If you have deleted some databases and want to regenerate `option_id` values in a serialwise manner, the easiest way would be to restore a backup of your database from before the deletions occurred. If you don't have a backup, you may need to manually update the `option_id` values using a tool like phpMyAdmin.

However, it's important to note that updating the `option_id` values can potentially break your site, especially if there are references to `option_id` values in your theme or plugins. So, proceed with caution and make sure you have a complete backup of your database before attempting any modifications.

Here are the general steps to regenerate `option_id` values:

1.  Open your database in phpMyAdmin and go to the `wp_options` table.
    
2.  Click on the "Operations" tab and select "Table options".
    
3.  In the "Table options" section, change the "AUTO\_INCREMENT" value to the next number you want to use for `option_id`. For example, if you want to start with `option_id` value 1000, set the "AUTO\_INCREMENT" value to 1000.
    
4.  Click on the "Go" button to save the changes.
    
5.  Now you need to update the `option_id` values in the table. This can be done by running the following SQL query in the SQL tab of phpMyAdmin:
    
```
SET @count = 0;
UPDATE wp_options SET option_id = (@count:=@count+1);
```
    
This query will reset the `option_id` values to be sequential, starting from the number you set in step 3.
    

Again, it's important to note that regenerating `option_id` values can potentially break your site, so proceed with caution and make sure you have a complete backup of your database before attempting any modifications.

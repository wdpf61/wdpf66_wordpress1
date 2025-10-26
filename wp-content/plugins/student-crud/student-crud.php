<?php
/*
Plugin Name: Student Crud
Plugin URI: http://intelsofts.com/wordpress/student_crud
Description: This is tutorial for student crud in wordpress.
Author: batch66
Version: 0.0.1
Author URI: http://batch66/
*/


register_activation_hook(__FILE__, "sc_add_table");

function sc_add_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "students";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name(
     id int primary key auto_increment,
     name varchar(200),
     email varchar(200)
    )$charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    // require_once(ABSPATH.  "wp-admin/includes/upgrade.php");
    dbDelta($sql);
}

// register_deactivation_hook(__FILE__, "sc_remove_table");
// function sc_remove_table(){
//     global $wpdb; 
//     $table_name= $wpdb->prefix ."students";
//     $sql= " DROP TABLE IF EXISTS $table_name";
//     $wpdb->query($sql);
// }

add_action('admin_menu', 'my_custom_menu');

function my_custom_menu()
{
    add_menu_page(
        'Students',
        'Students',
        'manage_options',
        'student',
        'student_page_html',
        'dashicons-admin-generic',
        3
    );
}

function student_page_html()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "students";

    if (isset($_GET['delete'])) {
         $wpdb->delete($table_name, ['id' => intval($_GET['delete'])]);
    }

    $data = $wpdb->get_results("select * from  $table_name");


     
   

?>

    <div id="wpwrap">

        <table class="table wp-list-table widefat fixed striped table-view-list posts">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $key => $value) {
                    ++ $key;
                    echo "
                  <tr>
                <th scope=\"row\">$key</th>
                <td>$value->name</td>
                <td>$value->email</td>
                <td> 
                
                            <a href=\"?page=student-create&edit=$value->id; \">Edit</a> | 
                            <a href=\"?page=student&delete=$value->id\" onclick=\"return confirm('Delete this student?');\">Delete</a>
                      
                      
                      </td>
                 </tr>
           
           ";
                }
                ?>


            </tbody>
        </table>
    </div>

<?php
}


add_action('admin_menu', function () {
    add_submenu_page(
        'student',                  // Parent slug
        'Create Student',           // Page title
        'Create Student',           // Menu title
        'manage_options',           // Capability
        'student-create',           // Slug
        "create_student"
    );
});

function create_student()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "students";


    if (isset($_POST['submit'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);

        if (!empty($_POST['id'])) {

            $wpdb->update($table_name, ['name' => $name, 'email' => $email], ['id' => intval($_POST['id'])]);
        } else {

            $wpdb->insert($table_name, ['name' => $name, 'email' => $email]);
        }


       

        ?>
        <script>
           window.location.href = "<?php echo admin_url('/admin.php?page=student'); ?>";
        </script>
        <?php
    }


    $edit_data = null;
    if (isset($_GET['edit'])) {
        $edit_data = $wpdb->get_row("SELECT * FROM $table_name WHERE id=" . intval($_GET['edit']));
    }
?>

    <h2>Student CRUD System</h2>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo esc_attr($edit_data->id ?? ''); ?>">
        <table class="form-table">
            <tr>
                <th>Name:</th>
                <td><input type="text" name="name" value="<?php echo esc_attr($edit_data->name ?? ''); ?>" required></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><input type="email" name="email" value="<?php echo esc_attr($edit_data->email ?? ''); ?>" required></td>
            </tr>
        </table>
        <input type="submit" name="submit"
            value="<?php echo isset($edit_data) ? 'Update' : 'Add'; ?>"
            class="button button-primary">
    </form>

<?php
}

<?


function add_callout_url_box() {
    add_meta_box(
    'callout_url_box', //
    'Internal Link', //
    'show_callout_url_box', //
    'callouts', //
    'normal', //
    'high'); //
}
add_action('add_meta_boxes', 'add_callout_url_box');

// Field Array
$prefix = 'callout_';
$callout_url_fields = array(
  array(
    'label'=> 'Internal Link',
    'desc'  => '',
    'id'  => $prefix.'internal_link',
    'type'  => 'text'
  )

);

// The Callback
function show_callout_url_box() {
global $callout_url_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="callout_url_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

  // Begin the field table and loop
  echo '<table class="form-table">';
  foreach ($callout_url_fields as $field) {
    // get value of this field if it exists for this post
    $meta = get_post_meta($post->ID, $field['id'], true);
    // begin a table row with
    echo '<tr>
        <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
        <td>';
        switch($field['type']) {
          case 'text':
            echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
                <br /><span class="description">'.$field['desc'].'</span>';
          break;
        } //end switch
    echo '</td></tr>';
  } // end foreach
  echo '</table>'; // end table
}

function save_callout_url($post_id) {
    global $callout_url_fields;

  // verify nonce
  if (!wp_verify_nonce($_POST['callout_url_box_nonce'], basename(__FILE__)))
    return $post_id;
  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return $post_id;
  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id))
      return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // loop through fields and save the data
  foreach ($callout_url_fields as $field) {
    if($field['type'] == 'tax_select') continue;
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
      update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $field['id'], $old);
    }
  } // enf foreach

  // save taxonomies
  $post = get_post($post_id);
  $category = $_POST['category'];
  wp_set_object_terms( $post_id, $category, 'category' );
}
add_action('save_post', 'save_callout_url');


?>
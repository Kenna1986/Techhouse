<?php
/*
 * Define and handle custom fields for taxonomy
 */
$tcfConfig = array('catalog', 'accessory-catalog');
$tcfTableValue = $wpdb->prefix . 'tcf_value';
$tcfFields = array('thumbnail' => 'image', 'title' => 'text');

$currTaxonomy = sanitize_key($_REQUEST['taxonomy']);

if (in_array($currTaxonomy, $tcfConfig)) {
    add_action($currTaxonomy . '_edit_form_fields','tcfEditTaxonomy');
    //add_action($currTaxonomy . '_add_form_fields','AddFieldsAction');
}
add_action('created_' . $currTaxonomy, 'tcfSaveValues');
add_action('edited_term','tcfSaveValues');

function tcfEditTaxonomy()
{
    wp_enqueue_media();
    Techhouse::getTemplate('taxonomyField.php');
}

function tcfGetTaxonomyFieldValue($termId, $name = null)
{
    global $wpdb, $tcfTableValue;
    if ($termId) {
        $sql = "SELECT `key`, `value` FROM $tcfTableValue WHERE `term_id` = $termId";
        if ($name) {
            $sql .= " AND `key` = '$name'";
            $result = $wpdb->get_row($sql);
            return $result ? $result->value : $result;
        }
        return $wpdb->get_results($sql);
    }
    return null;
}

function tcfSaveValues($termId)
{
    global $wpdb, $tcfTableValue, $tcfFields;
    $fieldValues = isset($_POST['taxonomy_field']) ? $_POST['taxonomy_field'] : array();
    foreach ($tcfFields as $name => $type) {
        if (isset($fieldValues[$name]) && trim($fieldValues[$name])) {
            $data = array('value' => $fieldValues[$name]);
            if (tcfGetTaxonomyFieldValue($termId, $name) !== null) {
                $where = array('key' => $name, 'term_id' => $termId);
                $wpdb->update($tcfTableValue, $data, $where);
            } else {
                $data['key'] = $name;
                $data['term_id'] = $termId;
                $wpdb->insert($tcfTableValue, $data);
            }
        } elseif (tcfGetTaxonomyFieldValue($termId, $name) !== null) {
            $sql = "DELETE FROM $tcfTableValue WHERE `key` = '$name' AND `term_id` = $termId";
            $wpdb->query($sql);
        }
    }
}
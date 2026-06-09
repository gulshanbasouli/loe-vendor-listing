<?php
/**
 * Plugin Name: All Vendor Listing
 * Plugin URI: https://loeion.com
 * Description: Display all vendors in a centralized admin listing.
 * Version: 1.0.0
 * Author: Loeion Infotech
 * Author URI: https://loeion.com
 * License: GPL v2 or later
 * Text Domain: loe-all-vendors
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require_once(ABSPATH.'wp-admin/includes/plugin.php'); 
$plugin_data = get_plugin_data( __FILE__ );

remove_action('load-update-core.php','wp_update_plugins');
add_filter('pre_site_transient_update_plugins','__return_null');


// Admin hooks

function LOE_AllVendorsAdminAction() {

   add_menu_page('All Vendors', 'All Vendors', 'manage_options', __FILE__, 'WBC_All_Vendors', "dashicons-admin-users",7);

}
 
add_action('admin_menu', 'LOE_AllVendorsAdminAction');

function LOE_All_Vendors() { 

  require_once plugin_dir_path( __FILE__ ) . 'inc/loe-vendor-listing.php';
}


/* Save selected data */


add_action(
    'personal_options_update',
    'loe_save_user_fields'
);

add_action(
    'edit_user_profile_update',
    'loe_save_user_fields'
);

function loe_save_user_fields( $user_id ) {

    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }

    if ( isset( $_POST['country'] ) ) {

        update_user_meta(
            $user_id,
            'country',
            sanitize_text_field(
                wp_unslash(
                    $_POST['country']
                )
            )
        );

    }
}

add_action( 'show_user_profile', 'Add_user_fields' );
add_action( 'edit_user_profile', 'Add_user_fields' );

function Add_user_fields( $user ) {

?>

<h3>Nationality</h3>
<table class="form-table">       

    <tr>
        <th><label for="dropdown">Country</label></th>
        <td>
            <?php 
            //get dropdown saved value
            $selected = get_the_author_meta( 'country', $user->ID );
            ?>

          
            <select name="country" id="country">
                <!-- <option <?php echo ($selected == "")?  'selected="selected"' : ''; ?> value="Argentina" <?php echo ($selected == "Argentina")?  'selected="selected"' : ''; ?>>Argentina</option>
                <option <?php echo ($selected == "")?  'selected="selected"' : ''; ?> value="Belgium" <?php echo ($selected == "Belgium")?  'selected="selected"' : ''; ?>>Belgium</option>
                <option <?php echo ($selected == "")?  'selected="selected"' : ''; ?> value="countryX" <?php echo ($selected == "countryX")?  'selected="selected"' : ''; ?>>country X</option> -->

  <option <?php echo ($selected == "Afghanistan")?  'selected="selected"' : ''; ?> value="Afghanistan" >Afghanistan</option>
  <option <?php echo ($selected == "Åland Islands")?  'selected="selected"' : ''; ?> value="Åland Islands">Åland Islands</option>
  <option <?php echo ($selected == "Albania")?  'selected="selected"' : ''; ?> value="Albania">Albania</option>
  <option <?php echo ($selected == "Algeria")?  'selected="selected"' : ''; ?> value="Algeria">Algeria</option>
  <option <?php echo ($selected == "American Samoa")?  'selected="selected"' : ''; ?> value="American Samoa">American Samoa</option>
  <option <?php echo ($selected == "Andorra")?  'selected="selected"' : ''; ?> value="Andorra">Andorra</option>
  <option <?php echo ($selected == "Angola")?  'selected="selected"' : ''; ?> value="Angola">Angola</option>
  <option <?php echo ($selected == "Anguilla")?  'selected="selected"' : ''; ?> value="Anguilla">Anguilla</option>
  <option <?php echo ($selected == "Antarctica")?  'selected="selected"' : ''; ?> value="Antarctica">Antarctica</option>
  <option <?php echo ($selected == "Antigua and Barbuda")?  'selected="selected"' : ''; ?> value="Antigua and Barbuda">Antigua and Barbuda</option>
  <option <?php echo ($selected == "Argentina")?  'selected="selected"' : ''; ?> value="Argentina">Argentina</option>
  <option <?php echo ($selected == "Armenia")?  'selected="selected"' : ''; ?> value="Armenia">Armenia</option>
  <option <?php echo ($selected == "Aruba")?  'selected="selected"' : ''; ?> value="Aruba">Aruba</option>
  <option <?php echo ($selected == "Australia")?  'selected="selected"' : ''; ?> value="Australia">Australia</option>
  <option <?php echo ($selected == "Austria")?  'selected="selected"' : ''; ?> value="Austria">Austria</option>
  <option <?php echo ($selected == "Azerbaijan")?  'selected="selected"' : ''; ?> value="Azerbaijan">Azerbaijan</option>
  <option <?php echo ($selected == "Bahamas")?  'selected="selected"' : ''; ?> value="Bahamas">Bahamas</option>
  <option <?php echo ($selected == "Bahrain")?  'selected="selected"' : ''; ?> value="Bahrain">Bahrain</option>
  <option <?php echo ($selected == "Bangladesh")?  'selected="selected"' : ''; ?> value="Bangladesh">Bangladesh</option>
  <option <?php echo ($selected == "Barbados")?  'selected="selected"' : ''; ?> value="Barbados">Barbados</option>
  <option <?php echo ($selected == "Belarus")?  'selected="selected"' : ''; ?> value="Belarus">Belarus</option>
  <option <?php echo ($selected == "Belgium")?  'selected="selected"' : ''; ?> value="Belgium">Belgium</option>
  <option <?php echo ($selected == "Belize")?  'selected="selected"' : ''; ?> value="Belize">Belize</option>
  <option <?php echo ($selected == "Benin")?  'selected="selected"' : ''; ?> value="Benin">Benin</option>
  <option <?php echo ($selected == "Bermuda")?  'selected="selected"' : ''; ?> value="Bermuda">Bermuda</option>
  <option <?php echo ($selected == "Bhutan")?  'selected="selected"' : ''; ?> value="Bhutan">Bhutan</option>
  <option <?php echo ($selected == "Bolivia, Plurinational State of")?  'selected="selected"' : ''; ?> value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
  <option <?php echo ($selected == "Bonaire, Sint Eustatius and Saba")?  'selected="selected"' : ''; ?> value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
  <option <?php echo ($selected == "Bosnia and Herzegovina")?  'selected="selected"' : ''; ?> value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
  <option <?php echo ($selected == "Botswana")?  'selected="selected"' : ''; ?> value="Botswana">Botswana</option>
  <option <?php echo ($selected == "Bouvet Island")?  'selected="selected"' : ''; ?> value="Bouvet Island">Bouvet Island</option>
  <option <?php echo ($selected == "Brazil")?  'selected="selected"' : ''; ?> value="Brazil">Brazil</option>
  <option <?php echo ($selected == "British Indian Ocean Territory")?  'selected="selected"' : ''; ?> value="British Indian Ocean Territory">British Indian Ocean Territory</option>
  <option <?php echo ($selected == "Brunei Darussalam")?  'selected="selected"' : ''; ?> value="Brunei Darussalam">Brunei Darussalam</option>
  <option <?php echo ($selected == "Bulgaria")?  'selected="selected"' : ''; ?> value="Bulgaria">Bulgaria</option>
  <option <?php echo ($selected == "Burkina Faso")?  'selected="selected"' : ''; ?> value="Burkina Faso">Burkina Faso</option>
  <option <?php echo ($selected == "Burundi")?  'selected="selected"' : ''; ?> value="Burundi">Burundi</option>
  <option <?php echo ($selected == "Cambodia")?  'selected="selected"' : ''; ?> value="Cambodia">Cambodia</option>
  <option <?php echo ($selected == "Cameroon")?  'selected="selected"' : ''; ?> value="Cameroon">Cameroon</option>
  <option <?php echo ($selected == "Canada")?  'selected="selected"' : ''; ?> value="Canada">Canada</option>
  <option <?php echo ($selected == "Cape Verde")?  'selected="selected"' : ''; ?> value="Cape Verde">Cape Verde</option>
  <option <?php echo ($selected == "Cayman Islands")?  'selected="selected"' : ''; ?> value="Cayman Islands">Cayman Islands</option>
  <option <?php echo ($selected == "")?  'selected="selected"' : 'Central African Republic'; ?> value="Central African Republic">Central African Republic</option>
  <option <?php echo ($selected == "Chad")?  'selected="selected"' : ''; ?> value="Chad">Chad</option>
  <option <?php echo ($selected == "Chile")?  'selected="selected"' : ''; ?> value="Chile">Chile</option>
  <option <?php echo ($selected == "China")?  'selected="selected"' : ''; ?> value="China">China</option>
  <option <?php echo ($selected == "Christmas Island")?  'selected="selected"' : ''; ?> value="Christmas Island">Christmas Island</option>
  <option <?php echo ($selected == "Cocos (Keeling) Islands")?  'selected="selected"' : ''; ?> value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
  <option <?php echo ($selected == "Colombia")?  'selected="selected"' : ''; ?> value="Colombia">Colombia</option>
  <option <?php echo ($selected == "Comoros")?  'selected="selected"' : ''; ?> value="Comoros">Comoros</option>
  <option <?php echo ($selected == "Congo")?  'selected="selected"' : ''; ?> value="Congo">Congo</option>
  <option <?php echo ($selected == "Congo, the Democratic Republic of the")?  'selected="selected"' : ''; ?> value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
  <option <?php echo ($selected == "Cook Islands")?  'selected="selected"' : ''; ?> value="Cook Islands">Cook Islands</option>
  <option <?php echo ($selected == "Costa Rica")?  'selected="selected"' : ''; ?> value="Costa Rica">Costa Rica</option>
  <option <?php echo ($selected == "Côte d'Ivoire")?  'selected="selected"' : ''; ?> value="Côte d'Ivoire">Côte d'Ivoire</option>
  <option <?php echo ($selected == "Croatia")?  'selected="selected"' : ''; ?> value="Croatia">Croatia</option>
  <option <?php echo ($selected == "Cuba")?  'selected="selected"' : ''; ?> value="Cuba">Cuba</option>
  <option <?php echo ($selected == "Curaçao")?  'selected="selected"' : ''; ?> value="Curaçao">Curaçao</option>
  <option <?php echo ($selected == "Cyprus")?  'selected="selected"' : ''; ?> value="Cyprus">Cyprus</option>
  <option <?php echo ($selected == "Czech Republic")?  'selected="selected"' : ''; ?> value="Czech Republic">Czech Republic</option>
  <option <?php echo ($selected == "Denmark")?  'selected="selected"' : ''; ?> value="Denmark">Denmark</option>
  <option <?php echo ($selected == "Djibouti")?  'selected="selected"' : ''; ?> value="Djibouti">Djibouti</option>
  <option <?php echo ($selected == "Dominica")?  'selected="selected"' : ''; ?> value="Dominica">Dominica</option>
  <option <?php echo ($selected == "Dominican Republic")?  'selected="selected"' : ''; ?> value="Dominican Republic">Dominican Republic</option>
  <option <?php echo ($selected == "Ecuador")?  'selected="selected"' : ''; ?> value="Ecuador">Ecuador</option>
  <option <?php echo ($selected == "Egypt")?  'selected="selected"' : ''; ?> value="Egypt">Egypt</option>
  <option <?php echo ($selected == "El Salvador")?  'selected="selected"' : ''; ?> value="El Salvador">El Salvador</option>
  <option <?php echo ($selected == "Equatorial Guinea")?  'selected="selected"' : ''; ?> value="Equatorial Guinea">Equatorial Guinea</option>
  <option <?php echo ($selected == "Eritrea")?  'selected="selected"' : ''; ?> value="Eritrea">Eritrea</option>
  <option <?php echo ($selected == "Estonia")?  'selected="selected"' : ''; ?> value="Estonia">Estonia</option>
  <option <?php echo ($selected == "Ethiopia")?  'selected="selected"' : ''; ?> value="Ethiopia">Ethiopia</option>
  <option <?php echo ($selected == "Falkland Islands (Malvinas)")?  'selected="selected"' : ''; ?> value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
  <option <?php echo ($selected == "Faroe Islands")?  'selected="selected"' : ''; ?> value="Faroe Islands">Faroe Islands</option>
  <option <?php echo ($selected == "Fiji")?  'selected="selected"' : ''; ?> value="Fiji">Fiji</option>
  <option <?php echo ($selected == "Finland")?  'selected="selected"' : ''; ?> value="Finland">Finland</option>
  <option <?php echo ($selected == "France")?  'selected="selected"' : ''; ?> value="France">France</option>
  <option <?php echo ($selected == "French Guiana")?  'selected="selected"' : ''; ?> value="French Guiana">French Guiana</option>
  <option <?php echo ($selected == "French Polynesia")?  'selected="selected"' : ''; ?> value="French Polynesia">French Polynesia</option>
  <option <?php echo ($selected == "French Southern Territories")?  'selected="selected"' : ''; ?> value="French Southern Territories">French Southern Territories</option>
  <option <?php echo ($selected == "Gabon")?  'selected="selected"' : ''; ?> value="Gabon">Gabon</option>
  <option <?php echo ($selected == "Gambia")?  'selected="selected"' : ''; ?> value="Gambia">Gambia</option>
  <option <?php echo ($selected == "Georgia")?  'selected="selected"' : ''; ?> value="Georgia">Georgia</option>
  <option <?php echo ($selected == "Germany")?  'selected="selected"' : ''; ?> value="Germany">Germany</option>
  <option <?php echo ($selected == "Ghana")?  'selected="selected"' : ''; ?> value="Ghana">Ghana</option>
  <option <?php echo ($selected == "Gibraltar")?  'selected="selected"' : ''; ?> value="Gibraltar">Gibraltar</option>
  <option <?php echo ($selected == "Greece")?  'selected="selected"' : ''; ?> value="Greece">Greece</option>
  <option <?php echo ($selected == "Greenland")?  'selected="selected"' : ''; ?> value="Greenland">Greenland</option>
  <option <?php echo ($selected == "Grenada")?  'selected="selected"' : ''; ?> value="Grenada">Grenada</option>
  <option <?php echo ($selected == "Guadeloupe")?  'selected="selected"' : ''; ?> value="Guadeloupe">Guadeloupe</option>
  <option <?php echo ($selected == "Guam")?  'selected="selected"' : ''; ?> value="Guam">Guam</option>
  <option <?php echo ($selected == "Guatemala")?  'selected="selected"' : ''; ?> value="Guatemala">Guatemala</option>
  <option <?php echo ($selected == "Guernsey")?  'selected="selected"' : ''; ?> value="Guernsey">Guernsey</option>
  <option <?php echo ($selected == "Guinea")?  'selected="selected"' : ''; ?> value="Guinea">Guinea</option>
  <option <?php echo ($selected == "Guinea-Bissau")?  'selected="selected"' : ''; ?> value="Guinea-Bissau">Guinea-Bissau</option>
  <option <?php echo ($selected == "Guyana")?  'selected="selected"' : ''; ?> value="Guyana">Guyana</option>
  <option <?php echo ($selected == "Haiti")?  'selected="selected"' : ''; ?> value="Haiti">Haiti</option>
  <option <?php echo ($selected == "Heard Island and McDonald Islands")?  'selected="selected"' : ''; ?> value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
  <option <?php echo ($selected == "Holy See (Vatican City State)")?  'selected="selected"' : ''; ?> value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
  <option <?php echo ($selected == "Honduras")?  'selected="selected"' : ''; ?> value="Honduras">Honduras</option>
  <option <?php echo ($selected == "Hong Kong")?  'selected="selected"' : ''; ?> value="Hong Kong">Hong Kong</option>
  <option <?php echo ($selected == "Hungary")?  'selected="selected"' : ''; ?> value="Hungary">Hungary</option>
  <option <?php echo ($selected == "Iceland")?  'selected="selected"' : ''; ?> value="Iceland">Iceland</option>
  <option <?php echo ($selected == "India")?  'selected="selected"' : ''; ?> value="India">India</option>
  <option <?php echo ($selected == "Indonesia")?  'selected="selected"' : ''; ?> value="Indonesia">Indonesia</option>
  <option <?php echo ($selected == "Iran, Islamic Republic of")?  'selected="selected"' : ''; ?> value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
  <option <?php echo ($selected == "Iraq")?  'selected="selected"' : ''; ?> value="Iraq">Iraq</option>
  <option <?php echo ($selected == "Ireland")?  'selected="selected"' : ''; ?> value="Ireland">Ireland</option>
  <option <?php echo ($selected == "Isle of Man")?  'selected="selected"' : ''; ?> value="Isle of Man">Isle of Man</option>
  <option <?php echo ($selected == "Israel")?  'selected="selected"' : ''; ?> value="Israel">Israel</option>
  <option <?php echo ($selected == "Italy")?  'selected="selected"' : ''; ?> value="Italy">Italy</option>
  <option <?php echo ($selected == "Jamaica")?  'selected="selected"' : ''; ?> value="Jamaica">Jamaica</option>
  <option <?php echo ($selected == "Japan")?  'selected="selected"' : ''; ?> value="Japan">Japan</option>
  <option <?php echo ($selected == "Jersey")?  'selected="selected"' : ''; ?> value="Jersey">Jersey</option>
  <option <?php echo ($selected == "Jordan")?  'selected="selected"' : ''; ?> value="Jordan">Jordan</option>
  <option <?php echo ($selected == "Kazakhstan")?  'selected="selected"' : ''; ?> value="Kazakhstan">Kazakhstan</option>
  <option <?php echo ($selected == "Kenya")?  'selected="selected"' : ''; ?> value="Kenya">Kenya</option>
  <option <?php echo ($selected == "Kiribati")?  'selected="selected"' : ''; ?> value="Kiribati">Kiribati</option>
  <option <?php echo ($selected == "Korea, Democratic People's Republic of")?  'selected="selected"' : ''; ?> value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
  <option <?php echo ($selected == "Korea, Republic of")?  'selected="selected"' : ''; ?> value="Korea, Republic of">Korea, Republic of</option>
  <option <?php echo ($selected == "Kuwait")?  'selected="selected"' : ''; ?> value="Kuwait">Kuwait</option>
  <option <?php echo ($selected == "Kyrgyzstan")?  'selected="selected"' : ''; ?> value="Kyrgyzstan">Kyrgyzstan</option>
  <option <?php echo ($selected == "Lao People's Democratic Republic")?  'selected="selected"' : ''; ?> value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
  <option <?php echo ($selected == "Latvia")?  'selected="selected"' : ''; ?> value="Latvia">Latvia</option>
  <option <?php echo ($selected == "Lebanon")?  'selected="selected"' : ''; ?> value="Lebanon">Lebanon</option>
  <option <?php echo ($selected == "Lesotho")?  'selected="selected"' : ''; ?> value="Lesotho">Lesotho</option>
  <option <?php echo ($selected == "Liberia")?  'selected="selected"' : ''; ?> value="Liberia">Liberia</option>
  <option <?php echo ($selected == "Libya")?  'selected="selected"' : ''; ?> value="Libya">Libya</option>
  <option <?php echo ($selected == "Liechtenstein")?  'selected="selected"' : ''; ?> value="Liechtenstein">Liechtenstein</option>
  <option <?php echo ($selected == "Lithuania")?  'selected="selected"' : ''; ?> value="Lithuania">Lithuania</option>
  <option <?php echo ($selected == "Luxembourg")?  'selected="selected"' : ''; ?> value="Luxembourg">Luxembourg</option>
  <option <?php echo ($selected == "Macao")?  'selected="selected"' : ''; ?> value="Macao">Macao</option>
  <option <?php echo ($selected == "Macedonia, the former Yugoslav Republic of")?  'selected="selected"' : ''; ?> value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
  <option <?php echo ($selected == "Madagascar")?  'selected="selected"' : ''; ?> value="Madagascar">Madagascar</option>
  <option <?php echo ($selected == "Malawi")?  'selected="selected"' : ''; ?> value="Malawi">Malawi</option>
  <option <?php echo ($selected == "Malaysia")?  'selected="selected"' : ''; ?> value="Malaysia">Malaysia</option>
  <option <?php echo ($selected == "Maldives")?  'selected="selected"' : ''; ?> value="Maldives">Maldives</option>
  <option <?php echo ($selected == "Mali")?  'selected="selected"' : ''; ?> value="Mali">Mali</option>
  <option <?php echo ($selected == "Malta")?  'selected="selected"' : ''; ?> value="Malta">Malta</option>
  <option <?php echo ($selected == "Marshall Islands")?  'selected="selected"' : ''; ?> value="Marshall Islands">Marshall Islands</option>
  <option <?php echo ($selected == "Martinique")?  'selected="selected"' : ''; ?> value="Martinique">Martinique</option>
  <option <?php echo ($selected == "Mauritania")?  'selected="selected"' : ''; ?> value="Mauritania">Mauritania</option>
  <option <?php echo ($selected == "Mauritius")?  'selected="selected"' : ''; ?> value="Mauritius">Mauritius</option>
  <option <?php echo ($selected == "Mayotte")?  'selected="selected"' : ''; ?> value="Mayotte">Mayotte</option>
  <option <?php echo ($selected == "Mexico")?  'selected="selected"' : ''; ?> value="Mexico">Mexico</option>
  <option <?php echo ($selected == "Micronesia, Federated States of")?  'selected="selected"' : ''; ?> value="Micronesia, Federated States of">Micronesia, Federated States of</option>
  <option <?php echo ($selected == "Moldova, Republic of")?  'selected="selected"' : ''; ?> value="Moldova, Republic of">Moldova, Republic of</option>
  <option <?php echo ($selected == "Monaco")?  'selected="selected"' : ''; ?> value="Monaco">Monaco</option>
  <option <?php echo ($selected == "Mongolia")?  'selected="selected"' : ''; ?> value="Mongolia">Mongolia</option>
  <option <?php echo ($selected == "Montenegro")?  'selected="selected"' : ''; ?> value="Montenegro">Montenegro</option>
  <option <?php echo ($selected == "Montserrat")?  'selected="selected"' : ''; ?> value="Montserrat">Montserrat</option>
  <option <?php echo ($selected == "Morocco")?  'selected="selected"' : ''; ?> value="Morocco">Morocco</option>
  <option <?php echo ($selected == "Mozambique")?  'selected="selected"' : ''; ?> value="Mozambique">Mozambique</option>
  <option <?php echo ($selected == "Myanmar")?  'selected="selected"' : ''; ?> value="Myanmar">Myanmar</option>
  <option <?php echo ($selected == "Namibia")?  'selected="selected"' : ''; ?> value="Namibia">Namibia</option>
  <option <?php echo ($selected == "Nauru")?  'selected="selected"' : ''; ?> value="Nauru">Nauru</option>
  <option <?php echo ($selected == "Nepal")?  'selected="selected"' : ''; ?> value="Nepal">Nepal</option>
  <option <?php echo ($selected == "Netherlands")?  'selected="selected"' : ''; ?> value="Netherlands">Netherlands</option>
  <option <?php echo ($selected == "New Caledonia")?  'selected="selected"' : ''; ?> value="New Caledonia">New Caledonia</option>
  <option <?php echo ($selected == "New Zealand")?  'selected="selected"' : ''; ?> value="New Zealand">New Zealand</option>
  <option <?php echo ($selected == "Nicaragua")?  'selected="selected"' : ''; ?> value="Nicaragua">Nicaragua</option>
  <option <?php echo ($selected == "Niger")?  'selected="selected"' : ''; ?> value="Niger">Niger</option>
  <option <?php echo ($selected == "Nigeria")?  'selected="selected"' : ''; ?> value="Nigeria">Nigeria</option>
  <option <?php echo ($selected == "Niue")?  'selected="selected"' : ''; ?> value="Niue">Niue</option>
  <option <?php echo ($selected == "Norfolk Island")?  'selected="selected"' : ''; ?> value="Norfolk Island">Norfolk Island</option>
  <option <?php echo ($selected == "Northern Mariana Islands")?  'selected="selected"' : ''; ?> value="Northern Mariana Islands">Northern Mariana Islands</option>
  <option <?php echo ($selected == "Norway")?  'selected="selected"' : ''; ?> value="Norway">Norway</option>
  <option <?php echo ($selected == "Oman")?  'selected="selected"' : ''; ?> value="Oman">Oman</option>
  <option <?php echo ($selected == "Pakistan")?  'selected="selected"' : ''; ?> value="Pakistan">Pakistan</option>
  <option <?php echo ($selected == "Palau")?  'selected="selected"' : ''; ?> value="Palau">Palau</option>
  <option <?php echo ($selected == "Palestinian Territory, Occupied")?  'selected="selected"' : ''; ?> value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
  <option <?php echo ($selected == "Panama")?  'selected="selected"' : ''; ?> value="Panama">Panama</option>
  <option <?php echo ($selected == "Papua New Guinea")?  'selected="selected"' : ''; ?> value="Papua New Guinea">Papua New Guinea</option>
  <option <?php echo ($selected == "Paraguay")?  'selected="selected"' : ''; ?> value="Paraguay">Paraguay</option>
  <option <?php echo ($selected == "Peru")?  'selected="selected"' : ''; ?> value="Peru">Peru</option>
  <option <?php echo ($selected == "Philippines")?  'selected="selected"' : ''; ?> value="Philippines">Philippines</option>
  <option <?php echo ($selected == "Pitcairn")?  'selected="selected"' : ''; ?> value="Pitcairn">Pitcairn</option>
  <option <?php echo ($selected == "Poland")?  'selected="selected"' : ''; ?> value="Poland">Poland</option>
  <option <?php echo ($selected == "Portugal")?  'selected="selected"' : ''; ?> value="Portugal">Portugal</option>
  <option <?php echo ($selected == "Puerto Rico")?  'selected="selected"' : ''; ?> value="Puerto Rico">Puerto Rico</option>
  <option <?php echo ($selected == "Qatar")?  'selected="selected"' : ''; ?> value="Qatar">Qatar</option>
  <option <?php echo ($selected == "Réunion")?  'selected="selected"' : ''; ?> value="Réunion">Réunion</option>
  <option <?php echo ($selected == "Romania")?  'selected="selected"' : ''; ?> value="Romania">Romania</option>
  <option <?php echo ($selected == "Russian Federation")?  'selected="selected"' : ''; ?> value="Russian Federation">Russian Federation</option>
  <option <?php echo ($selected == "Rwanda")?  'selected="selected"' : ''; ?> value="Rwanda">Rwanda</option>
  <option <?php echo ($selected == "Saint Barthélemy")?  'selected="selected"' : ''; ?> value="Saint Barthélemy">Saint Barthélemy</option>
  <option <?php echo ($selected == "Saint Helena, Ascension and Tristan da Cunha")?  'selected="selected"' : ''; ?> value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
  <option <?php echo ($selected == "Saint Kitts and Nevis")?  'selected="selected"' : ''; ?> value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
  <option <?php echo ($selected == "Saint Lucia")?  'selected="selected"' : ''; ?> value="Saint Lucia">Saint Lucia</option>
  <option <?php echo ($selected == "Saint Martin (French part)")?  'selected="selected"' : ''; ?> value="Saint Martin (French part)">Saint Martin (French part)</option>
  <option <?php echo ($selected == "Saint Pierre and Miquelon")?  'selected="selected"' : ''; ?> value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
  <option <?php echo ($selected == "Saint Vincent and the Grenadines")?  'selected="selected"' : ''; ?> value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
  <option <?php echo ($selected == "Samoa")?  'selected="selected"' : ''; ?> value="Samoa">Samoa</option>
  <option <?php echo ($selected == "San Marino")?  'selected="selected"' : ''; ?> value="San Marino">San Marino</option>
  <option <?php echo ($selected == "Sao Tome and Principe")?  'selected="selected"' : ''; ?> value="Sao Tome and Principe">Sao Tome and Principe</option>
  <option <?php echo ($selected == "Saudi Arabia")?  'selected="selected"' : ''; ?> value="Saudi Arabia">Saudi Arabia</option>
  <option <?php echo ($selected == "Senegal")?  'selected="selected"' : ''; ?> value="Senegal">Senegal</option>
  <option <?php echo ($selected == "Serbia")?  'selected="selected"' : ''; ?> value="Serbia">Serbia</option>
  <option <?php echo ($selected == "Seychelles")?  'selected="selected"' : ''; ?> value="Seychelles">Seychelles</option>
  <option <?php echo ($selected == "Sierra Leone")?  'selected="selected"' : ''; ?> value="Sierra Leone">Sierra Leone</option>
  <option <?php echo ($selected == "Singapore")?  'selected="selected"' : ''; ?> value="Singapore">Singapore</option>
  <option <?php echo ($selected == "Sint Maarten (Dutch part)")?  'selected="selected"' : ''; ?> value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
  <option <?php echo ($selected == "Slovakia")?  'selected="selected"' : ''; ?> value="Slovakia">Slovakia</option>
  <option <?php echo ($selected == "Slovenia")?  'selected="selected"' : ''; ?> value="Slovenia">Slovenia</option>
  <option <?php echo ($selected == "Solomon Islands")?  'selected="selected"' : ''; ?> value="Solomon Islands">Solomon Islands</option>
  <option <?php echo ($selected == "Somalia")?  'selected="selected"' : ''; ?> value="Somalia">Somalia</option>
  <option <?php echo ($selected == "South Africa")?  'selected="selected"' : ''; ?> value="South Africa">South Africa</option>
  <option <?php echo ($selected == "South Georgia and the South Sandwich Islands")?  'selected="selected"' : ''; ?> value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
  <option <?php echo ($selected == "South Sudan")?  'selected="selected"' : ''; ?> value="South Sudan">South Sudan</option>
  <option <?php echo ($selected == "Spain")?  'selected="selected"' : ''; ?> value="Spain">Spain</option>
  <option <?php echo ($selected == "Sri Lanka")?  'selected="selected"' : ''; ?> value="Sri Lanka">Sri Lanka</option>
  <option <?php echo ($selected == "Sudan")?  'selected="selected"' : ''; ?> value="Sudan">Sudan</option>
  <option <?php echo ($selected == "Suriname")?  'selected="selected"' : ''; ?> value="Suriname">Suriname</option>
  <option <?php echo ($selected == "Svalbard and Jan Mayen")?  'selected="selected"' : ''; ?> value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
  <option <?php echo ($selected == "Swaziland")?  'selected="selected"' : ''; ?> value="Swaziland">Swaziland</option>
  <option <?php echo ($selected == "Sweden")?  'selected="selected"' : ''; ?> value="Sweden">Sweden</option>
  <option <?php echo ($selected == "Switzerland")?  'selected="selected"' : ''; ?> value="Switzerland">Switzerland</option>
  <option <?php echo ($selected == "Syrian Arab Republic")?  'selected="selected"' : ''; ?> value="Syrian Arab Republic">Syrian Arab Republic</option>
  <option <?php echo ($selected == "Taiwan, Province of China")?  'selected="selected"' : ''; ?> value="Taiwan, Province of China">Taiwan, Province of China</option>
  <option <?php echo ($selected == "Tajikistan")?  'selected="selected"' : ''; ?> value="Tajikistan">Tajikistan</option>
  <option <?php echo ($selected == "Tanzania, United Republic of")?  'selected="selected"' : ''; ?> value="Tanzania, United Republic of">Tanzania, United Republic of</option>
  <option <?php echo ($selected == "Thailand")?  'selected="selected"' : ''; ?> value="Thailand">Thailand</option>
  <option <?php echo ($selected == "Timor-Leste")?  'selected="selected"' : ''; ?> value="Timor-Leste">Timor-Leste</option>
  <option <?php echo ($selected == "Togo")?  'selected="selected"' : ''; ?> value="Togo">Togo</option>
  <option <?php echo ($selected == "Tokelau")?  'selected="selected"' : ''; ?> value="Tokelau">Tokelau</option>
  <option <?php echo ($selected == "Tonga")?  'selected="selected"' : ''; ?> value="Tonga">Tonga</option>
  <option <?php echo ($selected == "Trinidad and Tobago")?  'selected="selected"' : ''; ?> value="Trinidad and Tobago">Trinidad and Tobago</option>
  <option <?php echo ($selected == "Tunisia")?  'selected="selected"' : ''; ?> value="Tunisia">Tunisia</option>
  <option <?php echo ($selected == "Turkey")?  'selected="selected"' : ''; ?> value="Turkey">Turkey</option>
  <option <?php echo ($selected == "Turkmenistan")?  'selected="selected"' : ''; ?> value="Turkmenistan">Turkmenistan</option>
  <option <?php echo ($selected == "Turks and Caicos Islands")?  'selected="selected"' : ''; ?> value="Turks and Caicos Islands">Turks and Caicos Islands</option>
  <option <?php echo ($selected == "Tuvalu")?  'selected="selected"' : ''; ?> value="Tuvalu">Tuvalu</option>
  <option <?php echo ($selected == "Uganda")?  'selected="selected"' : ''; ?> value="Uganda">Uganda</option>
  <option <?php echo ($selected == "Ukraine")?  'selected="selected"' : ''; ?> value="Ukraine">Ukraine</option>
  <option <?php echo ($selected == "United Arab Emirates")?  'selected="selected"' : ''; ?> value="United Arab Emirates">United Arab Emirates</option>
  <option <?php echo ($selected == "United Kingdom")?  'selected="selected"' : ''; ?> value="United Kingdom">United Kingdom</option>
  <option <?php echo ($selected == "United States")?  'selected="selected"' : ''; ?> value="United States">United States</option>
  <option <?php echo ($selected == "United States Minor Outlying Islands")?  'selected="selected"' : ''; ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
  <option <?php echo ($selected == "Uruguay")?  'selected="selected"' : ''; ?> value="Uruguay">Uruguay</option>
  <option <?php echo ($selected == "Uzbekistan")?  'selected="selected"' : ''; ?> value="Uzbekistan">Uzbekistan</option>
  <option <?php echo ($selected == "Vanuatu")?  'selected="selected"' : ''; ?> value="Vanuatu">Vanuatu</option>
  <option <?php echo ($selected == "Venezuela, Bolivarian Republic of")?  'selected="selected"' : ''; ?> value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
  <option <?php echo ($selected == "Viet Nam")?  'selected="selected"' : ''; ?> value="Viet Nam">Viet Nam</option>
  <option <?php echo ($selected == "Virgin Islands, British")?  'selected="selected"' : ''; ?> value="Virgin Islands, British">Virgin Islands, British</option>
  <option <?php echo ($selected == "Virgin Islands, U.S.")?  'selected="selected"' : ''; ?> value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
  <option <?php echo ($selected == "Wallis and Futuna")?  'selected="selected"' : ''; ?> value="Wallis and Futuna">Wallis and Futuna</option>
  <option <?php echo ($selected == "Western Sahara")?  'selected="selected"' : ''; ?> value="Western Sahara">Western Sahara</option>
  <option <?php echo ($selected == "Yemen")?  'selected="selected"' : ''; ?> value="Yemen">Yemen</option>
  <option <?php echo ($selected == "Zambia")?  'selected="selected"' : ''; ?> value="Zambia">Zambia</option>
  <option <?php echo ($selected == "Zimbabwe")?  'selected="selected"' : ''; ?> value="Zimbabwe">Zimbabwe</option>







            </select>
           
        </td>
    </tr>
</table>
<?php 
}
?>

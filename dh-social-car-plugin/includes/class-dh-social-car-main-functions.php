<?php
/* Main Plugin File */
add_action('admin_menu','Dh_Social_Car_add_menu');
function Dh_Social_Car_add_menu(){
    add_menu_page("Theme Panel", "DH Social Car", "manage_options", "dh-social-car", "Dh_Social_Car_setting_plugin_page", null, 99);
}

function Dh_Social_Car_setting_plugin_page(){
    global $wpdb;
    $table_name = $wpdb->prefix . "car_forms";
    $perPage = 25;
    $paged = 1;
    if(isset($_GET["page_no"]) && !empty($_GET["page_no"])){
        $paged = sanitize_text_field($_GET["page_no"]);
    }
    $recordStartFrom = $perPage * ($paged - 1);

    $allData = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC" );
    $getAll = count($allData); // Count            
    $big = 999999999; // need an unlikely integer
    $allPages = ceil($getAll / $perPage);   

    $formsData = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC LIMIT $recordStartFrom, $perPage " );    
    $getdata = ''; 
    $getdata .= '<table id="carAdminTable">
        <tr>
            <th>loanamount</th>
            <th>term</th>           
            <th>loan_type</th>
            <th>passport_no</th>
            <th>title</th>
            <th>fullnames</th>
            <th>email_address</th>
            <th>cellphone_number</th>
            <th>address</th>  
        </tr>';
        foreach($formsData as $oneData){   
            $getdata .= '<tr>
                <td> '.sanitize_text_field($oneData->loan_amount). '</td>
                <td> '.sanitize_text_field($oneData->term).' </td>       
                <td> '.sanitize_text_field($oneData->loan_type).' </td>
                <td> '.sanitize_text_field($oneData->passport_no).'</td>
                <td> '.sanitize_text_field($oneData->title).'</td>
                <td> '.sanitize_text_field($oneData->fullnames).'</td>
                <td> '.sanitize_text_field($oneData->email_address).'</td>
                <td> '.sanitize_text_field($oneData->cellphone_number).'</td>
                <td> '.sanitize_text_field($oneData->address).'</td>   
            </tr>';
        }
    $getdata .= '</table> ';     
            
    if($allPages > 0){
        $getdata .= '<ul class="pagination mb-sm-0">';
                $view = '';
                if($allPages >= 1){
                    $oldLink = $paged - 1;
                    $disabled = "";
                    if($paged == 1){
                        $disabled = "disabled";
                    }
                    $view .= '<li class="page-item '.$disabled.'"><a href="?page_no='.$oldLink.'" class="page-link"><i class="fas fa-angles-left"></i></a></li>';
                }

                for ($onePage=1; $onePage <= $allPages; $onePage++) {
                  $active = "";
                  if($onePage == $paged){
                    $active = "active";
                  }
                    $view .= '<li class="page-item '.$active.'"><a href="?page_no='.$onePage.'" class="page-link">'.$onePage.'</a></li>';
                }

                if($allPages > 1){
                    $newLink = $paged + 1;
                    if($paged < $allPages){
                        $view .= '<li class="page-item"><a href="?page_no='.$newLink.'" class="page-link"><i class="fas fa-angles-right"></i></a></li>';
                    }
                }
                $getdata .= $view;
        $getdata .= '</ul>';
    }

    _e($getdata);
}

add_shortcode('Dh_Social_Car_Quickloans', 'Dh_Social_Car_shortcode');
function Dh_Social_Car_shortcode()
{
?>
    <div class="alert alert-success hide"></div>
        <h3 class="dhcar_mainh3">Pre-Qualify For Finance | The Smart Way To Buy!</h3>    
        <form action="" method="POST" id="dh_form">
            <div class="tab" id="firstTab" style="display: block;">
                <h4>  Add Amount Details</h4>
                <p><label>Loan Amount</label>
                <input id="amount" class= "required" name="loan" type="loan" value="" style=""></p>
                <p><label>Term</label>
                <select id="month" class= "required" name="term" type="month" value="" style="width: 100%;"></p>
                    <option value="" style="border:none;">Months</option>
                    <option value="12" style="border:none;">12</option>
                    <option value="24" style="border:none;">24</option>
                    <option value="36" style="border:none;">36</option>
                    <option value="48" style="border:none;">48</option>
                    <option value="56" style="border:none;">56</option>
                </select>
                </p>
                <p><label>Loan Type</label>
                <select class="minimal" id="loanreason" name="loanreason" value="" style="width: 100%;"></p>
                    <option value="" style="border:none;">Select</option>
                    <option value="Vehicle Finance" style="border:none;">Vehicle Finance</option>
                </select>
                </p>
                <p><button type="button" id="nextBtn_1">Next</button></p>
            </div>
            <div class="tab" id="secondtab" style="display: none;">
                <h4>Add  Details</h4>
                <p><label>Passport_No</label>
                <input id="yourid" class="required" name="yourid" type="text" value="" style="border:none;"></p>   
                <p><label>Title</label>
                <select id= "yourtitle" class="minimal required" id="yourtitle" name="yourtitle" style="width:100%;"></p>
                    <option value="" style="border:none;">Select</option>
                    <option value="Mr" style="border:none;">Mr</option>
                    <option value="Mrs" style="border:none;">Mrs</option>
                    <option value="Miss" style="border:none;">Miss</option>
                    <option value="Other" style="border:none;">Other</option>
                </select>
                <p><button type="button" id="prevBtn_1">Previous</button>
                <button type="button" id="nextBtn_2">Next</button></p>
            </div>
            <div class="tab" id="thirdTab" style="display: none;">
                <h4>Add Personal Details</h4>
                <p><label>Full Name:</label>
                <input id="yourname" class="required" name="yourname" type="text" value="" style="border:none;"></p>
                <p><label>Email address:</label>
                <input id="youremail" class="required" name="youremail" type="text" value="" style="border:none;"></p> 
                <p><label>Cellphone Number:</label>
                <input id="yourtelephone" class="required" name="yourtelephone" type="text" value="" style="border:none;"></p>
                <p><label>Address:</label>
                <input id="youraddress" class="required" name="youraddress" type="text" value="" style="border:none;"></p>
                <p><button type="button" id="prevBtn_2">Previous</button>
                <button type="button" id="nextBtn_3">Next</button>
                <button type="submit" name="submitbtn" id="submitbtn" style="display:none;">Submit</button></p>
            </div>
           <!--  <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>                    
            </div> -->
        </form>
    </div>
<?php
}

add_action('init','Dh_Social_Car_db_save_function');
function Dh_Social_Car_db_save_function(){
    global $wpdb;
    if(isset($_POST['submitbtn'])){
        $loanamount = sanitize_text_field_text_field( $_POST['loan'] );    
        $term = sanitize_text_field_text_field( $_POST['term'] );
        $loantype = sanitize_text_field_text_field( $_POST['loanreason'] );
        $passport_no = sanitize_text_field_text_field( $_POST['yourid'] );
        $title = sanitize_text_field_text_field( $_POST['yourtitle'] );
        $fullnames = sanitize_text_field_text_field( $_POST['yourname'] );
        if (empty( $_POST["yourname"])) {
            $fullnames_surname = "Yourname is required";
        } else {
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fullnames)) {
                $fullnames= "Only letters and white space allowed";
            }
        }
        $email_address = sanitize_text_field_email( $_POST['youremail'] );
        if (empty($_POST['youremail'])) {
            $email_address = "Email is required";
        } else {
            // check if e-mail address is well-formed
            if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
                $email_address = "Invalid youremail format";
            }
        }
        $cellphone_number = sanitize_text_field_text_field( $_POST['yourtelephone'] );
        $address = sanitize_text_field_text_field( $_POST['youraddress'] );
        $tablename = $wpdb->prefix.'car_forms';
        $wpdb->insert( $tablename, array(
             'loan_amount' => sanitize_text_field_text_field($loanamount), 
                'term' => sanitize_text_field_text_field($term),
                'loan_type' => sanitize_text_field_text_field($loantype) ,
                'passport_no' => sanitize_text_field_text_field($passport_no),
                'title' => sanitize_text_field_text_field($title), 
                'fullnames' => sanitize_text_field_text_field($fullnames),
                'email_address' => sanitize_text_field_text_field($email_address),
                'cellphone_number' => sanitize_text_field_text_field($cellphone_number),
                'address' => sanitize_text_field_text_field($address)
            ),
            array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
        );              
    } 
}
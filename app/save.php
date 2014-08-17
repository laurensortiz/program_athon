<?php
 
$con = mysql_connect('localhost', 'ecotankc_progra', '){zrn+kZqk');
mysql_select_db('ecotankc_prograthon', $con);
// $con = mysql_connect('localhost', 'root', 'root');
// mysql_select_db('prograthon', $con);

$data = json_decode(file_get_contents("php://input"));

$group_name = mysql_real_escape_string($data->group_name);
$group_leader = mysql_real_escape_string($data->group_leader);
$member_1 = mysql_real_escape_string($data->member_1);
$member_2 = mysql_real_escape_string($data->member_2);
$member_3 = mysql_real_escape_string($data->member_3);
$member_4 = mysql_real_escape_string($data->member_4);
$member_5 = mysql_real_escape_string($data->member_5);
$group_leader_id = mysql_real_escape_string($data->group_leader_id);
$group_leader_email = mysql_real_escape_string($data->group_leader_email);
$group_leader_phone = mysql_real_escape_string($data->group_leader_phone);


 


$qry_em = 'select count(*) as cnt from groups where group_leader_email ="' . $group_leader_email . '"';
$qry_res = mysql_query($qry_em);
$res = mysql_fetch_assoc($qry_res);

if ($res['cnt'] == 0) {
    $qry = 'INSERT INTO groups (group_name,group_leader,member_1,member_2,member_3,member_4,member_5,group_leader_id,group_leader_email,group_leader_phone) values ("' . $group_name . '","' . $group_leader . '","' . $member_1 . '","' . $member_2 . '","' . $member_3 . '","' . $member_4 . '","' . $member_5 . '","' . $group_leader_id . '","' . $group_leader_email . '","' . $group_leader_phone . '")';
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "Group Registered Successfully!!!", 'error' => '');
        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error In inserting record');
        $jsn = json_encode($arr);
        print_r($jsn);
    }
} else {
    $arr = array('msg' => "", 'error' => 'Leader Already exists with same email');
    $jsn = json_encode($arr);
    print_r($jsn);
}

/*======================
EMAIL LOGIC
=====================*/
// Read POST request params into global vars
$to = 'laurens.ortiz@gmail.com';
$from = $group_leader_email;
$subject = 'New Register - Team '.$group_name;
$subjectToUser = 'Welcome '.$group_name.' team';

$msg = '<table align="left" cellspacing="5" cellpadding="5" width="600">';
$msg .= '<tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Group Name</td>
            <td style="border:1px solid #414041";>'.$group_name .'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Group Leader</td>
            <td style="border:1px solid #414041";>'.$group_leader.'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Member 1</td>
            <td style="border:1px solid #414041";>'.$member_1.'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Member 2</td>
            <td style="border:1px solid #414041";>'.$member_2.'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Member 3</td>
            <td style="border:1px solid #414041";>'.$member_3.'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Member 4</td>
            <td style="border:1px solid #414041";>'.$member_4.'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Member 5</td>
            <td style="border:1px solid #414041";>'.$member_5.'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Leader ID</td>
            <td style="border:1px solid #414041";>'.$group_leader_id.'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Leader Email</td>
            <td style="border:1px solid #414041";>'.$group_leader_email.'</td>
        </tr>
        <tr>
            <td align="right" style="background:#F16D24; color:#FFF;">Leader Phone</td>
            <td style="border:1px solid #414041";>'.$group_leader_phone.'</td>
        </tr>';

foreach ($_POST as $input => $value) {
    //los campos(input) que no deben de aparecer en el correo(captcha,hidden,botones etc...)
    $remove = array('Submit', 'redirect', 'required', 'subject', 'recipient',
        'env_report', 'missing_fields_redirect', 'submit', 'reset', 'recipients',
        'bad_url', 'good_url', 'Submit2', 'Uword', 'Anum', 'anum', 'uword', 'submit2',
        'Reset', 'successpage', 'enviar', 'receiver', 'success', 'error', 'send','retURL','lead_source','recordType',
        '00Nf0000000e4dq','00Nf0000000e4H6');

    if (!in_array($input, $remove) && $value != "") {
        $input = ucfirst(str_replace("_", " ", $input));
        $msg .= sprintf($cont, $input, $value);
    }
}

$msg .= '</table>';

$msgToUser ='<center>
                <table align="left" cellspacing="5" cellpadding="5" width="600">
                <tr>
                    <td align="center">
                        <img src="http://www.programathon.cr/images/email_logo.gif" border="0"/>
                    </td>
                </tr>
                <tr>
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:18px;text-align:left;letter-spacing:0.025em;color:#7d7d7d;line-height:15px;">
                        Hi '.$group_leader.'
                    </td>
                </tr>
                <tr>
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;text-align:center;letter-spacing:0.025em;color:#7d7d7d;line-height:15px;">
                        Welcome ............
                    </td>
                </tr>
                </table>
            </center>';

// Obtain file upload vars
$fileatt = $_FILES['adjunto']['tmp_name'];
$fileatt_type = $_FILES['adjunto']['type'];
$fileatt_name = $_FILES['adjunto']['name'];

$headers = "From: ".$group_leader_email;
$headersToUser = "From: noreplay@programathon.cr";

// Generate a boundary string
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// Add the headers for a file attachment
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" .
    " boundary=\"{$mime_boundary}\"";
$headersToUser .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" .
    " boundary=\"{$mime_boundary}\"";

// Add a multipart boundary above the plain message
$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" .
    "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $msg . "\n\n";

$messageToUser = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" .
    "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $msgToUser . "\n\n";

if (is_uploaded_file($fileatt)) {
    // Read the file to be attached ('rb' = read binary)
    $file = fopen($fileatt, 'rb');
    $data = fread($file, filesize($fileatt));
    fclose($file);

    // Base64 encode the file data
    $data = chunk_split(base64_encode($data));

    // Add file attachment to the message
    $message .= "--{$mime_boundary}\n" . "Content-Type: {$fileatt_type};\n" .
        " name=\"{$fileatt_name}\"\n" . //"Content-Disposition: attachment;\n" .
        //" filename=\"{$fileatt_name}\"\n" .
    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n" . "--{$mime_boundary}--\n";
}

// Send the message
$ok = @mail($to, $subject, $message, $headers);
$ok2 = @mail($from, $subjectToUser, $messageToUser, $headersToUser);
if ($ok) {
    //header("Location: " . $_POST['retURL']);
    echo 'OK';
} else {
    //header("Location: " . $_POST['error']);
    echo 'error';
}


?>
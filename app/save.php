<?php
$con = mysql_connect('localhost', 'ecotankc_progra', '){zrn+kZqk');
mysql_select_db('ecotankc_prograthon', $con);
// $con = mysql_connect('localhost', 'root', 'root');
// mysql_select_db('prograthon', $con);

$data = json_decode(file_get_contents("php://input"));

$group_name = mysql_real_escape_string($data->group_name);
$group_leader = mysql_real_escape_string($data->group_leader);
$group_leader_TSize = mysql_real_escape_string($data->group_leader_tSize);
$member_1 = mysql_real_escape_string($data->member_1);
$member_1_TSize = mysql_real_escape_string($data->member_1_tSize);
$member_2 = mysql_real_escape_string($data->member_2);
$member_2_TSize = mysql_real_escape_string($data->member_2_tSize);
$member_3 = mysql_real_escape_string($data->member_3);
$member_3_TSize = mysql_real_escape_string($data->member_3_tSize);
$member_4 = mysql_real_escape_string($data->member_4);
$member_4_TSize = mysql_real_escape_string($data->member_4_tSize);
$member_5 = mysql_real_escape_string($data->member_5);
$member_5_TSize = mysql_real_escape_string($data->member_5_tSize);
$group_leader_id = mysql_real_escape_string($data->group_leader_id);
$group_leader_email = mysql_real_escape_string($data->group_leader_email);
$group_leader_phone = mysql_real_escape_string($data->group_leader_phone);


 


$qry_em = 'select count(*) as cnt from groups where group_leader_email ="' . $group_leader_email . '"';
$qry_res = mysql_query($qry_em);
$res = mysql_fetch_assoc($qry_res);

if ($res['cnt'] == 0) {
    $qry = 'INSERT INTO groups (group_name,group_leader,group_leader_TSize,member_1,member_1_TSize,member_2,member_2_TSize,member_3,member_3_TSize,member_4,member_4_TSize,member_5,member_5_TSize,group_leader_id,group_leader_email,group_leader_phone) values ("' . $group_name . '","' . $group_leader . '","' . $group_leader_TSize . '","' . $member_1 . '","' . $member_1_TSize . '","' . $member_2 . '","' . $member_2_TSize . '","' . $member_3 . '","' . $member_3_TSize . '","' . $member_4 . '","' . $member_4_TSize . '","' . $member_5 . '","' . $member_5_TSize . '","' . $group_leader_id . '","' . $group_leader_email . '","' . $group_leader_phone . '")';
    $qry_res = mysql_query($qry);
    if ($qry_res) {
        $arr = array('msg' => "Group Registered Successfully!!!", 'error' => '');
        /*======================
            EMAIL LOGIC
            =====================*/

            include('SMTPconfig.php');
            include('SMTPClass.php');


            $from = $group_leader_email;
            $to = "laurens.ortiz@gmail.com";
            $subject = "New Register - Team ".$group_name;

            $fromUser = "info@programathon.cr";
            $toUser = $group_leader_email;
            $subjectUser = "Welcome - Team ".$group_name;

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
                        <td align="right" style="background:#F16D24; color:#FFF;">Group Leader T-Shirt Size</td>
                        <td style="border:1px solid #414041";>'.$group_leader_TSize.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 1</td>
                        <td style="border:1px solid #414041";>'.$member_1.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 1 T-Shirt Size</td>
                        <td style="border:1px solid #414041";>'.$member_1_TSize.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 2</td>
                        <td style="border:1px solid #414041";>'.$member_2.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 2 T-Shirt Size</td>
                        <td style="border:1px solid #414041";>'.$member_2_TSize.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 3</td>
                        <td style="border:1px solid #414041";>'.$member_3.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 3 T-Shirt Size</td>
                        <td style="border:1px solid #414041";>'.$member_3_TSize.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 4</td>
                        <td style="border:1px solid #414041";>'.$member_4.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 4 T-Shirt Size</td>
                        <td style="border:1px solid #414041";>'.$member_4_TSize.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 5</td>
                        <td style="border:1px solid #414041";>'.$member_5.'</td>
                    </tr>
                    <tr>
                        <td align="right" style="background:#F16D24; color:#FFF;">Member 5 T-Shirt Size</td>
                        <td style="border:1px solid #414041";>'.$member_5_TSize.'</td>
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
            $msgUser ='<center>
                            <table id="bodyTable" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:Arial,Helvetica,sans-serif; background-color:#ffffff" >
                            <tr>
                                <td>
                                    <table bgcolor="#ffffff" class="content" cellpadding="0" cellspacing="0" border="0" align="center" width="640" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                        <tr >
                                            <td width="640" colspan="2">
                                                <img src="http://www.programathon.cr/images/welcome_top.gif" width="640" height="134" alt="Congrats!" border="0"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="80">&nbsp;</td>
                                            <td width="560" style="color:#589FD2;font-family:Arial,Helvetica,sans-serif;font-size:14px; line-height:18px">
                                                We will be contact you soon with more information for your team.<br />
                                                If you have any inquires, just write us an e-mail to <a href="mailto:info@programathon.cr" style="color:#589FD2; text-decoration:none;">info@programathon.cr</a>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td width="640" colspan="2">
                                                <img src="http://www.programathon.cr/images/welcome_bottom.gif" width="640" height="301" alt="" border="0"/>
                                            </td>
                                        </tr>
                                    </table>
                                </td>    
                            </tr>

                            
                            </table>
                        </center>';

            $SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $msg);
            $SMTPChat = $SMTPMail->SendMail();

            $SMTPMail2 = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $fromUser, $toUser, $subjectUser, $msgUser);
            $SMTPChat2 = $SMTPMail2->SendMail();
             
            if (PEAR::isError($SMTPChat)) {
              echo("<p>" . $SMTPChat->getMessage() . "</p>");
            } else {
                
              echo("<p>Message successfully sent!</p>");
            }


        $jsn = json_encode($arr);
        print_r($jsn);
    } else {
        $arr = array('msg' => "", 'error' => 'Error In inserting record');
        $jsn = json_encode($arr);
        print_r($jsn);
    }
} else {
    $arr = array('msg' => "", 'error' => 'Leader already exists with same email');
    $jsn = json_encode($arr);
    print_r($jsn);
}




?>
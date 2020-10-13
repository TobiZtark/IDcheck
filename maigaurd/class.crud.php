<?php

class crud {

    private $db;

  private $sms_session_id = "312aa346-e102-4fb8-97c6-c72e157b45ae";
    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function runQuery($sql) {
        $stmt = $this->db->prepare($sql);
        return $stmt;
    }

    public function lasdID() {
        $stmt = $this->db->lastInsertId();
        return $stmt;
    }

    public function redirect($url) {
        header("Location: $url");
    }

    public function is_logged_in() {
        if (isset($_SESSION['userSession'])) {
            return true;
        }
    }

    public function randomPK() {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('10', '90'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 3; $i++) {
            $rand = mt_rand(0, $max);
            $str = $str . $characters[$rand];
        }
        return $str;
    }

    public function paging($query, $records_per_page) {

        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query, $records_per_page) {
        if (!$query == "") {
            $self = $_SERVER['PHP_SELF'];


            $stmt = $this->db->prepare($query);
            try {
                $stmt->execute();
            } catch (Exception $ex) {

            }


            $total_no_of_records = $stmt->rowCount();

            if ($total_no_of_records > 0) {
                ?><ul class="pager"><?php
                $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
                $current_page = 1;
                $class = "active";
                if (isset($_GET["page_no"])) {
                    $current_page = $_GET["page_no"];
                }
                if ($current_page != 1) {
                    $previous = $current_page - 1;
                    echo "<li><a href='" . $self . "?page_no=1'>First</a></li>";
                    echo "<li><a href='" . $self . "?page_no=" . $previous . "'>Previous</a></li>";
                }
                echo "<li> Page " . $current_page . " of " . $total_no_of_pages . " Pages </li>";
//                    for ($i = 1; $i <= $total_no_of_pages; $i++) {
//                        if ($i == $current_page) {
//                            echo "<li class=" . $class . "><a href='" . $self . "?page_no=" . $i . "' >" . $i . "</a></li>";
//                        } else {
//                            echo "<li><a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
//                        }
//                    }
                if ($current_page != $total_no_of_pages) {
                    $next = $current_page + 1;
                    echo "<li><a href='" . $self . "?page_no=" . $next . "'>Next</a></li>";
                    echo "<li><a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Last</a></li>";
                }
                ?></ul><?php
            }
        }
    }


    public function logout() {
        session_destroy();
        $_SESSION['userSession'] = false;
    }
   

 public function sendSMS($sendto, $message) {
        //  $session_id = "312aa346-e102-4fb8-97c6-c72e157b45ae";
        $owneremail = "indyer25@gmail.com";
        $subacct = "KopaHub";
        $subacctpwd = "indyerjonah@kopahub";
        //   $sendto = "08114395437"; /* destination number */
        $sender = "NIMCconnect"; /* sender id */
        // $message = "Welcome to KopaHub. Buy, sell and get informed!"; /* message to be sent */

        $url = "http://www.smslive247.com/http/index.aspx?"
                . "cmd=sendmsg"
                . "&sessionid=" . UrlEncode($this->sms_session_id)
                . "&message=" . UrlEncode($message)
                . "&sender=" . UrlEncode($sender)
                . "&sendto=" . UrlEncode($sendto)
                . "&msgtype=0";
        /* call the URL */
        if ($f = @fopen($url, "r")) {
            $answer = fgets($f, 255);
            if (substr($answer, 0, 1) == "+") {
                //  echo "SMS to $dnr was successful.";
                return true;
            } else {
                //  $result = "an error has occurred: ".[$answer];
                return false;
            }
        } else {
            //  echo "Error: URL could not be opened.";
            return false;
        }
    }

    public function send_confirmation_email($email, $message, $subject) {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
           $mail->Host = "emerald3.doveserver.com";
        $mail->Port = 465;
        $mail->AddAddress($email);

        $mail->Username = "admin@eventory.ng";
        $mail->Password = "G0OZ7UGTriO-";
        $mail->SetFrom('connect@nimc.gov.ng', 'NIMC Connect');
        $mail->AddReplyTo("connect@nimc.gov.ng", "NIMC Connect");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

   

    public function time_elapsed_string($ptime) {
        $etime = time() - $ptime;

        if ($etime < 1) {
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
            );
        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
            );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

 


//  function get_client_ip() {
//     $ipaddress = '';
//     if (getenv('HTTP_CLIENT_IP'))
//         $ipaddress = getenv('HTTP_CLIENT_IP');
//     else if(getenv('HTTP_X_FORWARDED_FOR'))
//         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
//     else if(getenv('HTTP_X_FORWARDED'))
//         $ipaddress = getenv('HTTP_X_FORWARDED');
//     else if(getenv('HTTP_FORWARDED_FOR'))
//         $ipaddress = getenv('HTTP_FORWARDED_FOR');
//     else if(getenv('HTTP_FORWARDED'))
//        $ipaddress = getenv('HTTP_FORWARDED');
//     else if(getenv('REMOTE_ADDR'))
//         $ipaddress = getenv('REMOTE_ADDR');
//     else
//         $ipaddress = 'UNKNOWN';
//     return $ipaddress;
// }

}

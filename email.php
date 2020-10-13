	<?php
	
			$html_head = file_get_contents("mailer/template/confirm-change/head_html.html");
			$html_body = file_get_contents("mailer/template/confirm-change/body_html.html");
        	$html_before_tail = file_get_contents("mailer/template/confirm-change/before_tail_html.html");
        	$html_after_tail = file_get_contents("mailer/template/confirm-change/after_tail_html.html");

			$html_tail = '<tr><td>
			Tracking ID:
		</td>
		<td>
			GT1234567890
		</td>
	</tr>
	<tr>
		<td>
			Batch ID:
		</td>
		<td>
			GT1234567890
		</td>
	</tr>';

	//$subject = "Change ";

 $email_message = $html_head.$html_body.$html_before_tail.$html_tail.$html_after_tail;
echo $email_message;
 //$full_email = $html_head.$html_body.$html_tail;
        	?>
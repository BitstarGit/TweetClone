/*
@*************************************************************************@
@ @author Mansur Altamirov (Mansur_TL)									  @
@ @author_url 1: https://www.instagram.com/mansur_tl                      @
@ @author_url 2: http://codecanyon.net/user/mansur_tl                     @
@ @author_email: highexpresstore@gmail.com                                @
@*************************************************************************@
@ ColibriSM - The Ultimate Modern Social Media Sharing Platform           @
@ Copyright (c) 21.03.2020 ColibriSM. All rights reserved.                @
@*************************************************************************@
 */

SELECT 

	user.`id` as user_id,
	user.`username`,
	CONCAT(user.`fname`,' ',user.`lname`) as name,
	user.`avatar`,
	user.`verified`,

	chat.`id` as chat_id, 
	chat.`time`, 

	/* Select last message from  chat conversation */

		(SELECT  message.`message`  FROM `<?php echo($data['t_msgs']); ?>` message  WHERE 

			(message.`sent_by` = chat.`user_one` AND message.`sent_to` = chat.`user_two` AND message.`deleted_fs1` = 'N') OR

			(message.`sent_by` = chat.`user_two` AND message.`sent_to` = chat.`user_one` AND message.`deleted_fs2` = 'N')

		ORDER BY message.`id` DESC LIMIT 1) AS last_message,


	/* Select_ unseen messages total from_ user conversation */

		(SELECT  COUNT(m.`id`) FROM `<?php echo($data['t_msgs']); ?>` m WHERE (m.`sent_to` = <?php echo($data['user_id']); ?> AND m.`sent_by` = chat.`user_two`) AND m.`seen` = 0) AS new_messages


FROM `<?php echo($data['t_chats']); ?>` chat INNER JOIN `<?php echo($data['t_users']); ?>` user ON chat.`user_two` = user.`id`

	WHERE chat.`user_one` = <?php echo($data['user_id']); ?>

	<?php if($data['offset']): ?>
		AND chat.`id` < <?php echo($data['offset']); ?>
	<?php endif; ?>

  	ORDER BY chat.`time` DESC 

<?php if($data['limit']): ?>
	LIMIT <?php echo($data['limit']); ?>
<?php endif; ?>
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

SELECT reports.`id`, reports.`user_id`, reports.`post_id`, reports.`report_id`, reports.`time`, users.`username`, users.`avatar`, CONCAT(users.`fname`,' ', users.`lname`) as `name`

	FROM `<?php echo($data['t_reports']); ?>` reports

  INNER JOIN `<?php echo($data['t_users']); ?>` users ON reports.`user_id` = users.`id`

	WHERE reports.`id` > 0

	<?php if($data['offset']): ?>

		<?php if($data['offset_to'] == 'gt'): ?>

			AND reports.`id` > <?php echo($data['offset']); ?>

		<?php else: ?>

			AND reports.`id` < <?php echo($data['offset']); ?>

		<?php endif; ?>

	<?php endif; ?>

	ORDER BY reports.`id` <?php echo($data['order']); ?>

<?php if($data['limit']): ?>
	LIMIT <?php echo($data['limit']); ?>
<?php endif; ?>



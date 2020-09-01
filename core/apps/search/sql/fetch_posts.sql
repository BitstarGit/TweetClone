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

SELECT * FROM `<?php echo($data['t_pubs']); ?>` 

	WHERE `status` = "active"

	<?php if(not_empty($data['keyword'])): ?>
		AND (`text` LIKE "%<?php echo($data['keyword']); ?>%"

		<?php if($data['htag']): ?>
			OR `text` LIKE "%{#id:<?php echo($data['htag']); ?>#}%"
		<?php endif; ?>)

	<?php endif; ?>

	<?php if($data['offset']): ?>
		AND `id` < <?php echo($data['offset']); ?>
	<?php endif; ?>

	ORDER BY `id` DESC, `likes_count` DESC, `replys_count` DESC, `reposts_count` DESC

<?php if($data['limit']): ?>
	LIMIT <?php echo($data['limit']); ?>
<?php endif; ?>


<?php
// force UTF-8 Ø

if (!defined('WEBPATH'))
	die();
?>
<!DOCTYPE html>
<html<?php printLangAttribute(); ?>>
	<head>
		<meta charset="<?php echo LOCAL_CHARSET; ?>">
		<?php zp_apply_filter('theme_head'); ?>
		<?php printHeadTitle(); ?>
		<link rel="stylesheet" href="<?php echo pathurlencode($zenCSS); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo pathurlencode(dirname(dirname($zenCSS))); ?>/common.css" type="text/css" />
		<?php if (class_exists('RSS')) printRSSHeaderLink('Gallery', gettext('Gallery RSS')); ?>
	</head>
	<body>
		<?php zp_apply_filter('theme_body_open'); ?>
		<div id="main">
<img id="logo" src="https://www.nurmoja.net.ee/nurmoja_net_ee.png" style="float:left; margin-right:20px;"/>
			<div id="gallerytitle">
				<h1><?php printHomeLink('', ' | ');
				printGalleryTitle(); ?></h1>
				<?php if (getOption('Allow_search')) {
					printSearchForm('');
				} ?>
			</div>
			<div id="padbox">
				<?php printGalleryDesc(); ?>
				<div id="albums">
					<?php while (next_album()): ?>
						<div class="album">
							<div class="thumb">
								<a href="<?php echo html_encode(getAlbumURL()); ?>" title="<?php echo gettext('View album:'); ?> <?php printAnnotatedAlbumTitle(); ?>"><?php printAlbumThumbImage(getAnnotatedAlbumTitle()); ?></a>
							</div>
							<div class="albumdesc">
								<h3><a href="<?php echo html_encode(getAlbumURL()); ?>" title="<?php echo gettext('View album:'); ?> <?php printAnnotatedAlbumTitle(); ?>"><?php printAlbumTitle(); ?></a></h3>
								<small><?php printAlbumDate(""); ?></small>
								<div><?php printAlbumDesc(); ?></div>
							</div>
							<p style="clear: both; "></p>
						</div>
					<?php endwhile; ?>
				</div>
				<br class="clearall">
				<?php printPageListWithNav("« " . gettext("prev"), gettext("next") . " »"); ?>
			</div>
		</div>
		<div id="credit">
			<?php /*
			if (function_exists('printFavoritesURL')) {
				printFavoritesURL(NULL, '', ' | ', '<br />');
			}
*/			?>
			<?php if (!zp_loggedin()) { ?>
			<a href="zp-core/zp-extensions/federated_logon/OpenID_logon.php?redirect=/index.php&user=openid.ee"><img src="https://www.nurmoja.net.ee/id-kaart.png" alt="ID-KAART"></a><br />
			<?php } ?>
			<?php @call_user_func('printUserLogin_out','', ' | ');?>
			<?php if (class_exists('RSS')) printRSSLink('Gallery', '', 'RSS', ' | '); ?>
			<?php printCustomPageURL(gettext("Archive View"), "archive"); ?> |
			<?php
			if (extensionEnabled('contact_form')) {
				printCustomPageURL(gettext('Contact us'), 'contact', '', '', ' | ');
			}
			?>
			<?php
			if (!zp_loggedin() && function_exists('printRegisterURL')) {
				printRegisterURL(gettext('Register for this site'), '', ' | ');
			}
			?>
			<?php
			if (function_exists('printFavoritesLink')) {
				printFavoritesLink();
				?> | <?php
			}
			?>
			<?php printZenphotoLink(); ?>
		</div>
		<?php @call_user_func('mobileTheme::controlLink'); ?>
		<?php @call_user_func('printLanguageSelector'); ?>
		<?php
		zp_apply_filter('theme_body_close');
		?>
		<?php include 'inc-footer.php'; ?>
	</body>
</html>
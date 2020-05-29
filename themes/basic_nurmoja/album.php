<?php
// force UTF-8 Ø

if (!defined('WEBPATH'))
	die();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php zp_apply_filter('theme_head'); ?>
		<?php printHeadTitle(); ?>
		<meta charset="<?php echo LOCAL_CHARSET; ?>">
		<link rel="stylesheet" href="<?php echo pathurlencode($zenCSS); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo pathurlencode(dirname(dirname($zenCSS))); ?>/common.css" type="text/css" />
		<?php if (class_exists('RSS')) printRSSHeaderLink('Album', getAlbumTitle()); ?>
	</head>
	<body>
		<?php zp_apply_filter('theme_body_open'); ?>
		<div id="main">
<img id="logo" src="https://www.nurmoja.net.ee/nurmoja_net_ee.png" style="float:left; margin-right:20px;"/>
			<div id="gallerytitle">
				<?php
				if (getOption('Allow_search')) {
					$album_list = array('albums' => array($_zp_current_album->name), 'pages' => '0', 'news' => '0');
					printSearchForm('', 'search', gettext('Search within album'), gettext('Search'), NULL, NULL, $album_list);
				}
				?>
				<h2>
					<span>
						<?php printHomeLink('', ' | '); printGalleryIndexURL(' | ', getGalleryTitle()); printParentBreadcrumb(); ?>
					</span>
					<?php printAlbumTitle(); ?>
				</h2>
			</div>
			<div id="padbox">
		<p><?php printAlbumZipStream(); ?></p>
				<p><?php printAlbumDesc(); ?></p>
				<p><?php printPageListWithNav("« " . gettext("prev"), gettext("next") . " »"); ?></p>
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

						</div>
					<?php endwhile; ?>
				</div>
				<br class="clearfloat">
				<div id="images">
					<?php while (next_image()): ?>
						<div class="image">
							<div class="imagethumb">
								<a href="<?php echo html_encode(getImageURL()); ?>" title="<?php printBareImageTitle(); ?>">
									<?php printImageThumb(getAnnotatedImageTitle()); ?>
								</a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<br class="clearfloat">
				<?php
    printPageListWithNav("« " . gettext("prev"), gettext("next") . " »");
    if (function_exists('printAddToFavorites')) printAddToFavorites($_zp_current_album);
    printTags('links', gettext('<strong>Tags:</strong>') . ' ', 'taglist', '');
    @call_user_func('printGoogleMap');
    @call_user_func('printSlideShowLink');
    @call_user_func('printRating');
    @call_user_func('printCommentForm');
    ?>
			</div>
	    <?php if (function_exists('zenFBComments')) { zenFBComments(); } ?>
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
			<?php if (class_exists('RSS')) printRSSLink('Album', '', 'RSS', ' | '); ?>
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
			if (function_exists('printFavoritesURL')) {
				printFavoritesURL(NULL, '', ' | ', '<br />');
			}
			?>
			<?php printZenphotoLink(); ?>
		</div>
		<?php
		zp_apply_filter('theme_body_close');
		?>
	</body>
</html>
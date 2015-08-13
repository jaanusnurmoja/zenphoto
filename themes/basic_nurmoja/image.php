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
		<?php if (zp_has_filter('theme_head', 'colorbox::css')) { ?>
			<script type="text/javascript">
				// <!-- <![CDATA[
				$(document).ready(function() {
					$(".colorbox").colorbox({
						inline: true,
						href: "#imagemetadata",
						close: '<?php echo gettext("close"); ?>'
					});
					$(".fullimage").colorbox({
						maxWidth: "98%",
						maxHeight: "98%",
						photo: true,
						close: '<?php echo gettext("close"); ?>'
					});
				});
				// ]]> -->
			</script>
		<?php } ?>
		<?php if (class_exists('RSS')) printRSSHeaderLink('Gallery', gettext('Gallery RSS')); ?>
	</head>
	<body>
		<?php zp_apply_filter('theme_body_open'); ?>
		<div id="main">
<img id="logo" src="http://www.nurmoja.net.ee/nurmoja_net_ee.png" style="float:left; margin-right:20px;"/>
			<div id="gallerytitle">
				<div class="imgnav">
					<?php
					if (hasPrevImage()) {
						?>
						<div class="imgprevious"><a href="<?php echo html_encode(getPrevImageURL()); ?>" title="<?php echo gettext("Previous Image"); ?>">« <?php echo gettext("prev"); ?></a></div>
						<?php
					} if (hasNextImage()) {
						?>
						<div class="imgnext"><a href="<?php echo html_encode(getNextImageURL()); ?>" title="<?php echo gettext("Next Image"); ?>"><?php echo gettext("next"); ?> »</a></div>
						<?php
					}
					?>
				</div>
				<h2>
					<span>
						<?php printHomeLink('', ' | '); printGalleryIndexURL(' | ', getGalleryTitle()); 
						printParentBreadcrumb("", " | ", " | ");
						printAlbumBreadcrumb("", " | ");
						?>
					</span>
					<?php printImageTitle(); ?>
				</h2>
			</div>
			<!-- The Image -->
			<div id="image">
				<strong>
					<?php
					if (isImagePhoto()) {
						$fullimage = getFullImageURL();
					} else {
						$fullimage = NULL;
					}
					if (!empty($fullimage)) {
						?>
						<a href="<?php echo html_encode(pathurlencode($fullimage)); ?>" title="<?php printBareImageTitle(); ?>" class="fullimage">
							<?php
						}
						if (function_exists('printUserSizeImage') && isImagePhoto()) {
							printUserSizeImage(getImageTitle());
						} else {
							printDefaultSizedImage(getImageTitle());
						}
						if (!empty($fullimage)) {
							?>
						</a>
						<?php
					}
					?>
				</strong>
				<?php
				if (isImagePhoto())
					@call_user_func('printUserSizeSelector');
				?>
			</div>
			<div id="narrow">
				<?php printImageDesc(); ?>
				<hr /><br />
				<?php
				If (function_exists('printAddToFavorites'))
					printAddToFavorites($_zp_current_image);
				@call_user_func('printSlideShowLink');

				if (getImageMetaData()) {
					printImageMetadata('', false);
					?>
					<br class="clearall" />
					<?php
				}
				printTags('links', gettext('<strong>Tags:</strong>') . ' ', 'taglist', '');
				?>
				<?php if (function_exists('zenFBComments')) { zenFBComments(); } ?>
				<br class="clearall" />

				<?php 
    @call_user_func('printGoogleMap'); 
    @call_user_func('printRating'); 
    @call_user_func('printCommentForm'); 
    ?>
			</div>
		</div>
		<div id="credit">
			<?php if (!zp_loggedin()) { ?>
			<a href="zp-core/zp-extensions/federated_logon/OpenID_logon.php?redirect=/index.php&user=openid.ee"><img src="http://www.nurmoja.net.ee/id-kaart.png" alt="ID-KAART"></a><br />
			<?php } ?>
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
			<?php printZenphotoLink(); ?> | 
			<?php @call_user_func('printUserLogin_out','', '');?>
		</div>
		<?php
		zp_apply_filter('theme_body_close');
		?>
	</body>
</html>

<?php
// force UTF-8 Ø

if (!defined('WEBPATH')) die();
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
<img id="logo" src="http://www.nurmoja.net.ee/nurmoja_net_ee.png" style="float:left; margin-right:20px;"/>
			<div id="gallerytitle">
				<?php
				if (getOption('Allow_search')) {
					$album_list = array('albums' => array($_zp_current_album->name), 'pages' => '0', 'news' => '0');
					printSearchForm('', 'search', gettext('Search within album'), gettext('search'), NULL, NULL, $album_list);
				}
				?>
				<h2>
					<span>
						<?php printHomeLink('', ' | '); ?>
						<a href="<?php echo html_encode(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php printGalleryTitle(); ?></a> |
						<?php printParentBreadcrumb(); ?>
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
								<a href="<?php echo html_encode(getAlbumLinkURL()); ?>" title="<?php echo gettext('View album:'); ?> <?php printAnnotatedAlbumTitle(); ?>"><?php printAlbumThumbImage(getAnnotatedAlbumTitle()); ?></a>
							</div>
							<div class="albumdesc">
								<h3><a href="<?php echo html_encode(getAlbumLinkURL()); ?>" title="<?php echo gettext('View album:'); ?> <?php printAnnotatedAlbumTitle(); ?>"><?php printAlbumTitle(); ?></a></h3>
								<small><?php printAlbumDate(""); ?></small>
								<div><?php printAlbumDesc(); ?></div>
							</div>
							<p style="clear: both; "></p>
						</div>
					<?php endwhile; ?>
				</div>
							<p style="clear: both; "></p>
				<div id="images">
					<?php while (next_image()): ?>
						<div class="image">
							<div class="imagethumb">
								<a href="<?php echo html_encode(getImageLinkURL()); ?>" title="<?php printBareImageTitle(); ?>">
									<?php printImageThumb(getAnnotatedImageTitle()); ?>
								</a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
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
			<?php if (class_exists('RSS')) printRSSLink('Album', '', gettext('Album RSS'), ' | '); ?>
			<?php printCustomPageURL(gettext("Archive View"), "archive"); ?> |
			<?php
			if (function_exists('printFavoritesURL')) {
				printFavoritesURL(NULL, '', ' | ', '<br />');
			}
			?>
			<?php 
   if (class_exists('RSS')) printRSSLink('Album', '', gettext('Album RSS'), ' | '); 
   printCustomPageURL(gettext("Archive View"), "archive"); 
   printZenphotoLink(); 
   @call_user_func('printUserLogin_out', " | "); 
   ?>
		</div>
		<?php
		zp_apply_filter('theme_body_close');
		?>
	</body>
</html>
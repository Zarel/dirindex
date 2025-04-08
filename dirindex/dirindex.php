<?php

$fa5pro = file_exists(__DIR__ . '/fontawesome5-solid-duotone.min.css');

$rel_dir = explode('?', $_SERVER['REQUEST_URI'])[0];
$dir = $_SERVER['DOCUMENT_ROOT'] . $rel_dir;
$dirname = basename($dir);
$files = scandir($dir);
$fileinfo = [];

$at_root = ($rel_dir === '/');
$up = null;

function get_icon(string $file, bool $is_dir) {
	global $fa5pro;
	if ($fa5pro) return get_icon_fa5pro($file, $is_dir);

	if ($is_dir) {
		return 'fa fa-folder-open';
	} else {
		$info = pathinfo($file);
		$ext = strtolower($info['extension'] ?? '.');
		if ($ext === 'jpg' || $ext === 'jpeg' || $ext === 'png' || $ext === 'bmp' || $ext === 'webp' || $ext === 'svg') {
			return 'fa fa-picture-o';
		} else if ($ext === 'gif') {
			return 'fa fa-film';
		} else if ($ext === 'mp4' || $ext === 'webm' || $ext === 'mkv' || $ext === 'avi' || $ext === 'mov') {
			return 'fa fa-video-camera';
		} else if ($ext === 'mp3' || $ext === 'ogg' || $ext === 'wav' || $ext === 'flac' || $ext === 'aac') {
			return 'fa fa-volume-up';
		} else if ($ext === 'zip' || $ext === 'tar' || $ext === 'gz') {
			return 'fa fa-file-archive-o';
		} else if ($ext === 'txt' || $ext === 'md') {
			return 'fa fa-file-text-o icon-' . $ext;
		} else if ($ext === 'html' || $ext === 'php') {
			return 'fa fa-file-code-o icon-' . $ext;
		} else if ($ext === 'js' || $ext === 'ts' || $ext === 'jsx' || $ext === 'tsx' || $ext === 'json') {
			return 'fa fa-code icon-' . substr($ext, 0, 2);
		} else if ($ext === 'mts' || $ext === 'cts' || $ext === 'mjs' || $ext === 'cjs') {
			return 'fa fa-code icon-' . substr($ext, 1, 2);
		} else if ($ext === 'c' || $ext === 'cpp' || $ext === 'h' || $ext === 'hpp' || $ext === 'py' || $ext === 'xml' || $ext === 'java' || $ext === 'rb' || $ext === 'go' || $ext === 'swift' || $ext === 'rs' || $ext === 'map' || $ext === 'csv') {
			return 'fa fa-code';
		} else if ($ext === 'css') {
			return 'fa fa-code icon-' . $ext;
		} else if ($ext === 'woff' || $ext === 'woff2' || $ext === 'ttf' || $ext === 'otf' || $ext === 'eot') {
			return 'fa fa-font';
		} else if ($ext === 'pdf') {
			return 'fa fa-file-pdf-o';
		} else if ($ext === 'doc' || $ext === 'docx' || $ext === 'odt') {
			return 'fa fa-file-word-o';
		} else if ($ext === 'xls' || $ext === 'xlsx' || $ext === 'ods') {
			return 'fa fa-file-excel-o';
		} else if ($ext === 'ppt' || $ext === 'pptx' || $ext === 'odp') {
			return 'fa fa-file-powerpoint-o';
		} else if ($ext === 'epub' || $ext === 'mobi') {
			return 'fa fa-book';
		} else if ($ext === 'exe' || $ext === 'dmg') {
			return 'fa fa-window-maximize';
		}
	}
	return 'fa fa-file-o';
}

function get_icon_fa5pro(string $file, bool $is_dir) {
	if ($is_dir) {
		return 'fad fa-folder-open';
	} else {
		$info = pathinfo($file);
		$ext = strtolower($info['extension'] ?? '.');
		if ($ext === 'jpg' || $ext === 'jpeg' || $ext === 'png' || $ext === 'bmp' || $ext === 'webp' || $ext === 'svg') {
			return 'fad fa-image';
		} else if ($ext === 'gif') {
			return 'fad fa-film';
		} else if ($ext === 'mp4' || $ext === 'webm' || $ext === 'mkv' || $ext === 'avi' || $ext === 'mov') {
			return 'fas fa-video';
		} else if ($ext === 'mp3' || $ext === 'ogg' || $ext === 'wav' || $ext === 'flac' || $ext === 'aac') {
			return 'fas fa-volume';
		} else if ($ext === 'zip' || $ext === 'tar' || $ext === 'gz') {
			return 'fad fa-file-archive';
		} else if ($ext === 'txt' || $ext === 'md') {
			return 'fad fa-file-alt icon-' . $ext;
		} else if ($ext === 'html' || $ext === 'php') {
			return 'fad fa-file-code icon-' . $ext;
		} else if ($ext === 'js' || $ext === 'ts' || $ext === 'jsx' || $ext === 'tsx' || $ext === 'json') {
			return 'fad fa-code icon-' . substr($ext, 0, 2);
		} else if ($ext === 'mts' || $ext === 'cts' || $ext === 'mjs' || $ext === 'cjs') {
			return 'fad fa-code icon-' . substr($ext, 1, 2);
		} else if ($ext === 'css') {
			return 'fad fa-code icon-' . $ext;
		} else if ($ext === 'c' || $ext === 'cpp' || $ext === 'h' || $ext === 'hpp' || $ext === 'py' || $ext === 'xml' || $ext === 'css' || $ext === 'java' || $ext === 'rb' || $ext === 'go' || $ext === 'swift' || $ext === 'rs' || $ext === 'map') {
			return 'fad fa-code';
		} else if ($ext === 'woff' || $ext === 'woff2' || $ext === 'ttf' || $ext === 'otf' || $ext === 'eot') {
			return 'fad fa-font-case';
		} else if ($ext === 'pdf') {
			return 'fad fa-file-pdf';
		} else if ($ext === 'csv') {
			return 'fad fa-file-csv';
		} else if ($ext === 'doc' || $ext === 'docx' || $ext === 'odt') {
			return 'fad fa-file-word';
		} else if ($ext === 'xls' || $ext === 'xlsx' || $ext === 'ods') {
			return 'fad fa-file-excel';
		} else if ($ext === 'ppt' || $ext === 'pptx' || $ext === 'odp') {
			return 'fad fa-file-powerpoint';
		} else if ($ext === 'epub' || $ext === 'mobi') {
			return 'fad fa-book';
		} else if ($ext === 'exe') {
			return 'fad fa-window-alt';
		} else if ($ext === 'dmg') {
			return 'fad fa-window';
		}
	}
	return 'fad fa-file';
}

foreach ($files as $file) {
	if ($file === '.') {
		continue;
	}
	$path = $dir . '/' . $file;

	$is_dir = is_dir($path);
	$ext = '';
	$icon = get_icon($file, $is_dir);
	if (!$is_dir) {
		$info = pathinfo($file);
		$ext = strtolower($info['extension'] ?? '.');
	}

	$size = $is_dir ? 0 : filesize($path);
	$size_text = '';
	if ($is_dir) {
		$size_text = '';
	} else if ($size > 1024 * 1024 * 1024) {
		$size_text = round($size / (1024 * 1024 * 1024), 2) . ' GiB';
	} else if ($size > 1024 * 1024) {
		$size_text = round($size / (1024 * 1024), 2) . ' MiB';
	} else if ($size > 1024) {
		$size_text = round($size / 1024, 2) . ' KiB';
	} else {
		$size_text = $size . ' bytes';
	}

	$next = [
		'name' => htmlentities($file),
		'mtime' => date('Y-m-d H:i:s', filemtime($path)),
		'icon' => $icon,
		'size' => $size,
		'ext' => $ext,
		'size_text' => $size_text,
	];
	if ($file === '..') {
		if (!$at_root) $up = $next;
	} else {
		$fileinfo[] = $next;
	}
}

$sort_by = $_GET['sort'] ?? $_GET['C'] ?? 'dir';
$sort_order = $_GET['order'] ?? $_GET['A'] ?? 'asc';
if ($sort_order === 'A') $sort_order = 'asc';
function sort_icon($col) {
	global $sort_by, $sort_order;
	if ($col === $sort_by) {
		return ' <i class="fa fa-caret-square-o-' . ($sort_order === 'asc' ? 'up' : 'down') . '"></i>';
	}
	return '';
}
function sort_link($col) {
	global $sort_by, $sort_order;
	if ($col === $sort_by && $sort_order === 'asc') {
		return './?sort=' . $col . '&order=desc';
	}
	if ($col === $sort_by && $sort_order === 'desc') {
		return './';
	}
	return './?sort=' . $col;
}

if ($sort_by === 'name' || $sort_by === 'N') {
	usort($fileinfo, fn($a, $b) => strcmp($a['name'], $b['name']) * ($sort_order === 'asc' ? 1 : -1));
} else if ($sort_by === 'size' || $sort_by === 'S') {
	usort($fileinfo, fn($a, $b) => ($a['size'] <=> $b['size']) * ($sort_order === 'asc' ? 1 : -1));
} else if ($sort_by === 'mtime' || $sort_by === 'M') {
	usort($fileinfo, fn($a, $b) => $a['mtime'] <=> $b['mtime']) * ($sort_order === 'asc' ? 1 : -1);
} else if ($sort_by === 'type') {
	usort($fileinfo, fn($a, $b) => $a['ext'] <=> $b['ext']) * ($sort_order === 'asc' ? 1 : -1);
} else { // name, dirs-first
	usort($fileinfo, fn($a, $b) => !!$a['ext'] <=> !!$b['ext']) * ($sort_order === 'asc' ? 1 : -1);
}

$title = 'Index of ' . $rel_dir;

?><!DOCTYPE html>
<html lang="en"><head>

	<meta charset="UTF-8" />

	<title><?= htmlentities($title) ?></title>

	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="/dirindex/font-awesome.min.css" />
<?php if ($fa5pro) { ?>
	<link rel="stylesheet" href="/dirindex/fontawesome5-solid-duotone.min.css?" />
<?php } ?>

	<style>
		html {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			background: #f0f0f0;
			color: #333333;
		}
		body {
			margin: 0 auto;
			padding: 15px;
			max-width: 800px;
			overflow-wrap: break-word;
		}

		a {
			color: #0073aa;
		}
		a:visited {
			color: #8000aa;
		}
		h1 {
			font-size: 1.5em;
			margin-bottom: 20px;
		}
		h1 a {
			font-weight: normal;
			text-decoration: none;
		}
		h1 a:hover {
			text-decoration: underline;
		}

		ul {
			list-style-type: none;
			padding: 0;
		}
		.header {
			padding: 0 9px;
			border-bottom: 1px solid #888888;
			background: #f0f0f0;
		}
		.parent {
			padding: 0 0 12px 0;
		}

		.header a, .header a:visited {
			text-decoration: none;
			padding: 5px 0;
			color: inherit;
		}
		.header a:hover {
			background: #dddddd;
		}
		a.row {
			text-decoration: none;
			display: block;
			border: 1px solid transparent;
			padding: 4px 8px;
			border-radius: 4px;
		}
		a.row:hover {
			background:#e7ebee;
			border-color:#5f8a9e;
		}
		a.row * {
			vertical-align: middle;
		}

		.icon {
			display: inline-block;
			width: 32px;
			font-size: 20px;
			text-align: center;
			color: #777;
		}
		.icon.fa-arrow-circle-o-up, .icon.fa-folder-open {
			color: #3798c5;
		}
		.icon.fa-arrow-circle-o-up, .icon.fa-folder-open {
			color: #3798c5;
			--fa-secondary-opacity: 0.55;
		}
		.icon.fa-image, .icon.fa-picture-o, .icon.fa-film, .icon.fa-video, .icon.fa-video-camera, .icon.fa-volume, .icon.fa-volume-up {
			color: rgb(139, 115, 82);
			--fa-secondary-opacity: 0.4;
		}
		.icon.icon-js {
			color: rgb(160, 153, 89);
		}
		.icon.icon-ts, .icon.icon-md {
			color: rgb(83, 112, 149);
		}
		.icon.icon-html {
			color: rgb(166, 125, 67);
		}
		.icon.icon-php, .icon.icon-css {
			color: rgb(125, 83, 149);
		}
		.icon.fa-file-pdf, .icon.fa-file-pdf-o, .icon.fa-font-case {
			color: rgb(149, 83, 83);
		}
		.icon.fa-file-archive, .icon.fa-file-archive-o {
			color:rgb(116, 149, 163);
		}

		.filename {
			display: inline-block;
			width: 50%;
			min-width: 260px;
			font-family: monospace;
		}
		.parent .filename {
			font-family: inherit;
			font-style: italic;
		}
		.filesize {
			display: inline-block;
			width: 20%;
			min-width: 80px;
			color: #666666;
		}
		.filemtime {
			display: inline-block;
			color: #666666;
			font-size: 0.9em;
			min-width: 120px;
		}
		.header .icon, .header .filename, .header .filesize, .header .filemtime {
			font-style: normal;
			font-family: inherit;
			font-size: inherit;
			color: inherit;
		}
		@media (prefers-color-scheme: dark) {
			html {
				background: #000;
				color: #ddd;
			}
			.header {
				background: #000;
			}
			.header a:hover {
				background: #333;
			}
			.icon {
				color: #888;
			}
			a {
				color:rgb(99, 174, 209);
			}
			a:visited {
				color:rgb(177, 123, 195);
			}
			a.row:hover {
				background: #181818;
				border-color: #444;
			}
			.filesize, .filemtime {
				color: #888;
			}
		}
	</style>
</head><body>

	<h1>
		Index of
		<a href="/"><?= htmlentities($_SERVER['SERVER_NAME']) ?></a><?php

$path = '';
$pathparts = array_slice(explode('/', $rel_dir), 1, -1);
$lastpart = array_pop($pathparts);
foreach ($pathparts as $cur_dir) {
	$path .= '/' . $cur_dir;
	echo '/';
	echo '<a href="' . htmlentities($path) . '/">' . htmlentities($cur_dir) . '</a>';
}
if ($lastpart) echo '/' . htmlentities($lastpart);
echo '/';

?>
	</h1>

<?php if ($up) { ?>
	<p class="parentlink">
		<a class="row" href="../">
			<i class="icon fa fa-arrow-circle-o-up">
			</i><em>(Parent directory)
			</em>
		</a>
	</p>
<?php } ?>

	<ul>
		<li class="header">
			<a class="icon" href="<?= sort_link('type') ?>">&nbsp;<?= sort_icon('type') ?>
			</a><a class="filename" href="<?= sort_link('name') ?>">Name<?= sort_icon('name') ?>
			</a><a class="filesize" href="<?= sort_link('size') ?>">Size<?= sort_icon('size') ?>
			</a><a class="filemtime" href="<?= sort_link('mtime') ?>">Last Modified<?= sort_icon('mtime') ?></a>
		</li>
<?php foreach ($fileinfo as $file) : ?>
		<li>
			<a class="row" href="./<?= rawurlencode($file['name']) ?>">
				<i class="icon <?= $file['icon'] ?>">
				</i><code class="filename"><?= $file['name'] === '..' ? '(Parent directory)' : htmlentities($file['name']) ?>
				</code><em class="filesize"><?= $file['size_text'] ?>
				</em><small class="filemtime"><?= $file['mtime'] ?></small>
			</a>
		</li>
<?php endforeach; ?>
	</ul>

</body>

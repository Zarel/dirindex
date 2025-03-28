<?php

$rel_dir = explode('?', $_SERVER['REQUEST_URI'])[0];
$dir = $_SERVER['DOCUMENT_ROOT'] . $rel_dir;
$dirname = basename($dir);
$files = scandir($dir);
$fileinfo = [];

$at_root = ($rel_dir === '/');
$up = null;

foreach ($files as $file) {
	if ($file === '.') {
		continue;
	}
	$path = $dir . '/' . $file;

	$is_dir = is_dir($path);
	$type = 'file';
	$ext = '';
	if ($file === '..') {
		$type = 'circle-up';
	} else if ($is_dir) {
		$type = 'folder-open';
	} else {
		$info = pathinfo($file);
		$ext = strtolower($info['extension'] ?? '.');
		if ($ext === 'jpg' || $ext === 'jpeg' || $ext === 'png' || $ext === 'gif' || $ext === 'bmp' || $ext === 'webp' || $ext === 'svg') {
			$type = 'file-image';
		} else if ($ext === 'mp4' || $ext === 'webm' || $ext === 'ogg' || $ext === 'mkv' || $ext === 'avi' || $ext === 'mov') {
			$type = 'file-video';
		} else if ($ext === 'mp3' || $ext === 'wav' || $ext === 'flac' || $ext === 'aac') {
			$type = 'file-audio';
		} else if ($ext === 'pdf') {
			$type = 'file-pdf';
		} else if ($ext === 'zip' || $ext === 'tar' || $ext === 'gz') {
			$type = 'file-archive';
		} else if ($ext === 'txt' || $ext === 'md') {
			$type = 'file-lines';
		} else if ($ext === 'c' || $ext === 'cpp' || $ext === 'h' || $ext === 'hpp' || $ext === 'py' || $ext === 'js' || $ext === 'ts' || $ext === 'jsx' || $ext === 'tsx' || $ext === 'json' || $ext === 'html' || $ext === 'xml' || $ext === 'css' || $ext === 'java' || $ext === 'php' || $ext === 'rb' || $ext === 'go' || $ext === 'swift' || $ext === 'rs') {
			$type = 'file-code';
		} else if ($ext === 'doc' || $ext === 'docx' || $ext === 'odt') {
			$type = 'file-word';
		} else if ($ext === 'xls' || $ext === 'xlsx' || $ext === 'ods') {
			$type = 'file-excel';
		} else if ($ext === 'ppt' || $ext === 'pptx' || $ext === 'odp') {
			$type = 'file-powerpoint';
		}
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
		'type' => $type,
		'size' => $size,
		'ext' => $ext,
		'size_text' => $size_text,
	];
	if ($file === '..') {
		$up = $next;
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
		return ' <i class="fa-regular fa-square-caret-' . ($sort_order === 'asc' ? 'up' : 'down') . '"></i>';
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

if ($up !== null && !$at_root) array_unshift($fileinfo, $up);

$title = 'Index of ' . $rel_dir;

?><!DOCTYPE html>
<html lang="en"><head>

	<meta charset="UTF-8" />

	<title><?= htmlentities($title) ?></title>

	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="/dirindex/fa-regular.min.css" />

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
			position: sticky;
			top: 0;
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
			width: 24px;
			font-size: 20px;
			text-align: center;
			color: #555;
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
echo '/' . htmlentities($lastpart) . '/';

?>
	</h1>

	<ul>
		<li class="header">
			<a class="icon" href="<?= sort_link('type') ?>">&nbsp;<?= sort_icon('type') ?></a>
			<a class="filename" href="<?= sort_link('name') ?>">Name<?= sort_icon('name') ?></a>
			<a class="filesize" href="<?= sort_link('size') ?>">Size<?= sort_icon('size') ?></a>
			<a class="filemtime" href="<?= sort_link('mtime') ?>">Last Modified<?= sort_icon('mtime') ?></a>
		</li>
<?php foreach ($fileinfo as $file) : ?>
		<li<?= $file['name'] === '..' ? ' class="parent"' : '' ?>>
			<a class="row" href="./<?= htmlentities($file['name']) ?>">
				<i class="icon fa-regular fa-<?= $file['type'] ?>"></i>
				<code class="filename"><?= $file['name'] === '..' ? '(Parent directory)' : htmlentities($file['name']) ?></code>
				<em class="filesize"><?= $file['size_text'] ?></em>
				<small class="filemtime"><?= $file['mtime'] ?></small>
			</a>
		</li>
<?php endforeach; ?>
	</ul>

</body>

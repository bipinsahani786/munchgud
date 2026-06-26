<?php
$source = imagecreatefromjpeg('logo.jpg');
$src_w = imagesx($source);
$src_h = imagesy($source);

$size = max($src_w, $src_h);

$dest = imagecreatetruecolor($size, $size);
$white = imagecolorallocate($dest, 255, 255, 255);
imagefill($dest, 0, 0, $white);

$dst_x = ($size - $src_w) / 2;
$dst_y = ($size - $src_h) / 2;

imagecopy($dest, $source, $dst_x, $dst_y, 0, 0, $src_w, $src_h);

imagepng($dest, 'favicon.png');

imagedestroy($source);
imagedestroy($dest);

echo "favicon.png created successfully.\n";

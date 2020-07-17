<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mimetype extends CI_Controller {

    /**
     * Name : Ogiogio Victor
     * Email : ogiogiovictor@gmail.com
     * Number : 07038807891
     */
    
    public function __construct() {
        parent::__construct(); 
    }

  public function allowedtype(){
	  $allowed = array_unique([
    '3g2', '3gp', '7zip', '7z', 'aac', 'ac3', 'acgi', 'ai', 'aif', 'aifc', 'aiff', 'asp', 'au', 'avi', 'bin', 'bmp', 'cdr', 'cer', 'cpt',
    'crl', 'crt', 'csr', 'css', 'csv', 'dcr', 'der', 'dir', 'divx', 'dll', 'dms', 'doc', 'docx', 'dot', 'dotx', 'dvi', 'dxr', 'eml',
    'eps', 'exe', 'f4v', 'flac', 'flv', 'gif', 'gpg', 'gtar', 'gz', 'gzip', 'hqx', 'htm', 'html', 'ical', 'ics', 'iso', 'jar', 'jpe',
    'jpeg', 'jpg', 'js', 'json', 'kdb', 'kml', 'kmz', 'lha', 'log', 'lzh', 'm3u', 'm4a', 'm4u', 'm4v', 'mid', 'midi', 'mif', 'mkv', 'mov',
    'movie', 'mp2', 'mp3', 'mp4', 'mpe', 'mpeg', 'mpg', 'mpga', 'oda', 'ogg', 'p10', 'p12', 'p7a', 'p7c', 'p7m', 'p7r', 'p7s', 'pdf',
    'pem', 'pgp', 'php', 'php3', 'php4', 'phps', 'phtml', 'png', 'ppt', 'pptx', 'ps', 'psd', 'qt', 'ra', 'ram', 'rar', 'rm', 'rpm',
    'rsa', 'rtf', 'rtx', 'rv', 'sea', 'shtml', 'sit', 'smi', 'smil', 'smv', 'so', 'sql', 'sst', 'svg', 'swf', 'tar', 'text', 'tgz',
    'tif', 'tiff', 'txt', 'vcf', 'vlc', 'vob', 'wav', 'wav', 'wbxml', 'webm', 'wma', 'wmlc', 'wmv', 'wvx', 'word', 'xht', 'xhtml',
    'xl', 'xls', 'xlsx', 'xml', 'xsl', 'xspf', 'z', 'zip', 'zsh'
]);
  }

}

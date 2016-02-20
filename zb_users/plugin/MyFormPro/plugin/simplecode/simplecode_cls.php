<?php
//MyFormPro_Simple Code
class MyFormPro_SC {
	private $charset = 'ABCDEFGHKMNPRSTUVWXYZ123456789';
	private $code;
	private $codelen = 4;
	private $width = 68;
	private $height = 24;
	private $img;
	private $font;
	private $fontsize = 14;
	private $fontcolor;

	public function __construct() {
		global $zbp;
		$this->font = $zbp->usersdir . 'plugin/MyFormPro/plugin/simplecode/fonts/' . mt_rand(1,3) . '.ttf';
		$this->charset = $zbp->option['ZC_VERIFYCODE_STRING'];
		$this->width = $zbp->option['ZC_VERIFYCODE_WIDTH'];
		$this->height = $zbp->option['ZC_VERIFYCODE_HEIGHT'];
	}

	private function createCode() {
		$_len = strlen($this->charset)-1;
		for ($i=0;$i<$this->codelen;$i++) {
			$this->code .= $this->charset[mt_rand(0,$_len)];
		}
	}

	private function createBg() {
		$this->img = imagecreatetruecolor($this->width, $this->height);
		$color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
		imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
	}

	private function createFont() {
		$_x = $this->width / $this->codelen;
		for ($i=0;$i<$this->codelen;$i++) {
			$this->fontcolor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
			imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height / 1.4,$this->fontcolor,$this->font,$this->code[$i]);
		}
	}

	private function createLine() {
		for ($i=3; $i<=$this->height-3; $i=$i+3) {
			$color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
			imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
		}
		for ($i=2;$i<100;$i=$i+6) {
			$color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
			imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
		}
	}

	private function outPut() {
		header('Content-type:image/png');
		imagepng($this->img);
		imagedestroy($this->img);
	}

	public function GetImg() {
		$this->createBg();
		$this->createCode();
//		$this->createLine();
		$this->createFont();
		$this->outPut();
	}

	public function GetCode() {
		return strtolower($this->code);
	}

}

function MyFormPro_ShowValidateImage($id=''){
	global $zbp;

		$_vc = new MyFormPro_SC();
		$_vc->GetImg();
		setcookie('myformpro_' . crc32($zbp->guid . $id), md5( $zbp->guid . date("YmdH") . $_vc->GetCode() ), null,$zbp->cookiespath);
}

function MyFormPro_CheckValidCode($vaidcode,$id=''){
	global $zbp;

		$vaidcode = strtolower($vaidcode);
		$original=GetVars('myformpro_' . crc32($zbp->guid . $id),'COOKIE');
		if(md5( $zbp->guid . date("YmdH") . $vaidcode)==$original) return true;
	}

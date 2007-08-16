<?php
/* 
Plugin Name: Login Encription
Description: Login encripted with DES and RSA
Version: 0.5
Author: ELSERVER.COM
Author URI: http://www.elserver.com/

   This file is part of Login Encryption.

    Login Encryption is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    Login Encryption is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class RSA {
	var $private_key;
	var $public_key;
	var $modulus;

	function RSA($modulus, $public_key, $private_key) {
		$this->modulus    = $modulus;
		$this->public_key  = $public_key;
		$this->private_key = $private_key;
	}


	function encrypt($mensaje) {
		$resultado = "";
		for ($i = 0; $i < strlen($mensaje); $i += 2) {
			$parcial = ord(substr($mensaje, $i, 1));
			if ($i + 1 < strlen($mensaje)) {
				$parcial += ord(substr($mensaje, $i + 1, 1)) << 8;
			}
			$resultado .= "".dechex(bcpowmod($parcial, $this->public_key, $this->modulus)) . " ";
		}
		return $resultado;
	}

	function decrypt($encriptado) {
		$lista = split(" ", $encriptado);
		$resultado = "";
		for ($i = 0; $i < count($lista); $i ++) {
			$parcial = 0;
			$parcial += bcpowmod(hexdec($lista[$i]), $this->private_key, $this->modulus);
			$caracter1 = $parcial & 255;
			$caracter2 = $parcial >> 8;
			$resultado .= chr($caracter1).chr($caracter2);
		}
		return $resultado;
	}

	function to_string() {
		$s = "";
		$s .= "public(hexa)  = " . dechex($this->public_key)  . "\n";
		$s .= "modulus(hexa) = " . dechex($this->modulus) . "\n";
		$s .= "public  = " . $this->public_key  . "\n";
		$s .= "modulus = " . $this->modulus . "\n";
		return $s;
	}

}

?>
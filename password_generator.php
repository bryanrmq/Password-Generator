<?php

	define("PW_LOWER", 1);
	define("PW_UPPER", 2);
	define("PW_NUMBER", 4);
	define("PW_SPECIAL", 8);

	class Password {


		/*
			PRIVATES
		*/
		
		private static $UPPER_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		private static $LOWER_CHARS = "abcdefghijklmnopqrstuvwxyz";
		private static $NUMBERS = "0123456789";
		private static $SPECIAL_CHARS = "@#+-=_/%()[]{}$&!<>;.,?";

		private $password = "";

		private $chars = "";
		private $size = 8;


		/*
			METHODS
		*/
		public function __construct($size = NULL, $difficulty = PW_LOWER, $additionnal = '') {
			if($size != NULL)
				$this->size = $size;
			$this->setDifficulty($difficulty);
			if(!empty($additionnal) && is_string($additionnal))
				$this->chars .= $additionnal;
			for($i = 0; $i < $this->size; $i++) {
				$this->password .= $this->getChar();
			}
		}


		/*
			Name : setDifficulty
			params : $level = PW_LOWER
				$level is a binary veriable. 
				Can contain constants like PW_LOWER / PW_UPPER / PW_NUMBER / PW_SPECIAL
			Description : This function implement the variable $this->chars with
			all the chars you want.
		*/
		public function setDifficulty($level = PW_LOWER) {
			if(($level & PW_LOWER) == true)
				$this->chars .= self::$LOWER_CHARS;
			if(($level & PW_UPPER) == true)
				$this->chars .= self::$UPPER_CHARS;
			if(($level & PW_NUMBER) == true) 
				$this->chars .= self::$NUMBERS;
			if(($level & PW_SPECIAL) == true)
				$this->chars .= self::$SPECIAL_CHARS;
		}

		/*
			Name : getChar()
			params : -
			Description : Return an random char set in $this->chars.
		*/
		private function getChar() {
			return $this->chars[rand(0, strlen($this->chars) - 1)];
		}

		/*
			Name : getPassword()
			params : -
			Description : Return the password set.
		*/
		public function getPassword() { return $this->password; }

		/*
			Name : setPassword( $password = NULL)
			params : string $password
			Description : set the $password in $this->password.
		*/
		public function setPassword($password = NULL) {
			if(!isset($password) && !empty($password))
				die("Password not set.\n");
			$this->password = $password;
		}

		/*
			Name : sha1( $password = NULL )
			params : string $password
			Description : Encrypt the $password or $this->password (if $password not set) in sha1.
		*/
		public function sha1($password = NULL) {
			if(isset($password))
				return sha1($password);
			return sha1($this->password);
		}

		/*
			Name : md5( $password = NULL )
			params : string $password
			Description : Encrypt the $password or $this->password (is $password not set) in md5.
		*/
		public function md5($password = NULL) {
			if(isset($password))
				return md5($password);
			return md5($this->password);
		}

	}

	/*
		INIT
		---------------
		$password = new Password();
		$password = new Password(10);
		$password = new Password(10, PW_LOWER);
		$password = new Password(10, PW_LOWER | PW_NUMBER | PW_SPECIAL | PW_UPPER);
		$password = new Password(10, PW_LOWER | PW_NUMBER | PW_SPECIAL | PW_UPPER, 'àç!è§(=+/ù$€*_-"');

		echo $password->getPassword();
	*/


		$password = new Password(32, PW_UPPER | PW_LOWER | PW_SPECIAL | PW_LOWER);
		echo $password->getPassword();

?>
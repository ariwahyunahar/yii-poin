<?php
class endecript
{
	public function to_encript($input){
		$inputlen = strlen($input);// Counts number characters in string $input
	    $randkey = rand(1, 9); // Gets a random number between 1 and 9
	    $i = 0;
	    while ($i < $inputlen)
	    {
	        $inputchr[$i] = (ord($input[$i]) - $randkey);//encrpytion
	        $i++; // For the loop to function
	    }
		//Puts the $inputchr array togtheir in a string with the $randkey add to the end of the string
	    $encrypted = implode('.', $inputchr) . '.' . (ord($randkey)+50);
	    return $encrypted;
    }
    
}
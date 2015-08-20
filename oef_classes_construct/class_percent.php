<?php 

/**
* Deze constructor zet $absolute gelijk aan de waarde van $new / $unit
$relative gelijk aan de member $absolute – 1
$hundred gelijk aan $absolute * 100
$nominal gelijk aan:
'positive' wanneer $absolute groter is dan 1
'status-quo' wanneer $absolute gelijk is aan 1
'negative' wanneer $absolute kleiner is dan 1
Let op, alle getallen moeten met twee cijfers na de komma opgeslagen worden
Elk resultaat moet door de methode formatNumber passeren.
formatNumber (method, public) met één parameter: $number
Returnt het getal met twee getallen na de komma number_format()
*/
class Percent
{
	
	public $absolute = null;
	public $relative = null;
	public $hundred = null;
	public $nominal = null;	
		
	public function __construct ($new, $unit) 
	{
		$this->absolute = $this->formatNumber(abs($new / $unit));
		$this->relative = $this->formatNumber($this->absolute-1);
		$this->hundred = $this->formatNumber($this->absolute*100);
		$this->nominal = $this->determineThis($this->absolute);
	}

	public function determineThis($getal){
		$returnstring = '';

		if ($getal>1)
		{
			$returnstring = "positive";
		}elseif($getal<1){
			$returnstring= "negative";
		}else{
			$returnstring=  "status-quo";
		}
		return $returnstring;
	}

	public function formatNumber($getal) {
		return number_format((float)$getal, 2, '.', '');
	}
}

$getal = new Percent( 150, 100);
echo $getal->absolute; 
echo " ";
echo $getal->relative;
echo " ";
echo $getal->hundred;
echo " ";
echo $getal->nominal;

 ?>
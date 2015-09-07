<?php 


/**
* 
*/
		class W_DebugHelper 
		{
			//debugmode op 1 zetten om var_dumps te tonen.
			public static $debugmode = 1;
			
			public function __construct($debugmodevalue = 1)
			{
				//$this->debugmode = $debugmodevalue;
			}

			public function dump($mixed){
				if (self::$debugmode === 1){
					var_dump($mixed);
				}
				else{
					//not in debugmode... do nothing
				}
			}
		}

 ?>
<?php
class TT{
	private static $message_arr=[];
	private static $flas_arr=[];
	private static $flas_name_arr=[];
	public static function flag($name=false){	
		if($name){
			self::$flas_name_arr[$name][]=microtime(true);
		}else{
			self::$flas_arr[]=microtime(true);
		}
	}
	public static function setM($message){	
		self::$message_arr[]=$message;
	}
	public static function cut_time($flas_arr){
		$time=[];
		foreach($flas_arr as $key=>$val){
			if(isset($flas_arr[$key+1])){
				$time[]=$flas_arr[$key+1]-$flas_arr[$key];
			}
		}
		return $time;
	}
	public static function show($show_type=0){
		self::flag();
		$noname_time=false;
		$name_time=false;
		if(count(self::$flas_arr)>1)
			$noname_time=self::cut_time(self::$flas_arr);
		
		foreach(self::$flas_name_arr as $key=>$val){
			if(count($val)>1)
				$name_time[$key]=self::cut_time($val);
		}
		
		
		if($show_type==1){
			echo "<pre>";
			if($noname_time){
				echo "<br>---noname_time----<br>";
				var_dump($noname_time);
			}
			if($name_time){
				echo "<br>---name_time----<br>";
				var_dump($name_time);
			}
			if(count(self::$message_arr)>0){
				echo "<br>---message----<br>";
				var_dump(self::$message_arr);
			}
			echo "</pre>";
		}else if($show_type==2){	
			if($noname_time)
				echo "<script>console.log('noname_time',".json_encode($noname_time).")</script>";
			if($name_time)
				echo "<script>console.log('name_time',".json_encode($name_time).")</script>";
			foreach(self::$message_arr as $val){
				if(is_array($val)){
					$json=json_encode($val);
					echo "<script>console.log({$json})</script>";
				}else
					echo "<script>console.log('{$val}')</script>";
			}
		}
		
	}
}

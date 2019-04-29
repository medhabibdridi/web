<?php

class promocode
{
	//attributs
	protected $code;
	protected $pourcentage;
	protected $used;
	//constructeur


	function __construct($code,$pourcentage){
		$this->code=$code;
		$this->pourcentage=$pourcentage;
	}
  function getcode()
  {
    return $this->code;
  }
  function getpourcentage()
  {
    return $this->pourcentage;
  }
  public static function generer()
  {
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$res = "";
		for ($i = 0; $i < 7; $i++)
		{
		    $res .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		return $res;
	}

		  public static function all() {
		      $list = [];
		      $db = Db::getInstance();
		      $req = $db->query("SELECT * from promocode");
		      foreach ($req->fetchAll() as $temp) {
		          if ($temp['used']==0) {
								$promo = new promocode($temp['code'], $temp['pourcentage']);
			          $list[] = $promo;
		          }
							else {
								promocode::supprimer($temp['code']);
							}
		      }
		      return $list;
		  }
		  public function ajout() {
		    $sql="insert into promocode(code,pourcentage,used)"
		            ."values ('".$this->code."',".$this->pourcentage.",0)";
		    $db=Db::getInstance();
		    $req=$db->prepare($sql);
		    $req->execute();
		  }

			public static function supprimer($ids)
			{
					$sql="DELETE from promocode WHERE code='".$ids."'";
					$db=Db::getInstance();
					$req=$db->prepare($sql);
					$req->execute();
					return $req;
			}

		}


?>

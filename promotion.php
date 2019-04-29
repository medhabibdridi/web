<?php
class Promotion{
	//attributs
	protected $idProd;
	protected $idPromo;
	protected $pourcentage;
	protected $delai;
	//constructeur


	function __construct($idPromo,$pourcentage,$delai,$idProd){
		$this->idPromo=$idPromo;
		$this->idProd=$idProd;
		$this->pourcentage=$pourcentage;
		$this->delai=$delai;
	}
	function getidPromo(){
		return $this->idPromo;
	}
	function getidProd(){
		return $this->idProd;
	}
	function getpourcentage(){
		return $this->pourcentage;
	}
	function getdelai(){
		return $this->delai;
	}

        function getnameProd()
        {
            $db = Db::getInstance();
            $req = $db->query("SELECT nom from produits where id=".$this->idProd."");
            $a=$req->fetch();
            return $a['nom'];
            
        }
                function setIdProd($idProd) {
            $this->idProd = $idProd;
        }
        function setIdPromo($idPromo) {
            $this->idPromo = $idPromo;
        }
		public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT * from promotions");
        foreach ($req->fetchAll() as $temp) {
            $promo = new Promotion($temp['idPromo'], $temp['pourcentage'], $temp['delai'], $temp['idProduit']);
            $list[] = $promo;
        }
        return $list;
    }

		public static function showsingle($idm) {
			$db = Db::getInstance();
			$Rq="SELECT * FROM promotions WHERE idPromo=".$idm;
			$P=$db->query($Rq);
			return $P->fetch();
		}

    function ajouter()
        {
            $sql="insert into promotions(idProduit,pourcentage,delai)"
                    ."values (".$this->idProd.",'".$this->pourcentage."','".$this->delai."')";
            $db=Db::getInstance();
            $req=$db->prepare($sql);
            $req->execute();
            return $req;
        }
        public static function supprimer($idPromo)
        {
            $sql="DELETE from promotions WHERE idPromo=".$idPromo;
            $db=Db::getInstance();
            $req=$db->prepare($sql);
            $req->execute();
            return $req;
        }
        public static function modifier($idProduit,$pourcentage,$delai,$idPromo)
        {
            $sql="UPDATE promotions set idProduit=".$idProduit.", delai='".$delai."', pourcentage=".$pourcentage." WHERE idPromo=".$idPromo;
            $db=Db::getInstance();
            $req=$db->prepare($sql);
            $req->execute();
            return $req;
        }
				public static function Search($word)
		{
				$list = [];
				$db= Db::getInstance();
			 $req =$db->query ("SELECT * FROM promotions WHERE idProduit like '%".$word."%' or pourcentage like '%".$word."%' or delai like '%".$word."%' or idPromo like '%".$word."%' ");
			 foreach ($req->fetchAll() as $temp) {
					 $promo = new Promotion($temp['idPromo'], $temp['pourcentage'], $temp['delai'], $temp['idProduit']);
					 $list[] = $promo;
			 }
			 return $list;
		}
}


?>

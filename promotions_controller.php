    <?php



    class promotionsController {




        public function Display()
        {
            $Promotions= Promotion::all();
            require_once('views/pages/promotions.php');
        }
        public function delete()
        {
          if(isset($_GET['ids']))
          {
            promotion::supprimer($_GET['ids']);

            echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Promotion retirée avec
                <strong class='green'>succès</strong>
                </div>";
            $this->Display();
          }
        }
        public function Add()
        {
          if(isset($_POST['AjoutPromo'])){
        	$Promotions= new Promotion(NULL,$_POST['pourcentage'],$_POST['delai'],$_POST['idProduit']);
        	$Promotions->ajouter();
          echo "<div class='alert alert-block alert-success'>
                  <button type='button' class='close' data-dismiss='alert'>
                      <i class='ace-icon fa fa-times'></i>
                       </button>
                      <i class='ace-icon fa fa-check green'></i>
             Promotion ajoutée avec
              <strong class='green'>succès</strong>
              </div>";
          $this->Display();
          }
        }


        public function Edit()
        {
          if(isset($_GET['idm']))
          {
            $l=Promotion::showsingle($_GET['idm']);

            require_once('views/pages/EditPromo.php');
          }
        }

        public function Update()
        {
        	Promotion::modifier($_POST['idProd'],$_POST['pourcentage'],$_POST['delai'],$_POST['idPromo']);

          echo "<div class='alert alert-block alert-success'>
                  <button type='button' class='close' data-dismiss='alert'>
                      <i class='ace-icon fa fa-times'></i>
                       </button>
                      <i class='ace-icon fa fa-check green'></i>
             Promotion mise à jour avec
              <strong class='green'>succès</strong>
              </div>";
          $this->Display();
        }

        public function Search()
        {
            if (isset($_POST['Find']))
               $Promotions = Promotion::Search($_POST['Find']);
           else $Promotions = Promotion::all();
           require_once('views/pages/promotions.php');
       }

    }

    ?>

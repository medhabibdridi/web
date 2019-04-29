    <?php



    class promocodeController
    {

      public function Display()
      {
          $Promocodes= promocode::all();
          require_once('views/pages/promocode.php');
      }
      public function Add()
      {
          if(isset($_POST['ajoutpromocode']))
          {
            $Promocode= new promocode($_POST['code'],$_POST['pourcentage'],NULL);
            $Promocode->ajout();
            echo "<div class='alert alert-block alert-success'>
                  <button type='button' class='close' data-dismiss='alert'>
                      <i class='ace-icon fa fa-times'></i>
                       </button>
                      <i class='ace-icon fa fa-check green'></i>
             code promo ajouté avec
              <strong class='green'>succès</strong>
              </div>";
          $this->Display();
        }
      }

        public function delete()
        {
          if(isset($_GET['ids']))
          {
            promocode::supprimer($_GET['ids']);
            echo "<div class='alert alert-block alert-success'>
                  <button type='button' class='close' data-dismiss='alert'>
                      <i class='ace-icon fa fa-times'></i>
                       </button>
                      <i class='ace-icon fa fa-check green'></i>
             code promo supprimé avec
              <strong class='green'>succès</strong>
              </div>";
          $this->Display();
          }
        }



    }

    ?>

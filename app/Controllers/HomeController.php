<?php

namespace App\Controllers;


use App\Models\PersonAdmin;


class HomeController
{


    public function showHomePage()
    {
        $personData = new PersonAdmin();

        echo 'GET HOMECONTROLLER SHOWHOMEPAGE' . '<br>';


        foreach($personData->getPersons()->getPersonData() as $person){
            echo 'name: ' . $person->getName() .
                '; surname: ' . $person->getSurname() .
                '; personalCode: ' . $person->getPersonalCode() . '<br>';
        }

        require_once 'app/Views/home.php';
    }














    /*  public function submit() {
          echo 'submit';
          require_once 'app/Views/submit.php';
      }

      public function search() {
          echo 'search';
          require_once 'app/Views/search.php';
      }

      public function save() {
          echo 'saved';
          require_once 'app/Views/home.php';
      }

      public function displayFound()
      {
          echo 'found';
          require_once 'app/Views/found.php';
      } */
}





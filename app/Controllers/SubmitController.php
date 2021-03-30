<?php


namespace App\Controllers;


use App\Validations\ExportPersonValidation;
use App\Services\StoreRequest;
use App\Services\SubmitPersonService;

class SubmitController
{
    private SubmitPersonService $service;

    public function __construct(SubmitPersonService $service)
    {
        $this->service = $service;
    }


    public function showPage(): void
    {
        require_once __DIR__ . '/../../public/Views/submit.php';
    }

    public function savePerson(): void
    {
        $validation = new ExportPersonValidation();
        $request = new StoreRequest($_POST['name'], $_POST['surname'], $_POST['personalId'], $_POST['personality']);

        if ($validation->validatePost($_POST) &&
            !$this->service->getRepository()->checkPersonExists($request)) {
            $this->service->save($request);
        };

        header('Location:/');
    }

}


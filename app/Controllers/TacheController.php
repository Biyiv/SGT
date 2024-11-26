<?php

namespace App\Controllers;

use App\Models\TacheModel;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class TacheController extends BaseController
{
    protected $session;
    public function __construct()
    {
        helper('form');
        $this->session = session();
    }

    public function index(): string
    {
        $model = new TacheModel();

        $tri = $this->session->get('tri') == null ? "" : $this->session->get('tri');
        // Récupérer toutes les tâches, triées par échéance
        $data['taches'] = $model->getTaches($this->session->get('user'), $tri);
		$data['tri'] = $tri;

        // Charger la vue avec les données
        return view('menu', $data);
    }

	public function setTriPreference()
    {
        $session = session();

        $tri = $this->request->getPost('tri');
        if ($tri) {
            $session->set('tri', $tri);
        }

        return redirect()->to('/dashboard');
    }
}

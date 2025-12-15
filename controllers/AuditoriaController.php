<?php

class AuditoriaController extends Controller
{
    /* ============================================================
       📋 AUDITORÍA GENERAL
    ============================================================ */
    public function index()
    {
        $auditoria = $this->loadModel("Auditoria");

        return $this->render("auditoria/log", [
            "logs" => $auditoria->listar()
        ]);
    }
}

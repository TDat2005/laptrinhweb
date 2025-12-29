<?php
class PatientHomeController {

    public function index(): void {
        require_role(['patient']);
        render('patient/index', [
            'pageTitle' => 'Trang bệnh nhân'
        ]);
    }
}
<?php

namespace App\DAL\Repositories\MailerSetting\Interfaces;

interface IMailerSettingsRepository
{
    public function getSetting();
    public function updateOrCreate(array $data);
}

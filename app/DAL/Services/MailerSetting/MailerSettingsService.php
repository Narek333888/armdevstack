<?php

namespace App\DAL\Services\MailerSetting;

use App\DAL\Repositories\MailerSetting\Interfaces\IMailerSettingsRepository;
use App\Models\MailerSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MailerSettingsService
{
    private IMailerSettingsRepository $mailerSettingsRepository;

    public function __construct(IMailerSettingsRepository $mailerSettingsRepository)
    {
        $this->mailerSettingsRepository = $mailerSettingsRepository;
    }

    /**
     * @return Model|Builder|MailerSetting|null
     */
    public function getMailerSetting(): Model|Builder|MailerSetting|null
    {
        return $this->mailerSettingsRepository->getSetting();
    }

    /**
     * @param array $data
     * @return void
     */
    public function updateOrCreateMailerSetting(array $data): void
    {
        $this->mailerSettingsRepository->updateOrCreate($data);
    }
}

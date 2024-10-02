<?php

namespace App\Services\MailerSetting;

use App\Models\MailerSetting;
use App\Repositories\MailerSetting\Interfaces\IMailerSettingsRepository;
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

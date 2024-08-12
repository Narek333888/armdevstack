<?php

namespace App\DAL\Repositories\MailerSetting;

use App\DAL\Repositories\MailerSetting\Interfaces\IMailerSettingsRepository;
use App\Models\MailerSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Override;

class MailerSettingsRepository implements IMailerSettingsRepository
{
    /**
     * @return Model|Builder|MailerSetting|null
     */
    #[Override]
    public function getSetting(): Model|Builder|MailerSetting|null
    {
        return MailerSetting::query()
            ->where('unique_key', 'mailer_setting')
            ->first();
    }

    /**
     * @param array $data
     * @return MailerSetting|Builder|Model|null
     */
    #[Override]
    public function updateOrCreate(array $data): Model|Builder|MailerSetting|null
    {
        if ($data['uniqueKey'] !== 'mailer_setting')
            $data['uniqueKey'] = 'mailer_setting';

        return MailerSetting::query()->updateOrCreate(
            ['unique_key' => $data['uniqueKey']],
            [
                'mailer'       => $data['mailer'],
                'host'         => $data['host'],
                'port'         => $data['port'],
                'username'     => $data['username'],
                'password'     => $data['password'],
                'encryption'   => $data['encryption'],
                'from_name'    => $data['fromName'],
                'from_address' => $data['fromAddress'],
            ]
        );
    }
}

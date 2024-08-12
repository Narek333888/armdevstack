<?php

namespace App\Http\Requests\MailerSetting;

use App\Helpers\InputHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $mailer
 * @property string $host
 * @property int $port
 * @property string $username
 * @property string $password
 * @property string $encryption
 * @property string $fromName
 * @property string $fromAddress
 */
class MailerSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'uniqueKey'    => ['required', 'string'],
            'mailer'       => ['required', 'string'],
            'host'         => ['required', 'string'],
            'port'         => ['required', 'integer'],
            'username'     => ['required', 'string'],
            'password'     => ['required', 'string'],
            'encryption'   => ['required', 'string'],
            'fromName'     => ['required', 'string'],
            'fromAddress'  => ['required', 'string'],
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'mailer' => InputHelper::filter($this->mailer),
            'host' => InputHelper::filter($this->host),
            'port' => InputHelper::filter($this->port),
            'username' => InputHelper::filter($this->username),
            'password' => InputHelper::filter($this->password),
            'encryption' => InputHelper::filter($this->encryption),
            'fromName' => InputHelper::filter($this->fromName),
            'fromAddress' => InputHelper::filter($this->fromAddress),
        ]);
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'mailer.required' => __('mailer_settings.validation.mailer_required'),
            'host.required' => __('mailer_settings.validation.host_required'),
            'port.required' => __('mailer_settings.validation.port_required'),
            'username.required' => __('mailer_settings.validation.username_required'),
            'password.required' => __('mailer_settings.validation.password_required'),
            'encryption.required' => __('mailer_settings.validation.encryption_required'),
            'fromName.required' => __('mailer_settings.validation.from_name_required'),
            'fromAddress.required' => __('mailer_settings.validation.from_address_required'),

            'port.integer' => __('mailer_settings.validation.port_integer'),
        ];
    }
}

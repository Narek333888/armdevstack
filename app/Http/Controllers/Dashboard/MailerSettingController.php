<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailerSetting\MailerSettingRequest;
use App\Services\MailerSetting\MailerSettingsService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class MailerSettingController extends Controller
{
    private MailerSettingsService $mailerSettingsService;

    /**
     * @param MailerSettingsService $mailerSettingsService
     */
    public function __construct(MailerSettingsService $mailerSettingsService)
    {
        $this->mailerSettingsService = $mailerSettingsService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $mailerSetting = $this->mailerSettingsService->getMailerSetting();

        return view('dashboard.admin.mailer-settings.index', [
            'mailerSetting' => $mailerSetting,
        ]);
    }

    /**
     * @param MailerSettingRequest $request
     * @return RedirectResponse
     */
    public function updateOrCreate(MailerSettingRequest $request): RedirectResponse
    {
        $this->mailerSettingsService->updateOrCreateMailerSetting($request->validated());

        return redirect()->back()->with(['success' => __('mailer-settings.alert.updated_successfully')]);
    }
}

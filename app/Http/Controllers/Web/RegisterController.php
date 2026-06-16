<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\WebRegisterRequest;
use App\Repositories\WebRegisterRepository;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class RegisterController extends AppBaseController
{
    /** @var WebRegisterRepository */
    private $webRegisterRepository;

    public function __construct(WebRegisterRepository $webRegisterRepository)
    {
        $this->webRegisterRepository = $webRegisterRepository;
    }

    /**
     * @return Factory|View
     */
    public function candidateRegister(): View
    {
        $isGoogleReCaptchaEnabled = $this->webRegisterRepository->getSettingForReCaptcha();

        return view('front_web.auth.candidate_register', compact('isGoogleReCaptchaEnabled'));
    }

    /**
     * @return Factory|View
     */
    public function employerRegister(): View
    {
        $isGoogleReCaptchaEnabled = $this->webRegisterRepository->getSettingForReCaptcha();

        return view('front_web.auth.employer_register', compact('isGoogleReCaptchaEnabled'));
    }

    /**
     * @throws \Throwable
     */
    public function register(WebRegisterRequest $request): JsonResponse
    {
        $input = $request->all();
        $user = $this->webRegisterRepository->store($input);

        \Illuminate\Support\Facades\Auth::login($user);

        $userType = ($input['type'] == 1) ? __('messages.notification_settings.candidate') : __('messages.company.employer');
        $redirectUrl = ($input['type'] == 1)
            ? route('dashboard')
            : route('employer.dashboard');
        Flash::success(__('messages.flash.registration_done'));

        return $this->sendResponse([
            'redirect_url' => $redirectUrl,
        ], "{$userType} ".__('messages.flash.registration_done'));
    }
}

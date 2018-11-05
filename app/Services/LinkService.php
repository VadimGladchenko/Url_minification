<?php

namespace App\Services;


use App\Exceptions\LinkServiceException;
use App\Models\Transition;
use App\Models\Url;
use App\Services\Interfaces\LinkServiceInterface;
use App\Tools\DatePostpone;
use App\Tools\RedirectObserver;
use App\Tools\StringGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class LinkService implements LinkServiceInterface
{
    protected const SHORT_LINK_LENGTH = 4;

    /**
     * @param $baseUrl
     * @param $customUrl
     * @param $datePostpone
     * @return array
     * @throws LinkServiceException
     */
    public function createShortLink($baseUrl, $customUrl, $datePostpone)
    {
        if (empty($customUrl) && empty($datePostpone)) {
            $linkWithCurrentUrl = Url::where([
                ['base_url', $baseUrl],
                ['is_custom', false],
                ['expired_date', null],
            ])->first();

            if (!empty($linkWithCurrentUrl)) {
                return ['status' => 'success',
                    'short_url' => url("/{$linkWithCurrentUrl->short_url}"),
                    'statistic_url' => url("/statistic/{$linkWithCurrentUrl->short_url}"),
                ];
            }
        }

        if (!empty($customUrl)) {
            if (Url::isShortUrlExist($customUrl)) {
                throw new LinkServiceException(LinkServiceException::LINK_ALREADY_EXIST);
            } else {
                $shortUrl = $customUrl;
                $isCustom = true;
            }
        } else {
            $shortUrl = $this->mGenerateNewUrl();
            $isCustom = false;
        }

        $expiredDate = null;

        if (!empty($datePostpone)) {
            $expiredDate = DatePostpone::getDateWithDelay($datePostpone);
        }

        $link = Url::create([
            'base_url' => $baseUrl,
            'short_url' => $shortUrl,
            'expired_date' => $expiredDate,
            'is_custom' => $isCustom,
        ]);

        return ['status' => 'success',
            'short_url' => url("/{$link->short_url}"),
            'statistic_url' => url("/statistic/{$link->short_url}"),
        ];
    }

    /**
     * @param $path
     * @return object
     * @throws LinkServiceException
     */
    public function tryToRedirect($path)
    {
        $url = Url::where('short_url', $path)->first();

        if (empty($url)) {
            throw new LinkServiceException(LinkServiceException::URL_NOT_FOUND);
        }

        if (!empty($url->expired_date)) {
            $now = Carbon::now();

            if ($now > $url->expired_date) {
                throw new LinkServiceException(LinkServiceException::URL_WAS_EXPIRED);
            }
        }

        RedirectObserver::gatherInfo($url, request());

        return Redirect::to($url->base_url);
    }

    /**
     * @param $path
     * @return array
     * @throws LinkServiceException
     */
    public function getStatistic($path)
    {
        $url = Url::where('short_url', $path)->first();

        if (empty($url)) {
            throw new LinkServiceException(LinkServiceException::URL_NOT_FOUND);
        }

        $transitions = Transition::where('url_id', $url->id)->get();

        return $this->mPrepareStatistic($transitions);
    }

    private function mGenerateNewUrl()
    {
        $length = self::SHORT_LINK_LENGTH;
        $attempt = 0;

        do {
            $url = StringGenerator::generate($length);

            if ($attempt++ > 20) {
                //there is a very high probably that almost all links of this length are occupied
                //and we need to increase url's length
                $length++;
            }
        } while (Url::isShortUrlExist($url));

        return $url;
    }

    private function mPrepareStatistic($transitions)
    {
        $result = [
            'browsers' => array(),
            'countries' => array(),
            'operating_systems' => array(),
            'count' => count($transitions),
        ];

        foreach ($transitions as $transition) {
            $currBrowser = $transition->browser;
            array_key_exists($currBrowser, $result['browsers'])
                ? $result['browsers'][$currBrowser] = ++$result['browsers'][$currBrowser]
                : $result['browsers'][$currBrowser] = 1;

            $currCountry = $transition->country;
            array_key_exists($currCountry, $result['countries'])
                ? $result['countries'][$currCountry] = ++$result['countries'][$currCountry]
                : $result['countries'][$currCountry] = 1;

            $currOS = $transition->operating_system;
            array_key_exists($currOS, $result['operating_systems'])
                ? $result['operating_systems'][$currOS] = ++$result['operating_systems'][$currOS]
                : $result['operating_systems'][$currOS] = 1;
        }

        return $result;
    }
}
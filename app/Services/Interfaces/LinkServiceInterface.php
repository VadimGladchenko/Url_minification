<?php
namespace App\Services\Interfaces;

use App\Exceptions\LinkServiceException;


interface LinkServiceInterface
{
    /**
     * @param $baseUrl
     * @param $customUrl
     * @param $datePostpone
     * @throws LinkServiceException
     */
    public function createShortLink($baseUrl, $customUrl, $datePostpone);

    /**
     * @param $path
     * @throws LinkServiceException
     */
    public function tryToRedirect($path);

    /**
     * @param $path
     * @throws LinkServiceException
     */
    public function getStatistic($path);
}
<?php

namespace App\Http\Controllers;


use App\Exceptions\LinkServiceException;
use App\Services\Interfaces\LinkServiceInterface;
use App\Tools\DatePostpone;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    private $linkService;


    public function __construct(LinkServiceInterface $linkService)
    {
        $this->linkService = $linkService;
    }

    public function index()
    {
        return view('pages.index')->with(['postpones' => DatePostpone::getDelayNames()]);
    }

    public function createShortLink(Request $request)
    {
        $this->validate($request, [
            'base_url' => 'required|max:255',
            'short_url' => 'nullable|max:255',
            'expired_date' => 'nullable|numeric',
        ]);

        try {
            return $this->linkService->createShortLink($request['base_url'], $request['short_url'], $request['expired_date']);
        } catch (LinkServiceException $e) {
            if ($e->getCode() == 200) {
                return ['status' => 'error',
                    'message' => $e->getMessage()];
            }

            return view('pages.error')->with(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }

    public function tryToRedirect($path)
    {
        try {
            return $this->linkService->tryToRedirect($path);
        } catch (LinkServiceException $e) {
            if ($e->getCode() == 200) {
                return ['status' => 'error',
                    'message' => $e->getMessage()];
            }

            return view('pages.error')->with(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

    }

    public function statistic($path)
    {
        try {
            $statistic = $this->linkService->getStatistic($path);
            return view('pages.statistic')->with('statistic', json_encode($statistic));
        } catch (LinkServiceException $e) {
            if ($e->getCode() == 200) {
                return ['status' => 'error',
                    'message' => $e->getMessage()];
            }

            return view('pages.error')->with(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }
}
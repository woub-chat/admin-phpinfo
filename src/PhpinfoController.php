<?php

namespace Admin\Extend\AdminPhpinfo;

use Admin\Delegates\Buttons;
use Admin\Delegates\Card;
use Admin\Delegates\CardBody;
use Admin\Delegates\ChartJs;
use Admin\Delegates\ModelTable;
use Admin\Delegates\SearchForm;
use Admin\Delegates\StatisticPeriod;
use Admin\Page;
use Admin\Controllers\Controller;
use Lar\Layout\Respond;

class PhpinfoController extends Controller
{
    public function index(
        Page $page,
        Card $card,
        CardBody $cardBody,
        StatisticPeriod $statisticPeriod,
        ChartJs $chartJs,
        SearchForm $searchForm,
        ModelTable $modelTable,
        Buttons $buttons,
    ) {

        //dd($this->toInfoCollection());

        $info = $this->toInfoCollection();

        return $page->card(
            $card->title('PHP\'s configuration'),
            $card->view('bfg-admin-phpinfo-extension::phpinfo', compact('info')),
        );
    }

    public function toInfoCollection(): \Illuminate\Support\Collection
    {
        ob_start();

        phpinfo();

        $phpinfo = ['phpinfo' => collect()];

        if (preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER)) {

            collect($matches)->each(function ($match) use (&$phpinfo) {
                if (strlen($match[1])) {
                    $phpinfo[$match[1]] = collect();

                } elseif (isset($match[3])) {
                    $keys = array_keys($phpinfo);

                    $phpinfo[end($keys)][$match[2]] = isset($match[4]) ? collect([$match[3], $match[4]]) : $match[3];
                } else {
                    $keys = array_keys($phpinfo);

                    $phpinfo[end($keys)][] = $match[2];
                }
            });
        }

        ob_end_clean();

        return collect($phpinfo);
    }
}
